# DelamatreZend

A Zend Framework 2 module that pre-configures your Zend Framework 2 project with the following:

<ul>
    <li>Authentication:
        <ul>
            <li>ZfcUser (ZfcUserDoctrineOrm)</li>
        </ul>
    </li>
    <li>Database:
        <ul>
            <li>Doctrine ORM</li>
        </ul>
    </li>
    <li>Frontend:
        <ul>
            <li>Bower compilation with:
                <ul>
                    <li>jQuery</li>
                    <li>Twitter Bootstrap</li>
                    <li>Font Awesome</li>
                </ul>
            </li>
            <li>Assetic</li>
            <li>(Optional) Typekit</li>
        </ul>
    </li>
    <li>Logging:
        <ul>
            <li>Monolog</li>
        </ul>
    </li>
    <li>Zend Framework extensions:
        <ul>
            <li>Mvc\Controller</li>
            <li>Form</li>
            <li>Navigation</li>
            <li>View</li>
        </ul>
    </li>
    <li>Various other integrations:
        <ul>
            <li>Google Api</li>
            <li>Lavacharts</li>
            <li>Geopip2</li>
            <li>ElFinder</li>
            <li>SalesForce</li>
            <li>GetResponse360</li>
            <li>Mashape</li>
            <li>PhantomJs</li>
        </ul>
    </li>
</ul>

## About

A set of pre-configured libraries, modules, resources, view helpers, etc. that can be used to quickly bootstrap your Zend Framework 2 project. This will be useful for anyone who wants to build a full-stack application using Zend Framework2 + DoctrineOrm + Twitter Bootstrap + jQuery. You may also find this project useful as a reference if you are trying to integrate any of the above libraries into your own Zend Framework 2 project.

## Getting Started

To get started, add the following to the require section in your composer.json then update composer.

```
"bdelamatre/delamatre-zend": "dev-master",
```

You will then need to add the following modules to your ZF2 application.config.php file.

```php
	'EdpModuleLayouts', 	#required by DelamatreZend
	'TwbBundle', 		#required by DelamatreZend
	'DoctrineModule', 	#required by DelamatreZend
	'DoctrineORMModule', 	#required by DelamatreZend
	'ZfcBase', 	#required by DelamatreZend
	'ZfcUser', 	#required by DelamatreZend
	'ZfcUserDoctrineORM', 	#required by DelamatreZend
	'AsseticBundle', 	#required by DelamatreZend
	'DelamatreZend',	#DelamatreZend
```

## Project Structure

The following project structure is assumed for your Zend Framework 2 project and mimics the <a href="https://github.com/zendframework/ZendSkeletonApplication">ZF2 Skeleton Application</a> directory structure. You can modify this as needed.

<ul>
    <li><b>config/</b> - contains application.config.php</li>
    <li><b>config/autoload/</b> - contains config files following the .local.php and .global.php standard.</li>
    <li><b>config/autoload/dist/</b> - contains a copy all config distrubtion files that you can include and configure.</li>
    <li><b>data/cache/</b> - location for various file system caches</li>
    <li><b>data/DoctrineORMModule/</b> - location for entity proxies and other Doctrine cache objects</li>
    <li><b>data/log/</b> - location for application logs</li>
    <li><b>data/log/screenshots/</b> - cached images of screenshots (PhantomJS)</li>
    <li><b>module/</b> - zend framework 2 modules</li>
    <li><b>public/</b> - public files</li>
    <li><b>public/assets/</b> - location for all front-end libraries and assetic compilation files.</li>
    <li><b>vendor/</b> - composer libraries</li>
</ul>

## Configuration Files

One of the primary goals of this project is to manage configuration files across a multitude of similiar projects. As such, there are many different configuration files available and traits that allow for interaction with the classes that they configure.

* **assetic.*.php** - Configures Assetic
* **doctrine.*.php** - Configures Doctrine ORM
* **ext.filemanager.*.php** - Configures elFinder Filemanager integration
* **ext.getresponse.*.php** - Configures GetResponse360 integration
* **ext.google.*.php** - Configues Google integration
* **ext.mashape.*.php** -- Configures Mashape integration
* **ext.maxmind.*.php** -- Configures Maxmind (Geoip2) integration
* **ext.phantomjs.*.php** -- Configures PhantomJS integration
* **ext.salesforce.*.php** -- Configures SalesForce integration
* **ext.typekit.*.php** -- Configures Typekit integration
* **myapp.*.php** -- Configures information about the application
* **navigation.*.php** -- Configures the navigation menu
* **session.*.php** -- Configures PHP sessions
* **user.*.php** -- Configures authentication / ZfCUser

