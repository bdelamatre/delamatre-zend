<?php

namespace DelamatreZend\Builder;

define('PATH_ROOT','');
define('PATH_CONFIG',PATH_ROOT.'/config');
define('PATH_CONFIG_AUTOLOAD',PATH_CONFIG.'/autoload');
define('PATH_DATA',PATH_ROOT.'/data');
define('PATH_DATA_CACHE',PATH_DATA.'/cache');
define('PATH_DATA_LOG',PATH_DATA.'/log');
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
        if(!file_exists(getcwd().PATH_PUBLIC_ASSETS.'/application')){
            //mkdir(getcwd().PATH_PUBLIC_ASSETS.'/application');
            self::recurse_copy($modulePath.PATH_PUBLIC_ASSETS.'/application',getcwd().PATH_PUBLIC_ASSETS.'/application');
        }

    }

    public static function _setupConfigLocalFiles(){

        if(!file_exists(PATH_CONFIG_AUTOLOAD.'/assetic.local.php')){
            copy(PATH_CONFIG_AUTOLOAD.'/assetic.local.php.dist',PATH_CONFIG_AUTOLOAD.'/assetic.local.php');
        }

    }

    public static function _syncPublicAssetFiles(){

        echo 'cwd: '.getcwd()."\n";

        $modulePath = dirname(__DIR__).'/../..';

        $files = glob($modulePath.'/bower_components'.'/*');
        foreach($files as $file){ // iterate files
            if(file_exists(getcwd().PATH_PUBLIC_ASSETS.'/'.basename($file))){
                unlink(getcwd().PATH_PUBLIC_ASSETS.'/'.basename($file));
            }
            echo 'copy '.$file.' to '.getcwd().PATH_CONFIG_AUTOLOAD.'/'.basename($file)."\n";
            self::recurse_copy($file,getcwd().PATH_PUBLIC_ASSETS.'/'.basename($file));
        }
    }

    public static function _syncConfigDistributionFiles(){

        echo 'cwd: '.getcwd()."\n";

        //remove existing .dist
        $files = glob(getcwd().PATH_CONFIG_AUTOLOAD.'/{,*.php.dist}',GLOB_BRACE);
        foreach($files as $file){ // iterate files
            if(is_file($file)) {
                echo 'unlink ' . $file . "\n";
                unlink($file); // delete file
            }
        }

        $modulePath = dirname(__DIR__).'/../..';

        $files = glob($modulePath.PATH_CONFIG_AUTOLOAD.'/{,*.php.dist}',GLOB_BRACE);
        foreach($files as $file){ // iterate files
            if(is_file($file)){
                echo 'copy '.$file.' to '.getcwd().PATH_CONFIG_AUTOLOAD.'/'.basename($file)."\n";
                copy($file,getcwd().PATH_CONFIG_AUTOLOAD.'/'.basename($file));
            }
        }
    }

    public static function _buildDirectories(){

        //create config directory
        if(!file_exists(PATH_CONFIG)){
            mkdir(PATH_CONFIG);
        }

        //create config autoload directory
        if(!file_exists(PATH_CONFIG_AUTOLOAD)){
            mkdir(PATH_CONFIG_AUTOLOAD);
        }

        //make sure that it is writable
        chmod(PATH_CONFIG_AUTOLOAD,0777);

        //create config data directory
        if(!file_exists(PATH_DATA)){
            mkdir(PATH_DATA);
        }

        //create config data cache directory
        if(!file_exists(PATH_DATA_CACHE)){
            mkdir(PATH_DATA_CACHE);
        }

        //make sure that it is writable
        chmod(PATH_DATA_CACHE,0777);


        //create config data cache directory
        if(!file_exists(PATH_DATA_LOG)){
            mkdir(PATH_DATA_LOG);
        }

        //make sure that it is writable
        chmod(PATH_DATA_LOG,0777);

        //create config data cache directory
        if(!file_exists(PATH_PUBLIC)){
            mkdir(PATH_PUBLIC);
        }

        //make sure that it is writable
        chmod(PATH_PUBLIC,0777);

        //create config data cache directory
        if(!file_exists(PATH_PUBLIC_ASSETS)){
            mkdir(PATH_PUBLIC_ASSETS);
        }

        //make sure that it is writable
        chmod(PATH_PUBLIC_ASSETS,0777);

    }

}