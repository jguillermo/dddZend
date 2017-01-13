<?php

namespace MisaCore\Domain\Base\Implement\Validator\Element;

use MisaCore\Domain\Base\Dto\ValidatorDto;
use MisaCore\Domain\Base\Validator\ValidatorElement;

/**
 * AbstractElementValidator class
 *
 * @package Domain
 * @subpackage Base\Validator\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

abstract class AbstractElementValidator implements ValidatorElement
{

    /**
     * @param bool $status
     * @return ValidatorDto
     */
    public static function getDto($status = false)
    {
        $dto = new ValidatorDto();
        if ($status === true) {
            $dto->setStatus(true);
        }
        return $dto;
    }

    /**
     * processa los Dto, si al menos uno es falso, hace que el redo sea falso
     * y si concatenamos varios elemntos filter,
     * esto hace que el resuiltado final sea falso , si uno es falso
     * @param ValidatorDto $currentDto
     * @param $previosDto
     * @return ValidatorDto
     */
    protected static function processDto(ValidatorDto $currentDto, $previosDto)
    {
        if (is_null($previosDto)) {
            return $currentDto;
        }
        /** si al menos uno de los 2 dto es false, hace que el reasultado final se falso */
        if (! $currentDto->isStatus() || ! $previosDto->isStatus()) {
            $previosDto->setStatus(false);
        }

        /** si el dto actual es falso, se agregan los mensajes de error al dto previo */
        if (! $currentDto->isStatus()) {
            $previosDto->mesagge()->set($currentDto->mesagge()->toArray());
        }

        return $previosDto;
    }
}
