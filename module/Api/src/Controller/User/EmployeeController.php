<?php
/**
 * Aptitus Project
 *
 * This file demonstrates the rich information that can be included in
 * in-code documentation through DocBlocks and tags.
 *
 * @author Jose Guillermo <jguillermo@outlook.com>
 */

namespace Api\Controller\User;

use MisaCore\Application\Controller\BaseRestfulController;
use MisaCore\Application\Controller\Exception\BadRequestException;

class EmployeeController extends BaseRestfulController
{
    public function postAuth($data)
    {
        $this->validateParams($data, 'user', 'password');
        $this->message = "login correcto";
        return  $this->factory()->personEmployee()->authSrv()->authenticate(
            $data['user'],
            $data['password']
        );
    }

    public function getList()
    {
        $this->message = "carga de datos correcta";
        $page = $this->params()->fromQuery('page', 1);
        $dtoPaginator = $this->factory()->personEmployee()->listSrv()->getList($page, 10);
        return [
            'data' => $dtoPaginator->getItemsByPage(),
            'paginator' => $dtoPaginator->getPages()
        ];
    }

    public function get($id)
    {
        $this->message = "Carga correcta del empleado";
        $employee = $this->factory()->personEmployee()->listSrv()->getById($id);
        $employee->setPassword('');
        $employee->setUser('');
        return ['data' => $this->factory()->baseHydrator()->extract($employee)];
    }

    public function update($id, $data)
    {
        $this->message = "Actualizacion correcta del empleado";
        return $this->factory()->personEmployee()->mngSrv()->update($id, $data);
    }

    public function create($data)
    {
        $this->message = "Se creo correctamente el empleado";
        return $this->factory()->personEmployee()->mngSrv()->insert($data);
    }

    public function putChangeUser($id, $data)
    {
        $this->validateParams($data, 'user', 'password');
        $this->message = "Se cambio el usuario exitosamemte";
        return $this->factory()->personEmployee()->mngSrv()->changeUser($id, $data['user'], $data['password']);
    }

    public function putchangePassword($id, $data)
    {
        $this->validateParams($data, 'newPassword', 'repeatNewPassword', 'currentPassword');

        $this->message = "Se cambio el password exitosamemte";
        return $this->factory()->personEmployee()->mngSrv()->changePassword(
            $id,
            $data['newPassword'],
            $data['repeatNewPassword'],
            $data['currentPassword']
        );
    }
}
