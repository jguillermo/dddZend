<?php

namespace MisaCore\Domain\Base\Dto;

/**
 * ValidatorDto class
 *
 * @package Domain
 * @subpackage Base\Dto
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class ValidatorDto
{
    /** @var  bool */
    private $status;

    /** @var  array */
    private $mesagge;

    /**
     * por seguridad statuspor defecto es false
     * ValidatorDto constructor.
     */
    public function __construct()
    {
        $this->status = false;
    }


    /**
     * @return boolean
     */
    public function isStatus()
    {
        return $this->status;
    }

    public function isOk()
    {
        return $this->status;
    }

    /**
     * @param boolean $status
     * @return ValidatorDto
     */
    public function setStatus($status)
    {
        $this->status = $status;
        return $this;
    }

    public function mesagge()
    {
        if (is_null($this->mesagge)) {
            $this->mesagge = new ArrayData();
        }
        return $this->mesagge;
    }
}
