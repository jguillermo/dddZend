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
use MisaCore\Domain\Person\Exception\RepUserNotFoundException;
use MisaCore\Domain\Person\Service\Employee\AuthSrv;

class AuthImp extends EmployeeImp implements AuthSrv
{

    /**
     * @param $user
     * @param $password
     * @return string
     * @throws SrvErrorException
     */
    public function authenticate($user, $password)
    {
        $jwt = '';
        try {
            $employee = $this->getEmployeeAuthenticate($user, $password);

            $jwt = $this->tokenService->generate([
                'id'   => $employee->getId(),
                'name' => $employee->getName().' '.$employee->getLastName(),
                'role' => $employee->getRole()
            ]);
        } catch (SrvErrorException $e) {
            throw new SrvErrorException('El usuario o password es incorrecto');
        }

        return $jwt;
    }

    /**
     * valida si el empleado esta registrado en la base de datos
     * @param $user
     * @param $password
     * @return Employee
     * @throws SrvErrorException
     */
    private function getEmployeeAuthenticate($user, $password)
    {
        $employee = false;

        $userFiltered = $this->employeeFilter->filterUser($user);
        $passwordFiltered = $this->employeeFilter->filterPassword($password);
        try {
            $employee = $this->employeeRepDl->getByUser($this->encryptService->encrypt($userFiltered));
        } catch (RepNotFoundException $e) {
            throw new SrvErrorException('El Usuario no existe.');
        }

        if (! $this->passwordService->verify($passwordFiltered, $employee->getPassword())) {
            throw new SrvErrorException('el password no coincide');
        }

        return $employee;
    }
}
