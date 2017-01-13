<?php

namespace MisaCore\Domain\Person\Entity;

use MisaCore\Domain\Person\Enum\EmployeeRole;

/**
 * Employee class
 *
 * @package Domain
 * @subpackage Person\Entity
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class Employee extends Person
{
    /** @var  int */
    private $role;

    /** @var  string */
    private $user;

    /** @var  string */
    private $password;

    /**
     * Employee constructor.
     */
    public function __construct()
    {
        $this->role = EmployeeRole::COMMON;
        $this->user = "";
        $this->password = "";
        parent::__construct();
    }

    /**
     * @return int
     */
    public function getRole()
    {
        return $this->role;
    }

    /**
     * @param int $role
     * @return Employee
     */
    public function setRole($role)
    {
        $this->role = $role;
        return $this;
    }

    /**
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param string $user
     * @return Employee
     */
    public function setUser($user)
    {
        $this->user = $user;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Employee
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}
