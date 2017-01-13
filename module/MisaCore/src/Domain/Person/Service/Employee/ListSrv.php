<?php

namespace MisaCore\Domain\Person\Service\Employee;

use MisaCore\Domain\Base\Dto\PaginatorDto;
use MisaCore\Domain\Person\Entity\Employee;
use MisaCore\Domain\Person\Filter\EmployeeFilter;

/**
 * EmployeeManagementService interface
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Person\Service
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

interface ListSrv
{
    /**
     * @param $id
     * @return Employee
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
