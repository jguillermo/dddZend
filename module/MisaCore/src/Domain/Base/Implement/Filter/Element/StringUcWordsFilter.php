<?php

namespace MisaCore\Domain\Base\Implement\Filter\Element;

/**
 * StringUcWords class
 *
 * @package Domain
 * @subpackage Base\Filter\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class StringUcWordsFilter extends AbstractElementFilterImplement
{
    /**
     * @param string $element
     * @return string
     */
    public static function filter($element)
    {
        return ucwords($element);
    }
}
