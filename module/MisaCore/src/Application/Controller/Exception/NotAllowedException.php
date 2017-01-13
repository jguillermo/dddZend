<?php
/**
 * Interface NotAllowedException
 *
 * @package AptitusEducation\Application\Controller\Exception
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016
 */

namespace MisaCore\Application\Controller\Exception;

class NotAllowedException extends HttpException
{
    /**
     * NotAllowedException constructor.
     */
    public function __construct()
    {
        parent::__construct("Method Not Allowed", 405, 34);
    }
}
