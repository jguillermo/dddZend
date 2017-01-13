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
class PaginatorPageFilter extends AbstractElementFilterImplement
{
    public static function filter($page)
    {
        $page = ToIntFilter::filter($page);
        if ($page < 0) {
            $page = 1;
        }
        return $page;
    }
}
