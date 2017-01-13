<?php

namespace MisaCore\Domain\Person\Entity;

use MisaCore\Domain\Base\Aggregate\CollectionAggregate;
use MisaCore\Domain\Base\Aggregate\Entity;

/**
 * Person class
 *
 * @package Domain
 * @subpackage Person\Entity
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class Person extends Entity
{

    /** @var  string */
    private $name;

    /** @var  string */
    private $lastName;

    /** @var  string */
    private $secondLastName;





    /**
     * Person constructor.
     */
    public function __construct()
    {
        $this->name = "";
        $this->lastName = "";
        $this->secondLastName = "";
        parent::__construct();
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

    /**
     * @return string
     */
    public function getSecondLastName()
    {
        return $this->secondLastName;
    }

    /**
     * @param string $secondLastName
     * @return Person
     */
    public function setSecondLastName($secondLastName)
    {
        $this->secondLastName = $secondLastName;
        return $this;
    }
}
