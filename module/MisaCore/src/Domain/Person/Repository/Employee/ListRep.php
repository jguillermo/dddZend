<?php

namespace MisaCore\Domain\Person\Repository\Employee;

use MisaCore\Domain\Base\Dto\MisaDto;
use MisaCore\Domain\Base\Dto\PaginatorDto;
use MisaCore\Domain\Person\Entity\Employee;

/**
 * EmployeeRepository interface
 *
 * @package Domain
 * @subpackage Person\Repository
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
interface ListRep
{
    /**
     * retorna un empleado
     * si no existe lanza una exception
     * @param  string $user
     * @return Employee
     */
    public function getByUser($user);

    /**
     * retorna un empleado
     * si no existe lanza una exception
     * @param string $id
     * @return Employee
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
