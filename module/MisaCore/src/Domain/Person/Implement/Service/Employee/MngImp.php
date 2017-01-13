<?php
/**
 * Class EmployeeImp
 *
 * @package MisaCore\Domain\Person\Implement\Service
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCore\Domain\Person\Implement\Service\Employee;

use MisaCore\Domain\Base\Exception\RepNotFoundException;
use MisaCore\Domain\Base\Exception\SrvErrorException;
use MisaCore\Domain\Person\Entity\Employee;
use MisaCore\Domain\Person\Service\Employee\MngSrv;

class MngImp extends EmployeeImp implements MngSrv
{
    /**
     * @param array $data
     * @return string
     */
    public function insert(array $data)
    {
        $data['user'] = "";
        $data['password'] = "";
        /** @var Employee $employee */
        $employee = $this->employeeEntity->next();
        return $this->save($data, $employee);
    }

    /**
     * @param $id
     * @param array $data
     * @return bool
     * @throws SrvErrorException
     */
    public function update($id, array $data)
    {
        try {
            $employee = $this->employeeRepDl->getById($id);
        } catch (RepNotFoundException $e) {
            throw new SrvErrorException("el id no existe");
        }
        /**
         * No se considerasn estos campos al actualizar,
         * por ser datos generados por otros servicios
         */
        unset($data['user']);
        unset($data['password']);
        return $this->save($data, $employee);
    }

    /**
     * @param $data
     * @param Employee $employee
     * @return bool
     */
    private function save($data, Employee $employee)
    {
        $filteredParams = $this->employeeFilter->allFilter($data);
        /** @var Employee $entity */
        $entity = $this->hydrator->hydrate($filteredParams, $employee);
        $this->employeeValidator->isValid($this->hydrator->extract($entity));
        return $this->employeeRepDm->saveEmployee($entity);
    }

    /**
     * * actualiza el usuario de logueo del empleado
     * @param $id
     * @param $newUser
     * @param $password
     * @return bool
     * @throws SrvErrorException
     */
    public function changeUser($id, $newUser, $password)
    {
        $employee = $this->validatePasswordById($id, $password);
        $data = [
            'user' => $this->encryptService->encrypt($newUser)
        ];
        return $this->save($data, $employee);
    }

    /**
     * actualiza el usuario el password del empleado
     * @param $id
     * @param $newPassword
     * @param $repeatNewPassword
     * @param $oldPassword
     * @return bool
     * @throws SrvErrorException
     */
    public function changePassword($id, $newPassword, $repeatNewPassword, $oldPassword)
    {
        if ($newPassword != $repeatNewPassword) {
            throw new SrvErrorException("los passwords no coinciden");
        }
        $employee = $this->validatePasswordById($id, $oldPassword);
        $data = [
            'password' => $this->passwordService->create($newPassword)
        ];
        return $this->save($data, $employee);
    }

    /**
     * valida si el password es el el id del empleado
     * si el empleado tiene el password enblanco "" la validacion es correcta
     * @param $id
     * @param $password
     * @return Employee
     * @throws SrvErrorException
     */
    public function validatePasswordById($id, $password)
    {
        $employee = $this->employeeRepDl->getById($id);
        if ($employee->getPassword() != '') {
            if (! $this->passwordService->verify($password, $employee->getPassword())) {
                throw new SrvErrorException('Fallo la autenticacion del password');
            }
        }
        return $employee;
    }
}
