<?php

namespace DelamatreZend\View\Helper;

class AdobeTypeKit extends AbstractHelper
{

    public function __invoke($typeKitId=null)
    {

        //if the typekitid isn't passed to the helper manually
        if(is_null($typeKitId)){

            //get it from configuration

            $config = $this->getServiceLocator()->getServiceLocator()->get('Config');

            if(empty($config['typekit']['id'])){
                throw new \Exception("Configuration doesn't define typekitid. please define ['typekit']['id'] to configuration file or manually pass typekitid to the helper.");
            }

            $typeKitId = $config['typekit']['id'];
        }

        //this is the advanced embed script from Adobe
        $render = <<<EOT
<script type="text/javascript">
(function(d) {
    var config = {
            kitId: '$typeKitId',
            scriptTimeout: 3000,
            async: true
        },
        h=d.documentElement,t=setTimeout(function(){h.className=h.className.replace(/\bwf-loading\b/g,"")+" wf-inactive";},config.scriptTimeout),tk=d.createElement("script"),f=false,s=d.getElementsByTagName("script")[0],a;h.className+=" wf-loading";tk.src='https://use.typekit.net/'+config.kitId+'.js';tk.async=true;tk.onload=tk.onreadystatechange=function(){a=this.readyState;if(f||a&&a!="complete"&&a!="loaded")return;f=true;clearTimeout(t);try{Typekit.load(config)}catch(e){}};s.parentNode.insertBefore(tk,s)
    })(document);
</script>\n
EOT;

        return $render;
    }

}