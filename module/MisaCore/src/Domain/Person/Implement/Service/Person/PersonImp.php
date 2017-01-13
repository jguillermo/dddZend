<?php

namespace MisaCore\Domain\Person\Implement\Service\Person;

use MisaCore\Domain\Base\Hydrator\AggregateHydrator;
use MisaCore\Domain\Base\Implement\Util\ArrayUtils;
use MisaCore\Domain\Person\Entity\Person;
use MisaCore\Domain\Person\Filter\PersonFilter;
use MisaCore\Domain\Person\Repository\Person\ListRep;
use MisaCore\Domain\Person\Repository\Person\MngRep;
use MisaCore\Domain\Person\Service\Person\BootstrapSrv;
use MisaCore\Domain\Person\Validator\PersonValidator;

/**
 * PersonImplement class
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Person\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

abstract class PersonImp
{
    /** @var  ListRep */
    protected $personRepDl;

    /** @var  MngRep */
    protected $personRepDm;

    /** @var  PersonFilter */
    protected $personFilter;

    /** @var  PersonValidator */
    protected $personValidator;

    /** @var  AggregateHydrator */
    protected $hydrator;

    /** @var  Person */
    protected $personEntity;

    /** @var  ArrayUtils */
    protected $arrayUtil;

    /**
     * @param ArrayUtils $arrayUtil
     * @return PersonImp
     */
    public function setArrayUtil($arrayUtil)
    {
        $this->arrayUtil = $arrayUtil;
        return $this;
    }



    /**
     * @param ListRep $personRepDl
     * @return PersonImp
     */
    public function setPersonRepDl($personRepDl)
    {
        $this->personRepDl = $personRepDl;
        return $this;
    }

    /**
     * @param MngRep $personRepDm
     * @return PersonImp
     */
    public function setPersonRepDm($personRepDm)
    {
        $this->personRepDm = $personRepDm;
        return $this;
    }

    /**
     * @param PersonFilter $personFilter
     * @return PersonImp
     */
    public function setPersonFilter($personFilter)
    {
        $this->personFilter = $personFilter;
        return $this;
    }

    /**
     * @param PersonValidator $personValidator
     * @return PersonImp
     */
    public function setPersonValidator($personValidator)
    {
        $this->personValidator = $personValidator;
        return $this;
    }

    /**
     * @param AggregateHydrator $hydrator
     * @return PersonImp
     */
    public function setHydrator($hydrator)
    {
        $this->hydrator = $hydrator;
        return $this;
    }

    /**
     * @param Person $personEntity
     * @return PersonImp
     */
    public function setPersonEntity($personEntity)
    {
        $this->personEntity = $personEntity;
        return $this;
    }
}
