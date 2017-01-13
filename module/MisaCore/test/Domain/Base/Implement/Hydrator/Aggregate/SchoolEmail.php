<?php
namespace MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate;

use MisaCore\Domain\Base\Aggregate\ValueObject;

/**
 * SchoolEmail Class
 *
 * @package MisaCoreTest\Domain\Base\Implement\Hydrator\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class SchoolEmail extends ValueObject
{
    /** @var  string */
    private $name;

    /** @var  string */
    private $domain;

    /**
     * SchoolEmail constructor.
     */
    public function __construct()
    {
        $this->name = "";
        $this->domain = "school.com";
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
     * @return SchoolEmail
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @param string $domain
     * @return SchoolEmail
     */
    public function setDomain($domain)
    {
        $this->domain = $domain;
        return $this;
    }

    public function email()
    {
        return $this->getName().'@'.$this->getDomain();
    }
}
