<?php
namespace MisaCore\Domain\Base\Filter;

/**
 * AggregateFilter Class
 *
 * @package MisaCore\Domain\Base\Filter
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
interface AggregateFilter
{
    /**
     * retorna un array con los datos filtrados
     * @param array $params
     * @return array
     */
    public function allFilter($params);
}
