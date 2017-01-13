<?php
namespace MisaCore\Infrastructure\Paginator;

use MisaCore\Domain\Base\Dto\PaginatorDto;
use Zend\Paginator\Paginator;

/**
 * AbstractPaginator Class
 *
 * @package MisaCore\Infrastructure
 * @subpackage Paginator
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
abstract class AbstractPaginator implements PaginatorInterface
{

    /**
     * retorna la data de la pagina actual
     * @return array
     */
    public function getItemsByPage()
    {
        return $this->paginator()->getItemsByPage($this->paginator()->getCurrentPageNumber());
    }

    /**
     * reorna los valores del paginador
     * @return object
     */
    public function getPages()
    {
        return $this->paginator()->getPages();
    }

    /**
     * setea la pagina que se va a retornar
     * @param int $currentPage
     * @return Paginator
     */
    public function setCurrentPage($currentPage = 1)
    {
        $this->paginator()->setCurrentPageNumber($currentPage);
    }

    /**
     * setea el numero de items del paginador que se va a mostrar
     * @param int $itemCount
     * @return Paginator
     * @throws \Exception
     */
    public function setItemCount($itemCount = -1)
    {
        $this->paginator()->setItemCountPerPage($itemCount);
    }

    /**
     * setea el numero de items a mostrar
     * @param int $pageRange
     * @return Paginator
     */
    public function setPageRange($pageRange = 10)
    {
        $this->paginator()->setPageRange($pageRange);
    }

    /**
     * retorna la data estandarizada por el dto
     * @return PaginatorDto
     */
    public function dto()
    {
        return new PaginatorDto(
            $this->getItemsByPage(),
            $this->getPages(),
            $this->paginator()->count(),
            $this->paginator()->getCurrentPageNumber()
        );
    }

    /**
     * @return Paginator
     */
    abstract protected function paginator();
}
