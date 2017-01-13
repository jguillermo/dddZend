<?php

namespace MisaCore\Domain\Person\Repository\Person;

use MisaCore\Domain\Base\Dto\MisaDto;
use MisaCore\Domain\Person\Entity\Person;

/**
 * PersonRepository interface
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Person\Repository
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

interface MngRep
{

    /**
     * guarda la entidad
     * @param Person $person
     * @return bool
     */
    public function save(Person $person);
}
