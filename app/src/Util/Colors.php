<?php

namespace XD\Basic\Util;

use Heyday\ColorPalette\Fields\ColorPaletteField;
use Heyday\ColorPalette\Fields\GroupedColorPaletteField;
use SilverStripe\Core\Config\Configurable;

class Colors
{
    use Configurable;

    /**
     * Get an array of available site colors
     * @var array
     */
    private static $colors = [];

    public static function getColors()
    {
        return self::config()->get('colors');
    }

    /**
     * Return the colors as a flattend list
     * Allows translation of color values to readable strings
     */
    public static function getColorsList()
    {
        $colors = self::config()->get('colors');
        $flatColors = [];
        foreach ($colors as $key => $colorOrGroup) {
            if (is_array($colorOrGroup)) {
                foreach ($colorOrGroup as $key => $color) {
                    $flatColors[$key] = _t(__CLASS__ . ".$color", $color);
                }
            } else {
                $flatColors[$key] = _t(__CLASS__ . ".$colorOrGroup", $colorOrGroup);
            }
        }

        return $flatColors;
    }

    /**
     * Utility for generating a color field with the configured site colors
     *
     * @param $field
     * @param null $label
     * @return GroupedColorPaletteField|ColorPaletteField
     */
    public static function getField($field, $label = null)
    {
        $colors = self::getColors();
        if (count(array_filter($colors, 'is_array'))) {
            return GroupedColorPaletteField::create($field, $label ?: _t(__CLASS__ . '.Color', 'Color'), $colors)
                ->setHasEmptyDefault(true);
        } else {
            return ColorPaletteField::create($field, $label ?: _t(__CLASS__ . '.Color', 'Color'), $colors)
                ->setHasEmptyDefault(true);
        }
    }

    /**
     * Get a random color
     *
     * @return mixed
     */
    public static function getRandom()
    {
        $colors = array_keys(self::getColors());
        $random = rand(0, count($colors) - 1);
        return $colors[$random];
    }
}
