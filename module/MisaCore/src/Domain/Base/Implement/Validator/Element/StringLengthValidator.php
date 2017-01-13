<?php

namespace MisaCore\Domain\Base\Implement\Validator\Element;

use MisaCore\Domain\Base\Dto\ValidatorDto;

/**
 * StringLengthValidator class
 *
 * @package Domain
 * @subpackage Base\Validator\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class StringLengthValidator extends AbstractElementValidator
{
    /**
     * @param $element
     * @param array $options recibe 3 parametros min,max,len
     * @return ValidatorDto
     */
    public static function validate($element, array $options = [], $previousDto = null)
    {
        self::validateOptionsInt($options);

        $result = self::getDto();
        if (! is_string($element)) {
            $result->setStatus(false);
            $result->mesagge()->set('noString', 'no es un texto');
            return self::processDto($result, $previousDto);
        }

        $strlen = Self::getStringlength($element);



        if (isset($options['len'])) {
            if ($strlen === $options['len']) {
                $result->setStatus(true);
            } else {
                $result->setStatus(false);
                $result->mesagge()->set('stringLen', "Debe tener {$options['len']} caracteres");
            }
        } elseif (isset($options['min']) && isset($options['max'])) {
            if ($options['min'] <= $strlen && $strlen <= $options['max']) {
                $result->setStatus(true);
            } else {
                $result->setStatus(false);
                $result->mesagge()->set(
                    'stringMinMax',
                    "Debe estar entre {$options['min']} - {$options['max']} caracteres"
                );
            }
        } elseif (isset($options['min'])) {
            if ($options['min'] <= $strlen) {
                $result->setStatus(true);
            } else {
                $result->setStatus(false);
                $result->mesagge()->set(
                    'stringMin',
                    "Debe ser mayor que {$options['min']} caracteres"
                );
            }
        } elseif (isset($options['max'])) {
            if ($strlen <= $options['max']) {
                $result->setStatus(true);
            } else {
                $result->setStatus(false);
                $result->mesagge()->set(
                    'stringMax',
                    "Debe ser menor que {$options['max']} caracteres"
                );
            }
        }

        return self::processDto($result, $previousDto);
    }

    /**
     * retorna el numero total de caracteres
     * @param $element
     * @return int
     */
    private static function getStringlength($element)
    {
        return strlen($element);
    }

    private static function validateOptionsInt($options)
    {
        if (! isset($options['min']) && ! isset($options['max']) && ! isset($options['max'])) {
            throw new \Exception("validator StringLength : Ingrese al menos una opcion : len, min, max ");
        }

        if (isset($options['len']) && ! is_int($options['len'])) {
            throw new \Exception("validator StringLength : 'len' debe ser un número entero");
        }
        if (isset($options['min']) && ! is_int($options['min'])) {
            throw new \Exception("validator StringLength : 'min' debe ser un número entero");
        }
        if (isset($options['max']) && ! is_int($options['max'])) {
            throw new \Exception("validator StringLength : 'max' debe ser un número entero");
        }


        if (isset($options['min']) && isset($options['max']) && $options['min'] > $options['max']) {
            throw new \Exception("validator StringLength : el 'max' debe ser mayor a la longitud 'min' ,
            pero {$options['max']} < {$options['min']} ");
        }
    }
}
