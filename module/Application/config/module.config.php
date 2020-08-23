<?php
declare(strict_types=1);

namespace Application;

use Application\Controller\ContractManagerController;
use Application\Controller\IndexController;
use Application\Factory\Controller\ContractManagerControllerFactory;
use Application\Factory\Controller\IndexControllerFactory;
use Application\Factory\Service\ContractManagerServiceFactory;
use Application\Service\PdfGeneratorService;
use Application\Service\PdfGeneratorServiceHelper;
use Application\Util\Region;
use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [
    'router'          => [
        'routes' => [
            'home'              => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/',
                    'defaults' => [
                        'controller' => IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'new-contract'      => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/contract-manager/new',
                    'defaults' => [
                        'controller' => ContractManagerController::class,
                        'action'     => 'new',
                    ],
                ],
            ],
            'generate-contract' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/contract-manager/generate',
                    'defaults' => [
                        'controller' => ContractManagerController::class,
                        'action'     => 'generate',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            PdfGeneratorService::class       => ContractManagerServiceFactory::class,
            PdfGeneratorServiceHelper::class => InvokableFactory::class,
        ],
    ],
    'controllers'     => [
        'factories' => [
            IndexController::class           => IndexControllerFactory::class,
            ContractManagerController::class => ContractManagerControllerFactory::class,
        ],
    ],
    'view_manager'    => [
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map'             => [
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'application/index/index' => __DIR__ . '/../view/application/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ],
        'template_path_stack'      => [
            __DIR__ . '/../view',
        ],
    ],
    'translator'      => [
        'locale'                    => Region::getCurrentLocale(),
        'translation_file_patterns' => [
            [
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ],
        ],
    ],
];
