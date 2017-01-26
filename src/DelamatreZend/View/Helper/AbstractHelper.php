<?php

namespace DelamatreZend\View\Helper;

class AbstractHelper implements \Zend\ServiceManager\ServiceLocatorAwareInterface
{

    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    public function setServiceLocator(\Zend\ServiceManager\ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        return $this;
    }

}