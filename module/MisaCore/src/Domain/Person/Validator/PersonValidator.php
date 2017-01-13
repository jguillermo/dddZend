<?php

namespace MisaCore\Domain\Person\Validator;

use MisaCore\Domain\Base\Dto\ValidatorDto;
use MisaCore\Domain\Base\Validator\AggregateValidator;

/**
 * PersonValidatorInterface interface
 *
 * @package Domain
 * @subpackage Person\Validator
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

interface PersonValidator extends AggregateValidator
{
    /**
     * @param string $id
     * @return ValidatorDto
     */
    public function validateId($id);

    /**
     * @param string $name
     * @return ValidatorDto
     */
    public function validateName($name);

    /**
     * @param string $lastName
     * @return ValidatorDto
     */
    public function validateLastName($lastName);

    /**
     * @param string $secondLastName
     * @return ValidatorDto
     */
    public function validateSecondLastName($secondLastName);
}
