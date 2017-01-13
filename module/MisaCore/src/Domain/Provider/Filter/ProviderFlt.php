<?php
/**
 * Class ProviderFlt
 *
 * @package MisaCore\Domain\Provider\Implement\Filter
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCore\Domain\Provider\Filter;

use MisaCore\Domain\Base\Implement\Filter\AggregateFilterImplement;
use MisaCore\Domain\Base\Implement\Filter\Element\IdFilter;
use MisaCore\Domain\Base\Implement\Filter\Element\StringTrimFilter;
use MisaCore\Domain\Base\Implement\Filter\Element\ToStringFilter;
use MisaCore\Domain\Base\Implement\Filter\Entity\AddressFlt;

class ProviderFlt extends AggregateFilterImplement
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
        return $name;
    }

    /**
     * @param $comment
     * @return string
     */
    public function filterComment($comment)
    {
        $comment = ToStringFilter::filter($comment);
        $comment = StringTrimFilter::filter($comment);
        return $comment;
    }

    public function collectionAddress()
    {
        return new AddressFlt();
    }
}
