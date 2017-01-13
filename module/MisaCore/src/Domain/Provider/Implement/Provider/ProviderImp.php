<?php
/**
 * Class ProviderImp
 *
 * @package MisaCore\Domain\Provider\Implement\Service\Provider
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCore\Domain\Provider\Implement\Provider;

use MisaCore\Domain\Base\Hydrator\AggregateHydrator;
use MisaCore\Domain\Provider\Entity\Provider;
use MisaCore\Domain\Provider\Filter\ProviderFlt;
use MisaCore\Domain\Provider\Validator\ProviderVld;
use MisaCore\Domain\Provider\Repository\Provider\ListRep;
use MisaCore\Domain\Provider\Repository\Provider\MngRep;

class ProviderImp
{
    /** @var  ProviderFlt */
    protected $providerFilter;

    /** @var  ProviderVld */
    protected $providerValidator;

    /** @var ListRep */
    protected $providerRepDl;

    /** @var  MngRep */
    protected $providerRepDm;

    /** @var  AggregateHydrator */
    protected $hydrator;

    /** @var  Provider */
    protected $providerEntity;

    /**
     * @param ProviderFlt $providerFilter
     * @return ProviderImp
     */
    public function setProviderFilter($providerFilter)
    {
        $this->providerFilter = $providerFilter;
        return $this;
    }

    /**
     * @param ProviderVld $providerValidator
     * @return ProviderImp
     */
    public function setProviderValidator($providerValidator)
    {
        $this->providerValidator = $providerValidator;
        return $this;
    }

    /**
     * @param ListRep $providerRepDl
     * @return ProviderImp
     */
    public function setProviderRepDl($providerRepDl)
    {
        $this->providerRepDl = $providerRepDl;
        return $this;
    }

    /**
     * @param MngRep $providerRepDm
     * @return ProviderImp
     */
    public function setProviderRepDm($providerRepDm)
    {
        $this->providerRepDm = $providerRepDm;
        return $this;
    }

    /**
     * @param AggregateHydrator $hydrator
     * @return ProviderImp
     */
    public function setHydrator($hydrator)
    {
        $this->hydrator = $hydrator;
        return $this;
    }

    /**
     * @param Provider $providerEntity
     * @return ProviderImp
     */
    public function setProviderEntity($providerEntity)
    {
        $this->providerEntity = $providerEntity;
        return $this;
    }
}
