<?php

namespace MisaCore\Domain\Base\Dto;

/**
 * MisaDto class
 *
 * @package Domain
 * @subpackage Base\Dto
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class MisaDto
{
    /** @var string */
    private $message;

    /** @var bool */
    private $status;

    /** @var array */
    private $data;

    /**
     * Result constructor.
     * @param $message
     * @param $status
     */
    public function __construct($message = "", $status = false)
    {
        $this->message = $message;
        $this->status = $status;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     * @return Result
     */
    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return boolean
     */
    public function isOk()
    {
        return $this->status;
    }

    /**
     * @param boolean $status
     * @return Result
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function data()
    {
        if (is_null($this->data)) {
            $this->data = new ArrayData();
        }
        return $this->data;
    }

    public function toArray()
    {
        return [
            'message' => $this->getMessage(),
            'status' => $this->isOk(),
            'data' => $this->data()->toArray(),
        ];
    }
}
