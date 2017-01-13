<?php

namespace MisaCore\Domain\Person\Implement\Filter;

use MisaCore\Domain\Base\Implement\Filter\AggregateFilterImplement;
use MisaCore\Domain\Base\Implement\Filter\Element\IdFilter;
use MisaCore\Domain\Base\Implement\Filter\Element\StringTrimFilter;
use MisaCore\Domain\Base\Implement\Filter\Element\StringUcWordsFilter;
use MisaCore\Domain\Base\Implement\Filter\Element\ToStringFilter;
use MisaCore\Domain\Person\Filter\PersonFilter;

/**
 * PersonFilter class
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Person\Filter\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class PersonFilterImplement extends AggregateFilterImplement implements PersonFilter
{
    /**
     * @param $id
     * @return string
     */
    public function filterId($id)
    {
        return IdFilter::filter($id);
    }

    /**
     * @param $name
     * @return string
     */
    public function filterName($name)
    {
        $name = ToStringFilter::filter($name);
        $name = StringTrimFilter::filter($name);
        $name = StringUcWordsFilter::filter($name);

        return $name;
    }

    /**
     * @param $lastName
     * @return string
     */
    public function filterLastName($lastName)
    {
        $lastName = ToStringFilter::filter($lastName);
        $lastName = StringTrimFilter::filter($lastName);
        $lastName = StringUcWordsFilter::filter($lastName);

        return $lastName;
    }

    /**
     * @param $secondLastName
     * @return string
     */
    public function filterSecondLastName($secondLastName)
    {
        $secondLastName = ToStringFilter::filter($secondLastName);
        $secondLastName = StringTrimFilter::filter($secondLastName);
        $secondLastName = StringUcWordsFilter::filter($secondLastName);

        return $secondLastName;
    }
}
