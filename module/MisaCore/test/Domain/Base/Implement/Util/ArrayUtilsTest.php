<?php
/**
 * Class ArrayUtilsTest
 *
 * @package MisaCoreTest\Domain\Base\Implement\Util
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaCoreTest\Domain\Base\Implement\Util;

use MisaCore\Domain\Base\Implement\Util\ArrayUtils;
use MisaCoreTest\TestCase;

class ArrayUtilsTest extends TestCase
{
    public function testMerge()
    {
        $util = new ArrayUtils();
        $a = ['a' => 1,'b' => 2];
        $b = ['b' => 20,'c' => 30];
        $merge = $util->merge($a, $b);

        $this->assertEquals([
            "a" => 1,
            "b" => 20,
            "c" => 30
        ], $merge);
    }

    public function testMergeRecursivo()
    {
        $util = new ArrayUtils();
        $a = ['a' => 1,'b' => ['aa' => 1,'bb' => 2]];
        $b = ['b' => ['bb' => 22,'cc' => 33],'c' => 30];
        $this->assertEquals([
            'a' => 1,
            'b' => [
                'aa' => 1,
                'bb' => 22,
                'cc' => 33
            ],
            'c' => 30
        ], $util->merge($a, $b));
    }
}
