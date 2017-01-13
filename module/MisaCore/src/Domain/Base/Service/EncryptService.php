<?php

namespace MisaCore\Domain\Base\Service;

/**
 * EncryptService class
 *
 * @package MisaCore\Domain
 * @subpackage Base\Service
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

interface EncryptService
{


    /**
     * EncryptService constructor.
     * @param $key
     */
    public function __construct($key);

    /** retorna un acadena encriptada enformato sha1
     * agregando string del key ingresado
     * ejemplo $cadena_encriptada = shaMisa("LA CADENA A ENCRIPTAR");
     * @param $string
     * @return string
     */
    public function shaMisa($string);

    /**
     * encripta una cadena con la llave ingresada
     * la repuesta siempre va a serla misma cadena encriptada
     * ejemplo $cadena_encriptada = encrypt("LA CADENA A ENCRIPTAR");
     * @param $string
     * @return string
     */
    public function encrypt($string);

    /**
     * desencripta la cadena, que se encripto cno la funcion encrypt
     * ejemplo $cadena_desencriptada = decrypt("LA CADENA ENCRIPTADA");
     * @param $string
     * @return string
     */
    public function decrypt($string);

    /**
     * encripta una cadena con la llave ingresada
     * la repuesta siempre va a ser diferente
     * @param $string
     * @return string
     */
    public function encryptRnd($string);

    /**
     * desencripta la cadena, que se encripto cno la funcion encryptRnd
     * @param $string
     * @return string
     */
    public function decryptRnd($string);
}
