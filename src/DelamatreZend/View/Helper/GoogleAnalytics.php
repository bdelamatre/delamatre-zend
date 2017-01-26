<?php

namespace DelamatreZend\View\Helper;

class GoogleAnalytics extends AbstractHelper
{

    //fix-me: need to add additional support of tracker options
    public function __invoke($googleAnalyticsCode=null,$userId=null,$dimensions=array())
    {

        //if the typekitid isn't passed to the helper manually
        if(is_null($googleAnalyticsCode)){

            //get it from configuration
            $config = $this->getServiceLocator()->getServiceLocator()->get('Config');

            if(empty($config['google']['analytics']['code'])){
                throw new \Exception("Configuration doesn't define googleanalyticscode. please define ['google']['analytics']['code'] to configuration file or manually pass googleanalyticscode to the helper.");
            }

            $googleAnalyticsCode = $config['google']['analytics']['code'];
        }

        //this is the advanced embed script from Adobe
        $render = <<<EOT
<script type="text/javascript">
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','https://www.google-analytics.com/analytics.js','ga');\n
EOT;
        $render .= "ga('create', '$googleAnalyticsCode', 'auto');\n";
        if(!empty($dimensions)){
            foreach($dimensions as $dimensionKey=>$dimensionValue){
                $render .= "ga('set', 'dimension$dimensionKey', '$dimensionValue');\n";
            }
        }
        $render .= "ga('send', 'pageview');\n";
        $render .= "</script>\n";

        return $render;
    }

}