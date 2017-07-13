<?php

namespace DelamatreZend\Mvc\Controller;

use Application\Entity\Organization;
use Zend\Crypt\Password\Bcrypt;

trait User{

    public function getUserClass(){
        return $this->getConfig()['zfcuser']['user_entity_class'];
    }

    /*public function getZfcUserClass(){
        return $this->getConfig()['zfcuser']['user_entity_class'];
    }*/

    public function getOrganizationClass(){
        return $this->getConfig()['zfcuser']['organization_entity_class'];
    }

    /**
     * @return \Zfcuser\Controller\Plugin\ZfcUserAuthentication
     */
    public function getZfcUserAuthentication(){

        $plugin = $this->getPluginManager()->get('zfcUserAuthentication');

        return $plugin;
    }

    public function getUserCount(){

        $qb = $this->createQueryBuilder();
        $qb->select($qb->expr()->count('u.id'))->from($this->getUserClass(),'u')->setMaxResults(1);
        $count = $qb->getQuery()->getSingleResult();

        return $count[1];
    }

    /**
     * @return \ZfcUser\Service\User
     */

    public function getUserService()
    {
        if (!$this->userService) {
            $this->userService = $this->getServiceLocator()->get('zfcuser_user_service');
        }
        return $this->userService;
    }

    public function createDefaultUser($useConfig=false){

        $config = $this->getConfig();

        if($useConfig==false || $config['user']['default_user']['createIfDbEmpty']==true){

            $organization = new \DelamatreZend\Entity\Organization();
            $organization->name = 'default';
            $this->getEntityManager()->persist($organization);

            $class = $this->getUserClass();

            $user = new $class();
            $user->setUsername($config['user']['default_user']['username']);
            $user->setDisplayName($config['user']['default_user']['username']);
            $user->setPassword($config['user']['default_user']['password']);
            $user->setEmail($config['user']['default_user']['email']);
            $user->organization = $organization;

            $bcrypt = new Bcrypt();
            $bcrypt->setCost($config['zfcuser']['password_cost']);
            $user->setPassword($bcrypt->create($user->getPassword()));

            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();

        }

    }

    public function requireAuthentication($allowedGroups=null){

        $userCount = $this->getUserCount();

        if($userCount<1){

            $this->createDefaultUser(true);
        }

        $plugin = $this->getZfcUserAuthentication();

        //if not authenticated
        if(!$plugin->hasIdentity()){

            //$this->redirect()->toRoute('zfcuser-login');
            $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
            $url = '/user/login?redirect='.urlencode($_SERVER['REQUEST_URI']);
            //$this->redirect()->toUrl('/user/login?redirect='.urlencode($_SERVER['REQUEST_URI']));
            header( "Location: $url" ) ;
            exit();

            //if authenticated user doesn't have the required group
        }elseif(!is_null($allowedGroups)
            && !in_array($plugin->getIdentity()->getType(),$allowedGroups)){

            throw new \Exception('You are not authorized to view this page');

        //user is okay
        }else{
        }

    }

}