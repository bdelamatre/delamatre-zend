<?php

return array(
    'navigation' => array(
        'options' => array(
            'footer'=> array(
                'exclude_children'=>array(
                    //'EntiyName'
                )
            )
        ),
        'menu' => array(
            array(
                'label' => 'About',
                'route'=>'about',
                'col'=>'4',
                'entity'=>false,
            ),
            array(
                'label' => 'Contact',
                'route' => 'contact',
                'col'=>'6',
                'entity'=>false,
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'default' => 'DelamatreZend\Navigation\Service\NavigationFactory',
        ),
    ),
);