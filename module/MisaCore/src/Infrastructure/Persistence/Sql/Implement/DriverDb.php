<?php

namespace MisaCore\Infrastructure\Persistence\Sql\Implement;

use MisaCore\Domain\Base\Exception\RepErrorException;
use MisaCore\Domain\Base\Exception\RepNotFoundException;
use MisaCore\Infrastructure\Paginator\PaginatorSql;
use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\ResultInterface;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\Sql\PreparableSqlInterface;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Db\Sql\SqlInterface;

/**
 * DriverDb class
 *
 * @package Infrastructure
 * @subpackage Persistence/sql
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
final class DriverDb
{
    /** @var  Adapter */
    private $adapter;

    /**
     * @return Adapter
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * AbstractDriver constructor.
     * @param Adapter $adapter
     */
    public function __construct(Adapter $adapter)
    {
        $this->adapter = $adapter;
    }

    /**
     * inserta datos en la tabla
     * @param string $table
     * @param array $data
     * @return bool
     */
    public function insert($table, $data)
    {
        $sqlInsert = $this->getSql()->insert($table);

        $sqlInsert->values($data);

        return $this->executeSqlObject($sqlInsert);
    }

    /**
     * inserta datos en la tabla
     * @param string $table
     * @param array $data
     * @return bool
     */
    public function insertBatch($table, $data)
    {
        foreach ($data as $row) {
            $this->insert($table, $row);
        }
        return true;
    }

    /**
     * actualiza datos de una tabla
     * @param string $table
     * @param array $data
     * @param array $where
     * @return bool
     */
    public function update($table, $data, $where)
    {
        $sqlUpdate = $this->getSql()->update($table);

        $sqlUpdate->set($data)->where($where);

        return $this->executeSqlObject($sqlUpdate);
    }

    /**
     * borra datos de una tabla
     * @param string $table
     * @param array $where
     * @return bool
     */
    public function delete($table, $where)
    {
        $sqlDelete = $this->getSql()->delete($table);

        $sqlDelete->where($where);

        return $this->executeSqlObject($sqlDelete);
    }

    /**
     * @param $table
     * @param array $where
     * @return array
     */
    public function select($table, array $where)
    {
        $select = $this->getSelect();
        $select->from($table)->where($where);
        /** @var ResultSet $rs */
        $rs = $this->executeSqlObject($select);
        return $rs->toArray();
    }



    /**
     * retorna el objeto SQL de todos los datos
     * @param string $table
     * @return Select
     */
    public function getAll($table)
    {
        return $this->getSelect($table);
    }

    /**
     * executa un string sql
     * @param $stringSql
     * @return \Zend\Db\Adapter\Driver\StatementInterface|\Zend\Db\ResultSet\ResultSet
     */
    public function query($stringSql)
    {
        $queryMode = $this->getAdapter();
        return $this->getAdapter()->query($stringSql, $queryMode::QUERY_MODE_EXECUTE);
    }

    /**
     * retorna la data del objeto Select
     * @param PreparableSqlInterface $sqlObject
     * @return bool|ResultSet
     * @throws RepErrorException
     */
    public function executeSqlObject(PreparableSqlInterface $sqlObject)
    {
        $result = false;
        try {
            $statement = $this->getSql()->prepareStatementForSqlObject($sqlObject);
            $resultSql = $statement->execute();

            if ($resultSql instanceof ResultInterface && $resultSql->isQueryResult()) {
                $resultSet = new ResultSet(ResultSet::TYPE_ARRAY);
                $resultSet->initialize($resultSql);
                $result = $resultSet;
            } else {
                $result = true;
            }
        } catch (\Exception $e) {
            //guardar en un log
            var_dump($e->getMessage());
            var_dump($this->toString($sqlObject));
            throw new RepErrorException("error sql server");
        }
        return $result;
    }

    /**
     * @param Select $select
     * @return ResultSet
     */
    public function executeSelect(Select $select)
    {
        return $this->executeSqlObject($select);
    }



    /**
     * retorna el row actual,
     * se usa para optener el row en forma de array
     * si no existe retorna un array vacio
     * se pone el limite a 1
     * @param Select $select
     * @return array
     * @throws RepNotFoundException
     */
    public function getRowCurrent(Select $select)
    {
        $select->limit(1);
        $rs = $this->executeSqlObject($select);
        if ($rs->count() == 0) {
            throw new RepNotFoundException("row not found");
        }
        return $rs->current();
    }

    /**
     * reorna el objeto SQL de ZF
     * @param null $table
     * @return Sql
     */
    protected function getSql($table = null)
    {
        return new Sql($this->getAdapter(), $table);
    }

    /**
     * retorna el obj Sql/Select de ZF
     * @param null $table
     * @return Select
     */
    public function getSelect($table = null)
    {
        return $this->getSql($table)->select();
    }

    /**
     * Convierte el objeto Select a una consuta string
     * @param SqlInterface $sqlObject
     * @return string
     */
    public function toString(SqlInterface $sqlObject)
    {
        return $this->getSql()->buildSqlString($sqlObject);
    }


    /**
     * existe en la base de datos
     * @param $table
     * @param string $id
     * @param string $columnId
     * @return bool
     */
    public function rowExistsInDatabase($table, $id, $columnId = 'id')
    {
        $exist = false;
        try {
            $select = $this->getSelect($table);
            $select
                ->columns([$columnId])
                ->where([$columnId => $id]);
            $row = $this->getRowCurrent($select);
            $exist = true;
        } catch (RepNotFoundException $e) {
            $exist = false;
        }

        return $exist;
    }

    /**
     * geenra un paginador
     * @param Select $select
     * @param int $currentPage *pagina actual
     * @param int $pageRange   *numero de items por pagina
     * @param int $itemCount   *numero de items del paginador
     * @return PaginatorSql
     */
    public function paginator(Select $select, $currentPage = 1, $pageRange = 10, $itemCount = -1)
    {
        $paginator = new PaginatorSql($select, $this->getAdapter(), $currentPage);
        $paginator->setPageRange($pageRange);
        $paginator->setItemCount($itemCount);
        return $paginator;
    }
}
