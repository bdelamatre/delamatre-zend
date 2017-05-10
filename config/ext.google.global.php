<?php

define('GOOGLE_ANALYTICS_ENABLED',true);
define('GOOGLE_ANALYTICS_DISABLED',false);

define('GOOGLE_MAPS_ENABLED',true);
define('GOOGLE_MAPS_DISABLED',false);

define('GOOGLE_REPORTS_ENABLED',true);
define('GOOGLE_REPORTS_DISABLED',false);

define('GOOGLE_RECAPTCHA_ENABLED',true);
define('GOOGLE_RECAPTCHA_DISABLED',false);

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
        'reports' => array(
            'enabled' => GOOGLE_REPORTS_DISABLED,
            'json_key_file' => '',
            'default_profile' => '',
            'profile_id' => array(
                'Default' => '',
            ),
        ),
        'recaptcha' => array(
            'enabled' => GOOGLE_RECAPTCHA_DISABLED,
            'site_key'=>'',
            'secret_key'=>'',
        ),
    ),
);