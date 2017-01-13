<?php
/**
 * SqlDm Class
 *
 * @package MisaCore\Infrastructure\Persistence\Sql\Provider\Provider
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2017, Getmin
 */
namespace MisaCore\Infrastructure\Persistence\Sql\Provider\Provider;

use MisaCore\Domain\Provider\Entity\Provider;
use MisaCore\Domain\Provider\Entity\ProviderAdress;
use MisaCore\Domain\Provider\Repository\Provider\MngRep;
use MisaCore\Infrastructure\Persistence\Sql\Implement\AbstractDb;

class SqlDm extends AbstractDb implements MngRep
{

    /**
     * guarda la entidad
     * @param Provider $provider
     * @return bool
     */
    public function save(Provider $provider)
    {
        return $this->persisteProviderData($provider);
    }

    /**
     * alamcena los datos en al base de datos
     * si existe, lo actualiza, si no existe lo inserta
     * esta funcion se separo para poder guardar data en entidades heredadas
     * @param Provider $provider
     * @return bool
     */
    protected function persisteProviderData(Provider $provider)
    {
        $driver = $this->getDriver();

        $params = $this->processParams($provider);

        if ($driver->rowExistsInDatabase('provider', $provider->getId())) {
            /** actualizar */
            $driver->update('provider', $params['provider'], ['id' => $provider->getId()]);
        } else {
            /** insertar */
            $driver->insert('provider', $params['provider']);
        }
        $this->persistentity()->persistData($params['provider_address'], 'id', 'provider_address', 'id');
        return true;
    }

    /**
     * clasifica los parametros que vienen para poder se guardados en al base de datos
     * @param Provider $provider
     * @return array
     */
    private function processParams(Provider $provider)
    {
        $params = [
            'provider' => [
                'id' => $provider->getId(),
                'name' => $provider->getName(),
                'comment' => $provider->getComment(),
            ],
        ];

        /** @var ProviderAdress $providerAddress */
        foreach ($provider->getAddress()->getAll() as $providerAddress) {
            $params['provider_address'][] = [
                'id' => $providerAddress->getId(),
                'name' => $providerAddress->getName(),
                'reference' => $providerAddress->getReference(),
            ];
        }

        return $params;
    }
}
