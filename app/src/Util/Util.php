<?php

namespace XD\Basic\Util;

use SilverStripe\ORM\DataObject;

/**
 * Class Util
 *
 * @author Bram de Leeuw
 */
class Util
{
    /**
     * Get the enum values in a friendly displayable way
     * Looks for a translation under the given class.
     *
     * For example getting the enum Example (Enum("ONE,TWO", "ONE")) from class XD\ExampleClass
     * calling: XD\Util::friendlyEnum('XD\ExampleClass', 'Example')
     * will return: ['One','Two']
     *
     * First it looks for translations under:
     * XD\ExampleClass:
     *   Example_ONE: 'One'
     *   Example_TWO: 'Two'
     *
     * If no translation is found it wil lowercase the string and uppercase the first value
     * Except for numeric enum values
     *
     * @param DataObject $class
     * @param string $enum
     * @return array
     */
    public static function friendlyEnum(DataObject $class, $enum)
    {
        return array_map(function ($value) use ($class, $enum) {
            $fallback = is_numeric($value) ? $value : ucfirst(strtolower($value));
            return _t(get_class($class) . ".{$enum}_{$value}", $fallback);
        }, $class::singleton()->dbObject($enum)->enumValues());
    }

    /**
     * Creates a CSS class name
     */
    public static function cssClassName($class) {
        return strtolower(preg_replace('/([a-zA-Z])(?=[A-Z])/', '$1-', $class));
    }
}