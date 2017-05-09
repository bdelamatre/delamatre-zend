<h1>DelamatreZend</h1>
<p>
A Zend Framework 2 module that pre-configures your Zend Framework 2 project with the following:
<ul>
    <li>Database:
        <ul>
            <li>Doctrine ORM</li>
        </ul>
    </li>
    <li>Authentication:
        <ul>
            <li>ZfcUser (ZfcUserDoctrineOrm)</li>
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
</p>

<h1>About</h1>
<p>A set of pre-configured libraries, modules, resource view helpers, etc. that can be used to more quickly and bootstrap and Zend Framework 2 project. This will be useful for anyone who wishes to use this exact stack: ZF2+DoctrineOrm+Bootstrap+jQuery.</p>

<h1>Project Structure</h1>
<p>The following project structure is assumed for your Zend Framework 2 project and mimics the <a href="https://github.com/zendframework/ZendSkeletonApplication">ZF2 Skeleton Application</a> directory structure. You can modify this as needed.</p>
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

<h1>Configuration Files</h1>
<p>One of the primary reasons for this project was to manage configuration files across all of my projects. As such, there are many different configuration files available and traits that allow for interaction with their classes.</p>
<p>To bootstrap your project, all configurations have a default configuration that is included in this module under config/. For each configuration file there is a correspondering *.global.php.dist and/or *.local.php.dist file under config/autoload/. The builder will copy all of these distribution files into your project under config/autoload/dist/*. These distribution files contain the values that you will likely want to modify for your project.</p>
<p>To get started with any configuration, just copy the *.dist file into config/autoload/, remove the .dist extension and make your changes. <i>Note: The required .local.php configuration files (such as database.local.php) will have already been copied there for your.</i></p>
<h2>myap.*.php</h2>
<p>The myapp configuration file is different from the other configuration files in that it doesn't configure any specific PHP classes/libraries. Instead, the values here are used to describe general information, environment information and other application-specific settings. You should configure myapp.global.php with your general app settings and myapp.local.php with your development environment settings.</p>

<h1>Authentication</h1>
<h2>ZfcUser (ZfcUserDoctrineOrm)</h2>
<p>Integration using <a href="https://packagist.org/packages/zf-commons/zfc-user">zf-commons/zfc-user</a> and <a href="https://packagist.org/packages/zf-commons/zfc-user-doctrine-orm">zf-commons/zfc-user-doctrine-orm</a>. On composer install/update the autoloader config distribution file will be copied to config/autoload/dist/user.local.php.dist. Rename this to user.local.php and modify as needed.</p>
<p>A default [user entity](delamatre-zend/src/DelamatreZend/Entity/User.php) and [organization entity](delamatre-zend/src/DelamatreZend/Entity/Organization.php) have been created and associated as the default entities in the user config. Additional configurations include the creation of a default user if no users exist in the database. Default username/password is root/root1234.</p>
<p>To override the default user/organization entites just extend the existing entities and update the user_entity_class and organization_entity_class user config options.</p>
<h3>Controller Helpers</h3>
<p>
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
</p>

<h1>Builder</h1>
<p>A simple PHP class that contains static functions for use as composer hooks. The builder does the following out of box:
<ul>
    <li>Setup required project directories and permissions</li>
    <li>Copy config distrubtion files to config/autoload/dist/</li>
    <li>Copy required public assets to public/assets/</li>
</ul>
</p>

<h1>Database</h1>
<h2>Doctrine ORM</h2>
<p>Integration using <a href="https://packagist.org/packages/doctrine/doctrine-module">doctrine/doctrine-module</a> and <a href="https://packagist.org/packages/doctrine/doctrine-orm-module">doctrine/doctrine-orm-module</a>. On composer install/update the autoloader config distribution file will be copied to config/autoload/dist/database.local.php.dist and (if it doesn't exist) also /config/autoload/database.local.php. Insert your database connection information here.</p>
<p>The trait DelamatreZend\Mvc\Controller\DoctrineIntegration is applied to DelamatreZend\Mvc\Controller\AbstractActionController. This trait allows for the following functions to be easily called within your controllers:
<ul>
	<li><b>getEntityManager()</b> - Get the default entity manager</li>
	<li><b>createQueryBuilder()</b> - Create a query builder instance</li>
	<li><b>quoteSQL()</b> - Quote an object for the configured database</li>
</ul>
</p>
<p>A default AbstractEntity provides additional functionality to any entity that inherits it. These include: magic setters/getters, entity to array and array to entity functions, etc.</p>

<h1>Front-end</h1>
<h2>Bower Compilation</h2>
<p>bower.json defines the needed libraries for a jquery/bootstrap/font awesome project. These assets are already included under src/bower_components but you can run bower and refetch if needed.</p>
<h2>Assetic</h2>
<p>Integration using <a href="https://packagist.org/packages/widmogrod/zf2-assetic-module">widmogrod/zf2-assetic-module</a>. On composer install/update the autoloader config distribution file will be copied to config/autoload/dist/assetic.global.php.dist and config/autoload/dist/assetic.local.php.dist. If it doesn't exist, config/autoload/assetic.local.php will be setup as wel. To make changes to the global Assetic config, rename the file to assetic.global.php and modify as needed.</p>
<p>By default all public assets are assumed to belong under public/assets and assetic uses the included bower resources to autocreate a base_css.css and base_js.js file in this directory. These base files include compiled and minified code for jquery, bootstrap and font-awesome.</p>
<p>fix-me: You will need to copy the contents of bower_components to public/assets/ so that the image resources are available to bootstrap and font-awesome.</p>

<h1>Views / Templates</h1>
<ul>
    <li><b>view/error/404.phtml</b> - a default 404 error page.</li>
    <li><b>view/error/index.phtml</b> - a simple default error page.</li>
    <li><b>view/layout/ajax.phtml</b> - an alternative layout for AJAX rednering strategies.</li>
    <li><b>view/layout/layout.phtml</b> - a simple default layout.</li>
    <li><b>view/layout/components/*</b> - various components that can be used as partials.</li>
    <li><b>view/layout/navigation/menu.phtml</b> - a mega menu renderer for ZF2 navigation.</li>
    <li><b>view/zfc-user/user/*.phtml</b> - overrides of the default view templates from zfcuser</li>

</ul>

<h1>Zend Framework Extensions</h1>
<h2>Form</h2>
<h2>Mvc\Controller</h2>
<p>An extensible AbstractActionController that provides additional controller helpers and integrations:
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
<h2>Navigation</h2>
<p>On composer install/update the autoloader config distribution file will be copied to config/autoload/navigation.global.php.dist. Rename this to navigation.global.php and modify as needed.</p>
<p>This extensions allows for dynamically generated navigation menus using Doctrine Entities. The additional options have been added to the navigation options:
<ul>
    <li><b>entity</b> - The doctrine entity to use</li>
    <li><b>entity_route</b> - The ZF2 route to assembly links built from entities. This does not have to be the same as the normal route.</li>
    <li><b>depth</b> - How deep recursion should go when building out this menu item.</li>
    <li><b>col</b> - If using mega menus (yamm) this is how many columns will be output.  </li>
</ul>
</p>
<h2>View</h2>
<p>As with any developer's library, there are an array of custom view helpers that have been added.</p>

</p>
