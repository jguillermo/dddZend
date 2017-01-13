<?php

namespace MisaCoreTest\Domain\Base;

use MisaCore\Domain\Base\Implement\MisaUniqId;
use MisaCoreTest\TestCase;

/**
 * MisaUniqIdTest test
 *
 * @package Domain
 * @subpackage MisaCoreTest\Base
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class MisaUniqIdTest extends TestCase
{
    public function testGenracionCorectaDeId()
    {
        $id = MisaUniqId::generate();
        $id2 = MisaUniqId::generate('s');

        $this->assertEquals(14, strlen($id));
        $this->assertEquals('m', substr($id, 0, 1));
        $this->assertEquals('s', substr($id2, 0, 1));
    }
}
