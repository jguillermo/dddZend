<?php

namespace MisaCore\Domain\Base\Enum;

/**
 * AbstractEnum class
 *
 * @package Domain
 * @subpackage Base\Enum
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

abstract class AbstractEnum
{
    /** @var array */
    private static $constCacheArray = null;

    /**
     * Return all Constants
     *
     * @return array
     */
    protected static function getConstants()
    {
        if (self::$constCacheArray == null) {
            self::$constCacheArray = [];
        }

        $calledClass = get_called_class();

        if (! array_key_exists($calledClass, self::$constCacheArray)) {
            $reflect = new \ReflectionClass($calledClass);
            self::$constCacheArray[$calledClass] = $reflect->getConstants();
        }

        return self::$constCacheArray[$calledClass];
    }

    /**
     * Get Enum value
     *
     * @param string $name
     * @return null|string
     */
    public static function getValue($name)
    {
        $constants = self::getConstants();

        return $constants[strtoupper($name)];
    }

    /**
     * Check if enum name is valid
     *
     * @param  string  $name
     * @param  boolean $strict
     * @return boolean
     */
    public static function isValidName($name, $strict = false)
    {
        $constants = self::getConstants();

        if ($strict) {
            return array_key_exists($name, $constants);
        }

        $keys = array_map('strtolower', array_keys($constants));

        return in_array(strtolower($name), $keys);
    }

    /**
     * Check if enum value is valid
     *
     * @param  mixed   $value
     * @param  boolean $strict
     * @return boolean
     */
    public static function isValidValue($value, $strict = true)
    {
        $values = array_values(self::getConstants());

        return in_array($value, $values, $strict);
    }
}
