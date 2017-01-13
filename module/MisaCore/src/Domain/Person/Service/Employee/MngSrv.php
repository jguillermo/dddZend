<?php

namespace MisaCore\Domain\Person\Service\Employee;

use MisaCore\Domain\Person\Entity\Employee;

/**
 * EmployeeManagementService interface
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Person\Service
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

interface MngSrv
{
    /**
     * @param array $data
     * @return bool
     */
    public function insert(array $data);


    /**
     * @param $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data);


    /**
     * actualiza el usuario de logueo del empleado
     * @param $id
     * @param $newUser
     * @param $password
     * @return bool
     */
    public function changeUser($id, $newUser, $password);

    /**
     * actualiza el usuario el password del empleado
     * @param $id
     * @param $newPassword
     * @param $repeatNewPassword
     * @param $oldPasword
     * @return bool
     */
    public function changePassword($id, $newPassword, $repeatNewPassword, $oldPasword);

    /**
     * valida si el password es el el id del empleado
     * si el empleado tiene el password enblanco "" la validacion es correcta
     * @param $id
     * @param $password
     * @return Employee
     */
    public function validatePasswordById($id, $password);
}
