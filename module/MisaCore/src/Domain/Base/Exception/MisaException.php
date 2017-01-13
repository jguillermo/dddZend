<?php
/**
 * Class RepNotFoundException
 *
 * @package MisaCore\Domain\Base\Exception
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCore\Domain\Base\Exception;

class MisaException extends \Exception
{
    private $listError;

    /**
     * MisaException constructor.
     * @param $listError
     */
    public function __construct($message, $listError = [])
    {
        $this->listError = $listError;
        parent::__construct($message);
    }

    /**
     * @return array
     */
    public function getListError()
    {
        return $this->listError;
    }

    /**
     * @param array $listError
     * @return MisaException
     */
    public function setListError($listError)
    {
        $this->listError = $listError;
        return $this;
    }

    public function getCountError()
    {
        return count($this->listError);
    }
}
