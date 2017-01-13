<?php

namespace MisaCore\Domain\Person\Implement\Service\Person;

use MisaCore\Domain\Base\Dto\MisaDto;
use MisaCore\Domain\Base\Dto\PaginatorDto;
use MisaCore\Domain\Base\Exception\SrvErrorException;
use MisaCore\Domain\Base\Hydrator\AggregateHydrator;
use MisaCore\Domain\Base\Implement\Filter\Element\PaginatorPageFilter;
use MisaCore\Domain\Person\Entity\Person;
use MisaCore\Domain\Person\Filter\PersonFilter;
use MisaCore\Domain\Person\Repository\Person\ListRep;
use MisaCore\Domain\Person\Repository\Person\MngRep;
use MisaCore\Domain\Person\Service\Person\BootstrapSrv;
use MisaCore\Domain\Person\Service\Person\ListSrv;
use MisaCore\Domain\Person\Validator\PersonValidator;

/**
 * PersonImplement class
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Person\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class ListImp extends PersonImp implements ListSrv
{
    /**
     * @param $id
     * @return Person
     */
    public function getById($id)
    {
        return $this->personRepDl->getById($id);
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

        return $this->personRepDl->getPage($currentPage, $itemByPage);
    }
}
