<?php

define('GOOGLE_ANALYTICS_ENABLED',true);
define('GOOGLE_ANALYTICS_DISABLED',false);

define('GOOGLE_MAPS_ENABLED',true);
define('GOOGLE_MAPS_DISABLED',false);

/**
To customize and use Adobe Typekit copy this your config/* directory and insert your kit id
**/
return array(
    'google' => array(
        'analytics' => array(
            'enabled' => GOOGLE_ANALYTICS_DISABLED,
            'code'=>'',
        ),
        'maps' => array(
            'enabled' => GOOGLE_MAPS_DISABLED,
            'code'=>'',
        ),
    ),
);