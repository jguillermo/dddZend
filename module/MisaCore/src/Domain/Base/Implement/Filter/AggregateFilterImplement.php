<?php
namespace MisaCore\Domain\Base\Implement\Filter;

use MisaCore\Domain\Base\Filter\AggregateFilter;
use MisaCore\Domain\Base\Implement\Hydrator\AggregateHydratorImplement;

/**
 * AbstractAggregateFilterImplement Class
 *
 * @package MisaCore\Domain\Base\Implement\Filter
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class AggregateFilterImplement implements AggregateFilter
{
    /** @var string  */
    private $prefix;

    /**
     * AggregateFilterImplement constructor.
     */
    public function __construct()
    {
        $this->prefix = "";
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     * @return AggregateFilterImplement
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * retorna un array con los datos filtrados
     * @param array $params
     * @return array
     */
    public function allFilter($params)
    {
        $params = $this->elementFilter($params);
        $params = $this->elementAggregateFilter($params);
        $params = $this->elementCollectionFilter($params);
        return $params;
    }

    /**
     * filtra elemtos primitivos como string, int, float, etc
     * @param array $data
     * @return array
     */
    private function elementFilter(array $data)
    {
        $filterMethods = $this->getFilterMethods('filter');
        foreach ($filterMethods as $method => $nameKeyMethod) {
            $nameKeyMethod = $this->getPrefix().$nameKeyMethod;
            if (isset($data[$nameKeyMethod])) {
                $data[$nameKeyMethod] = $this->{'filter'.$method}($data[$nameKeyMethod]);
            }
        }
        return $data;
    }

    /**
     * filtra los elementos de un aggregate anidado
     * para eso usa recursividad
     * @param array $data
     * @return array
     */
    private function elementAggregateFilter(array $data)
    {
        $filterMethods = $this->getFilterMethods('aggregate');

        foreach ($filterMethods as $method => $nameKeyMethod) {
            $nameKeyMethod = $this->getPrefix().$nameKeyMethod;
            /** @var AggregateFilterImplement $filter */
            $filter = $this->{'aggregate'.$method}();
            if ($filter instanceof AggregateFilterImplement) {
                $filter->setPrefix($nameKeyMethod.AggregateHydratorImplement::SEPARATE);
                $data = $filter->allFilter($data);
            }
        }
        return $data;
    }


    /**
     * filtra los elementos de una coleccion de agregates
     * @param array $data
     * @return array
     */
    private function elementCollectionFilter(array $data)
    {
        $filterMethods = $this->getFilterMethods('collection');

        foreach ($filterMethods as $method => $nameKeyMethod) {
            $nameKeyMethod = $this->getPrefix().$nameKeyMethod;
            /** @var AggregateFilterImplement $filter */
            $filter = $this->{'collection'.$method}();
            if ($filter instanceof AggregateFilterImplement) {
                if (isset($data[$nameKeyMethod]) && is_array($data[$nameKeyMethod])) {
                    foreach ($data[$nameKeyMethod] as $key => $row) {
                        $data[$nameKeyMethod][$key] = $filter->allFilter($row);
                    }
                }
            }
        }
        return $data;
    }

    /**
     * genera un array con los nombres de las funciones
     * que tengan el prefijo pasado por el parametro
     * @param $prefix
     * @return array
     */
    private function getFilterMethods($prefix)
    {
        $listMethods = get_class_methods($this);
        $return = [];
        $strlenPrefix = strlen($prefix);
        foreach ($listMethods as $method) {
            if (substr($method, 0, $strlenPrefix) === $prefix) {
                $return[substr($method, $strlenPrefix)] =
                    strtolower(substr($method, $strlenPrefix, 1)) . substr($method, ($strlenPrefix + 1));
            }
        }
        return $return;
    }
}
