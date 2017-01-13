<?php
/**
 * Singleton Class
 *
 * @package MisaCore\Application\Pattern
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016
 */
namespace MisaCore\Application\Pattern;

abstract class Singleton
{
    private static $instances;
    final public static function getInstance()
    {
        $className = get_called_class();
        if (isset(self::$instances[$className]) == false) {
            self::$instances[$className] = static::newInstance();
        }
        return self::$instances[$className];
    }
    protected static function newInstance()
    {
        return;
    }
}
