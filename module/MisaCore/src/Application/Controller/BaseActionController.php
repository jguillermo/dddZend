<?php

namespace MisaCore\Application\Controller;

use MisaCore\Application\Config\Autoload;
use MisaCore\Application\Factory\AuthFactory;
use MisaCore\Domain\Base\Dto\MisaDto;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Mvc\MvcEvent;
use Zend\Mvc\Exception;
use Zend\View\Model\JsonModel;
use Zend\Json\Json;

/**
 * BaseActionController class
 *
 * @package MisaCore\Application
 * @subpackage Controller
 * @author Jose Guillermo <jguillermo@outlook.com>
 * @copyright (c) 2016, Getmin
 */
class BaseActionController extends AbstractActionController
{
    protected $data;
    protected $auth;

    /**
     * Action called if matched action does not exist
     *
     * @return MisaDto
     */
    public function notFoundAction()
    {
        $response = $this->getResponse();
        $response->setStatusCode(500);
        return new MisaDto("Pagina no encontrada.", false);
    }

    public function notTokenAction()
    {
        $dto = new MisaDto("No logueado.", false);
        $dto->data()->set('action', 'goto-login');
        if (isset($this->data['message'])) {
            $dto->data()->set('message', $this->data['message']);
        }

        return $dto;
    }


    public function onDispatch(MvcEvent $e)
    {
        $routeMatch = $e->getRouteMatch();
        if (! $routeMatch) {
            throw new Exception\DomainException('Missing route matches; unsure how to retrieve action');
        }

        /**
         * se setean variables iniciales de las configuraciones
         */
        Autoload::set($e->getApplication()->getConfig());

        /** filtros y validaciondes de la data enviada
         * para poder usar esta Api se debe usar un callback
         * y la data se convierte en array
         */
        $jsonCallBack = $this->getRequest()->getQuery('callback', false);
        $data = $this->getRequest()->getQuery('data', false);
        $token = $this->getRequest()->getQuery('token', '');
        if ($jsonCallBack && $data) {
            $this->data = Json::decode($data, Json::TYPE_ARRAY);
        }

        $action = $routeMatch->getParam('action', 'not-found');

        /**
         * si no existe callback ni data se va a page not found
         */
        if (! $this->data) {
            $action = 'not-found';
        }

        /** la unica url que no necista token es el login */
        if ($action !== 'authenticate') {
            //var_dump($token);exit();
            /** en caso contrario se valida el token */
            $dtoToken = AuthFactory::getData($token);
            if ($dtoToken->isOk()) {
                $this->auth = $dtoToken->data()->toArray();
                //var_dump($this->auth);exit();
            } else {
                $action = 'not-token';
                $this->data['message'] = $dtoToken->getMessage();
            }
        }

        $method = static::getMethodFromAction($action);

        if (! method_exists($this, $method)) {
            $method = 'notFoundAction';
        }

        /** @var MisaDto $actionResponse */
        $actionResponse = $this->$method();

        /**
         * enviar datos a la vista
         */
        $actionData = new JsonModel($actionResponse->toArray());

        if ($jsonCallBack) {
            $actionData->setJsonpCallback($jsonCallBack);
        }

        $e->setResult($actionData);

        return $actionData;
    }
}
