<?php
/**
 * Aptitus Project
 *
 * This file demonstrates the rich information that can be included in
 * in-code documentation through DocBlocks and tags.
 *
 * @author Jose Guillermo <jguillermo@outlook.com>
 */

namespace MisaCore\Application\Controller;

use MisaCore\Application\Config\Autoload;
use MisaCore\Application\Config\RouteMatch;
use MisaCore\Application\Controller\Exception\BadRequestException;
use MisaCore\Application\Controller\Exception\HttpException;
use MisaCore\Application\Controller\Exception\NotAllowedException;
use MisaCore\Application\Controller\Exception\UnauthorizedException;
use MisaCore\Application\Factory\MisaFactory;
use MisaCore\Application\Factory\ServiceMng;
use MisaCore\Domain\Base\Exception\MisaException;
use MisaCore\Domain\Base\Exception\SrvErrorException;
use Zend\Http\PhpEnvironment\Response as HttpResponse;
use Zend\Json\Json;
use Zend\Mvc\Controller\AbstractController;
use Zend\Mvc\Exception;
use Zend\Mvc\MvcEvent;
use Zend\Stdlib\RequestInterface as Request;
use Zend\View\Model\JsonModel;

class BaseRestfulController extends AbstractController
{

    const CONTENT_TYPE_JSON = 'json';

    /**
     * {@inheritDoc}
     */
    protected $eventIdentifier = __CLASS__;

    /**
     * @var array
     */
    protected $contentTypes = [
        self::CONTENT_TYPE_JSON => [
            'application/hal+json',
            'application/json'
        ]
    ];

    protected $message;

    /**
     * Name of request or query parameter containing identifier
     *
     * @var string
     */
    protected $identifierName = 'id';

    /**
     * Flag to pass to json_decode and/or Zend\Json\Json::decode.
     *
     * The flags in Zend\Json\Json::decode are integers, but when evaluated
     * in a boolean context map to the flag passed as the second parameter
     * to json_decode(). As such, you can specify either the Zend\Json\Json
     * constant or the boolean value. By default, starting in v3, we use
     * the boolean value, and cast to integer if using Zend\Json\Json::decode.
     *
     * Default value is boolean true, meaning JSON should be cast to
     * associative arrays (vs objects).
     *
     * Override the value in an extending class to set the default behavior
     * for your class.
     *
     * @var int|bool
     */
    protected $jsonDecodeType = true;


    protected $auth;

    /** @var  ServiceMng */
    private $misaServiceManager;

    /**
     * @return ServiceMng
     */
    public function factory()
    {
        return $this->misaServiceManager;
    }

    /**
     * BaseRestfulController constructor.
     */
    public function __construct()
    {
        $this->auth = false;
    }

    /**
     * valida si se estan enviando los parámetros de pasa por el argumento
     * @param array $data
     * @param array ...$params
     * @return bool
     * @throws BadRequestException
     */
    protected function validateParams($data, ...$params)
    {
        foreach ($params as $param) {
            if (! isset($data[$param])) {
                throw new BadRequestException("no se envia el parámetro : ".$param);
            }
        }
        return true;
    }


    /**
     * @param $data
     * @throws NotAllowedException
     */
    public function create($data)
    {
        throw new NotAllowedException();
    }

    /**
     * @param $id
     * @throws NotAllowedException
     */
    public function delete($id)
    {
        throw new NotAllowedException();
    }

    /**
     * @param $id
     * @throws NotAllowedException
     */
    public function get($id)
    {
        throw new NotAllowedException();
    }

    /**
     * @throws NotAllowedException
     */
    public function getList()
    {
        throw new NotAllowedException();
    }

    /**
     * @param $id
     * @param $data
     * @throws NotAllowedException
     */
    public function update($id, $data)
    {
        throw new NotAllowedException();
    }

    /**
     * Basic functionality for when a page is not available
     *
     * @return array
     */
    public function notFoundAction()
    {
        $this->response->setStatusCode(404);

        return [
            'content' => 'Page not found'
        ];
    }

