<?php
/**
 * Trait PersonMng
 *
 * @package MisaCore\Application\Factory\Person
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCore\Application\Factory\Person;

trait PersonTrait
{

    private $personEmployee;

    private $personPerson;

    /**
     * @return PersonFac
     */
    public function personPerson()
    {
        if (! $this->personPerson) {
            $this->personPerson = new PersonFac();
        }
        return $this->personPerson;
    }

    /**
     * @return EmployeeFac
     */
    public function personEmployee()
    {
        if (! $this->personEmployee) {
            $this->personEmployee = new EmployeeFac();
        }
        return $this->personEmployee;
    }
}
