<?php

namespace DelamatreZend\Mvc\Controller;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;

class AbstractActionController extends \Zend\Mvc\Controller\AbstractActionController{

    use MaxmindIntegration;
    use SalesforceIntegration;
    use GoogleAnalyticsIntegration;
    use GetreponseIntegration;
    use LavachartsIntegration;
    use User;

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $em;

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager()
    {
        if (null === $this->em) {
            $this->em = $this->getServiceLocator()->get('doctrine.entitymanager.orm_default');
        }
        return $this->em;
    }

    /**
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function createQueryBuilder(){
        return $this->getEntityManager()->createQueryBuilder();
    }

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
        return $this->getEvent()->getApplication()->getServiceManager()->get('Zend\Session\SessionManager');
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
     * @param $sql
     * @return string
     */
    public function quoteSQL($sql){
        return $this->getEntityManager()->getConnection()->quote($sql);
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