    /**
     * Handle the request
     *
     * @todo   try-catch in "patch" for patchList should be removed in the future
     * @param MvcEvent $event
     * @return mixed
     * @internal param MvcEvent $e
     */
    public function onDispatch(MvcEvent $event)
    {

        /** @var HttpResponse $response */
        $response = $this->getResponse();

        $headers = $response->getHeaders();

        $headers->addHeaderLine('Access-Control-Allow-Origin', '*');
        $headers->addHeaderLine('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS');
        $headers->addHeaderLine('Access-Control-Allow-Headers', 'Content-Type, Accept');
        $headers->addHeaderLine('Access-Control-Allow-Credentials', 'true');

        $routeMatch = $event->getRouteMatch();
        if (! $routeMatch) {
            /**
             * @todo Determine requirements for when route match is missing.
             *       Potentially allow pulling directly from request metadata?
             */
            throw new Exception\DomainException('Missing route matches; unsure how to retrieve action');
        }


        /** @var Request $request */
        $request = $this->getRequest();

        Autoload::set($event->getApplication()->getConfig());

        /** se setean variables iniciales de las configuraciones */
        RouteMatch::set($routeMatch->getParams());

        $siteUrl = $request->getUri()->getScheme() . '://' . $request->getUri()->getHost();
        Autoload::add('siteUrl', $siteUrl);

        $this->misaServiceManager = MisaFactory::getInstance();

        $view['message'] = '';

        try {
            $this->authorizedAccess();

            // RESTful methods
            $method = strtolower($request->getMethod());

            switch ($method) {
                case 'delete':
                    $id = $this->getIdentifier();
                    if ($id === false) {
                        throw new NotAllowedException();
                    }
                    $viewData = $this->delete($id);
                    break;
                case 'get':
                    $id = $this->getIdentifier();
                    if ($id !== false) {
                        $viewData = $this->get($id);
                        break;
                    }
                    $viewData = $this->getList();
                    break;
                case 'post':
                    $data = $this->getPostData($request);
                    $action = $this->getMethodRest($method, false);
                    if ($action === false) {
                        $viewData = $this->create($data);
                    } else {
                        $viewData = $this->{$action}($data);
                    }
                    break;
                case 'put':
                    $id   = $this->getIdentifier();
                    if ($id === false) {
                        throw new NotAllowedException();
                    }
                    $action = $this->getMethodRest($method);
                    $data = $this->processBodyContent($request);
                    if ($action === false) {
                        $viewData = $this->update($id, $data);
                    } else {
                        $viewData = $this->{$action}($id, $data);
                    }
                    break;
                case 'options':
                    break;
                default:
                    throw new NotAllowedException();
            }
            if ($this->message) {
                $view['message'] = $this->message;
            }
            if (isset($viewData)) {
                if (is_array($viewData)) {
                    foreach ($viewData as $key => $value) {
                        $view[$key] = $value;
                    }
                } else {
                    $view['data'] = $viewData;
                }
            }
            $this->response->setStatusCode(200);
        } catch (HttpException $e) {
            $this->response->setStatusCode($e->getStatusCode());
            $view['message'] = $e->getMessage();
            $view['code'] = $e->getErrorCode();
            $view['method'] = $request->getMethod();
        } catch (SrvErrorException $e) {
            $this->response->setStatusCode(400);
            $view['message'] = $e->getMessage();
            if ($e->getCountError() > 0) {
                $view['listError'] = $e->getListError();
            }
            $view['code'] = 42;
        } catch (\Exception $e) {
            $this->response->setStatusCode(400);
            $view['message'] = $e->getMessage();
            $view['code'] = 40;
        }

        $actionData = new JsonModel($view);

        $event->setResult($actionData);
        return $actionData;
    }

    /**
     * @return string
     * @throws NotAllowedException
     */
    private function getIdentifier()
    {
        $id = $this->params()->fromRoute($this->identifierName, false);
        return $id;
    }

    /**
     * @param $method
     * @return string
     */
    private function getMethodRest($method, $isId = true)
    {

        if ($isId) {
            $action = $this->params()->fromRoute('method', false);
        } else {
            $action = $this->params()->fromRoute($this->identifierName, false);
        }
        if (is_string($action)) {
            $method = $this->getMethod($method.'-'.$action);
            if (method_exists($this, $method)) {
                $action = $method;
            } else {
                $action = false;
            }
        }
        return $action;
    }

