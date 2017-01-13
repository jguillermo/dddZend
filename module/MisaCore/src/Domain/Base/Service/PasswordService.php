<?php

namespace MisaCore\Domain\Base\Service;

/**
 * SecurityRepository interface
 *
 * @package Domain
 * @subpackage Base\Service
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
interface PasswordService
{
    /**
     * genera un password con encriptacion
     * @param string $password
     * @return string
     */
    public function create($password);

    /**
     * compara elpassword ingresao, con el almacenado en un repositorio
     * @param string $password   ingresado por el usuario
     * @param string $securePass almacenado en un repositorio
     * @return bool
     */
    public function verify($password, $securePass);
}
