<?php

namespace MisaCore\Domain\Base\Implement\Filter\Element;

/**
 * Id class
 *
 * @package Domain
 * @subpackage Base\Filter\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class IdFilter extends AbstractElementFilterImplement
{
    public static function filter($id)
    {
        $id = ToStringFilter::filter($id);
        $id = StringTrimFilter::filter($id);
        return $id;
    }
}
