<?php
/**
 * Class MngImp
 *
 * @package MisaCore\Domain\Provider\Implement\Service\Provider
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCore\Domain\Provider\Implement\Provider;

use MisaCore\Domain\Base\Exception\RepNotFoundException;
use MisaCore\Domain\Base\Exception\SrvErrorException;
use MisaCore\Domain\Provider\Entity\Provider;
use MisaCore\Domain\Provider\Service\Provider\MngSrv;

class MngImp extends ProviderImp implements MngSrv
{
    /**
     * @param array $data
     * @return bool
     */
    public function create(array $data)
    {
        /** @var Provider $newProvider */
        $newProvider = $this->providerEntity->next();
        return $this->save($data, $newProvider);
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
            $provider = $this->providerRepDl->getById($id);
        } catch (RepNotFoundException $e) {
            throw new SrvErrorException("el id no existe");
        }
        return $this->save($data, $provider);
    }

    private function save($data, Provider $provider)
    {
        $filteredParams = $this->providerFilter->allFilter($data);
        /** @var Provider $entity */
        $entity = $this->hydrator->hydrate($filteredParams, $provider);
        $this->providerValidator->isValid($this->hydrator->extract($entity));
        return $this->providerRepDm->save($entity);
    }
}
