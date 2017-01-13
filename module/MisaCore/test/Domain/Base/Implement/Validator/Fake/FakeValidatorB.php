<?php
namespace MisaCoreTest\Domain\Base\Implement\Validator\Fake;

use MisaCore\Domain\Base\Implement\Validator\AggregateValidatorImplement;
use MisaCore\Domain\Base\Implement\Validator\Element\IdValidator;

/**
 * FakeValidatorB Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Validator\Fake
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class FakeValidatorB extends AggregateValidatorImplement
{
    public function validateId($id)
    {
        return IdValidator::validate($id);
    }

    public function aggregateA()
    {
        return new FakeValidatorA();
    }
}
