<?php

namespace MisaCore\Domain\Person\Implement\Filter;

use MisaCore\Domain\Base\Implement\Filter\Element\StringTrimFilter;
use MisaCore\Domain\Base\Implement\Filter\Element\ToIntFilter;
use MisaCore\Domain\Base\Implement\Filter\Element\ToStringFilter;
use MisaCore\Domain\Person\Filter\EmployeeFilter;

/**
 * EmployeeFilter class
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Person\Filter\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class EmployeeFilterImplement extends PersonFilterImplement implements EmployeeFilter
{

    /**
     * @param $role
     * @return int
     */
    public function filterRole($role)
    {
        return ToIntFilter::filter($role);
    }

    /**
     * @param $user
     * @return string
     */
    public function filterUser($user)
    {
        $user = ToStringFilter::filter($user);
        $user = StringTrimFilter::filter($user);
        return $user;
    }

    /**
     * @param $password
     * @return string
     */
    public function filterPassword($password)
    {
        $password = ToStringFilter::filter($password);
        $password = StringTrimFilter::filter($password);
        return $password;
    }
}
