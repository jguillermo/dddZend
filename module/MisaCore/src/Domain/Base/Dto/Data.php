<?php

namespace MisaCore\Domain\Base\Dto;

/**
 * Data class
 *
 * @package Domain
 * @subpackage Base\Dto
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class Data
{
    /** @var  obj */
    private $value;

    /**
     * Setea un Obj
     * @param $value
     * @return $this
     */
    public function set($value)
    {
        $this->value = $value;
        return $this;
    }

    /**
     * @return obj
     */
    public function get()
    {
        return $this->value;
    }

    /**
     * @return obj
     */
    public function __invoke()
    {
        return $this->get();
    }
}
