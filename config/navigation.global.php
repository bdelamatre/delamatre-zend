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
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'default' => 'DelamatreZend\Navigation\Service\NavigationFactory',
        ),
    ),
);