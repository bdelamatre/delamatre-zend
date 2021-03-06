<?php

/**
 * Default configuration file for Assetic
 *
 * Creates two files
 *     base_css.css = contains the default css
 *     base_js = contains the default js
 *
 * Debugging and buildOnRequest disabled by default. These need to be
 * enabled at least once to build the assetic files and than they can
 * be disabled again.
 */
return array(

    //default assetic configuration
    'assetic_configuration' => array(

        //use on development environments
        'debug' => false,
        'buildOnRequest' => false,

        // this is specific to this project
        'webPath' => realpath('public/assets'),
        'basePath' => 'assets',

        //configuration of default modules
        'default' => array(
            'assets' => array(
                '@base_css',
                '@base_js',
            ),
            'options' => array(
                'mixin' => true
            ),
        ),

        //resources to include in default modules
        'modules' => array(
            'delamatre-zend' => array(
                'root_path' => __DIR__ . '/../bower_components',

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
                ),

            ),
        ),

    ),

);
