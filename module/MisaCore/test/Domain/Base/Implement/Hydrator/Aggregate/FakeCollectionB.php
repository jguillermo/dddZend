<?php
namespace MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate;

use MisaCore\Domain\Base\Aggregate\CollectionAggregate;
use MisaCore\Domain\Base\Aggregate\ValueObject;

/**
 * FakeCollectionB Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class FakeCollectionB extends ValueObject
{
    /** @var  CollectionAggregate */
    private $b;

    private $name;

    /**
     * FakeCollectionB constructor.
     */
    public function __construct()
    {
        $this->b = new CollectionAggregate(new FakeCollectionA());
        $this->name = "";
    }

    /**
     * @return CollectionAggregate
     */
    public function getB()
    {
        return $this->b;
    }

    /**
     * @param CollectionAggregate $b
     * @return FakeCollectionB
     */
    public function setB($b)
    {
        $this->b = $b;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return FakeCollectionB
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
