<?php

namespace MisaCore\Domain\Base\Implement;

/**
 * MisaUniqId class
 *
 * @package Domain
 * @subpackage Base\Implement
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

class MisaUniqId
{
    public static function generate($prefix = 'm')
    {
        $uniq = uniqid($prefix);
        $rnd = self::randomString(8);
        return $prefix.$rnd.substr($uniq, 9);
    }

    private static function randomString($leng)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
        $charactersLen = strlen($characters) - 1;
        $randstring = '';
        for ($i = 0; $i < $leng; $i++) {
            $randstring .= $characters[rand(0, $charactersLen)];
        }
        return $randstring;
    }
}
