<?php
namespace MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate;

use MisaCore\Domain\Base\Aggregate\ValueObject;

/**
 * FakeC Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class FakeC extends ValueObject
{
    private $c;
    private $cc;

    /** @var  FakeD */
    private $fd;

    /**
     * FakeC constructor.
     */
    public function __construct()
    {
        $this->c = "";
        $this->cc = "";
        $this->fd = new FakeD();
    }

    /**
     * @return string
     */
    public function getC()
    {
        return $this->c;
    }

    /**
     * @param string $c
     * @return FakeC
     */
    public function setC($c)
    {
        $this->c = $c;
        return $this;
    }

    /**
     * @return string
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * @param string $cc
     * @return FakeC
     */
    public function setCc($cc)
    {
        $this->cc = $cc;
        return $this;
    }

    /**
     * @return FakeD
     */
    public function getFd()
    {
        return $this->fd;
    }

    /**
     * @param FakeD $fd
     * @return FakeC
     */
    public function setFd($fd)
    {
        $this->fd = $fd;
        return $this;
    }
}
