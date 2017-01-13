<?php
namespace MisaCore\Application\Implement\Base;

use MisaCore\Domain\Base\Service\PasswordService;
use Zend\Crypt\Password\Bcrypt;

/**
 * PasswordImplement Class
 *
 * @package MisaCore\Application
 * @subpackage Implement\Base
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class PasswordImplement implements PasswordService
{

    /**
     * genera un password con encriptacion
     * @param string $password
     * @return string
     */
    public function create($password)
    {
        $bcrypt = new Bcrypt();
        return $bcrypt->create($password);
    }

    /**
     * compara elpassword ingresao, con el almacenado en un repositorio
     * @param string $password ingresado por el usuario
     * @param string $securePass almacenado en un repositorio
     * @return bool
     */
    public function verify($password, $securePass)
    {
        $bcrypt = new Bcrypt();
        return $bcrypt->verify($password, $securePass);
    }
}
