<?php

namespace DelamatreZend\View\Helper;

class EntityManager extends AbstractHelper
{

    public function __invoke()
    {
        $em = $this->getServiceLocator()->getServiceLocator()->get('doctrine.entitymanager.orm_default');

        return $em;
    }

}