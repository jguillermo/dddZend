<?php

namespace MisaCore\Application\Service;

use MisaCore\Application\Config\Autoload;
use Zend\Db\Adapter\Adapter;

/**
 * DbAdapter class
 *
 * @package Domain
 * @subpackage MisaCore\Application\Service
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class DbAdapter
{
    private static $adapter;

    /**
     * DbAdapter constructor.
     */
    private function __construct()
    {
    }

    private static function set($db)
    {
        return new Adapter(Autoload::getByKey($db));
    }

    /**
     * @param string $db
     * @return Adapter
     */
    public static function get($db = 'db')
    {
        if (! isset(self::$adapter[$db])) {
            self::$adapter[$db] = self::set($db);
        }
        return self::$adapter[$db];
    }
}
