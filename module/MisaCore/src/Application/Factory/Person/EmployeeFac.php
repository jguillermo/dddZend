<?php
/**
 * Class EmployeeFac
 *
 * @package MisaCore\Application\Factory\Person
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCore\Application\Factory\Person;

use MisaCore\Application\Factory\Base\EncryptFac;
use MisaCore\Application\Factory\Base\HydratorFac;
use MisaCore\Application\Factory\Base\TokenFac;
use MisaCore\Application\Implement\Base\PasswordImplement;
use MisaCore\Application\Service\DbAdapter;
use MisaCore\Domain\Base\Implement\Util\ArrayUtils;
use MisaCore\Domain\Person\Entity\Employee;
use MisaCore\Domain\Person\Implement\Filter\EmployeeFilterImplement;
use MisaCore\Domain\Person\Implement\Service\Employee\AuthImp;
use MisaCore\Domain\Person\Implement\Service\Employee\ListImp;
use MisaCore\Domain\Person\Implement\Service\Employee\MngImp;
use MisaCore\Domain\Person\Implement\Validator\EmployeeValidatorImplement;
use MisaCore\Domain\Person\Service\Employee\AuthSrv;
use MisaCore\Domain\Person\Service\Employee\ListSrv;
use MisaCore\Domain\Person\Service\Employee\MngSrv;
use MisaCore\Infrastructure\Persistence\Sql\Person\Employee\EmployeeSqlDl;
use MisaCore\Infrastructure\Persistence\Sql\Person\Employee\EmployeeSqlDm;

class EmployeeFac
{

    /**
     * @return AuthSrv
     */
    public function authSrv()
    {
        $service = new AuthImp();
        $service
            ->setEmployeeRepDl(new EmployeeSqlDl(DbAdapter::get()))
            ->setEmployeeRepDm(new EmployeeSqlDm(DbAdapter::get()))
            ->setHydrator(HydratorFac::getInstance())
            ->setEmployeeEntity(new Employee())
            ->setEncryptService(EncryptFac::getInstance())
            ->setEmployeeValidator(new EmployeeValidatorImplement())
            ->setEmployeeFilter(new EmployeeFilterImplement())
            ->setPasswordService(new PasswordImplement())
            ->setTokenService(TokenFac::getInstance())
            ->setArrayUtil(new ArrayUtils());
        return $service;
    }

    /**
     * @return ListSrv
     */
    public function listSrv()
    {
        $service = new ListImp();
        $service
            ->setEmployeeRepDl(new EmployeeSqlDl(DbAdapter::get()))
            ->setEmployeeRepDm(new EmployeeSqlDm(DbAdapter::get()))
            ->setHydrator(HydratorFac::getInstance())
            ->setEmployeeEntity(new Employee())
            ->setEncryptService(EncryptFac::getInstance())
            ->setEmployeeValidator(new EmployeeValidatorImplement())
            ->setEmployeeFilter(new EmployeeFilterImplement())
            ->setPasswordService(new PasswordImplement())
            ->setArrayUtil(new ArrayUtils());

        return $service;
    }

    /**
     * @return MngSrv
     */
    public function mngSrv()
    {
        $service = new MngImp();
        $service
            ->setEmployeeRepDl(new EmployeeSqlDl(DbAdapter::get()))
            ->setEmployeeRepDm(new EmployeeSqlDm(DbAdapter::get()))
            ->setHydrator(HydratorFac::getInstance())
            ->setEmployeeEntity(new Employee())
            ->setEncryptService(EncryptFac::getInstance())
            ->setEmployeeValidator(new EmployeeValidatorImplement())
            ->setEmployeeFilter(new EmployeeFilterImplement())
            ->setPasswordService(new PasswordImplement())
            ->setArrayUtil(new ArrayUtils());
        return $service;
    }
}
