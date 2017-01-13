<?php
/**
 * ProviderFac Class
 *
 * @package MisaCore\Application\Factory\Provider
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2017, Getmin
 */
namespace MisaCore\Application\Factory\Provider;

use MisaCore\Application\Service\DbAdapter;
use MisaCore\Domain\Base\Implement\Hydrator\AggregateHydratorImplement;
use MisaCore\Domain\Provider\Entity\Provider;
use MisaCore\Domain\Provider\Filter\ProviderFlt;
use MisaCore\Domain\Provider\Implement\Provider\ListImp;
use MisaCore\Domain\Provider\Implement\Provider\MngImp;
use MisaCore\Domain\Provider\Service\Provider\ListSrv;
use MisaCore\Domain\Provider\Service\Provider\MngSrv;
use MisaCore\Domain\Provider\Validator\ProviderVld;
use MisaCore\Infrastructure\Persistence\Sql\Provider\Provider\SqlDl;
use MisaCore\Infrastructure\Persistence\Sql\Provider\Provider\SqlDm;

class ProviderFac
{
    /**
     * @return ListSrv
     */
    public function listSrv()
    {
        $service = new ListImp();
        $service
            ->setProviderFilter(new ProviderFlt())
            ->setProviderRepDl(new SqlDl(DbAdapter::get()));
        return $service;
    }

    /**
     * @return MngSrv
     */
    public function mngSrv()
    {
        $service = new MngImp();
        $service
            ->setProviderEntity(new Provider())
            ->setProviderFilter(new ProviderFlt())
            ->setProviderValidator(new ProviderVld())
            ->setHydrator(new AggregateHydratorImplement())
            ->setProviderRepDl(new SqlDl(DbAdapter::get()))
            ->setProviderRepDm(new SqlDm(DbAdapter::get()));
        return $service;
    }
}
