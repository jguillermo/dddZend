<?php
/**
 * PersistEntity Class
 *
 * @package MisaCore\Infrastructure\Persistence\Sql\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2017, Getmin
 */
namespace MisaCore\Infrastructure\Persistence\Sql\Implement\Plugins;

class PersistEntity extends PluginDriverDb
{


    public function persistData($data, $dataId, $tableName, $tableId)
    {
        $dataEntity = $this->arrayWhithKey($data, $dataId);
        $dataDb = $this->getDataDbByKeys(array_column($data, $dataId), $tableName, $tableId);
        $dataSeparate = $this->separateData($dataEntity, $dataDb);

        if (count($dataSeparate['insert']) > 0) {
            foreach ($dataSeparate['update'] as $row) {
                $this->getDriver()->insert($tableName, $row);
            }
        }
        if (count($dataSeparate['update']) > 0) {
            foreach ($dataSeparate['update'] as $row) {
                $this->getDriver()->update($tableName, $row, [$tableId => $row[$dataId]]);
            }
        }
        if (count($dataSeparate['delete']) > 0) {
            foreach ($dataSeparate['delete'] as $row) {
                $this->getDriver()->delete($tableName, [$tableId => $row[$tableId]]);
            }
        }

        return true;
    }

    private function separateData($dataEnt, $dataDb)
    {
        /*
        $array1 = array("a" => "green", "b" => "brown", "c" => "blue", "red"); //entity
        $array2 = array("a" => "green", "b" => "brown", "c" => "blue2", "red"); //db
        $result = array_diff_assoc($array1, $array2);
        print_r($result);
        */
        $row = [
            'insert' => [],
            'update' => [],
            'delete' => [],
        ];
        foreach ($dataEnt as $keyEntity => $rowEntity) {
            if (! isset($dataDb[$keyEntity])) {
                $row['insert'][] = $rowEntity;
                continue;
            }
            $diff = array_diff_assoc($rowEntity, $dataDb[$keyEntity]);
            if (count($diff) > 0) {
                $row['update'][] = $rowEntity;
            }
        }

        foreach ($dataDb as $keyDb => $rowDb) {
            if (! isset($dataEnt[$keyDb])) {
                $row['delete'][] = $rowDb;
                continue;
            }
        }
        return $row;
    }

    /**
     * extrae la data de una coleccion de ids
     * @param array $ids listade ids a buscar en una tabla
     * @param $table -nombre de la tabla a buscar
     * @param string $columnId columna que se va a buscar los ids
     * @return array
     */
    private function getDataDbByKeys(array $ids, $table, $columnId)
    {
        $select = $this->getDriver()->getSelect();
        $select->from($table);
        $select->where->in($columnId, $ids);
        $result = $this->getDriver()->executeSelect($select)->toArray();
        return $this->arrayWhithKey($result, $columnId);
    }

    /**
     * retorna el array con los key de una columna
     * @param $data
     * @param $key
     * @return array
     */
    private function arrayWhithKey($data, $key)
    {
        $names = array_column($data, $key);
        return array_combine($names, $data);
    }
}
