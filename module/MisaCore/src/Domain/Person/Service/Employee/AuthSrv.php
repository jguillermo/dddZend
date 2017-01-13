<?php

namespace MisaCore\Domain\Person\Service\Employee;

/**
 * EmployeeManagementService interface
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Person\Service
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

interface AuthSrv
{
    /**
     * valida si el empleado esta registrado en la base de datos
     * @param $user
     * @param $password
     * @return string jwt de logueo
     */
    public function authenticate($user, $password);
}
