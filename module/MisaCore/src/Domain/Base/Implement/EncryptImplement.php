<?php

namespace MisaCore\Domain\Base\Implement;

use MisaCore\Domain\Base\Service\EncryptService;

/**
 * EncryptImplement class
 *
 * @package MisaCore\Domain
 * @subpackage Base\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class EncryptImplement implements EncryptService
{
    /** @var string */
    private $key;

    /**
     * EncryptImplement constructor.
     * @param $key
     */
    public function __construct($key)
    {
        $this->key = sha1("Misa" . $key . "System");
    }

    /** retorna un acadena encriptada enformato sha1
     * agregando string del key ingresado
     * ejemplo $cadena_encriptada = shaMisa("LA CADENA A ENCRIPTAR");
     * @param $string
     * @return string
     */
    public function shaMisa($string)
    {
        return sha1(
            substr($this->key, 10, 5) .
            md5(substr($this->key, 0, -4) . md5($string) . substr($this->key, 0, 5)) .
            substr($this->key, 15, 5)
        );
    }

    /**
     * encripta una cadena con la llave ingresada
     * la repuesta siempre va a serla misma cadena encriptada
     * ejemplo $cadena_encriptada = encrypt("LA CADENA A ENCRIPTAR");
     * @param $string
     * @return string
     */
    public function encrypt($string)
    {
        $result = '';
        $strlenKey = strlen($this->key);
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($this->key, ($i % $strlenKey), 1);
            $char = chr(ord($char) + ord($keychar));
            $result .= $char;
        }
        return base64_encode(utf8_encode($result));
    }

    /**
     * desencripta la cadena, que se encripto cno la funcion encrypt
     * ejemplo $cadena_desencriptada = decrypt("LA CADENA ENCRIPTADA");
     * @param $string
     * @return string
     */
    public function decrypt($string)
    {
        $result = '';
        $string = utf8_decode(base64_decode($string));
        $strlenKey = strlen($this->key);
        for ($i = 0; $i < strlen($string); $i++) {
            $char = substr($string, $i, 1);
            $keychar = substr($this->key, ($i % $strlenKey), 1);
            $char = chr(ord($char) - ord($keychar));
            $result .= $char;
        }
        return $result;
    }

    /**
     * encripta una cadena con la llave ingresada
     * la repuesta siempre va a ser diferente
     * @param $string
     * @return string
     */
    public function encryptRnd($string)
    {
        $rand = $this->generateTextRand(strlen($string));
        $enc = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $enc .= substr($rand, $i, 1)
                . (substr($rand, $i, 1) ^ substr($string, $i, 1));
        }
        $enc = $this->xorMerge($enc);
        return base64_encode(utf8_encode($enc));
    }

    /**
     * desencripta la cadena, que se encripto cno la funcion encryptRnd
     * @param $string
     * @return string
     */
    public function decryptRnd($string)
    {
        if (preg_match('/[^a-zA-Z0-9\/\+=]/', $string)) {
            return false;
        }
        $string = utf8_decode(base64_decode($string));
        $string = $this->xorMerge($string);
        $dec = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $dec .= (substr($string, $i++, 1) ^ substr($string, $i, 1));
        }
        return $dec;
    }

    /**
     * @param $string
     * @return string
     */
    private function xorMerge($string)
    {
        $str = '';
        $strlenKey = strlen($this->key);
        for ($i = 0; $i < strlen($string); $i++) {
            $str .= substr($string, $i, 1) ^ substr($this->key, ($i % $strlenKey), 1);
        }
        return $str;
    }

    /**
     * genera una cadena denumeros random
     * como minino el limete asignado
     * @param int $limit
     * @return string
     */
    private function generateTextRand($limit)
    {
        $rand = '';
        while (strlen($rand) < $limit) {
            $rand .= mt_rand(0, mt_getrandmax());
        }
        return $rand;
    }
}
