<?php

namespace Application\Controller;

use Firebase\JWT\JWT;
use MisaCore\Application\Controller\BaseBasicActionController;
use MisaCore\Application\Factory\AuthFactory;
use MisaCore\Application\Factory\Person\EmployeeFactory;
use MisaCore\Domain\Base\Implement\MisaUniqId;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends BaseBasicActionController
{
    public function indexAction()
    {

        return new ViewModel();
    }
}
