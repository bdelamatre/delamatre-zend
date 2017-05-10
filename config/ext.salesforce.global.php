<?php

define('SALESFORCE_ENABLED',true);
define('SALESFORCE_DISABLED',false);

define('SEND_LEADS_TO_SALESFORCE_USING_API','api');
define('SEND_LEADS_TO_SALESFORCE_USING_WEBTOLEAD','web_to_lead_form');

return array(

    'salesforce' => array(
        'enabled' => SALESFORCE_DISABLED,
        'send_leads_to_salesforce' => false,
        'send_leads_to_salesforce_using' => SEND_LEADS_TO_SALESFORCE_USING_API,
        'api' => array(
            'wsdl'              => 'config/enterprise.wsdl.xml',
            'username'          => '',
            'password'          => '',
            'token'             => '',
        ),
        'web_to_lead_form'=>array(
            'oid' => '',
        ),
    ),

);