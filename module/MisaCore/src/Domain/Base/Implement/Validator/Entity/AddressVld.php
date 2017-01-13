<?php
/**
 * Class AddressVld
 *
 * @package MisaCore\Domain\Base\Implement\Validator\Entity
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCore\Domain\Base\Implement\Validator\Entity;

use MisaCore\Domain\Base\Dto\ValidatorDto;
use MisaCore\Domain\Base\Implement\Validator\AggregateValidatorImplement;
use MisaCore\Domain\Base\Implement\Validator\Element\IdValidator;
use MisaCore\Domain\Base\Implement\Validator\Element\StringLengthValidator;

class AddressVld extends AggregateValidatorImplement
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
     * @param string $reference
     * @return ValidatorDto
     */
    public function validateReference($reference)
    {
        return StringLengthValidator::validate($reference, ['max' => 250]);
    }
}
