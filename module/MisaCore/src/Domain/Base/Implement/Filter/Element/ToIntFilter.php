<?php

namespace MisaCore\Domain\Base\Implement\Filter\Element;

/**
 * ToInt class
 *
 * @package Domain
 * @subpackage Base\Filter\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class ToIntFilter extends AbstractElementFilterImplement
{

    /**
     * conviete cualquier elemento aentero
     * si no es integer, float, string o bool se convierte en 0
     * @param $element
     * @return int
     */
    public static function filter($element)
    {

        if (! is_scalar($element)) {
            return 0;
        }
        $element = (string) $element;

        return (int) $element;
    }
}
