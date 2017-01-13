<?php
namespace MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate;

use MisaCore\Domain\Base\Aggregate\CollectionAggregate;
use MisaCore\Domain\Base\Aggregate\ValueObject;

/**
 * FakeCollectionA Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class FakeCollectionA extends ValueObject
{
    /** @var CollectionAggregate */
    private $a;

    private $name;


    /**
     * FakeCollectionA constructor.
     */
    public function __construct()
    {
        $this->name = "";
        $this->a = new CollectionAggregate(new FakeA());
    }

    /**
     * @return CollectionAggregate
     */
    public function getA()
    {
        return $this->a;
    }

    /**
     * @param CollectionAggregate $a
     * @return FakeCollectionA
     */
    public function setA($a)
    {
        $this->a = $a;
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
     * @return FakeCollectionA
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }
}
