<?php
/**
 * Class TestIntegrationCase
 *
 * @package TestIntegration
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaIntegrationTest;

use MisaCore\Application\Config\Autoload;
use MisaCore\Application\Config\LoadConfig;
use MisaCore\Application\Factory\MisaFactory;
use MisaCore\Application\Factory\ServiceMng;
use PHPUnit_Framework_TestCase;

class TestIntegrationCase extends PHPUnit_Framework_TestCase
{
    /** @var ServiceMng  */
    private static $factory;

    public static function setUpBeforeClass()
    {
        $path = realpath(__DIR__.'/../../../config').'/autoload/{{,*.}global,{,*.}local}.php';
        $config = LoadConfig::get($path);
        Autoload::set($config);
        self::$factory = MisaFactory::getInstance();
    }

    /**
     * @return ServiceMng
     */
    public function factory()
    {
        return self::$factory;
    }
}
