<?php

/**
 * Default configuration file for Doctrine ORM
 *
 * Configures a default driver, entity manager and orm configuration.
 */
return array(

    //doctrine settings
    'doctrine' => array(
        //Doctrine Entity settings
        'driver' => array(
            // defines an annotation driver with two paths, and names it `my_annotation_driver`
            'default_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/DelamatreZend/Entity',
                ),
            ),
            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    // register `my_annotation_driver` for any entity under namespace `My\Namespace`
                    'DelamatreZend\Entity' => 'default_driver',
                )
            )
        ),
        // Entity Manager instantiation settings
        'entitymanager' => array(
            'orm_default' => array(
                'connection'    => 'orm_default',
                'configuration' => 'orm_default',
            ),
        ),
        'configuration' => array(
            'orm_default' => array(
                'metadata_cache' => 'array',
                'query_cache' => 'array',
                'result_cache' => 'array',
                'hydration_cache' => 'array',
                'generate_proxies' => false,
            ),
        ),

    ),

);