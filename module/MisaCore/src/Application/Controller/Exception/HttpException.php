<?php
/**
 * Interface NotFoundException
 *
 * @package AptitusEducation\Application\Controller\Exception
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016
 */

namespace MisaCore\Application\Controller\Exception;

class HttpException extends \Exception
{
    /** @var  int */
    protected $statusCode;

    /** @var  int */
    protected $errorCode;

    /**
     * HttpException constructor.
     * @param string $message
     * @param int $statusCode
     * @param int $errorCode
     */
    public function __construct($message, $statusCode, $errorCode)
    {
        $this->setStatusCode($statusCode);
        $this->setErrorCode($errorCode);
        parent::__construct($message);
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     * @return HttpException
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    /**
     * @return int
     */
    public function getErrorCode()
    {
        return $this->errorCode;
    }

    /**
     * @param int $errorCode
     * @return HttpException
     */
    public function setErrorCode($errorCode)
    {
        $this->errorCode = $errorCode;
        return $this;
    }
}
