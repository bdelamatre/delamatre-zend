<?php

namespace DelamatreZend;

use DelamatreZend\Entity\User;

return array(

    //default assetic configuration
    'assetic_configuration' => array(

        // Use on development environment
        'debug' => false,
        'buildOnRequest' => false,

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

        'routes' => array(
            'cms-admin(.*)' => array(
                '@admin_css',
                '@admin_js',
            ),
        ),

        'modules' => array(
            'delamatre-zend' => array(
                'root_path' => __DIR__.'/../bower_components',

                'collections' => array(
                    'base_css' => array(
                        'assets' => array(
                            'bootstrap/dist/css/bootstrap.css',
                            'bootstrap/dist/css/bootstrap-theme.css',
                            'font-awesome/css/font-awesome.css',
                            'yamm3/yamm/yamm.css',
                        ),
                        'filters' => array(
                            'CssRewriteFilter' => array(
                                'name' => 'Assetic\Filter\CssRewriteFilter'
                            ),
                            '?CssMinFilter' => array(
                                'name' => 'Assetic\Filter\CssMinFilter'
                            ),
                        ),
                    ),
                    'base_js' => array(
                        'assets' => array(
                            'jquery/jquery.js',
                            'bootstrap/dist/js/bootstrap.js',
                            'jquery-validate/dist/jquery.validate.js',
                            'parallax.js/parallax.js',
                        ),
                        'filters' => array(
                            '?JSMinFilter' => array(
                                'name' => 'Assetic\Filter\JSMinFilter'
                            ),
                        ),
                    ),
                    'admin_js' => array(
                        'assets' => array(
                            'jquery-ui/jquery-ui.js',
                            'summernote/dist/summernote.js',
                            'elfinder/js/elfinder.full.js',
                            'summernote-ext-elfinder-master/summernote-ext-elfinder.js',
                        ),
                        'filters' => array(
                            '?JSMinFilter' => array(
                                'name' => 'Assetic\Filter\JSMinFilter'
                            ),
                        ),
                    ),
                    'admin_css' => array(
                        'assets' => array(
                            'summernote/dist/summernote.css',
                            'elfinder/css/elfinder.full.css',
                            'elfinder/css/theme.css',
                        ),
                        'filters' => array(
                            'CssRewriteFilter' => array(
                                'name' => 'Assetic\Filter\CssRewriteFilter'
                            ),
                            '?CssMinFilter' => array(
                                'name' => 'Assetic\Filter\CssMinFilter'
                            ),
                        ),
                    ),
                ),
            ),
        ),

    ),

);
