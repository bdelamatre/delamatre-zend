<?php

define('FILEMANAGER_ENABLED',true);
define('FILEMANAGER_DISABLED',false);

/**
To customize and use Adobe Typekit copy this your config/* directory and insert your kit id
**/
return array(
    'filemanager' => array(
        'enable' => FILEMANAGER_DISABLED,
        'locale' => 'en_US.UTF-8',
        /*'roots'  => array(
            array(
                'driver' => 'LocalFileSystem',
                'path'   => '/',
                'URL'    => '/',
            )
        )*/
    ),
);