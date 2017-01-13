<?php
/**
 * Class EmployeeImp
 *
 * @package MisaCore\Domain\Person\Implement\Service
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCore\Domain\Person\Implement\Service\Employee;

use MisaCore\Domain\Base\Dto\PaginatorDto;
use MisaCore\Domain\Base\Exception\RepNotFoundException;
use MisaCore\Domain\Base\Exception\SrvErrorException;
use MisaCore\Domain\Base\Implement\Filter\Element\PaginatorPageFilter;
use MisaCore\Domain\Person\Entity\Employee;
use MisaCore\Domain\Person\Exception\RepUserNotFoundException;
use MisaCore\Domain\Person\Service\Employee\ListSrv;

class ListImp extends EmployeeImp implements ListSrv
{
    /**
     * @param $id
     * @return Employee
     * @throws SrvErrorException
     */
    public function getById($id)
    {
        $filteredId = $this->employeeFilter->filterId($id);
        try {
            $employee = $this->employeeRepDl->getById($filteredId);
        } catch (RepNotFoundException $e) {
            throw  new SrvErrorException("Empleado no encontrado.");
        }
        return $employee;
    }

    /**
     * retorna la lista de empleados paginado
     * @param $currentPage * pagina actual
     * @param int $itemByPage * empleados por pagina
     * @return PaginatorDto
     * id name lastName
     */
    public function getList($currentPage = 1, $itemByPage = 10)
    {
        $currentPage = PaginatorPageFilter::filter($currentPage);
        $itemByPage = PaginatorPageFilter::filter($itemByPage);

        return $this->employeeRepDl->getPage($currentPage, $itemByPage);
    }
}
