<?php

namespace MisaCore\Domain\Person\Validator;

use MisaCore\Domain\Base\Dto\ValidatorDto;

/**
 * EmployeeValidatorInterface interface
 *
 * @package Domain
 * @subpackage Person\Validator
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

interface EmployeeValidator extends PersonValidator
{
    /**
     * @param int $role
     * @return ValidatorDto
     */
    public function validateRole($role);

    /**
     * @param string $user
     * @return ValidatorDto
     */
    public function validateUser($user);

    /**
     * @param string $password
     * @return ValidatorDto
     */
    public function validatePassword($password);
}
