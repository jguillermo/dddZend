<?php
/**
 * Class PersonTest
 *
 * @package MisaIntegrationTest\Service\Person
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaIntegrationTest\Service\Person;

use MisaIntegrationTest\TestIntegrationCase;

class PersonTest extends TestIntegrationCase
{
    public function testInsertData()
    {
        $data = [
            'name' => 'Jose',
            'lastName' => 'Guillerm',
            'secondLastName' => 'Inche',
        ];
        $result = $this->factory()->personPerson()->mngSrv()->insert($data);
        $this->assertTrue($result);
    }


    public function testListPerson()
    {
        $dto = $this->factory()->personPerson()->listSrv()->getList();
        $items = $dto->getItemsByPage();
        $this->assertCount(1, $items);
        return $items[0];
    }

    /**
     * @depends testListPerson
     */
    public function testInsertOk($paramsPerson)
    {
        $this->assertEquals('Jose', $paramsPerson['name']);
        $this->assertEquals('Guillerm', $paramsPerson['lastName']);
        $this->assertEquals('Inche', $paramsPerson['secondLastName']);

        return $paramsPerson['id'];
    }

    /**
     * @depends testInsertOk
     */
    public function testEditData($personId)
    {
        $person = $this->factory()->personPerson()->listSrv()->getById($personId);
        $person->setLastName('Guillermo');
        $params = $this->factory()->baseHydrator()->extract($person);
        unset($params['id']);

        $result = $this->factory()->personPerson()->mngSrv()->update($personId, $params);

        $this->assertTrue($result);
    }
}
