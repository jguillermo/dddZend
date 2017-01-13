<?php
/**
 * Created by PhpStorm.
 * User: Jose
 * Date: 03/12/2016
 * Time: 03:42 AM
 */

namespace MisaIntegrationTest\Config;

use MisaCore\Application\Config\Autoload;
use MisaCore\Domain\Base\Exception\ConfigErrorException;
use MisaIntegrationTest\TestIntegrationCase;

class ConfigTest extends TestIntegrationCase
{
    public function testnoexisteconfiguracion()
    {
        $this->expectException(ConfigErrorException::class);
        Autoload::getByKey('este-config-no-debe-existir');
    }

    /**
     * @dataProvider additionProvider
     * @param $configName
     * @param $existe
     */
    public function testConfigOk($configName, $existe)
    {
        $config = Autoload::get();
        $this->assertEquals($existe, isset($config[$configName]));
    }

    public function additionProvider()
    {
        return [
            'config-no-exist' => ['config-no-exist',false],
            'config-db' => ['db',true],
            'config-encryptKey' => ['encryptKey',true],
        ];
    }
}
