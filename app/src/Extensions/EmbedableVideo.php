<?php

namespace XD\Basic\Extensions;

use Exception;
use GuzzleHttp\Exception\GuzzleException;
use SilverStripe\Assets\Image;
use SilverStripe\Control\Controller;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\DataObject;
use SilverStripe\ORM\FieldType\DBHTMLText;
use SilverStripe\ORM\ValidationException;
use SilverStripe\View\Embed\EmbedContainer;
use SilverStripe\View\Parsers\URLSegmentFilter;
use XD\Basic\Models\VideoPreview;

/**
 * Class EmbedableVideo
 * @package XD\Basic\Extensions
 * @property DataObject|EmbedableVideo $owner
 *
 * @property string VideoURL
 * @property string EmbedCode
 * @property int VideoPreviewID
 *
 * @method VideoPreview VideoPreview()
 */
class EmbedableVideo extends DataExtension
{
    private static $db = [
        'VideoURL' => 'Varchar',
        'EmbedCode' => 'HTMLText'
    ];

    private static $has_one = [
        'VideoPreview' => Image::class
    ];

    private static $owns = [
        'VideoPreview'
    ];

    public function updateCMSFields(FieldList $fields)
    {
        $fields->removeByName('EmbedCode');
    }

    public function onBeforeWrite()
    {
        parent::onBeforeWrite();

        if ($this->owner->isChanged('VideoURL', DataObject::CHANGE_VALUE) || (!$this->owner->VideoPreviewID && $this->owner->VideoURL)) {
            if ($container = $this->getEmbedContainer()) {
                $extractor = $container->getExtractor();
                $this->owner->EmbedCode = $extractor->code->html;
            }
            try {
                $this->owner->savePreview();
            } catch (Exception $e) {
                // soft fail
            } catch (GuzzleException $e) {
                // soft fail
            }
        }
    }

    public function getPreview()
    {
        $preview = $this->owner->VideoPreview();
        $this->owner->extend('updateVideoPreview', $preview);
        return $preview;
    }

    public function getAjaxEmbedLink()
    {
        $className = str_replace('\\', '_', $this->owner->ClassName);
        return Controller::join_links('embed', $className, $this->owner->ID);
    }

    /**
     * Get the Video Resource from the given URL
     *
     * @return EmbedContainer
     */
    public function getEmbedContainer()
    {
        return EmbedContainer::create($this->owner->VideoURL);
    }

    /**
     * Get the embed code
     *
     * @return null|DBHTMLText
     */
    public function getVideo()
    {
        /** @var EmbedContainer $resource */
        if (!$this->owner->VideoURL) return null;
        if ($this->owner->EmbedCode) {
            $html = new DBHTMLText();
            $html->setValue(
                '<div class="responsive-embed widescreen">' . $this->owner->EmbedCode . '</div>'
            );
            return $html;
        }
        return null;
    }

    /**
     * Save a preview image
     *
     * @return VideoPreview|null
     * @throws ValidationException
     * @throws GuzzleException
     */
    public function savePreview()
    {
        if (($container = $this->owner->getEmbedContainer()) && $url = $container->getPreviewURL()) {
            $url = str_replace('hqdefault', 'maxresdefault', $url); // get large image instead of small one
            $filter = URLSegmentFilter::create();
            $fileTitle = $container->getExtractor()->providerName . ': ' . $container->getExtractor()->authorName . ' - ' . $container->getExtractor()->title;
            $fileName = $filter->filter($fileTitle) . '.jpg';
            $preview = VideoPreview::create();
            $preview->Title = $fileTitle;
            $preview->download($url, $fileName);
            $preview->write();
            $preview->publishSingle();
            $this->owner->VideoPreviewID = $preview->ID;
            return $preview;
        }

        return null;
    }
}
