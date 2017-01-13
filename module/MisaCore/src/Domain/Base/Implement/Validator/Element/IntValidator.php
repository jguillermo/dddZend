<?php

namespace MisaCore\Domain\Base\Implement\Validator\Element;

use MisaCore\Domain\Base\Dto\ValidatorDto;

/**
 * IntValidator class
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Base\Implement\Validator\Element
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class IntValidator extends AbstractElementValidator
{

    /**
     * @param $element
     * @param array $options
     * @return ValidatorDto
     */
    public static function validate($element, array $options = [], $previousDto = null)
    {
        $result = self::getDto(true);
        if (! is_int($element)) {
            $result->setStatus(false);
            $result->mesagge()->set('int', 'El valor no es un entero válido');
        }
        return self::processDto($result, $previousDto);
    }
}
