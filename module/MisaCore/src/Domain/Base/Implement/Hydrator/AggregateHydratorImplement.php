<?php
namespace MisaCore\Domain\Base\Implement\Hydrator;

use MisaCore\Domain\Base\Aggregate\Aggregate;
use MisaCore\Domain\Base\Aggregate\CollectionAggregate;
use MisaCore\Domain\Base\Hydrator\AggregateHydrator;

/**
 * AggregateHydratorImplement Class
 *
 * @package MisaCore\Domain\Base\Implement\Hydrator
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class AggregateHydratorImplement implements AggregateHydrator
{
    const SEPARATE = "-";

    /**
     * extrae toda la data en formato array o objeto
     * @param Aggregate $aggregate
     * @return array
     */
    public function extract(Aggregate $aggregate)
    {
        $data = [];

        $methods = $this->getClassGetMethods($aggregate);

        foreach ($methods as $method => $nameKeyMethod) {
            $dataMethod = $aggregate->{'get' . $method}();

            /** en caso de ser una Entidad, ValueObject o Agregate
             * se extrae los datos en forma recursiva
             */
            if ($dataMethod instanceof Aggregate) {
                $values = $this->extract($dataMethod);
                foreach ($values as $key => $valEntity) {
                    $data[$nameKeyMethod . self::SEPARATE . $key] = $valEntity;
                }
            } /** en caso de ser una coleccion,
             * se recorre el arreglo y se extrae la data
             */
            elseif ($dataMethod instanceof CollectionAggregate) {
                $data[$nameKeyMethod] = [];
                foreach ($dataMethod->getAll() as $collectionEntity) {
                    $data[$nameKeyMethod][] = $this->extract($collectionEntity);
                }
            } else {
                $data[$nameKeyMethod] = $dataMethod;
            }
        }
        return $data;
    }

    /**
     * agrega algunos paramestoa a la entidad
     * retorna la entidad con lo datos cargados
     * @param array $data
     * @param Aggregate $aggregate
     * @param string $prefix
     * @return Aggregate
     */
    public function hydrate(array $data, Aggregate $aggregate, $prefix = "")
    {

        $methods = $this->getClassGetMethods($aggregate);

        foreach ($methods as $method => $nameKeyMethod) {
            $nameKeyMethod = $prefix.$nameKeyMethod;

            $dataMethod = $aggregate->{'get' . $method}();

            /** en caso de ser una Entidad, ValueObject o Agregate
             * se hydrata los datos en forma recursiva
             */
            if ($dataMethod instanceof Aggregate) {
                $objAggregate = $this->hydrate($data, $dataMethod->next(), $nameKeyMethod.self::SEPARATE);
                $aggregate->{'set'.$method}($objAggregate);
            } /** en caso de ser una coleccion,
             * se recorre el arreglo y se hydrata la data
             */
            elseif ($dataMethod instanceof CollectionAggregate) {
                if (isset($data[$nameKeyMethod]) && is_array($data[$nameKeyMethod])) {
                    foreach ($data[$nameKeyMethod] as $keyCollection => $rowCollection) {
                        $objAggregateCollection = $this->hydrate($rowCollection, $dataMethod->getEntity());
                        $dataMethod->add($objAggregateCollection, $keyCollection.'');
                    }
                }
            } else {
                if (isset($data[$nameKeyMethod])) {
                    $aggregate->{'set'.$method}($data[$nameKeyMethod]);
                }
            }
        }
        return $aggregate;
    }

    /**
     * genera un array con los nombres de las funciones
     * que tengan el prefijo pasado por el parametro
     * @param Aggregate $aggregate
     * @return array
     */
    private function getClassGetMethods(Aggregate $aggregate)
    {
        $listMethods = get_class_methods($aggregate);
        $return = [];
        foreach ($listMethods as $method) {
            if (substr($method, 0, 3) === 'get') {
                $return[substr($method, 3)] = strtolower(substr($method, 3, 1)) . substr($method, 4);
            }
        }
        return $return;
    }
}
