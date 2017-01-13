<?php
namespace MisaCoreTest\Domain\Base\Implement\Validator\Fake;

use MisaCore\Domain\Base\Implement\Validator\AggregateValidatorImplement;
use MisaCore\Domain\Base\Implement\Validator\Element\IdValidator;
use MisaCore\Domain\Base\Implement\Validator\Element\RequiredValidator;
use MisaCore\Domain\Base\Implement\Validator\Element\StringLengthValidator;

/**
 * FakeValidatorA Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Validator\Fake
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class FakeValidatorA extends AggregateValidatorImplement
{
    public function validateId($id)
    {
        return IdValidator::validate($id);
    }

    public function validateName($name)
    {
        $dto = RequiredValidator::validate($name);
        $dto = StringLengthValidator::validate($name, ['min' => 3, 'max' => 120], $dto);
        return $dto;
    }
}
