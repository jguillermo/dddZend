<?php
namespace MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate;

/**
 * Student Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class Student extends Person
{
    /** @var  int */
    private $codigo;

    /** @var  Person */
    private $father;

    /** @var  Person */
    private $mother;

    /**
     * Student constructor.
     */
    public function __construct()
    {
        $this->codigo = 0;
        $this->father = new Person();
        $this->mother = new Person();
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param int $codigo
     * @return Student
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
        return $this;
    }

    /**
     * @return Person
     */
    public function getFather()
    {
        return $this->father;
    }

    /**
     * @param Person $father
     * @return Student
     */
    public function setFather($father)
    {
        $this->father = $father;
        return $this;
    }

    /**
     * @return Person
     */
    public function getMother()
    {
        return $this->mother;
    }

    /**
     * @param Person $mother
     * @return Student
     */
    public function setMother($mother)
    {
        $this->mother = $mother;
        return $this;
    }
}
