<?php
namespace MisaCore\Application\Config;

use MisaCore\Domain\Base\Exception\ConfigErrorException;

/**
 * Autoload Class
 *
 * @package MisaCore\Application
 * @subpackage Config
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class Autoload
{
    private static $config;

    public static function set(array $config)
    {
        self::$config = $config;
    }

    public static function get()
    {
        return self::$config;
    }

    public static function getByKey($key)
    {
        if (! isset(self::$config[$key])) {
            throw new ConfigErrorException("no existe  el autoload {$key}");
        }
        return self::$config[$key];
    }

    public static function add($key, $value)
    {
        self::$config[$key] = $value;
    }
}
