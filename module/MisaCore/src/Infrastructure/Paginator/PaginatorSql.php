<?php
namespace MisaCore\Infrastructure\Paginator;

use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\Predicate\Expression;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;

/**
 * PaginatorSql Class
 *
 * @package MisaCore\Infrastructure
 * @subpackage Paginator
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class PaginatorSql extends AbstractPaginator
{

    /** @var  Paginator */
    private $paginator;

    /** @var  Select */
    private $select;

    /** @var  Adapter */
    private $adapter;

    const ROW_COUNT_COLUMN_NAME = 'C';

    /**
     * PaginatorSql constructor.
     * @param Select $select
     * @param Adapter $adapter
     * @param int $currentPage
     */
    public function __construct(Select $select, Adapter $adapter, $currentPage = 1)
    {
        $this->select = $select;
        $this->adapter = $adapter;
        $this->setCurrentPage($currentPage);
    }

    /**
     * @return Paginator
     */
    protected function paginator()
    {
        if (is_null($this->paginator)) {
            $countSelect = $this->getCountSelect();
            $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);
            $this->paginator = new Paginator(
                new DbSelect($this->select, $this->adapter, $resultSet, $countSelect)
            );
        }

        return $this->paginator;
    }

    /**
     * retorna la funcion para optener el total de elementos de la consulta
     * @return Select
     */
    private function getCountSelect()
    {
        $select = clone $this->select;

        $group = $select->getRawState($select::GROUP);

        $joins = $select->getRawState($select::JOINS);

        /**
         * esta validacion es para poder sacar el contador real,
         * en los joins da error al sacar datos adicionales de un join y este join tiene columasn adicionales
         * ya que el group by saca un error
         */
        if (! is_null($group) || ! is_null($joins)) {
            return null;
        }

        $select->reset(Select::LIMIT);
        $select->reset(Select::OFFSET);
        $select->reset(Select::ORDER);

        $select->columns([self::ROW_COUNT_COLUMN_NAME => new Expression('COUNT(*)')]);

        return $select;
    }
}
