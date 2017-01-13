<?php
/**
 * Class Provide
 *
 * @package MisaCore\Domain\Provider\Entity
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCore\Domain\Provider\Entity;

use MisaCore\Domain\Base\Aggregate\CollectionAggregate;
use MisaCore\Domain\Base\Aggregate\Entity;
use MisaCore\Domain\Base\Entity\Address;

class Provider extends Entity
{
    /** @var  string */
    private $name;

    /** @var  CollectionAggregate */
    private $address;

    /** @var  string */
    private $comment;

    /**
     * Provider constructor.
     */
    public function __construct()
    {
        $this->name = "";
        $this->address = new CollectionAggregate(new ProviderAdress());
        $this->comment = "";
        parent::__construct();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Provider
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return CollectionAggregate
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param CollectionAggregate $address
     * @return Provider
     */
    public function setAddress($address)
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param string $comment
     * @return Provider
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
        return $this;
    }
}
