<?php
namespace MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate;

use MisaCore\Domain\Base\Aggregate\Entity;

/**
 * Listentity Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class School extends Entity
{
    /** @var  Person */
    private $head;

    /** @var string */
    private $name;

    /**
     * Listentity constructor.
     */
    public function __construct()
    {
        $this->id = 0;
        $this->head = new Person();
        $this->name = "";
    }

    /**
     * @return Person
     */
    public function getHead()
    {
        return $this->head;
    }

    /**
     * @param Person $head
     * @return School
     */
    public function setHead($head)
    {
        $this->head = $head;
        return $this;
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
     * @return School
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
