<?php

namespace MisaCore\Domain\Base\Dto;

/**
 * ArrayData class
 *
 * @package Domain
 * @subpackage Base\Dto
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class ArrayData
{
    /** @var stdClass  */
    private $params;

    /**
     * ArrayData constructor.
     */
    public function __construct()
    {
        $this->params = new \stdClass();
    }

    /**
     * @param $key
     * @param null $value
     * @return $this
     */
    public function set($key, $value = null)
    {
        if (is_array($key) || is_object($key)) {
            foreach ($key as $k => $v) {
                $this->params->{$k} = $v;
            }
        } else {
            $this->params->{$key} = $value;
        }
        return $this;
    }

    /**
     * @param null $key
     * @return stdClass
     */
    public function get($key = null, $defaul = null)
    {
        if (is_null($key)) {
            return $this->params;
        }
        if (! isset($this->params->{$key})) {
            return $defaul;
        }
        return $this->params->{$key};
    }

    /**
     * @return stdClass
     */
    public function __invoke()
    {
        return $this->get();
    }

    /**
     * @return array
     */
    public function toArray()
    {
        $data = [];
        foreach ($this->params as $key => $val) {
            $data[$key] = $val;
        }
        return $data;
    }
}
