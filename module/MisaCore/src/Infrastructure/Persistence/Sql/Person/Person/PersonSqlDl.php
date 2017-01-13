<?php

namespace MisaCore\Infrastructure\Persistence\Sql\Person\Person;

use MisaCore\Domain\Base\Dto\PaginatorDto;
use MisaCore\Domain\Person\Entity\Person;
use MisaCore\Domain\Person\Implement\Filter\PersonFilterImplement;
use MisaCore\Domain\Person\Repository\Person\ListRep;
use MisaCore\Infrastructure\Persistence\Sql\Implement\AbstractDb;
use Zend\Db\Sql\Select;

/**
 * PersonRepositoryImplement class
 *
 * @package Domain
 * @subpackage MisaCore\Infrastructure\Persistence\Sql\Person
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class PersonSqlDl extends AbstractDb implements ListRep
{

    /**
     * retorna un objeto persona con todos los datos llenos
     * si no existe retorna ua persona con los datos vacios
     * @param string $id
     * @return Person
     * @throws \Exception
     */
    public function getById($id)
    {
        $select = $this->getSelect();

        $select->where(['p.id' => $id]);

        $row = $this->getDriver()->getRowCurrent($select);

        $personFilter = new PersonFilterImplement();

        $rowFiltered = $personFilter->allFilter($row);

        /** @var Person $person */
        $person = $this->factory()->baseHydrator()->hydrate($rowFiltered, new Person());

        return $person;
    }

    /**
     * genera el select con tolos los parametros por defecto
     * para poder ser usado en la herencia de otras entidades
     * @return Select
     */
    protected function getSelect()
    {
        $select = $this->getDriver()->getSelect();
        $select->from(['p' => 'person']);
        $select->columns([
            'id' => 'id',
            'name' => 'name',
            'lastName' => 'lastname',
            'secondLastName' => 'secondlastname',
        ]);
        return $select;
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
}
