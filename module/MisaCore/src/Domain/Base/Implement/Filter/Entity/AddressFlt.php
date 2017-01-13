<?php
/**
 * Class Addressflt
 *
 * @package MisaCore\Domain\Base\Implement\Filter\Entity
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCore\Domain\Base\Implement\Filter\Entity;

use MisaCore\Domain\Base\Implement\Filter\AggregateFilterImplement;
use MisaCore\Domain\Base\Implement\Filter\Element\IdFilter;
use MisaCore\Domain\Base\Implement\Filter\Element\StringTrimFilter;
use MisaCore\Domain\Base\Implement\Filter\Element\StringUcWordsFilter;
use MisaCore\Domain\Base\Implement\Filter\Element\ToStringFilter;

class AddressFlt extends AggregateFilterImplement
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
     * @param $reference
     * @return string
     */
    public function filterReference($reference)
    {
        $reference = ToStringFilter::filter($reference);
        $reference = StringTrimFilter::filter($reference);
        return $reference;
    }
}
