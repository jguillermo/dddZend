<?php
/**
 * Class TokenImp
 *
 * @package MisaCore\Application\Implement\Base
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCore\Application\Implement\Base;

use Firebase\JWT\JWT;
use MisaCore\Domain\Base\Dto\MisaDto;
use MisaCore\Domain\Base\Exception\MisaException;
use MisaCore\Domain\Base\Service\EncryptService;
use MisaCore\Domain\Base\Service\TokenService;

class TokenImp implements TokenService
{
    private $key;
    /**
     * para generar un key de fuerte cifrado y unico para cada instancia de instalacion
     * AuthService constructor.
     * @param EncryptService $encryptService
     */
    public function __construct(EncryptService $encryptService)
    {
        $this->key = $encryptService->shaMisa('MisaKeyToken');
    }

    /**
     * encripta los datos en una cadena de texo , token
     * @param array $data
     * @param int $timeExpire por defecto 1 hora
     * @return string
     */
    public function generate($data = [], $timeExpire = 3600)
    {
        $issuedAt  = time();
        $notBefore = $issuedAt + JWT::$leeway;             // Adding 10 seconds
        $expire    = $notBefore + $timeExpire;       // Adding 1 hour , 60*60
        $token = [
            'iat' => $issuedAt,         // Issued at: time when the token was generated
            'nbf' => $notBefore,        // Not before
            'exp' => $expire,           // Expire
            'data' => $data
        ];
        return JWT::encode($token, $this->key, 'HS256');
    }

    /**
     * retorna la data desencriptando del token
     * @param $token
     * @return array
     * @throws MisaException
     */
    public function getData($token)
    {
        $data = [];
        try {
            $decode = JWT::decode($token, $this->key, ['HS256']);
            foreach ($decode->data as $key => $value) {
                $data[$key] = $value;
            }
        } catch (\Exception $e) {
            throw new MisaException($e->getMessage());
        }
        return $data;
    }
}
