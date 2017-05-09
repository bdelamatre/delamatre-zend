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

<h1>Project Purpose</h1>
<p>A set of pre-configured libraries, modules, resource view helpers, etc. that can be used to more quickly and bootstrap and Zend Framework 2 project.</p>

<h1>Project Structure</h1>
<p>The following project structure is assumed for your Zend Framework 2 project. You can modify this as needed.</p>
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

<h1>Authentication</h1>
<h2>ZfcUser (ZfcUserDoctrineOrm)</h2>
<p>Integration using zf-commons/zfc-user and zf-commons/zfc-user-doctrine-orm. On composer install/update the autoloader config distribution file will be copied to config/autoload/user.local.php.dist. Rename this to user.local.php and modify as needed.</p>
<p>A default user entity (\DelamatreZend\Entity\User) and organization entity (\Delamatre\Entity\Organization) have been created and associated as the default entities in the user config. Additional configurations include the creation of a default user if no users exist in the database. Default username/password is root/root1234.</p>
<p>To override the default user/organization entites just extend the existing entities and update the user_entity_class and organization_entity_class user config options.</p>

<h1>Builder</h1>
<p>A simple PHP class that contains static functions for use as composer hooks.</p>

<h1>Database</h1>
<h2>Doctrine ORM</h2>
<p>Integration using doctrine/doctrine-module and doctrine/doctrine-orm-module. On composer install/update the autoloader config distribution file will be copied to config/autoload/database.local.php.dist. Rename this to database.local.php and insert your database connection information.</p>
<p>The trait DelamatreZend\Mvc\Controller\DoctrineIntegration is applied to DelamatreZend\Mvc\Controller\AbstractActionController. This trait allows for the following functions to be easily called within your controllers: getEntityManager(), createQueryBuilder() and quoteSQL().</p>
<p>A default AbstractEntity provides additional functionality to any entity that inherits it. These include: magic setters/getters, entity to array and array to entity functions, etc.</p>

<h1>Front-end</h1>
<h2>Bower Compilation</h2>
<p>bower.json defines the needed libraries for a jquery/bootstrap/font awesome project. These assets are already included under src/bower_components but you can run bower and refetch if needed.</p>
<h2>Assetic</h2>
<p>Integration using widmogrod/zf2-assetic-module. On composer install/update the autoloader config distribution file will be copied to config/autoload/assetic.local.php.dist. Rename this to assetic.local.php and modify as needed.</p>
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
