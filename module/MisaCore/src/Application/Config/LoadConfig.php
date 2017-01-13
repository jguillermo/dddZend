<?php
/**
 * Class LoadConfig
 *
 * @package MisaCore\Application\Config
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCore\Application\Config;

use Zend\Config\Factory as ConfigFactory;
use Zend\Stdlib\ArrayUtils;
use Zend\Stdlib\Glob;

class LoadConfig
{
    public static function get($path)
    {
        $config = [];
        foreach (Glob::glob($path, Glob::GLOB_BRACE) as $file) {
            $configFile = ConfigFactory::fromFile($file);
            $config = ArrayUtils::merge($config, $configFile);
        }
        return $config;
    }
}
