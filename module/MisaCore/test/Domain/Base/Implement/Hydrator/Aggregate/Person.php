<?php
namespace MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate;

use MisaCore\Domain\Base\Aggregate\Entity;

/**
 * SimpleEntity Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class Person extends Entity
{
    private $name;
    private $lastName;

    /**
     * SimpleEntity constructor.
     */
    public function __construct()
    {
        $this->id = 0;
        $this->name = "";
        $this->lastName = "";
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Person
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param string $lastName
     * @return Person
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
}
