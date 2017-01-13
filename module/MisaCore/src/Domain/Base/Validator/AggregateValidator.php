<?php
namespace MisaCore\Domain\Base\Validator;

use MisaCore\Domain\Base\Dto\ValidatorDto;

/**
 * AggregateValidator Class
 *
 * @package MisaCore\Domain\Base\Validator
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
interface AggregateValidator
{
    /**
     * @param array $params
     * @return bool
     */
    public function isValid(array $params);
}
