<?php
/**
 * Class PasswordFac
 *
 * @package MisaCore\Application\Factory\Base
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCore\Application\Factory\Base;

use MisaCore\Application\Implement\Base\PasswordImplement;
use MisaCore\Application\Pattern\Singleton;

class PasswordFac extends Singleton
{

    protected static function newInstance()
    {
        return new PasswordImplement();
    }
}
