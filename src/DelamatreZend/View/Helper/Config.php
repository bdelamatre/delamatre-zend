<?php

namespace DelamatreZend\View\Helper;

class Config extends AbstractHelper
{

    public function __invoke()
    {
        $config = $this->getServiceLocator()->getServiceLocator()->get('Config');

        return $config;
    }

}