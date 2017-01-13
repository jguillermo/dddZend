<?php

namespace MisaCore\Domain\Person\Service\Person;

use MisaCore\Domain\Base\Dto\MisaDto;

/**
 * PersonManagement interface
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Person\Service
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

interface MngSrv
{

    /**
     * @param array $data
     * @return bool
     */
    public function insert(array $data);


    /**
     * @param $id
     * @param array $data
     * @return bool
     */
    public function update($id, array $data);
}
