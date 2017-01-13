<?php
namespace MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate;

/**
 * Teacher Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class Teacher extends Person
{
    /** @var  TeacherCode */
    private $code;


    /**
     * Teacher constructor.
     */
    public function __construct()
    {
        $this->code = new TeacherCode();
        parent::__construct();
    }

    /**
     * @return TeacherCode
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param TeacherCode $code
     * @return Teacher
     */
    public function setCode(TeacherCode $code)
    {
        $this->code = $code;
        return $this;
    }
}
