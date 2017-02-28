<?php

namespace DelamatreZend\View\Helper;

use Doctrine\Common\Util\Debug;

class Config extends AbstractHelper
{

    public function __invoke()
    {
        $config = $this->getServiceLocator()->getServiceLocator()->get('Config');

        return $config;
    }

}