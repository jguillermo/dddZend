<?php
/**
 * Class ArrayUtils
 *
 * @package MisaCore\Domain\Base\Implement\Util
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCore\Domain\Base\Implement\Util;

class ArrayUtils
{
    public function merge($a, $b)
    {
        foreach ($a as $key => $value) {
            if (isset($b[$key])) {
                if (is_array($b[$key])) {
                    $a[$key] = $this->merge($a[$key], $b[$key]);
                } else {
                    $a[$key] = $b[$key];
                }
            }
        }
        foreach ($b as $key => $value) {
            if (! isset($a[$key])) {
                $a[$key] = $value;
            }
        }
        return $a;
    }
}
