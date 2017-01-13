<?php
/**
 * Interface NotAllowedException
 *
 * @package AptitusEducation\Application\Controller\Exception
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016
 */

namespace MisaCore\Application\Controller\Exception;

class BadRequestException extends HttpException
{
    /**
     * NotAllowedException constructor.
     */
    public function __construct($message = 'Error')
    {
        parent::__construct("BadRequest : ".$message, 400, 40);
    }
}
