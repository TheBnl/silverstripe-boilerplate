<?php

namespace XD\Basic\Blocks;

use DNADesign\Elemental\Models\BaseElement;
use SilverStripe\Forms\Tab;
use SilverStripe\SiteConfig\SiteConfig;
use Symbiote\Addressable\Addressable;
use Symbiote\Addressable\Geocodable;
use XD\Basic\Extensions\EmbedableVideo;

/**
 * Class MapBlock
 * Enable this block by editing Page.disallowed_elements in elemental.yml
 *
 * @package Viva\Basic\Blocks
 */
class MapBlock extends BaseElement
{
    private static $table_name = 'Blocks_MapBlock';

    private static $singular_name = 'Map Block';

    private static $plural_name = 'Map Blocks';

    private static $icon = 'font-icon-block-globe';

    private static $extensions = [
        Addressable::class,
        Geocodable::class,
    ];

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Map');
    }

    public function getCMSFields()
    {
        $field = parent::getCMSFields();
        /** @var Tab $addressFields */
        $addressFields = $field->fieldByName('Root.Address');
        $field->removeByName($addressFields->Fields()->column('Name'));
        $field->addFieldsToTab('Root.Main', $addressFields->Fields()->toArray());
        return $field;
    }

    /**
     * Get the configured address or the address from the site config
     *
     * @return string
     */
    public function getActiveEmbedLink()
    {
        if ($this->Address && $address = $this->getGoogleMapsEmbedLink()) {
            return $address;
        }

        $config = SiteConfig::current_site_config();
        return $config->getGoogleMapsEmbedLink();
    }

    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        if ($this->Address) {
            $blockSchema['content'] = $this->getFormattedAddress();
        } else {
            $config = SiteConfig::current_site_config();
            $blockSchema['content'] = $config->getFormattedAddress();
        }

        return $blockSchema;
    }
}
