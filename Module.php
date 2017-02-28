<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace DelamatreZend;

use Monolog\Handler\LogglyHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

class Module
{

    public function onBootstrap(MvcEvent $e)
    {

        //get the event and and service manager instances
        $eventManager        = $e->getApplication()->getEventManager();
        $serviceManager      = $e->getApplication()->getServiceManager();
        $config              = $serviceManager->get('Config');


        //set default timezone from config
        if(isset($config['myapp']['timezone'])){
            date_default_timezone_set($config['myapp']['timezone']);
        }

        //set error reporting from config
        if(isset($config['myapp']['environment']['error_reporting'])){
            error_reporting($config['myapp']['environment']['error_reporting']);
        }

        //set display errors from config
        if(isset($config['myapp']['environment']['display_errors'])){
            ini_set('display_errors', $config['myapp']['environment']['display_errors']);
        }

        //set display exceptions from config
        if(isset($config['myapp']['environment']['display_exceptions'])){
            ini_set('display_exception', $config['myapp']['environment']['display_exceptions']);
        }

        //log exceptions
        $eventManager->attach('dispatch.error', function($e){
            $exception = $e->getResult()->exception;
            if ($exception) {

                $serviceManager      = $e->getApplication()->getServiceManager();
                $config              = $serviceManager->get('Config');

                //if logging exceptions
                if(isset($config['myapp']['environment']['log_exceptions'])
                    && $config['myapp']['environment']['log_exceptions']){

                    //create logger
                    $log = new Logger('exceptions');

                    //log to file
                    if(isset($config['myapp']['environment']['log_file'])
                        && $config['myapp']['environment']['log_file']){

                        $formatter = new \Monolog\Formatter\LineFormatter();
                        $formatter->includeStacktraces(true);

                        $streamHandler = new StreamHandler($config['myapp']['environment']['log_file'], Logger::ERROR);
                        $streamHandler->setFormatter($formatter);
                        $log->pushHandler($streamHandler);

                    }

                    //log to loggly
                    if(isset($config['myapp']['environment']['log_loggly'])
                        && $config['myapp']['environment']['log_loggly']){

                        $log->pushHandler(new LogglyHandler($config['myapp']['environment']['log_loggly'], Logger::ERROR));
                    }

                    $log->error($exception);

                }
            }
        });

        //change the layout based on the controller
        //fix-me: convert this to a configuration file
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, function($e) {
            $controller = $e->getTarget();
            if($e->getRequest()->isXmlHttpRequest()) {
                $controller->layout('layout/ajax');
            } else {
                $controller->layout('layout/layout');
            }
        });

        //attach the event manager to the module route listener so that we can change the layout based on route paramaters
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);

        //get the router, request and matched route
        $router = $serviceManager->get('router');
        $request = $serviceManager->get('request');
        $matchedRoute = $router->match($request);

        //we are going to inject some variables into the view model so that we can use them later
        if($matchedRoute){

            $params = $matchedRoute->getParams();

            $controller = $params['controller'];
            $action = $params['action'];

            if(isset($params['__NAMESPACE__'])){
                $module_array = explode('\\', $params['__NAMESPACE__']);
                $module = $module_array[0];
            }else{
                $module = $controller;
            }

            $route = $matchedRoute->getMatchedRouteName();

            $e->getViewModel()->setVariables(
                array(
                    'CURRENT_MODULE_NAME' => $module,
                    'CURRENT_CONTROLLER_NAME' => $controller,
                    'CURRENT_ACTION_NAME' => $action,
                    'CURRENT_ROUTE_NAME' => $route,
                )
            );

        }

    }

    public function getConfig()
    {
        $config = array();

        //split the module config into multiple files
        $configFiles = array(
            __DIR__ . '/config/module.config.php',
            __DIR__ . '/config/assetic.global.php',
            __DIR__ . '/config/doctrine.global.php',
            __DIR__ . '/config/getresponse.global.php',
            __DIR__ . '/config/google.global.php',
            __DIR__ . '/config/filemanager.global.php',
            __DIR__ . '/config/maxmind.global.php',
            __DIR__ . '/config/myapp.global.php',
            __DIR__ . '/config/navigation.global.php',
            __DIR__ . '/config/salesforce.global.php',
            __DIR__ . '/config/session.global.php',
            __DIR__ . '/config/typekit.global.php',
            __DIR__ . '/config/user.global.php',
        );

        // Merge all module config options
        foreach($configFiles as $configFile) {
            $config = \Zend\Stdlib\ArrayUtils::merge($config, include $configFile);
        }

        return $config;
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }

}
