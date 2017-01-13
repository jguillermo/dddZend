<?php
namespace MisaCoreTest\Domain\Base\Implement\Filter\Fake;

use MisaCore\Domain\Base\Implement\Filter\AggregateFilterImplement;
use MisaCore\Domain\Base\Implement\Filter\Element\IdFilter;

/**
 * FakeFilterB Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Filter\Fake
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class FakeFilterB extends AggregateFilterImplement
{
    public function filterId($id)
    {
        return IdFilter::filter($id);
    }

    public function aggregateA()
    {
        return new FakeFilterA();
    }
}
