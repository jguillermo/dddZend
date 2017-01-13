<?php
namespace MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate;

use MisaCore\Domain\Base\Aggregate\CollectionAggregate;
use MisaCore\Domain\Base\Aggregate\Entity;

/**
 * ClassRoomEntity Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class ClassRoom extends Entity
{
    /** @var  string */
    private $name;

    /** @var  CollectionAggregate */
    private $students;

    /** @var  Teacher */
    private $teacher;

    /**
     * ClassRoomEntity constructor.
     */
    public function __construct()
    {
        $this->id = 0;
        $this->name = "";
        $this->students = new CollectionAggregate(new Student());
        $this->teacher = new Teacher();
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
     * @return ClassRoom
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return CollectionAggregate
     */
    public function getStudents()
    {
        return $this->students;
    }

    /**
     * @param CollectionAggregate $students
     * @return ClassRoom
     */
    public function setStudents($students)
    {
        $this->students = $students;
        return $this;
    }

    /**
     * @return Teacher
     */
    public function getTeacher()
    {
        return $this->teacher;
    }

    /**
     * @param Teacher $teacher
     * @return ClassRoom
     */
    public function setTeacher($teacher)
    {
        $this->teacher = $teacher;
        return $this;
    }
}
