<?php
/**
 * Class ListImp
 *
 * @package MisaCore\Domain\Provider\Implement\Service\Provider
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCore\Domain\Provider\Implement\Provider;

use MisaCore\Domain\Base\Dto\PaginatorDto;
use MisaCore\Domain\Base\Exception\RepNotFoundException;
use MisaCore\Domain\Base\Exception\SrvErrorException;
use MisaCore\Domain\Base\Implement\Filter\Element\PaginatorPageFilter;
use MisaCore\Domain\Provider\Entity\Provider;
use MisaCore\Domain\Provider\Service\Provider\ListSrv;

class ListImp extends ProviderImp implements ListSrv
{

    /**
     * @param $id
     * @return Provider
     * @throws SrvErrorException
     */
    public function getById($id)
    {
        $filteredId = $this->providerFilter->filterId($id);
        try {
            $provider = $this->providerRepDl->getById($filteredId);
        } catch (RepNotFoundException $e) {
            throw  new SrvErrorException("Proveedor no encontrado.");
        }
        return $provider;
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

        return $this->providerRepDl->getPage($currentPage, $itemByPage);
    }
}
