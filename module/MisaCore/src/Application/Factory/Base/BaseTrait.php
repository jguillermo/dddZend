<?php
/**
 * Class BaseTrait
 *
 * @package MisaCore\Application\Factory\Base
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCore\Application\Factory\Base;

use MisaCore\Domain\Base\Hydrator\AggregateHydrator;
use MisaCore\Domain\Base\Service\EncryptService;
use MisaCore\Domain\Base\Service\PasswordService;
use MisaCore\Domain\Base\Service\TokenService;

trait BaseTrait
{

    /**
     * @return EncryptService
     */
    public function baseEncrypt()
    {
        return EncryptFac::getInstance();
    }

    /**
     * @return TokenService
     */
    public function baseToken()
    {
        return TokenFac::getInstance();
    }

    /**
     * @return PasswordService
     */
    public function basePassword()
    {
        return  PasswordFac::getInstance();
    }

    /**
     * @return AggregateHydrator
     */
    public function baseHydrator()
    {
        return  HydratorFac::getInstance();
    }
}
