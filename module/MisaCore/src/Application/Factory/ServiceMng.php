<?php
/**
 * Class ServiceMng
 *
 * @package MisaCore\Application\Factory
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */

namespace MisaCore\Application\Factory;

use MisaCore\Application\Factory\Base\BaseTrait;
use MisaCore\Application\Factory\Person\PersonTrait;
use MisaCore\Application\Factory\Provider\ProviderTrait;

class ServiceMng
{
    use BaseTrait;
    use PersonTrait;
    use ProviderTrait;
}
