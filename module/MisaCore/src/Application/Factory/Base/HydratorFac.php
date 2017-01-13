<?php
/**
 * Class TokenFac
 *
 * @package MisaCore\Application\Factory\Base
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCore\Application\Factory\Base;

use MisaCore\Application\Pattern\Singleton;
use MisaCore\Domain\Base\Implement\Hydrator\AggregateHydratorImplement;

class HydratorFac extends Singleton
{
    protected static function newInstance()
    {
        return new AggregateHydratorImplement();
    }
}
