<?php

namespace MisaCore\Domain\Base\Implement\Filter\Element;

/**
 * StringTrim class
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Base\Filter\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class StringTrimFilter extends AbstractElementFilterImplement
{

    /**
     * @param string $element
     * @return string
     */
    public static function filter($element)
    {
        return trim($element);
    }
}
