<?php
/**
 * SqlDl Class
 *
 * @package MisaCore\Infrastructure\Persistence\Sql\Provider\Provider
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2017, Getmin
 */
namespace MisaCore\Infrastructure\Persistence\Sql\Provider\Provider;

use MisaCore\Domain\Base\Dto\PaginatorDto;
use MisaCore\Domain\Provider\Entity\Provider;
use MisaCore\Domain\Provider\Repository\Provider\ListRep;
use MisaCore\Infrastructure\Persistence\Sql\Implement\AbstractDb;

class SqlDl extends AbstractDb implements ListRep
{

    /**
     * @param string $id
     * @return Provider
     */
    public function getById($id)
    {
        // TODO: Implement getById() method.
    }

    /**
     * retorna un array con los datos completos del empleado
     * @param int $page
     * @param int $rp
     * @return PaginatorDto
     */
    public function getPage($page = 1, $rp = 10)
    {
        // TODO: Implement getPage() method.
    }
}
