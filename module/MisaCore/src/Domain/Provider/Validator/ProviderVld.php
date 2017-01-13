<?php
/**
 * Class ProviderVld
 *
 * @package MisaCore\Domain\Provider\Implement\Validator
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCore\Domain\Provider\Validator;

use MisaCore\Domain\Base\Dto\ValidatorDto;
use MisaCore\Domain\Base\Implement\Validator\AggregateValidatorImplement;
use MisaCore\Domain\Base\Implement\Validator\Element\IdValidator;
use MisaCore\Domain\Base\Implement\Validator\Element\StringLengthValidator;
use MisaCore\Domain\Base\Implement\Validator\Entity\AddressVld;

class ProviderVld extends AggregateValidatorImplement
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
     * @param string $comment
     * @return ValidatorDto
     */
    public function validateComment($comment)
    {
        return StringLengthValidator::validate($comment, ['max' => 250]);
    }

    /**
     * @return AddressVld
     */
    public function collectionAddress()
    {
        return new AddressVld();
    }
}
