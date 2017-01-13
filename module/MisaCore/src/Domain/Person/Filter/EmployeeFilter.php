<?php

namespace MisaCore\Domain\Person\Filter;

/**
 * EmployeeFilterInterface interface
 *
 * @package Domain
 * @subpackage Person\Filter
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

interface EmployeeFilter extends PersonFilter
{
    /**
     * @param $role
     * @return int
     */
    public function filterRole($role);

    /**
     * @param $user
     * @return string
     */
    public function filterUser($user);

    /**
     * @param $password
     * @return string
     */
    public function filterPassword($password);
}
