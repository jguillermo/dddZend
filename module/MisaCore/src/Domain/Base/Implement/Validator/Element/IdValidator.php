<?php

namespace MisaCore\Domain\Base\Implement\Validator\Element;

use MisaCore\Domain\Base\Dto\ValidatorDto;

/**
 * IdValidator class
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Base\Validator\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class IdValidator extends AbstractElementValidator
{

    /**
     * @param $element
     * @param array $options
     * @return ValidatorDto
     */
    public static function validate($element, array $options = [], $previousDto = null)
    {
        $result = self::getDto();

        if (is_string($element) && strlen($element) === 14) {
            $result->setStatus(true);
        } else {
            $result->mesagge()->set('noCorrect', 'El Id no es Válido');
        }

        return self::processDto($result, $previousDto);
    }
}
