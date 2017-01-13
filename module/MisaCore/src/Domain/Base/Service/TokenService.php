<?php

namespace MisaCore\Domain\Base\Service;

use MisaCore\Domain\Base\Dto\MisaDto;
use MisaCore\Domain\Base\Exception\MisaException;

/**
 * AuthService interface
 *
 * @package Domain
 * @subpackage Base\Service
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

interface TokenService
{
    /**
     * para generar un key de fuerte cifrado y unico para cada instancia de instalacion
     * AuthService constructor.
     * @param EncryptService $encryptService
     */
    public function __construct(EncryptService $encryptService);

    /**
     * encripta los datos en una cadena de texo , token
     * @param array $data
     * @param int $timeExpire por defecto 1 hora
     * @return string
     */
    public function generate($data = [], $timeExpire = 3600);

    /**
     * retorna la data desencriptando del token
     * @param $token
     * @return array
     * @throws MisaException
     */
    public function getData($token);
}
