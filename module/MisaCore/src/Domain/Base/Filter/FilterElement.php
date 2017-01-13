<?php

namespace MisaCore\Domain\Base\Filter;

/**
 * FilterElement interface
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Base\Filter
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

interface FilterElement
{
    /**
     * @param mixed $elemnt
     * @return mixed
     */
    public static function filter($elemnt);
}
