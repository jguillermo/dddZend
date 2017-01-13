<?php

namespace MisaCore\Domain\Person\Repository\Person;

use MisaCore\Domain\Base\Dto\MisaDto;
use MisaCore\Domain\Base\Dto\PaginatorDto;
use MisaCore\Domain\Person\Entity\Person;

/**
 * PersonRepository interface
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Person\Repository
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

interface ListRep
{
    /**
     * retorna un objeto persona con todos los datos llenos
     * @param string $id
     * @return Person
     */
    public function getById($id);

    /**
     * retorna un array con los datos completos del empleado
     * @param int $page
     * @param int $rp
     * @return PaginatorDto
     */
    public function getPage($page = 1, $rp = 10);
}
