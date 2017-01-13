<?php
/**
 * Aptitus Project
 *
 *
 * @author Jose Guillermo <jguillermo@outlook.com>
 */

namespace MisaCore\Infrastructure\Paginator;

use Zend\Paginator\Paginator;

interface PaginatorInterface
{
    /**
     * retorna la data de la pagina actual
     * @return array
     */
    public function getItemsByPage();

    /**
     * reorna los valores del paginador
     * @return object
     */
    public function getPages();

    /**
     * setea la pagina que se va a retornar
     * @param int $currentPage
     * @return Paginator
     */
    public function setCurrentPage($currentPage = 1);

    /**
     * setea el numero de items del paginador que se va a mostrar
     * @param int $itemCount
     * @return Paginator
     * @throws \Exception
     */
    public function setItemCount($itemCount = -1);

    /**
     * setea el numero de items a mostrar
     * @param int $pageRange
     * @return Paginator
     */
    public function setPageRange($pageRange = 10);
}
