<?php

namespace MisaCore\Domain\Person\Filter;

use MisaCore\Domain\Base\Filter\AggregateFilter;

/**
 * PersonFilterInterface interface
 *
 * @package Domain
 * @subpackage Person\Filter
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

interface PersonFilter extends AggregateFilter
{
    /**
     * @param $id
     * @return string
     */
    public function filterId($id);

    /**
     * @param $name
     * @return string
     */
    public function filterName($name);

    /**
     * @param $lastName
     * @return string
     */
    public function filterLastName($lastName);

    /**
     * @param $secondLastName
     * @return string
     */
    public function filterSecondLastName($secondLastName);
}
