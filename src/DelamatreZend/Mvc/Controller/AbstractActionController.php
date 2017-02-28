<?php

namespace DelamatreZend\Mvc\Controller;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;

class AbstractActionController extends \Zend\Mvc\Controller\AbstractActionController{

    use DoctrineIntegration;
    use MaxmindIntegration;
    use SalesforceIntegration;
    use GoogleAnalyticsIntegration;
    use GetreponseIntegration;
    use LavachartsIntegration;
    use FilemanagerIntegration;
    use User;

    /**
     * @return array|object
     */
    public function getConfig(){
        return $this->getServiceLocator()->get('config');
    }

    /**
     * @return \Zend\Session\SessionManager
     */
    public function getSessionManager(){
        return $this->getEvent()->getApplication()->getServiceManager()->get('\Zend\Session\SessionManager');
    }


        /**
     * @return Smtp
     */
    public function getSmtp(){

        $transport = new Smtp();
        $options   = new SmtpOptions($this->getConfig()['myapp']['smtp']);
        $transport->setOptions($options);

        return $transport;

    }

    /**
     * @return Message
     */
    public function createMail(){

        $mail = new Message();
        $mail->setFrom($this->getConfig()['myapp']['smtp']['connection_config']['username']);
        return $mail;
    }

    /**
     * @return \Zend\View\Helper\HeadTitle
     */
    public function getHeadTitle(){
        return $this->getServiceLocator()->get('ViewHelperManager')->get('HeadTitle');
    }


    /**
     * @return \Zend\View\Helper\HeadMeta
     */
    public function getHeadMeta(){
        return $this->getServiceLocator()->get('ViewHelperManager')->get('HeadMeta');
    }

    /**
     * @param $keywords
     */
    public function setHeadMetaKeywords($keywords){
        $this->getHeadMeta()->setName('keywords',$keywords);
    }

    /**
     * @param $keywords
     */
    public function setHeadMetaDescription($description){
        $this->getHeadMeta()->setName('description',$description);
    }


}