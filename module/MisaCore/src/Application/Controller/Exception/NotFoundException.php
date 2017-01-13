<?php
/**
 * Interface NotFoundException
 *
 * @package AptitusEducation\Application\Controller\Exception
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016
 */

namespace MisaCore\Application\Controller\Exception;

class NotFoundException extends HttpException
{
    /**
     * NotFoundException constructor.
     */
    public function __construct()
    {
        parent::__construct("Page not found", 404, 34);
    }
}
