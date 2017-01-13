<?php
/**
 * Inteface MngRep
 *
 * @package MisaCore\Domain\Provider\Repository\Provider
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCore\Domain\Provider\Repository\Provider;

use MisaCore\Domain\Provider\Entity\Provider;

interface MngRep
{
    /**
     * guarda la entidad
     * @param Provider $provider
     * @return bool
     */
    public function save(Provider $provider);
}
