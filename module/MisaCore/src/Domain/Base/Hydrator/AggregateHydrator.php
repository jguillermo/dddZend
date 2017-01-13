<?php
namespace MisaCore\Domain\Base\Hydrator;

use MisaCore\Domain\Base\Aggregate\Aggregate;

/**
 * AggregateHydrator Class
 *
 * @package MisaCore\Domain\Base\Hydrator
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
interface AggregateHydrator
{
    /**
     * extrae toda la data en formato array o objeto
     * @param Aggregate $aggregate
     * @return array
     */
    public function extract(Aggregate $aggregate);

    /**
     * agrega algunos paramestoa a la entidad
     * retorna la entidad con lo datos cargados
     * @param array $data
     * @param Aggregate $aggregate
     * @param string $prefix
     * @return Aggregate
     */
    public function hydrate(array $data, Aggregate $aggregate, $prefix = "");
}
