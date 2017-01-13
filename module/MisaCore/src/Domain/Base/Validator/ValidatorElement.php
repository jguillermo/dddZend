<?php

namespace MisaCore\Domain\Base\Validator;

use MisaCore\Domain\Base\Dto\ValidatorDto;

/**
 * ValidatorElementInterface interface
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Base\Validator
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

interface ValidatorElement
{

    /**
     * @return ValidatorDto
     */
    public static function getDto();

    /**
     * @param $element
     * @param array $options
     * @param null $previousDto
     * @return ValidatorDto
     */
    public static function validate($element, array $options = [], $previousDto = null);
}
