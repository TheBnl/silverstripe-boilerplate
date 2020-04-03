<?php

namespace XD\Basic\Blocks;

use DNADesign\Elemental\Models\BaseElement;
use XD\Basic\Extensions\EmbedableVideo;

/**
 * Class VideoBlock
 * Enable this block by editing Page.disallowed_elements in elemental.yml
 *
 * @package Viva\Basic\Blocks
 * @mixin EmbedableVideo
 */
class VideoBlock extends BaseElement
{
    private static $table_name = 'Blocks_VideoBlock';

    private static $singular_name = 'Video Block';

    private static $plural_name = 'Video Blocks';

    private static $icon = 'font-icon-block-media';

    private static $extensions = [
        EmbedableVideo::class
    ];

    public function getType()
    {
        return _t(__CLASS__ . '.BlockType', 'Video');
    }

    protected function provideBlockSchema()
    {
        $blockSchema = parent::provideBlockSchema();
        $blockSchema['content'] = $this->VideoURL;

        if (($image = $this->VideoPreview()) && $image->exists()) {
            $blockSchema['fileURL'] = $image->CMSThumbnail()->getURL();
            $blockSchema['fileTitle'] = $image->Title;
        }

        return $blockSchema;
    }


}