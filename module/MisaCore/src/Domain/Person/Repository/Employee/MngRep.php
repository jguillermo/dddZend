<?php

namespace MisaCore\Domain\Person\Repository\Employee;

use MisaCore\Domain\Person\Entity\Employee;

/**
 * EmployeeRepository interface
 *
 * @package Domain
 * @subpackage Person\Repository
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
interface MngRep
{
    /**
     * Guarda el emplado
     * @param Employee $employee
     * @return bool
     */
    public function saveEmployee(Employee $employee);
}
