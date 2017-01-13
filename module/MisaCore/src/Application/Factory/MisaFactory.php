<?php
/**
 * Class MisaFactory
 *
 * @package MisaCore\Application\Factory
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCore\Application\Factory;

class MisaFactory
{
    private static $instance;

    /**
     * MisaFactory constructor.
     */
    private function __construct()
    {
    }
    private function __clone()
    {
    }

    /**
     * @return ServiceMng
     */
    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new ServiceMng();
        }
        return self::$instance;
    }
}