    private function authorizedAccess()
    {
        $isWhiteList = $this->whiteListUrl(RouteMatch::get('module'), RouteMatch::get('controller'));
        if ($isWhiteList) {
            return true;
        }
        $token = $this->params()->fromQuery('token', '');

        try {
            $this->auth = $this->misaSrv()->baseToken()->getData($token);
        } catch (MisaException $e) {
            //throw new UnauthorizedException();
        }
        return true;
    }


    /**
     * url que no requieren de token para ser validadas
     * @return bool
     */
    private function whiteListUrl($module, $controller)
    {
        $return = false;
        if ($module == 'Api') {
            if ($controller == 'Authentication') {
                $return = true;
            }
        }
        return $return;
    }

    /**
     * Process post data and call create
     *
     * @param Request $request
     * @return mixed
     * @throws Exception\DomainException If a JSON request was made, but no
     *    method for parsing JSON is available.
     */
    private function getPostData(Request $request)
    {

        if ($this->requestHasContentType($request, self::CONTENT_TYPE_JSON)) {
            return $this->jsonDecode($request->getContent());
        }


        return $request->getPost()->toArray();
    }

    /**
     * Check if request has certain content type
     *
     * @param  Request $request
     * @param  string|null $contentType
     * @return bool
     */
    private function requestHasContentType(Request $request, $contentType = '')
    {
        /** @var $headerContentType \Zend\Http\Header\ContentType */
        $headerContentType = $request->getHeaders()->get('content-type');
        if (! $headerContentType) {
            return false;
        }

        $requestedContentType = $headerContentType->getFieldValue();
        if (strstr($requestedContentType, ';')) {
            $headerData = explode(';', $requestedContentType);
            $requestedContentType = array_shift($headerData);
        }
        $requestedContentType = trim($requestedContentType);
        if (array_key_exists($contentType, $this->contentTypes)) {
            foreach ($this->contentTypes[$contentType] as $contentTypeValue) {
                if (stripos($contentTypeValue, $requestedContentType) === 0) {
                    return true;
                }
            }
        }

        return false;
    }
    /**
     * Process the raw body content
     *
     * If the content-type indicates a JSON payload, the payload is immediately
     * decoded and the data returned. Otherwise, the data is passed to
     * parse_str(). If that function returns a single-member array with a empty
     * value, the method assumes that we have non-urlencoded content and
     * returns the raw content; otherwise, the array created is returned.
     *
     * @param  mixed $request
     * @return object|string|array
     * @throws Exception\DomainException If a JSON request was made, but no
     *    method for parsing JSON is available.
     */
    private function processBodyContent($request)
    {
        $content = $request->getContent();



        // JSON content? decode and return it.
        if ($this->requestHasContentType($request, self::CONTENT_TYPE_JSON)) {
            return $this->jsonDecode($request->getContent());
        }

        parse_str($content, $parsedParams);

        // If parse_str fails to decode, or we have a single element with empty value
        if (! is_array($parsedParams) || empty($parsedParams)
            || (1 == count($parsedParams) && '' === reset($parsedParams))
        ) {
            return $content;
        }

        return $parsedParams;
    }

    /**
     * Transform an "action" token into a method name
     *
     * @param  string $action
     * @return string
     */
    private function getMethod($action)
    {
        $method  = str_replace(['.', '-', '_'], ' ', $action);
        $method  = ucwords($method);
        $method  = str_replace(' ', '', $method);
        $method  = lcfirst($method);
        return $method;
    }

    /**
     * Decode a JSON string.
     *
     * Uses json_decode by default. If that is not available, checks for
     * availability of Zend\Json\Json, and uses that if present.
     *
     * Otherwise, raises an exception.
     *
     * Marked protected to allow usage from extending classes.
     *
     * @param string
     * @return mixed
     * @throws Exception\DomainException if no JSON decoding functionality is
     *     available.
     */
    private function jsonDecode($string)
    {
        if (function_exists('json_decode')) {
            return json_decode($string, (bool) $this->jsonDecodeType);
        }

        if (class_exists(Json::class)) {
            return Json::decode($string, (int) $this->jsonDecodeType);
        }

        throw new Exception\DomainException(sprintf(
            'Unable to parse JSON request, due to missing ext/json and/or %s',
            Json::class
        ));
    }
}
