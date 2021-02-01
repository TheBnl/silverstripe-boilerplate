<?php

namespace XD\Basic\Extensions;

use SilverStripe\Assets\Image;
use SilverStripe\ORM\ArrayList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\ORM\FieldType\DBHTMLText;

/**
 * Class ImageExtension
 * @property Image|ImageExtension owner
 */
class ImageExtension extends DataExtension
{
    private static $casting = [
        'Intrinsic' => 'HTMLText',
    ];

    public function WebP()
    {
        // todo add webp conversion
        // find a way to change file extension from jpg to webp while maintaining silverstipe asset variants
        return $this->owner;
    }

    /**
     * Start of image optimisation strategy.
     * ToDo: image sets (responsive images), and lazy loading.
     */
    public function PaddingBottom()
    {
        // Get padding ratio for use with this technique: http://www.smashingmagazine.com/2013/09/16/responsive-images-performance-problem-case-study/
        // Mostly copied from https://github.com/Moosylvania/SilverStripe-Responsive-Image/blob/master/code/ResponsiveImage.php
        // Use in templates like style='padding-bottom:{$PaddingBottom}%'
        $w = $this->owner->getWidth();
        $h = $this->owner->getHeight();
        if (!$w || !$h) {
            return false;
        }
        $ratio = $h / $w;

        return round($ratio * 100, 10);
    }

    /**
     * Return markup for intrinsic ratio image.
     *
     * @param bool $lazy
     * @param string $wrapperElement
     * @return DBHTMLText
     */
    public function Intrinsic($lazy = false, $wrapperElement = 'div')
    {
        $image = $this->owner;
        if (!$image && $this->owner->record instanceof Image) {
            $image = $this->owner->record;
        }

        return $image->renderWith('DBFile_imageIntrinsic', [
            'WrapperElement' => $wrapperElement,
            'ImageTag' => $this->owner->renderWith('DBFile_image', [
                'Lazy' => $lazy
            ])
        ]);
    }

    public function IntrinsicSrcSet($minWidth, $maxWidth, $resizeMode = 'ScaleWidth', $minHeight = null, $color = null, $lazy = false, $stepMultiplier = 1.2, $wrapperElement = 'div')
    {
        return $this->owner->renderWith('DBFile_imageIntrinsic', [
            'WrapperElement' => $wrapperElement,
            'ImageTag' => $this->SrcSet($minWidth, $maxWidth, $resizeMode, $minHeight, $color, $lazy, $stepMultiplier)
        ]);
    }

    /**
     * Generate an img tag with a range of options
     * Increase the width by set percent until max width reached.
     *
     * @param $minWidth
     * @param $maxWidth
     * @param string $resizeMode
     * @param null $minHeight
     * @param null $color
     * @param bool $lazy
     * @param float $stepMultiplier
     * @return bool|DBHTMLText|null
     */
    public function SrcSet($minWidth, $maxWidth, $resizeMode = 'ScaleWidth', $minHeight = null, $color = null, $lazy = false, $stepMultiplier = 1.2)
    {
        if ((int) $minWidth < 1 || (int) $maxWidth < 1 || $this->owner->getWidth() < 1) {
            return false;
        }
        $images = ArrayList::create();
        // Generate the images, starting with the minimum
        $width = $minWidth;

        // Prevent loss of resampled image. Workaround for https://github.com/silverstripe/silverstripe-assets/commit/03d38f2a817f970b6e75cc6a44e784b0e2e9eae4
        $backend = $this->owner->getImageBackend();
        $originalResource = $backend->getImageResource();
        $resource = $originalResource;

        while ($width < $maxWidth && $width < $this->owner->getWidth()) {
            $images->push($this->owner->$resizeMode($width, $minHeight, $color));
            $width = ceil($width * $stepMultiplier);
            $backend->setImageResource($resource);
        }
        // Add an image set at max width
        $images->push($this->owner->$resizeMode($maxWidth, $minHeight, $color));

        // Reset the resource
        $backend->setImageResource($originalResource);

        // Render as an img tag
        if ($images->count()) {
            return $images->renderWith('DBFile_imageSrcSet', [
                'Lazy' => $lazy
            ]);
        }

        return null;
    }
}
