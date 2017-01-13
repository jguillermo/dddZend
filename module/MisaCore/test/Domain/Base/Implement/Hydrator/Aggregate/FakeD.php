<?php
namespace MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate;

use MisaCore\Domain\Base\Aggregate\ValueObject;

/**
 * FakeD Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class FakeD extends ValueObject
{
    private $d;
    private $dd;

    /**
     * FakeD constructor.
     */
    public function __construct()
    {
        $this->d = "";
        $this->dd = "";
    }

    /**
     * @return string
     */
    public function getD()
    {
        return $this->d;
    }

    /**
     * @param string $d
     * @return FakeD
     */
    public function setD($d)
    {
        $this->d = $d;
        return $this;
    }

    /**
     * @return string
     */
    public function getDd()
    {
        return $this->dd;
    }

    /**
     * @param string $dd
     * @return FakeD
     */
    public function setDd($dd)
    {
        $this->dd = $dd;
        return $this;
    }
}
