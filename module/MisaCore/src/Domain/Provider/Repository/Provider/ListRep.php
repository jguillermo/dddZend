<?php
/**
 * Inteface ListRep
 *
 * @package MisaCore\Domain\Provider\Repository\Provider
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCore\Domain\Provider\Repository\Provider;

use MisaCore\Domain\Base\Dto\PaginatorDto;
use MisaCore\Domain\Provider\Entity\Provider;

interface ListRep
{
    /**
     * @param string $id
     * @return Provider
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
