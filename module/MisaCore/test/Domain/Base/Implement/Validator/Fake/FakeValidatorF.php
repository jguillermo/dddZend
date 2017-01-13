<?php
namespace MisaCoreTest\Domain\Base\Implement\Validator\Fake;

use MisaCore\Domain\Base\Implement\Validator\AggregateValidatorImplement;
use MisaCore\Domain\Base\Implement\Validator\Element\AlphabeticStringValidator;
use MisaCore\Domain\Base\Implement\Validator\Element\RequiredValidator;
use MisaCore\Domain\Base\Implement\Validator\Element\StringLengthValidator;

/**
 * FakeValidatorF Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Validator\Fake
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class FakeValidatorF extends AggregateValidatorImplement
{
    public function validateLastName($name)
    {
        $dto = RequiredValidator::validate($name);
        $dto = StringLengthValidator::validate($name, ['min' => 8, 'max' => 12], $dto);

        return $dto;
    }

    public function collectionE()
    {
        return new FakeValidatorE();
    }
}
