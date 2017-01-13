<?php

namespace MisaCore\Infrastructure\Persistence\Sql\Implement;

use MisaCore\Application\Factory\MisaFactory;
use MisaCore\Application\Factory\ServiceMng;
use MisaCore\Infrastructure\Persistence\Sql\Implement\Plugins\PersistEntity;
use Zend\Db\Adapter\Adapter;

/**
 * AbstractDb class
 *
 * @package Infrastructure
 * @subpackage Persistence\Sql
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

abstract class AbstractDb
{
    /** @var  DriverDb */
    private $driverDb;

    /** @var ServiceMng */
    private $factory;


    public function __construct(Adapter $adapter)
    {
        $this->factory = MisaFactory::getInstance();
        $this->setDriver($adapter);
    }

    /**
     * @return DriverDb
     */
    public function getDriver()
    {
        return $this->driverDb;
    }

    /**
     * @param Adapter $adapter
     */
    private function setDriver(Adapter $adapter)
    {
        $this->driverDb = new DriverDb($adapter);
    }

    /**
     * @return ServiceMng
     */
    public function factory()
    {
        return $this->factory;
    }

    /**
     * @return PersistEntity
     */
    public function persistentity()
    {
        return new PersistEntity($this->getDriver());
    }
}
