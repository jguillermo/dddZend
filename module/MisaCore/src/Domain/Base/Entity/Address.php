<?php
/**
 * Class Address
 *
 * @package MisaCore\Domain\Base\Entity
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCore\Domain\Base\Entity;

use MisaCore\Domain\Base\Aggregate\Entity;

class Address extends Entity
{
    /** @var  string */
    private $name;

    /** @var  string */
    private $reference;

    /**
     * Address constructor.
     */
    public function __construct()
    {
        $this->name = '';
        $this->reference = '';
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
     * @return Address
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @param string $reference
     * @return Address
     */
    public function setReference($reference)
    {
        $this->reference = $reference;
        return $this;
    }
}
