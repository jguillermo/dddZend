<?php
namespace MisaCore\Domain\Base\Aggregate;

use MisaCore\Domain\Base\Hydrator\AggregateHydrator;
use MisaCore\Domain\Base\Implement\Hydrator\AggregateHydratorImplement;

/**
 * CollectionAggregate Class
 *
 * @package MisaCore\Domain\Base\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class CollectionAggregate
{
    /** @var  Aggregate */
    private $aggregate;

    /** @var  array */
    private $collection;

    /** @var  AggregateHydrator */
    private $hydrator;

    public function __construct(Aggregate $aggregate)
    {
        $this->aggregate = $aggregate;
        $this->collection = [];
        $this->hydrator = null;
    }

    /**
     * @return AggregateHydratorImplement
     */
    private function getHydrator()
    {
        if (is_null($this->hydrator)) {
            $this->hydrator = new AggregateHydratorImplement();
        }
        return $this->hydrator;
    }


    /**
     * agrega los datos de un array
     * usa el hydrator generado para poder insertar los datos
     * @param array $data
     * @param string $key
     * @return $this
     * @throws \Exception
     */
    public function addArray(array $data, $key = "")
    {
        $aggregate = $this->getHydrator()->hydrate($data, $this->getEntity());
        return $this->add($aggregate, $key);
    }

    /**
     * @param Aggregate $aggregate
     * @param string $key
     * @return $this
     * @throws \Exception
     */
    public function add(Aggregate $aggregate, $key = "")
    {
        if (! ($aggregate instanceof $this->aggregate)) {
            throw new \Exception("El Aggregate no pertenece al tipo de la coleccion");
        }
        if (is_string($key) && $key != "") {
            $this->collection[$key] = $aggregate;
        } else {
            $this->collection[uniqid("c")] = $aggregate;
        }
        return $this;
    }

    /**
     * @param string $key
     * @return Aggregate
     */
    public function getByKey($key)
    {
        return $this->collection[$key];
    }

    /**
     * retorna todas la entidades
     * @return array
     */
    public function getAll()
    {
        return $this->collection;
    }

    /**
     * retorna el total de entidades
     * @return int
     */
    public function count()
    {
        return count($this->getAll());
    }

    /**
     * @return Aggregate
     */
    public function getEntity()
    {
        return $this->aggregate->next();
    }

    /**
     * @param bool $removeKey
     * @return array
     */
    public function toArray($removeKey = true)
    {
        $data = [];

        foreach ($this->collection as $key => $aggregate) {
            if ($removeKey) {
                $data[] = $this->getHydrator()->extract($aggregate);
            } else {
                $data[$key] = $this->getHydrator()->extract($aggregate);
            }
        }

        return $data;
    }
}
