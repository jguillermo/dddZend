<?php

namespace MisaCore\Domain\Person\Implement\Service\Person;

use MisaCore\Domain\Base\Exception\RepNotFoundException;
use MisaCore\Domain\Base\Exception\SrvErrorException;
use MisaCore\Domain\Person\Entity\Person;
use MisaCore\Domain\Person\Service\Person\MngSrv;

/**
 * PersonImplement class
 *
 * @package Domain
 * @subpackage MisaCore\Domain\Person\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class MngImp extends PersonImp implements MngSrv
{

    /**
     * @param array $data
     * @return bool
     */
    public function insert(array $data)
    {
        /** @var Person $newPerson */
        $newPerson = $this->personEntity->next();
        return $this->save($data, $newPerson);
    }

    /**
     * @param $id
     * @param array $data
     * @return bool
     * @throws SrvErrorException
     */
    public function update($id, array $data)
    {
        try {
            $person = $this->personRepDl->getById($id);
        } catch (RepNotFoundException $e) {
            throw new SrvErrorException("el id no existe");
        }
        return $this->save($data, $person);
    }

    /**
     * @param $data
     * @param Person $person
     * @return bool
     * @throws SrvErrorException
     */
    private function save($data, Person $person)
    {
        $filteredParams = $this->personFilter->allFilter($data);
        /** @var Person $entity */
        $entity = $this->hydrator->hydrate($filteredParams, $person);
        $this->personValidator->isValid($this->hydrator->extract($entity));

        return $this->personRepDm->save($entity);
    }
}
