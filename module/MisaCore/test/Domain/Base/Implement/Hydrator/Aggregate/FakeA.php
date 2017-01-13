<?php
namespace MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate;

use MisaCore\Domain\Base\Aggregate\ValueObject;

/**
 * kakeA Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class FakeA extends ValueObject
{
    private $a;
    private $aa;

    /** @var  FakeB */
    private $fb;

    /**
     * kakeA constructor.
     */
    public function __construct()
    {
        $this->a = "";
        $this->aa = "";
        $this->fb = new FakeB();
    }

    /**
     * @return string
     */
    public function getA()
    {
        return $this->a;
    }

    /**
     * @param string $a
     * @return FakeA
     */
    public function setA($a)
    {
        $this->a = $a;
        return $this;
    }

    /**
     * @return string
     */
    public function getAa()
    {
        return $this->aa;
    }

    /**
     * @param string $aa
     * @return FakeA
     */
    public function setAa($aa)
    {
        $this->aa = $aa;
        return $this;
    }

    /**
     * @return FakeB
     */
    public function getFb()
    {
        return $this->fb;
    }

    /**
     * @param FakeB $fb
     * @return FakeA
     */
    public function setFb($fb)
    {
        $this->fb = $fb;
        return $this;
    }
}
