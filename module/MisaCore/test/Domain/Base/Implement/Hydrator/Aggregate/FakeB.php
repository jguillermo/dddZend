<?php
namespace MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate;

use MisaCore\Domain\Base\Aggregate\ValueObject;

/**
 * FakeB Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class FakeB extends ValueObject
{
    private $b;
    private $bb;

    /** @var  FakeC */
    private $fc;

    /**
     * FakeB constructor.
     */
    public function __construct()
    {
        $this->b = "";
        $this->bb = "";
        $this->fc = new FakeC();
    }

    /**
     * @return string
     */
    public function getB()
    {
        return $this->b;
    }

    /**
     * @param string $b
     * @return FakeB
     */
    public function setB($b)
    {
        $this->b = $b;
        return $this;
    }

    /**
     * @return string
     */
    public function getBb()
    {
        return $this->bb;
    }

    /**
     * @param string $bb
     * @return FakeB
     */
    public function setBb($bb)
    {
        $this->bb = $bb;
        return $this;
    }

    /**
     * @return FakeC
     */
    public function getFc()
    {
        return $this->fc;
    }

    /**
     * @param FakeC $fc
     * @return FakeB
     */
    public function setFc($fc)
    {
        $this->fc = $fc;
        return $this;
    }
}
