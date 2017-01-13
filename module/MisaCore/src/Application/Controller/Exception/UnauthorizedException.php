<?php
/**
 * Interface UnauthorizedException
 *
 * @package AptitusEducation\Application\Controller\Exception
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016
 */

namespace MisaCore\Application\Controller\Exception;

class UnauthorizedException extends HttpException
{
    /**
     * NotAllowedException constructor.
     */
    public function __construct()
    {
        parent::__construct("Missing or incorrect authentication credentials.", 401, 41);
    }
}
