<?php
/**
 * PluginDriverDb Class
 *
 * @package MisaCore\Infrastructure\Persistence\Sql\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2017, Getmin
 */
namespace MisaCore\Infrastructure\Persistence\Sql\Implement\Plugins;

use MisaCore\Infrastructure\Persistence\Sql\Implement\DriverDb;

abstract class PluginDriverDb
{
    /** @var  DriverDb */
    private $driverDb;

    /**
     * PluginDriverDb constructor.
     * @param DriverDb $driverDb
     */
    public function __construct(DriverDb $driverDb)
    {
        $this->driverDb = $driverDb;
    }

    /**
     * @return DriverDb
     */
    protected function getDriver()
    {
        return $this->driverDb;
    }
}
