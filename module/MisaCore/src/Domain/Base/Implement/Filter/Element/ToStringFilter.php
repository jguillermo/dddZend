<?php

namespace MisaCore\Domain\Base\Implement\Filter\Element;

/**
 * ToString class
 *
 * @package Domain
 * @subpackage Base\Filter\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class ToStringFilter extends AbstractElementFilterImplement
{
    /**
     * verifica si el parametro es un string
     * si no es integer, float, string o bool se convierte en ""
     * @param $element
     * @return string
     */
    public static function filter($element)
    {
        if (! is_scalar($element)) {
            return "";
        }
        return  (string) $element;
    }
}
