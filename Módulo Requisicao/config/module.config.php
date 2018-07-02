<?php
return array(
	'router' => array(
        'routes' => array(
            'requisicao' => array(
                'type'    => 'segment',
                'options' => array(
                    'route'    => '/requisicao[/:controller[/:action]][/]',
                    'constraints' => array(
                        'action' => '[a-zA-Z0-9_-]*'
                    ),
                    'defaults' => array(
                        '__NAMESPACE__' => 'Requisicao\Controller',
                        'controller' => 'Requisicao\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),
        ),
    ),
	'controllers' => array(
        'invokables' => array(
            'Requisicao\Controller\Index' => 'Requisicao\Controller\IndexController'     
        ),
    ),
	'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,

        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'requisicao/index/index' => __DIR__.'/../view/requisicao/index/index.phtml',  
            
        ),

        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
        
    ),

    
    'doctrine' => array(
        'driver' => array(
            'application_entities' => array(
              'class' =>'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
              'cache' => 'array',
              'paths' => array(__DIR__ . '/../src/Requisicao/Entity')
            ),

            'orm_default' => array(
                'drivers' => array(
                    'Requisicao\Entity' => 'application_entities'
                ),
            ),
        ),
        
    ),
    
);