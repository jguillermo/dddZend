<?php
/**
 * Class PersonFac
 *
 * @package MisaCore\Application\Factory\Person
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCore\Application\Factory\Person;

use MisaCore\Application\Factory\Base\HydratorFac;
use MisaCore\Application\Service\DbAdapter;
use MisaCore\Domain\Base\Implement\Util\ArrayUtils;
use MisaCore\Domain\Person\Entity\Person;
use MisaCore\Domain\Person\Implement\Filter\PersonFilterImplement;
use MisaCore\Domain\Person\Implement\Service\Person\ListImp;
use MisaCore\Domain\Person\Implement\Service\Person\MngImp;
use MisaCore\Domain\Person\Implement\Validator\PersonValidatorImplement;
use MisaCore\Domain\Person\Service\Person\ListSrv;
use MisaCore\Domain\Person\Service\Person\MngSrv;
use MisaCore\Infrastructure\Persistence\Sql\Person\Person\PersonSqlDl;
use MisaCore\Infrastructure\Persistence\Sql\Person\Person\PersonSqlDm;

class PersonFac
{
    /**
     * @return ListSrv
     */
    public function listSrv()
    {
        $service = new ListImp();
        $service
            ->setPersonRepDl(new PersonSqlDl(DbAdapter::get()));
        return $service;
    }

    /**
     * @return MngSrv
     */
    public function mngSrv()
    {
        $service = new MngImp();
        $service
            ->setPersonRepDl(new PersonSqlDl(DbAdapter::get()))
            ->setPersonRepDm(new PersonSqlDm(DbAdapter::get()))
            ->setPersonEntity(new Person())
            ->setHydrator(HydratorFac::getInstance())
            ->setPersonValidator(new PersonValidatorImplement())
            ->setArrayUtil(new ArrayUtils())
            ->setPersonFilter(new PersonFilterImplement());
        return $service;
    }
}
