<?php

namespace MisaCore\Infrastructure\Persistence\Sql\Person\Person;

use MisaCore\Domain\Base\Dto\MisaDto;
use MisaCore\Domain\Person\Entity\Person;
use MisaCore\Domain\Person\Repository\Person\MngRep;
use MisaCore\Infrastructure\Persistence\Sql\Implement\AbstractDb;

/**
 * PersonRepositoryImplement class
 *
 * @package Domain
 * @subpackage MisaCore\Infrastructure\Persistence\Sql\Person
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class PersonSqlDm extends AbstractDb implements MngRep
{
    /**
     * guarda la entidad
     * @param Person $person
     * @return bool
     */
    public function save(Person $person)
    {
        return $this->persistePersonData($person);
    }


    /**
     * alamcena los datos en al base de datos
     * si existe, lo actualiza, si no existe lo inserta
     * esta funcion se separo para poder guardar data en entidades heredadas
     * @param Person $person
     * @return bool
     */
    protected function persistePersonData(Person $person)
    {
        $driver = $this->getDriver();

        $params = $this->processParams($person);

        if ($driver->rowExistsInDatabase('person', $person->getId())) {
            /** actualizar */
            $result = $driver->update('person', $params, ['id' => $person->getId()]);
        } else {
            /** insertar */
            $result = $driver->insert('person', $params);
        }
        return $result;
    }

    /**
     * clasifica los parametros que vienen para poder se guardados en al base de datos
     * @param Person $person
     * @return array
     */
    private function processParams(Person $person)
    {
        return  [
            'id' => $person->getId(),
            'name' => $person->getName(),
            'lastname' => $person->getLastName(),
            'secondlastname' => $person->getSecondLastName(),
        ];
    }
}
