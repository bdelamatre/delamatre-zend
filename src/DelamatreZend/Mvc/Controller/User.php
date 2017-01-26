<?php

namespace DelamatreZend\Mvc\Controller;

use GeoIp2\WebService\Client;
use GeoIp2\Database\Reader;

trait User{

    /**
     * @return \Zfcuser\Controller\Plugin\ZfcUserAuthentication
     */
    public function getZfcUserAuthentication(){

        $plugin = $this->getPluginManager()->get('zfcUserAuthentication');

        return $plugin;
    }

    public function getUserCount(){

        $qb = $this->createQueryBuilder();
        $qb->select($qb->expr()->count('u.id'))->from('DelamatreZend\Entity\User','u')->setMaxResults(1);
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

            $user = new \DelamatreZend\Entity\User();
            $user->setDisplayName($config['user']['default_user']['displayName']);
            $user->setUsername($config['user']['default_user']['username']);
            $user->setPassword($config['user']['default_user']['password']);
            $user->setEmail($config['user']['default_user']['email']);

            $bcrypt = new Bcrypt();
            $bcrypt->setCost($config['zfcuser']['password_cost']);
            $user->setPassword($bcrypt->create($user->getPassword()));

            $this->getEntityManager()->persist($user);
            $this->getEntityManager()->flush();

        }

    }

    public function requireAuthentication(){


        $userCount = $this->getUserCount();

        if($userCount<1){

            $this->createDefaultUser(true);
        }

        $plugin = $this->getZfcUserAuthentication();

        if(!$plugin->hasIdentity()){

            //$this->redirect()->toRoute('zfcuser-login');
            $_SESSION['redirect'] = $_SERVER['REQUEST_URI'];
            $this->redirect()->toUrl('/user/login?redirect='.urlencode($_SERVER['REQUEST_URI']));
        }

    }

}