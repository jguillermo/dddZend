<?php
namespace MisaCore\Infrastructure\Persistence\Sql\Person\Employee;

use MisaCore\Domain\Person\Entity\Employee;
use MisaCore\Domain\Person\Repository\Employee\MngRep;
use MisaCore\Infrastructure\Persistence\Sql\Person\Person\PersonSqlDm;

/**
 * EmployeeRepositoryImplement Class
 *
 * @package MisaCore\Infrastructure
 * @subpackage Persistence\Sql\Person
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class EmployeeSqlDm extends PersonSqlDm implements MngRep
{

    /**
     * Guarda el emplado
     * @param Employee $employee
     * @return bool
     */
    public function saveEmployee(Employee $employee)
    {
        return $this->persisteEmployeeData($employee);
    }


    /**
     * alamcena los datos en al base de datos
     * si existe, lo actualiza, si no existe lo inserta
     * esta funcion se separo para poder guardar data en entidades heredadas
     * @param Employee $employee
     * @return bool
     */
    protected function persisteEmployeeData(Employee $employee)
    {
        $driver = $this->getDriver();
        $this->persistePersonData($employee);
        $params = $this->processParams($employee);
        if ($driver->rowExistsInDatabase('employee', $employee->getId())) {
            /** actualizar */
            $driver->update('employee', $params, ['id' => $employee->getId()]);
        } else {
            /** insertar */
            $driver->insert('employee', $params);
        }

        return true;
    }


    /**
     * clasifica los parametros que vienen para poder se guardados en al base de datos
     * @param Employee $employee
     * @return array
     */
    private function processParams(Employee $employee)
    {
        return [
            'id' => $employee->getId(),
            'role' => $employee->getRole(),
            'user' => $employee->getUser(),
            'password' => $employee->getPassword(),
        ];
    }
}
