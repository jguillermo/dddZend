<?php
/**
 * Class EmployeeTestInt
 *
 * @package MisaIntegrationTest\Domain\Person
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaIntegrationTest\Seed;

use MisaCore\Application\Service\DbAdapter;
use MisaCore\Infrastructure\Persistence\Sql\Implement\DriverDb;
use MisaIntegrationTest\TestIntegrationCase;

class LoadTest extends TestIntegrationCase
{
    public function testDropAnyTables()
    {
        $db = new DriverDb(DbAdapter::get());

        $sql = "
        DROP TABLE IF EXISTS `employee`;
        DROP TABLE IF EXISTS `person`;
        DROP TABLE IF EXISTS `provider_address`;
        DROP TABLE IF EXISTS `provider`;
        ";
        $db->query($sql);
        $this->assertEquals(1, 1);
    }

    public function testCreatePersonTables()
    {
        $db = new DriverDb(DbAdapter::get());

        $sql = "
            CREATE TABLE `person` (
              `id` char(14) COLLATE utf8_spanish2_ci NOT NULL,
              `name` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
              `lastname` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
              `secondlastname` varchar(20) COLLATE utf8_spanish2_ci DEFAULT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
        ";

        $db->query($sql);
        $this->assertEquals(1, 1);
    }

    public function testCreateEmployeeTables()
    {
        $db = new DriverDb(DbAdapter::get());


        $sql = "
            CREATE TABLE `employee` (
              `id` char(14) COLLATE utf8_spanish2_ci NOT NULL,
              `role` smallint(6) DEFAULT NULL,
              `user` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
              `password` char(60) COLLATE utf8_spanish2_ci DEFAULT NULL,
              PRIMARY KEY (`id`),
              CONSTRAINT `fk_person_employee` FOREIGN KEY (`id`) REFERENCES `person` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
        ";
        $db->query($sql);
        $this->assertEquals(1, 1);
    }

    public function testCreateProviderTables()
    {
        $db = new DriverDb(DbAdapter::get());


        $sql = "
            CREATE TABLE `provider` (
              `id` char(14) COLLATE utf8_spanish2_ci NOT NULL,
              `name` varchar(50) COLLATE utf8_spanish2_ci DEFAULT NULL,
              `comment` text COLLATE utf8_spanish2_ci,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
        ";
        $db->query($sql);
        $this->assertEquals(1, 1);
    }

    public function testCreateProviderAddressTables()
    {
        $db = new DriverDb(DbAdapter::get());


        $sql = "
            CREATE TABLE `provider_address` (
              `id` char(14) COLLATE utf8_spanish2_ci NOT NULL,
              `name` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
              `reference` varchar(100) COLLATE utf8_spanish2_ci DEFAULT NULL,
              PRIMARY KEY (`id`),
              CONSTRAINT `fk_provider_provider_address` FOREIGN KEY (`id`) REFERENCES `provider` (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish2_ci;
        ";
        $db->query($sql);
        $this->assertEquals(1, 1);
    }
}
