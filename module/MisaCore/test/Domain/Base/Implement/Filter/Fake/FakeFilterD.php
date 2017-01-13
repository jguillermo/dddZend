<?php
namespace MisaCoreTest\Domain\Base\Implement\Filter\Fake;

use MisaCore\Domain\Base\Implement\Filter\AggregateFilterImplement;
use MisaCore\Domain\Base\Implement\Filter\Element\StringTrimFilter;
use MisaCore\Domain\Base\Implement\Filter\Element\ToStringFilter;

/**
 * FakeFilterD Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Filter\Fake
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class FakeFilterD extends AggregateFilterImplement
{
    public function filterName($name)
    {
        $name = ToStringFilter::filter($name);
        $name = StringTrimFilter::filter($name);
        return $name;
    }

    public function collectionA()
    {
        return new FakeFilterA();
    }
}
