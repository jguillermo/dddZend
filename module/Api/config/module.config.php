<?php
namespace Api;

use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;
use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'controllers' => [

        'factories' => [
            Controller\User\EmployeeController::class => InvokableFactory::class,
        ]
    ],

    // The following section is new` and should be added to your file
    'router' => [
        'routes' => [
            'app-rest' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/api/v1',
                    'defaults' => [
                        'controller' => Controller\User\EmployeeController::class,
                    ],
                ],
                'may_terminate' => true,
                'child_routes' => [
                    'employee' => [
                        'type'    => Segment::class,
                        'options' => [
                            'route'    => '/employees[/:id][/:method]',
                            'constraints' => [
                            ],
                            'defaults' => [
                                'controller' => Controller\User\EmployeeController::class,
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'view_manager' => [
        'strategies' => [
            'ViewJsonStrategy',
        ],
    ],
];
