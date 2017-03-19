<?php

define('PHANTOMJS_ENABLED',true);
define('PHANTOMJS_DISABLED',false);
/**
To customize and use Adobe Typekit copy this your config/* directory and insert your kit id
**/
return array(
    'phantomjs' => array(
        'enabled' => PHANTOMJS_ENABLED,
        'bin'=>'data/phantomjs/phantomjs.exe',
    ),
);