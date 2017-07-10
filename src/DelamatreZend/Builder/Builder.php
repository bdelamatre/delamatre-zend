<?php

namespace DelamatreZend\Builder;

define('PATH_ROOT',getcwd());
define('PATH_CONFIG',PATH_ROOT.'/config');
define('PATH_CONFIG_AUTOLOAD',PATH_CONFIG.'/autoload');
define('PATH_CONFIG_AUTOLOAD_DIST',PATH_CONFIG_AUTOLOAD.'/dist');
define('PATH_DATA',PATH_ROOT.'/data');
define('PATH_DATA_CACHE',PATH_DATA.'/cache');
define('PATH_DATA_LOG',PATH_DATA.'/log');
define('PATH_DATA_SCREENSHOTS',PATH_DATA.'/screenshots');
define('PATH_PUBLIC',PATH_ROOT.'/public');
define('PATH_PUBLIC_ASSETS',PATH_PUBLIC.'/assets');

class Builder{

    public static function recurse_copy($src,$dst) {
        $dir = opendir($src);
        @mkdir($dst);
        while(false !== ( $file = readdir($dir)) ) {
            if (( $file != '.' ) && ( $file != '..' )) {
                if ( is_dir($src . '/' . $file) ) {
                    self::recurse_copy($src . '/' . $file,$dst . '/' . $file);
                }
                else {
                    copy($src . '/' . $file,$dst . '/' . $file);
                }
            }
        }
        closedir($dir);
    }

    public static function postInstall(){

        self::_buildDirectories();
        self::_syncConfigDistributionFiles();
        self::_setupConfigLocalFiles();
        self::_setupPublicAssetFiles();
        self::_syncPublicAssetFiles();

    }

    public static function postUpdate(){

        self::_buildDirectories();
        self::_syncConfigDistributionFiles();
        self::_setupConfigLocalFiles();
        self::_setupPublicAssetFiles();
        self::_syncPublicAssetFiles();

    }

    public static function _setupPublicAssetFiles(){

        $modulePath = dirname(__DIR__).'/../..';

        //create config autoload directory
        if(!file_exists(PATH_PUBLIC_ASSETS.'/application')){
            mkdir(PATH_PUBLIC_ASSETS.'/application');
            self::recurse_copy($modulePath.PATH_PUBLIC_ASSETS.'/application',PATH_PUBLIC_ASSETS.'/application');
        }

    }

    public static function _setupConfigLocalFiles(){

        //assetic
        if(!file_exists(PATH_CONFIG_AUTOLOAD.'/assetic.local.php')){
            copy(PATH_CONFIG_AUTOLOAD_DIST.'/assetic.local.php.dist',PATH_CONFIG_AUTOLOAD.'/assetic.local.php');
        }

        //database
        if(!file_exists(PATH_CONFIG_AUTOLOAD.'/doctrine.local.php')){
            copy(PATH_CONFIG_AUTOLOAD_DIST.'/doctrine.local.php.dist',PATH_CONFIG_AUTOLOAD.'/doctrine.local.php');
        }

        //myapp
        /*if(!file_exists(PATH_CONFIG_AUTOLOAD.'/myapp.local.php')){
            copy(PATH_CONFIG_AUTOLOAD_DIST.'/myapp.local.php.dist',PATH_CONFIG_AUTOLOAD.'/myapp.local.php');
        }*/


    }

    public static function _syncPublicAssetFiles(){

        echo "synchronize public asset files from bower";

        $modulePath = dirname(__DIR__).'/../..';

        $files = glob($modulePath.'/bower_components'.'/*');
        foreach($files as $file){ // iterate files
            self::recurse_copy($file,PATH_PUBLIC_ASSETS.'/'.basename($file));
        }
    }

    public static function _syncConfigDistributionFiles(){

        echo 'synchronizing distribution files in'.PATH_ROOT."\n";

        //remove existing .dist
        $files = glob(PATH_CONFIG_AUTOLOAD_DIST.'/{,*.php.dist}',GLOB_BRACE);
        foreach($files as $file){ // iterate files
            if(is_file($file)) {
                echo 'unlink ' . $file . "\n";
                unlink($file); // delete file
            }
        }

        $modulePath = dirname(__DIR__).'/../..';

        $files = glob($modulePath.'/config/autoload/dist'.'/{,*.php.dist}',GLOB_BRACE);
        foreach($files as $file){ // iterate files
            if(is_file($file)){
                echo 'copy '.$file.' to '.PATH_CONFIG_AUTOLOAD_DIST.'/'.basename($file)."\n";
                copy($file,PATH_CONFIG_AUTOLOAD_DIST.'/'.basename($file));
            }
        }
    }

    public static function _buildDirectories(){

        echo "verifying project directory structure in ".PATH_ROOT."\n";

        //create config directory
        if(!file_exists(PATH_CONFIG)){
            echo "creating ".PATH_CONFIG."\n";
            mkdir(PATH_CONFIG);
        }

        //create config autoload directory
        if(!file_exists(PATH_CONFIG_AUTOLOAD)){
            echo "creating ".PATH_CONFIG_AUTOLOAD."\n";
            mkdir(PATH_CONFIG_AUTOLOAD);
        }

        //create config autoload distribution directory
        if(!file_exists(PATH_CONFIG_AUTOLOAD_DIST)){
            echo "creating ".PATH_CONFIG_AUTOLOAD_DIST."\n";
            mkdir(PATH_CONFIG_AUTOLOAD_DIST);
        }

        //make sure that it is writable
        echo "Setting permissions for ".PATH_CONFIG_AUTOLOAD_DIST." to 0777";
        chmod(PATH_CONFIG_AUTOLOAD_DIST,0777);

        //create config data directory
        if(!file_exists(PATH_DATA)){
            echo "creating ".PATH_DATA."\n";
            mkdir(PATH_DATA);
        }

        //create config data cache directory
        if(!file_exists(PATH_DATA_CACHE)){
            echo "creating ".PATH_CONFIG."\n";
            mkdir(PATH_DATA_CACHE);
        }

        //make sure that it is writable
        chmod(PATH_DATA_CACHE,0777);


        //create config data cache directory
        if(!file_exists(PATH_DATA_LOG)){
            echo "creating ".PATH_DATA_LOG."\n";
            mkdir(PATH_DATA_LOG);
        }

        //make sure that it is writable
        chmod(PATH_DATA_LOG,0777);


        //create config data cache directory
        if(!file_exists(PATH_DATA_SCREENSHOTS)){
            echo "creating ".PATH_CONFIG."\n";
            mkdir(PATH_DATA_SCREENSHOTS);
        }

        //make sure that it is writable
        chmod(PATH_DATA_SCREENSHOTS,0777);

        //create config data cache directory
        if(!file_exists(PATH_PUBLIC)){
            echo "creating ".PATH_PUBLIC."\n";
            mkdir(PATH_PUBLIC);
        }

        //make sure that it is writable
        chmod(PATH_PUBLIC,0777);

        //create config data cache directory
        if(!file_exists(PATH_PUBLIC_ASSETS)){
            echo "creating ".PATH_CONFIG."\n";
            mkdir(PATH_PUBLIC_ASSETS);
        }

        //make sure that it is writable
        chmod(PATH_PUBLIC_ASSETS,0777);

    }

}