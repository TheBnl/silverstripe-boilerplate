<?php

namespace XD\Basic;

use SilverStripe\ORM\DataExtension;

/**
 * Class ImageExtension
 */
class ImageExtension extends DataExtension
{
    /**
     * Generate a scr set for responsive image rendering.
     *
     * @param int $minWidth The starting point for generating the set's range
     * @param int $maxWidth Where set's range should end
     * @param int $increment The steps in between
     * @param string $resizeMode Set a different resizing mode
     * @param null $minHeight When using a method like Fill set the height relative to the min width
     * @param null $color When using Pad, optionally set the color here
     *
     * @return string
     */
    public function ScrSet($minWidth = 600, $maxWidth = 1200, $increment = 200, $resizeMode = 'ScaleWidth', $minHeight = null, $color = null)
    {
        $ratio = $minHeight / $minWidth;
        $values = range($minWidth, $maxWidth, $increment);
        if ($this->owner->exists()) {
            return implode(', ', array_map(function ($value) use ($resizeMode, $ratio, $color) {
                $height = $ratio * $value;
                return "{$this->owner->{$resizeMode}($value, $height, $color)->Link()} {$value}w";
            }, $values));
        }

        return null;
    }
}