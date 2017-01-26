<?php

namespace DelamatreZend\Mvc\Controller;


trait GetreponseIntegration{

    public function getGetresponseAccounts(){
        $accounts = array_keys($this->getConfig()['getresponse']['accounts']);
        return $accounts;
    }

    /**
     * @return \GetResponse
     * @throws \Exception
     */
    public function getGetresponseClient($account=null){

        if(empty($account)){
            $account = $this->getConfig()['getresponse']['default_account'];
        }

        if(!isset($this->getConfig()['getresponse']['accounts'][$account])){
            throw new \Exception("Account $account not configured for Getresponse integration");
        }

        try{

            $client = new \GetResponse($this->getConfig()['getresponse']['accounts'][$account]['api_key'],$this->getConfig()['getresponse']['accounts'][$account]['api_url']);

            if($this->getConfig()['getresponse']['accounts'][$account]['enterprise_domain']){
                $client->enterprise_domain = $this->getConfig()['getresponse']['accounts'][$account]['enterprise_domain'];
            }

            return $client;

        }catch(\Exception $e){
            throw $e;
        }

    }

    public function getGetresponseClients(){

        $accounts = $this->getGetresponseAccounts();
        $clients = array();
        foreach($accounts as $account){
            $clients[$account] = $this->getGetresponseClient($account);
        }
        return $clients;

    }


}