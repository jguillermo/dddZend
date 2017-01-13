<?php
namespace MisaCore\Domain\Base\Aggregate;

/**
 * Aggregate Class
 *
 * @package MisaCore\Domain
 * @subpackage Domain\Base\Aggregate
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class Aggregate
{
    /**
     * @return Aggregate
     */
    public function next()
    {
        return new $this;
        //$calledClass = get_called_class();
        //return new $calledClass;
    }
}
