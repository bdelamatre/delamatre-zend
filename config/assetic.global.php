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
                'root_path' => 'public/assets',

                'collections' => array(
                    'base_css' => array(
                        'assets' => array(
                            'bootstrap/css/bootstrap.min.css',
                            'bootstrap/css/bootstrap-theme.min.css',
                            'font-awesome/css/font-awesome.min.css',
                            'yamm/yamm.css',
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
                            'jquery/jquery.min.js',
                            'bootstrap/js/bootstrap.min.js',
                            'jquery-validate/jquery.validate.min.js',
                            'parallax/parallax.min.js',
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
