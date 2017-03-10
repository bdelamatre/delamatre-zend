<?php

namespace DelamatreZend;

use DelamatreZend\Entity\User;

return array(

    //default routes
    'router' => array(
        'routes' => array(

            'home' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'DelamatreZend\Controller\Index',
                        'action'     => 'index',
                    ),
                ),
            ),

            'about' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/',
                    'defaults' => array(
                        'controller' => 'DelamatreZend\Controller\about',
                        'action'     => 'index',
                    ),
                ),
            ),

            'sitemap' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/sitemap',
                    'defaults' => array(
                        'controller' => 'DelamatreZend\Controller\Index',
                        'action'     => 'sitemap',
                    ),
                ),
            ),

            'sitemap-xml' => array(
                'type' => 'Zend\Mvc\Router\Http\Literal',
                'options' => array(
                    'route'    => '/sitemap.xml',
                    'defaults' => array(
                        'controller' => 'DelamatreZend\Controller\Index',
                        'action'     => 'sitemapXml',
                    ),
                ),
            ),

            // The following is a route to simplify getting started creating
            // new controllers and actions without needing to create a new
            // module. Simply drop new controllers in, and you can access them
            // using the path /application/:controller/:action
            'delamatre-zend-default' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/delamatre',
                    'defaults' => array(
                        '__NAMESPACE__' => 'DelamatreZend\Controller',
                        'controller'    => 'Index',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:controller[/:action]]',
                            'constraints' => array(
                                'controller' => '[a-zA-Z][a-zA-Z0-9_-]*',
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        ),
    ),

    'service_manager' => array(
        'abstract_factories' => array(
            'Zend\Cache\Service\StorageCacheAbstractServiceFactory',
            'Zend\Log\LoggerAbstractServiceFactory',
        ),
        'factories' => array(
            'translator' => 'Zend\Mvc\Service\TranslatorServiceFactory',
            'Zend\Session\SessionManager' => 'Zend\Session\Service\SessionManagerFactory',
        ),
        'aliases' => array(
            'zfcuser_zend_db_adapter' => (isset($settings['zend_db_adapter'])) ? $settings['zend_db_adapter']: 'Zend\Db\Adapter\Adapter',
        ),
    ),

    'translator' => array(
        'locale' => 'en_US',
        'translation_file_patterns' => array(
            array(
                'type'     => 'gettext',
                'base_dir' => __DIR__ . '/../language',
                'pattern'  => '%s.mo',
            ),
        ),
    ),

    'controllers' => array(
        'invokables' => array(
            'DelamatreZend\Controller\Index' => Controller\IndexController::class,
        ),
    ),

    'module_layouts' => array(
    ),

    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'layout/ajax'             => __DIR__ . '/../view/layout/ajax.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),

    //custom view helpers
    'view_helpers' => array(
        'invokables'=> array(
            'entityManager'     => 'DelamatreZend\View\Helper\EntityManager',
            'cmsContent'        => 'DelamatreZend\View\Helper\CmsContent',
            'config'            => 'DelamatreZend\View\Helper\Config',
            'formElfinder'      => 'DelamatreZend\View\Helper\FormElfinder',
            'getRoute'          => 'DelamatreZend\View\Helper\GetRoute',
            'adobeTypeKit'      => 'DelamatreZend\View\Helper\AdobeTypeKit',
            'googleAnalytics'   => 'DelamatreZend\View\Helper\GoogleAnalytics',
            'fontAwesome'       => 'DelamatreZend\View\Helper\FontAwesome',
            'icon'              => 'DelamatreZend\View\Helper\Icon',
            'iconCheckMark'     => 'DelamatreZend\View\Helper\IconCheckMark',
            'IPAddress'         => 'DelamatreZend\View\Helper\IPAddress',
            'yesNo'             => 'DelamatreZend\View\Helper\YesNo',
        )
    ),

    //default session configuration
    'session' => array(
        'config' => array(
            'class' => 'Zend\Session\Config\SessionConfig',
            'options' => array(
                'name' => 'delamatre',
            ),
        ),
        'storage' => 'Zend\Session\Storage\SessionArrayStorage',
        'validators' => array(
            'Zend\Session\Validator\RemoteAddr',
            'Zend\Session\Validator\HttpUserAgent',
        ),
    ),

);
