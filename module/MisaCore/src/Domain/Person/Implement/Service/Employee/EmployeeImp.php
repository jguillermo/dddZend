<?php
/**
 * Class EmployeeImp
 *
 * @package MisaCore\Domain\Person\Implement\Service
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCore\Domain\Person\Implement\Service\Employee;

use MisaCore\Domain\Base\Hydrator\AggregateHydrator;
use MisaCore\Domain\Base\Implement\Util\ArrayUtils;
use MisaCore\Domain\Base\Service\EncryptService;
use MisaCore\Domain\Base\Service\PasswordService;
use MisaCore\Domain\Base\Service\TokenService;
use MisaCore\Domain\Person\Entity\Employee;
use MisaCore\Domain\Person\Filter\EmployeeFilter;
use MisaCore\Domain\Person\Repository\Employee\ListRep;
use MisaCore\Domain\Person\Repository\Employee\MngRep;
use MisaCore\Domain\Person\Validator\EmployeeValidator;

abstract class EmployeeImp
{
    /** @var  PasswordService */
    protected $passwordService;

    /** @var  EmployeeFilter */
    protected $employeeFilter;

    /** @var  EmployeeValidator */
    protected $employeeValidator;

    /** @var  EncryptService */
    protected $encryptService;

    /** @var  AggregateHydrator */
    protected $hydrator;

    /** @var  Employee */
    protected $employeeEntity;

    /** @var  ListRep */
    protected $employeeRepDl;

    /** @var  MngRep */
    protected $employeeRepDm;

    /** @var  TokenService */
    protected $tokenService;

    /** @var  ArrayUtils */
    protected $arrayUtil;

    /**
     * @param ArrayUtils $arrayUtil
     * @return EmployeeImp
     */
    public function setArrayUtil($arrayUtil)
    {
        $this->arrayUtil = $arrayUtil;
        return $this;
    }



    /**
     * @param TokenService $tokenService
     * @return EmployeeImp
     */
    public function setTokenService($tokenService)
    {
        $this->tokenService = $tokenService;
        return $this;
    }

    /**
     * @param PasswordService $passwordService
     * @return EmployeeImp
     */
    public function setPasswordService($passwordService)
    {
        $this->passwordService = $passwordService;
        return $this;
    }

    /**
     * @param EmployeeFilter $employeeFilter
     * @return EmployeeImp
     */
    public function setEmployeeFilter($employeeFilter)
    {
        $this->employeeFilter = $employeeFilter;
        return $this;
    }

    /**
     * @param EmployeeValidator $employeeValidator
     * @return EmployeeImp
     */
    public function setEmployeeValidator($employeeValidator)
    {
        $this->employeeValidator = $employeeValidator;
        return $this;
    }

    /**
     * @param EncryptService $encryptService
     * @return EmployeeImp
     */
    public function setEncryptService($encryptService)
    {
        $this->encryptService = $encryptService;
        return $this;
    }

    /**
     * @param AggregateHydrator $hydrator
     * @return EmployeeImp
     */
    public function setHydrator($hydrator)
    {
        $this->hydrator = $hydrator;
        return $this;
    }

    /**
     * @param Employee $employeeEntity
     * @return EmployeeImp
     */
    public function setEmployeeEntity($employeeEntity)
    {
        $this->employeeEntity = $employeeEntity;
        return $this;
    }

    /**
     * @param ListRep $employeeRepDl
     * @return EmployeeImp
     */
    public function setEmployeeRepDl($employeeRepDl)
    {
        $this->employeeRepDl = $employeeRepDl;
        return $this;
    }

    /**
     * @param MngRep $employeeRepDm
     * @return EmployeeImp
     */
    public function setEmployeeRepDm($employeeRepDm)
    {
        $this->employeeRepDm = $employeeRepDm;
        return $this;
    }
}
