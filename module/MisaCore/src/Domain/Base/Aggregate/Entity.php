<?php
namespace MisaCore\Domain\Base\Aggregate;

use MisaCore\Domain\Base\Implement\MisaUniqId;

/**
 * Entity Class
 *
 * @package MisaCore\Domain\Base\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class Entity extends Aggregate
{
    /** @var  string */
    private $id;

    /**
     * Entity constructor.
     */
    public function __construct()
    {
        $this->setId(MisaUniqId::generate('E'));
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     * @return Entity
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }
}
