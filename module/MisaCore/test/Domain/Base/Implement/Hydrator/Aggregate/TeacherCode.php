<?php
namespace MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate;

use MisaCore\Domain\Base\Aggregate\ValueObject;

/**
 * TeacherCode Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class TeacherCode extends ValueObject
{
    /** @var  string */
    private $yearBirth;

    /** @var  string */
    private $num;


    /**
     * TeacherCode constructor.
     */
    public function __construct()
    {
        $this->yearBirth = "";
        $this->num = "";
    }

    /**
     * @return string
     */
    public function getYearBirth()
    {
        return $this->yearBirth;
    }

    /**
     * @param string $yearBirth
     * @return TeacherCode
     */
    public function setYearBirth($yearBirth)
    {
        $this->yearBirth = $yearBirth;
        return $this;
    }

    /**
     * @return string
     */
    public function getNum()
    {
        return $this->num;
    }

    /**
     * @param string $num
     * @return TeacherCode
     */
    public function setNum($num)
    {
        $this->num = $num;
        return $this;
    }
}
