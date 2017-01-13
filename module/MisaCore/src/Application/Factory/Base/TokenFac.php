<?php
/**
 * Class TokenFac
 *
 * @package MisaCore\Application\Factory\Base
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCore\Application\Factory\Base;

use MisaCore\Application\Implement\Base\TokenImp;
use MisaCore\Application\Pattern\Singleton;

class TokenFac extends Singleton
{

    protected static function newInstance()
    {
        return new TokenImp(EncryptFac::getInstance());
    }
}
