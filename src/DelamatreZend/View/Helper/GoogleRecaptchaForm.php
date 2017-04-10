<?php

namespace DelamatreZend\View\Helper;

class GoogleRecaptchaForm extends AbstractHelper
{

    //fix-me: need to add additional support of tracker options
    public function __invoke($siteKey=null)
    {

        //fix-me: add secret key support

        //if the typekitid isn't passed to the helper manually
        if(is_null($siteKey)){

            //get it from configuration
            $config = $this->getServiceLocator()->getServiceLocator()->get('Config');

            if(empty($config['google']['recaptcha']['site_key'])){
                throw new \Exception("Configuration doesn't define google recaptcha. please define ['google']['recaptcha']['site_key'] in configuration file or manually pass the site key to the helper.");
            }

            $siteKey = $config['google']['recaptcha']['site_key'];
        }

        //this is the advanced embed script from Adobe
        $render ='<div class="g-recaptcha" data-sitekey="'.$siteKey.'"></div>';

        return $render;
    }

}