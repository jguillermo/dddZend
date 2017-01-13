<?php
namespace MisaCore\Infrastructure\Persistence\Sql\Person\Employee;

use MisaCore\Domain\Base\Dto\PaginatorDto;
use MisaCore\Domain\Person\Entity\Employee;
use MisaCore\Domain\Person\Implement\Filter\EmployeeFilterImplement;
use MisaCore\Domain\Person\Repository\Employee\ListRep;
use MisaCore\Infrastructure\Persistence\Sql\Person\Person\PersonSqlDl;
use Zend\Db\Sql\Select;

/**
 * EmployeeRepositoryImplement Class
 *
 * @package MisaCore\Infrastructure
 * @subpackage Persistence\Sql\Person
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class EmployeeSqlDl extends PersonSqlDl implements ListRep
{

    /**
     * retorna un empleado
     * @param string $id
     * @return Employee
     * @throws \Exception
     */
    public function getById($id)
    {

        $select = $this->getSelect();
        $select->where(['e.id' => $id]);

        $row = $this->getDriver()->getRowCurrent($select);

        $employeeFilter = new EmployeeFilterImplement();

        $rowFiltered = $employeeFilter->allFilter($row);

        return $this->factory()->baseHydrator()->hydrate($rowFiltered, new Employee());
    }

    /**
     * retorna un empleado
     * si no existe lanza una exception
     * @param  string $user
     * @return Employee
     */
    public function getByUser($user)
    {

        $select = $this->getSelect();
        $select->where(['e.user' => $user]);
        $row = $this->getDriver()->getRowCurrent($select);

        $employeeFilter = new EmployeeFilterImplement();
        $dataFiltered = $employeeFilter->allFilter($row);
        return  $this->factory()->baseHydrator()->hydrate($dataFiltered, new Employee());
    }

    /**
     * retorna un array con los datos completos del empleado
     * @param int $page
     * @param int $rp
     * @return PaginatorDto
     */
    public function getPage($page = 1, $rp = 10)
    {
        $select = $this->getSelect();
        $paginator = $this->getDriver()->paginator($select, $page, $rp);
        return $paginator->dto();
    }

    /**
     * genera el select con tolos los parametros por defecto
     * para poder ser usado en la herencia de otras entidades
     * @return Select
     */
    protected function getSelect()
    {
        $select = parent::getSelect();

        $select->join(
            [
            'e' => 'employee'],
            'e.id=p.id',
            [
                'role' => 'role',
                'user' => 'user',
                'password' => 'password'
            ]
        );
        return $select;
    }
}
