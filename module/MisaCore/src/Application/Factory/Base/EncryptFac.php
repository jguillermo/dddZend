<?php
/**
 * Class EncryptFac
 *
 * @package MisaCore\Application\Factory\Base
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCore\Application\Factory\Base;

use MisaCore\Application\Config\Autoload;
use MisaCore\Application\Pattern\Singleton;
use MisaCore\Domain\Base\Implement\EncryptImplement;

class EncryptFac extends Singleton
{

    protected static function newInstance()
    {
        $encryptKey = Autoload::getByKey('encryptKey');
        return new EncryptImplement($encryptKey);
    }
}
