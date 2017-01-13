<?php
/**
 * Class EmployeeTestInt
 *
 * @package MisaIntegrationTest\Domain\Person
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */


namespace MisaIntegrationTest\Service\Person;

use MisaCore\Domain\Base\Entity\Address;
use MisaCore\Domain\Base\Exception\SrvErrorException;
use MisaCore\Domain\Provider\Entity\Provider;
use MisaIntegrationTest\TestIntegrationCase;

class EmployeeTest extends TestIntegrationCase
{
    public function testLoginError()
    {
        $this->expectException(SrvErrorException::class);
        $this->factory()->personEmployee()->authSrv()->authenticate('admin', '123');
    }

    public function testInsertEmployee()
    {
        $dto = $this->factory()->personPerson()->listSrv()->getList();
        $items = $dto->getItemsByPage();
        $paramsEmployee = $items[0];
        $paramsEmployee['role'] = 1;
        // test para actualizar el nombre de la persona
        $paramsEmployee['name'] = 'jose';
        $paramsEmployee['user'] = 'user';
        $paramsEmployee['password'] = 'password';
        $result = $this->factory()->personEmployee()->mngSrv()->insert($paramsEmployee);

        $this->assertTrue($result);

        return $paramsEmployee;
    }

    /**
     * @depends testInsertEmployee
     */
    public function tesDataEmployyeInsert($paramsEmployee)
    {
        $employee = $this->factory()->personEmployee()->listSrv()->getById($paramsEmployee['id']);
        $this->assertEquals('', $employee->getUser());
        $this->assertEquals('', $employee->getPassword());
        $this->assertEquals($paramsEmployee['role'], $employee->getRole());
        $this->assertEquals($paramsEmployee['name'], $employee->getName());
        $this->assertEquals($paramsEmployee['lastName'], $employee->getLastName());
        $this->assertEquals($paramsEmployee['secondLastName'], $employee->getSecondLastName());

        return $paramsEmployee['id'];
    }

    /**
     * @depends testInsertEmployee
     */
    public function testChangeUserPaswwordEmpty($paramsEmployee)
    {
        $result = $this->factory()->personEmployee()->mngSrv()->changeUser($paramsEmployee['id'], 'admin1', '');

        $employee = $this->factory()->personEmployee()->listSrv()->getById($paramsEmployee['id']);

        // se actualizo correcto
        $this->assertTrue($result);

        // encripto correctamnete el usuario
        $this->assertEquals($employee->getUser(), $this->factory()->baseEncrypt()->encrypt('admin1'));

        // se puede sesencriptar el usuario
        $this->assertEquals('admin1', $this->factory()->baseEncrypt()->decrypt($employee->getUser()));
    }


    public function testChangePasswordPassworsNoEquals()
    {
        $this->expectException(SrvErrorException::class);
        $result = $this->factory()->personEmployee()->mngSrv()->changePassword('abc', '123', '1234', '');
    }


    /**
     * @depends testInsertEmployee
     */
    public function testChangePasswordEmpty($paramsEmployee)
    {
        $result = $this->factory()->personEmployee()->mngSrv()->changePassword($paramsEmployee['id'], '12', '12', '');

        $employee = $this->factory()->personEmployee()->listSrv()->getById($paramsEmployee['id']);

        // se actualizo correcto
        $this->assertTrue($result);

        // verificacion de password
        $this->assertTrue($this->factory()->basePassword()->verify('12', $employee->getPassword()));
    }


    /**
     * @depends testInsertEmployee
     */
    public function testChangeUserPaswwordError($paramsEmployee)
    {
        $this->expectException(SrvErrorException::class);
        $result = $this->factory()->personEmployee()->mngSrv()->changeUser($paramsEmployee['id'], 'admin', '1234');
    }


    /**
     * @depends testInsertEmployee
     */
    public function testChangeUserPaswwordOk($paramsEmployee)
    {
        $result = $this->factory()->personEmployee()->mngSrv()->changeUser($paramsEmployee['id'], 'admin', '12');

        $employee = $this->factory()->personEmployee()->listSrv()->getById($paramsEmployee['id']);

        // se actualizo correcto
        $this->assertTrue($result);

        // encripto correctamnete el usuario
        $this->assertEquals($employee->getUser(), $this->factory()->baseEncrypt()->encrypt('admin'));

        // se puede sesencriptar el usuario
        $this->assertEquals('admin', $this->factory()->baseEncrypt()->decrypt($employee->getUser()));
    }


    /**
     * @depends testInsertEmployee
     */
    public function testChangePasswordNotEmpty($paramsEmployee)
    {
        $result = $this->factory()->personEmployee()->mngSrv()->changePassword(
            $paramsEmployee['id'],
            '123',
            '123',
            '12'
        );

        $employee = $this->factory()->personEmployee()->listSrv()->getById($paramsEmployee['id']);

        // se actualizo correcto
        $this->assertTrue($result);

        // verificacion de password
        $this->assertTrue($this->factory()->basePassword()->verify('123', $employee->getPassword()));
    }

    /**
     * @depends testInsertEmployee
     */
    public function testLoginOk($paramsEmployee)
    {
        $jwt = $this->factory()->personEmployee()->authSrv()->authenticate('admin', '123');

        $data = $this->factory()->baseToken()->getData($jwt);

        $this->assertTrue(isset($data['id']));
        $this->assertTrue(isset($data['role']));
        $this->assertTrue(isset($data['name']));

        $this->assertEquals($paramsEmployee['id'], $data['id']);
        $this->assertEquals(1, $data['role']);
        $this->assertEquals('Jose Guillermo', $data['name']);
    }
}
