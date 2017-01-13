<?php

namespace MisaCore\Domain\Person\Implement\Validator;

use MisaCore\Domain\Base\Dto\ValidatorDto;
use MisaCore\Domain\Base\Implement\Validator\Element\IntValidator;
use MisaCore\Domain\Base\Implement\Validator\Element\StringValidator;
use MisaCore\Domain\Person\Validator\EmployeeValidator;

/**
 * Employee class
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Person\Validator\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class EmployeeValidatorImplement extends PersonValidatorImplement implements EmployeeValidator
{

    /**
     * @param int $role
     * @return ValidatorDto
     */
    public function validateRole($role)
    {
        return IntValidator::validate($role);
    }

    /**
     * @param string $user
     * @return ValidatorDto
     */
    public function validateUser($user)
    {
        return StringValidator::validate($user);
    }

    /**
     * @param string $password
     * @return ValidatorDto
     */
    public function validatePassword($password)
    {
        return StringValidator::validate($password);
    }
}
