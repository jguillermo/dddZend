<?php
/**
 * Inteface MngSrv
 *
 * @package MisaCore\Domain\Provider\Service\Provider
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCore\Domain\Provider\Service\Provider;

interface MngSrv
{
    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data);


    /**
     * @param $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data);
}
