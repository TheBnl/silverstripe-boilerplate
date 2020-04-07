<?php

namespace XD\Basic\Tasks;

use Psr\Log\LoggerInterface;
use SilverStripe\Core\Config\Config;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Dev\BuildTask;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\DB;

class VersionTruncator extends BuildTask
{
    protected $enabled = true;

    protected $title = 'Truncate versions task';

    protected $description = 'Truncate unused versions';

    /**
     * Configure this with class names you want to clean, e.g.
     * XD\Basic\Tasks\VersionTruncator:
     *   clean_tables:
     *     - SilverStripe\Assets\Image
     *
     * @var array
     */
    private static $clean_tables = [];

    function run($request)
    {
        $this->log('Start cleaning tables');
        foreach (Config::inst()->get(__CLASS__, 'clean_tables') as $cleanClass) {
            $cleanObj = singleton($cleanClass);
            if (!($cleanObj instanceof DataObject)) {
                $this->log("Skip $cleanClass not a DataObject");
                break;
            }

            $tableName = DataObject::getSchema()->tableName($cleanClass);
            $baseTableName = DataObject::getSchema()->baseDataTable($cleanClass);

            $cleanTables = [];
            if ($tableName !== $baseTableName) {
                $ancestry = $cleanObj->getClassAncestry();
                foreach ($ancestry as $ancestorClass) {
                    if ($ancestorTable = DataObject::getSchema()->tableName($ancestorClass)) {
                        $cleanTables[] = $ancestorTable;
                    }
                }
            } else {
                $cleanTables = [$baseTableName];
            }

            if ($tableName) {
                $this->log("Clean $tableName table");
                $cleanIds = DB::query("SELECT ID FROM $tableName");
                foreach( $cleanIds as $obj ){
                    $this->clean($cleanTables, $baseTableName, $obj['ID']);
                }

                $this->log("Ready cleaning $tableName table");
                $this->log("Optimize {$tableName}_Versions table");
                DB::query("OPTIMIZE TABLE {$tableName}_Versions");
                $this->log("Ready optimizing {$tableName}_Versions table");
            }
        }

        $this->log("Finished truncation task");
        exit();
    }

    public function clean($tables, $baseTable, $id) {
        $liveVersion = DB::query("SELECT Version FROM {$baseTable}_Live WHERE ID=$id")->value();
        $draftVersion = DB::query("SELECT Version FROM {$baseTable} WHERE ID=$id")->value();
        $excludeVersions[$liveVersion] = $liveVersion;
        $excludeVersions[$draftVersion] = $draftVersion;
        $excluded = implode(',', array_filter($excludeVersions));
        foreach ($tables as $table) {
            $this->log("Cleaning $table [$id] exclude ($excluded)");
            DB::query("DELETE FROM {$table}_Versions WHERE RecordID=$id AND Version NOT IN($excluded)");
        }
    }

    /**
     * @param string $message
     * @param string $level
     */
    public function log($message, $level = 'info')
    {
        echo $message . PHP_EOL;
        Injector::inst()->get(LoggerInterface::class)->$level($message);
    }
}
