<?php

define('ENVIRONMENT_TYPE_PRODUCTION','PRODUCTION');
define('ENVIRONMENT_TYPE_STAGING','STAGING');
define('ENVIRONMENT_TYPE_DEVELOPMENT','DEVELOPMENT');

return array(
    'myapp' => array(
        'baseurl' => 'http://localhost',
        'timezone' => 'America/Chicago',
        'name' => 'Delamatre Zend',
        'appendTitle' => 'Delamatre Zend',
        'environment' => array(
            'type' => ENVIRONMENT_TYPE_DEVELOPMENT,
            'notes' => 'to change to production, set [myapp][environment][type] to ENVIRONMENT_TYPE_PRODUCTION',
            'error_reporting' => E_ALL,
            'display_errors' => true,
            'display_exceptions' => true,
        ),
        'contact' => array(
            'company_name'=>'Delamatre, LLC',
            'email'=>'byron@delamatre',
            'phone_formatted'=>'+1 (123) 345-7890',
            'phone_link'=>'11234567890',
            'fax_formatted'=>'',
            'fax_link'=>'',
            'street'=>'',
            'city'=>'',
            'state'=>'',
            'zip'=>'',
            'country'=>'',
        ),
        'author' => array(
            'company_name'=>'',
            'website'=>'',
            'email'=>'',
            'phone_formatted'=>'',
            'phone_link'=>'',
            'fax_formatted'=>'',
            'fax_link'=>'',
            'street'=>'',
            'city'=>'',
            'state'=>'',
            'zip'=>'',
            'country'=>'',
        ),
        'date_format' => 'm-d-Y',
        'datetime_format' => 'm/d/Y h:i:s',
        'time_format' => 'g:i A',
        'smtp' => array(
            //'display'           => 'Byron DeLaMatre',
            'name'              => 'smtp.office365.com',
            'host'              => 'smtp.office365.com',
            'port'              => 587,
            'connection_class'  => 'login',
            'connection_config' => array(
                'username' => '',
                'password' => '',
                'ssl'      => '',
            ),
        ),
        'contact-popup' => array(
            'enable' => false,
            'timeout' => 60000,
            'exceptions' =>array(
                'routes' => array('home','contact','thank-you','thank-you-newsletter','sitemap','sitemap-xml','careers','community','branding'),
                'modules' => array('DelamatreZendCmsAdmin'),
                'controllers' => array(),
            ),
        ),
    ),

);
