<?php

namespace MisaCore\Infrastructure\Persistence\Sql\Dictionary;

/**
 * PersonDictionary trait
 *
 * @package MisaCore\Infrastructure
 * @subpackage Persistence\Sql\Dictionary
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

trait PersonDictionary
{
    public function personDictionary()
    {
        return [
            'person-id' => 'id',
            'person-name' => 'name',
            'person-lastName' => 'lastname',
            'person-secondLastName' => 'secondlastname',
        ];
    }
}
