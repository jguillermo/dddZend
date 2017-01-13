<?php
/**
 * Inteface ListSrv
 *
 * @package MisaCore\Domain\Provider\Service\Provider
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCore\Domain\Provider\Service\Provider;

use MisaCore\Domain\Base\Dto\PaginatorDto;
use MisaCore\Domain\Provider\Entity\Provider;

interface ListSrv
{
    /**
     * @param $id
     * @return Provider
     */
    public function getById($id);

    /**
     * retorna la lista de empleados paginado
     * @param $currentPage    * pagina actual
     * @param int $itemByPage * empleados por pagina
     * @return PaginatorDto
     * id name lastName
     */
    public function getList($currentPage = 1, $itemByPage = 10);
}
