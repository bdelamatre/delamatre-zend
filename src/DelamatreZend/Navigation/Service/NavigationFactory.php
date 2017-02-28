<?php

namespace DelamatreZend\Navigation\Service;

use Zend\Navigation\Service\DefaultNavigationFactory;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class NavigationFactory implements FactoryInterface{

    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $navigation = new \DelamatreZend\Navigation\Navigation();
        return $navigation->createService($serviceLocator);
    }

}