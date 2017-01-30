<?php

namespace DelamatreZend;

use DelamatreZend\Entity\User;

return array(

    //default assetic configuration
    'assetic_configuration' => array(

        // Use on development environment
        'debug' => true,
        'buildOnRequest' => true,


        // this is specific to this project
        'webPath' => realpath('public/assets'),
        'basePath' => 'assets',

        'default' => array(
            'assets' => array(
                '@base_css',
                '@base_js',
            ),
            'options' => array(
                'mixin' => true
            ),
        ),

        'modules' => array(
            'application' => array(
                'root_path' => 'bower_components',

                'collections' => array(
                    'base_css' => array(
                        'assets' => array(
                            'bower_components/bootstrap/dist/css/bootstrap.css',
                            'bower_components/bootstrap/dist/css/bootstrap-theme.css',
                            'bower_components/font-awesome/css/font-awesome.css',
                            'bower_components/yamm3/yamm/yamm.css',
                        ),
                        'filters' => array(
                            '?CssRewriteFilter' => array(
                                'name' => 'Assetic\Filter\CssRewriteFilter'
                            ),
                            '?CssMinFilter' => array(
                                'name' => 'Assetic\Filter\CssMinFilter'
                            ),
                        ),
                    ),
                    'base_js' => array(
                        'assets' => array(
                            'bower_components/jquery/dist/jquery.js',
                            'bower_components/bootstrap/dist/js/bootstrap.js',
                            'bower_components/jquery-validate/dist/jquery.validate.js',
                            'bower_components/parallax.js/parallax.js',
                        ),
                        'filters' => array(
                            '?JSMinFilter' => array(
                                'name' => 'Assetic\Filter\JSMinFilter'
                            ),
                        ),
                    ),
                ),
            ),
        ),

    ),

);