Configuration extensions

<ul>
	<li>*.global.php - a global configuration file</li>
	<li>*.local.php - a local configuration file, overrides *.global.php files.</li>
	<li>*.dist - a distribution copy of a configuration file.</li>
</ul>


### Default configuration files

To bootstrap your project, all configurations have a default configuration that is included in this module under config/. By default, all ext.*.php config files are disabled and the rest of the configurations work out of box with the default project structure.

### Distribution configuration files

For each default configuration file there is a correspondering *.global.php.dist and/or *.local.php.dist file under config/autoload/dist/. The builder will copy all of these distribution files into your project under config/autoload/dist/*. These distribution files contain the values that you will likely want to modify for your project. To use them, just copy/paste the distribution file into config/autoload/, remove the .dist extension and modify as needed.

<i>Note: The required .local.php configuration files (such as database.local.php) will have already been copied into /config/autoload/ for you by the Builder.</i>

### myapp.*.php

The myapp configuration file is different from the other configuration files in that it doesn't configure any specific PHP classes/libraries. Instead, the values here are used to describe general information, environment information and other application-specific settings. You should configure myapp.global.php with your general app settings and myapp.local.php with your development environment settings.

Sample myapp.development.local.php configuration for a development environment:

```php
return array(
    'myapp' => array(
        'environment' => array(
            'type' => ENVIRONMENT_TYPE_DEVELOPMENT,
            'notes' => 'to change to production, set [myapp][environment][type] to ENVIRONMENT_TYPE_PRODUCTION',
            'display_errors' => true,
            'display_exceptions' => true,
        ),
        'baseurl' => 'http://localhost',
    ),

);
```

## Authentication

### ZfcUser (ZfcUserDoctrineOrm)

Integration using <a href="https://packagist.org/packages/zf-commons/zfc-user">zf-commons/zfc-user</a> and <a href="https://packagist.org/packages/zf-commons/zfc-user-doctrine-orm">zf-commons/zfc-user-doctrine-orm</a>. On composer install/update the autoloader config distribution file will be copied to config/autoload/dist/user.local.php.dist. No modifications are required out of box but you can rename this to user.local.php and modify if needed.

A default [user entity](/src/DelamatreZend/Entity/User.php) and [organization entity](/src/DelamatreZend/Entity/Organization.php) have been created and associated as the default entities in the user config. Additional configurations include the creation of a default user if no users exist in the database. Default username/password is root/root1234.

To override the default user/organization entites just extend the existing entities and update the user_entity_class and organization_entity_class user config options.</p>

#### Built-in controller actions

Same as all of the built-in ZfCUser actions. You can login at /user/login and logout at /user/logout. Take a look at ZfcUser for other actions and helpers.

#### Requiring authentication

You can use the built-in ZfcUser methods and add requirements to your Module.php for requiring authentication to large chunks of your application. You can also require authentication for any controller action using this simple method:

```php
//require authentication
$this->requireAuthentication();
```

optionally pass in an array of required groups

```php
//require authentication
$this->requireAuthentication(array('admin')); //must be an admin
```

#### Controller Helpers

When extending AbstractActionController.php or applying the User trait, the following helper methods will be available in your controller:
<ul>
	<li><b>getUserClass()</b> - The user class defined in user_entity_class</li>
	<li><b>getOrganizationClass()</b> - The organization class defined in organization_entity_class</li>
	<li><b>getZfcUserAuthentication()</b> - The zfcUserAuthentication plugin</li>
	<li><b>getUserCount()</b> - Number of users in the database</li>
	<li><b>getUserService()</b> - Get zfcuser_user_service from the service manager</li>
	<li><b>createDefaultUser($userConfig)</b> - Creates the default user defined in the user config</li>
	<li><b>requireAuthentication($allowedGroups)</b> -  Requires authentication for the specified groups. If not logged in, redirects to login. Otherwise throws an exception.</li>
</ul>

## Builder

<p>A simple PHP class that contains static functions for use as composer hooks. The builder does the following out of box:
<ul>
    <li>Setup required project directories and permissions</li>
    <li>Copy config distrubtion files to config/autoload/dist/</li>
    <li>Copy required public assets to public/assets/</li>
</ul>
</p>

## Database

### Doctrine ORM

Integration using <a href="https://packagist.org/packages/doctrine/doctrine-module">doctrine/doctrine-module</a> and <a href="https://packagist.org/packages/doctrine/doctrine-orm-module">doctrine/doctrine-orm-module</a>. On composer install/update the autoloader config distribution file will be copied to config/autoload/dist/database.local.php.dist and (if it doesn't exist) also /config/autoload/database.local.php. Insert your database connection information here.

The trait DelamatreZend\Mvc\Controller\DoctrineIntegration is applied to DelamatreZend\Mvc\Controller\AbstractActionController. This trait allows for the following functions to be easily called within your controllers:
<ul>
	<li><b>getEntityManager()</b> - Get the default entity manager</li>
	<li><b>createQueryBuilder()</b> - Create a query builder instance</li>
	<li><b>quoteSQL()</b> - Quote an object for the configured database</li>
</ul>

A default AbstractEntity provides additional functionality to any entity that inherits it. These include: magic setters/getters, entity to array and array to entity functions, etc.

#### database.*.php

database.local.php is one of the most important configuration files as it contains your local database connection information. There is no reason to configure database.global.php unless you need to add multiple database connections or modify entity locations.

## Front-end

### Bower Compilation

bower.json defines the needed libraries for a jquery/bootstrap/font awesome project. These assets are already included under src/bower_components but you can run bower and refetch if needed.

### Assetic

Integration using <a href="https://packagist.org/packages/widmogrod/zf2-assetic-module">widmogrod/zf2-assetic-module</a>. On composer install/update the autoloader config distribution file will be copied to config/autoload/dist/assetic.global.php.dist and config/autoload/dist/assetic.local.php.dist. If it doesn't exist, config/autoload/assetic.local.php will be setup as wel. To make changes to the global Assetic config, rename the file to assetic.global.php and modify as needed.

By default all public assets are assumed to belong under public/assets and assetic uses the included bower resources to autocreate a base_css.css and base_js.js file in this directory. These base files include compiled and minified code for jquery, bootstrap and font-awesome.

fix-me: You will need to copy the contents of bower_components to public/assets/ so that the image resources are available to bootstrap and font-awesome.

Assetic is configured to automatically add its assets to the ZF2 style and script objects. All you need to do to output assetic files is to use the headStyle() and headScript() view helpers.

#### assetic.*.php
<p>Assetic is configured and ready to use out of box. However, when modifying source code that is compiled with assetic (i.e. in development) you will want to enable the buildOnRequest option to autocompile your base files. You can use the assetic.local.php.dist file to do this.</p>

## Views / Templates
<ul>
    <li><b>view/error/404.phtml</b> - a default 404 error page.</li>
    <li><b>view/error/index.phtml</b> - a simple default error page.</li>
    <li><b>view/layout/ajax.phtml</b> - an alternative layout for AJAX rednering strategies.</li>
    <li><b>view/layout/layout.phtml</b> - a simple default layout.</li>
    <li><b>view/layout/components/*</b> - various components that can be used as partials.</li>
    <li><b>view/layout/navigation/menu.phtml</b> - a mega menu renderer for ZF2 navigation.</li>
    <li><b>view/zfc-user/user/*.phtml</b> - overrides of the default view templates from zfcuser</li>

</ul>

## Zend Framework Extensions

### Form

Various custom form elements.

### Mvc\Controller

An extensible AbstractActionController that provides additional controller helpers and integrations:

<ul>
    <li>Doctrine Integration</li>
    <li>elFinder Filemanager Integration</li>
    <li>GetResponse360 Integration</li>
    <li>Google Analytics Integration</li>
    <li>Lavacharts Integration</li>
    <li>Maxmind Geoip2 Integration</li>
    <li>Salesforce Integration</li>
    <li>Authentication Integration</li>
</ul>

Just extend controllers with DelamatreZend\Mvc\Controller\AbstractActionController or apply any of the available traits as needed.

### Navigation

On composer install/update the autoloader config distribution file will be copied to config/autoload/navigation.global.php.dist. Rename this to navigation.global.php and modify as needed.

This extensions allows for dynamically generated navigation menus using Doctrine Entities. The additional options have been added to the navigation options:
<ul>
    <li><b>entity</b> - The doctrine entity to use</li>
    <li><b>entity_route</b> - The ZF2 route to assembly links built from entities. This does not have to be the same as the normal route.</li>
    <li><b>depth</b> - How deep recursion should go when building out this menu item.</li>
    <li><b>col</b> - If using mega menus (yamm) this is how many columns will be output.  </li>
</ul>

### View

As with any developer's library, there are an array of custom view helpers that have been added.