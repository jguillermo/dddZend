<?php

namespace MisaCore\Domain\Base\Implement\Validator\Element;

use MisaCore\Domain\Base\Dto\ValidatorDto;

/**
 * RequiredValidator class
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Base\Implement\Validator\Element
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class RequiredValidator extends AbstractElementValidator
{

    /**
     * @param $element
     * @param array $options
     * @param null $previousDto
     * @return ValidatorDto
     */
    public static function validate($element, array $options = [], $previousDto = null)
    {
        $result = self::getDto(true);
        if (empty($element)) {
            $result->setStatus(false);
            $result->mesagge()->set('required', 'Este campo es requerido');
        }
        return self::processDto($result, $previousDto);
    }
}
