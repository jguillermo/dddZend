<?php

namespace MisaCore\Domain\Person\Implement\Validator;

use MisaCore\Domain\Base\Dto\ValidatorDto;
use MisaCore\Domain\Base\Implement\Validator\AggregateValidatorImplement;
use MisaCore\Domain\Base\Implement\Validator\Element\IdValidator;
use MisaCore\Domain\Base\Implement\Validator\Element\StringLengthValidator;
use MisaCore\Domain\Person\Validator\PersonValidator;

/**
 * Person class
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Person\Validator\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class PersonValidatorImplement extends AggregateValidatorImplement implements PersonValidator
{

    /**
     * @param string $id
     * @return ValidatorDto
     */
    public function validateId($id)
    {
        return IdValidator::validate($id);
    }

    /**
     * @param string $name
     * @return ValidatorDto
     */
    public function validateName($name)
    {
        return StringLengthValidator::validate($name, ['min' => 2,'max' => 10]);
    }

    /**
     * @param string $lastName
     * @return ValidatorDto
     */
    public function validateLastName($lastName)
    {
        return StringLengthValidator::validate($lastName, ['min' => 2,'max' => 10]);
    }

    /**
     * @param string $secondLastName
     * @return ValidatorDto
     */
    public function validateSecondLastName($secondLastName)
    {
        return StringLengthValidator::validate($secondLastName, ['max' => 10]);
    }
}
