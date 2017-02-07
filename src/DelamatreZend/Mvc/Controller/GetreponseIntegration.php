<?php

namespace DelamatreZend\Mvc\Controller;


trait GetreponseIntegration{

    protected $getresponse_clients;

    public function getGetresponseAccounts(){
        $accounts = array_keys($this->getConfig()['getresponse']['accounts']);
        return $accounts;
    }

    /**
     * @return \GetResponse
     * @throws \Exception
     */
    public function getGetresponseClient($account=null){

        if($this->getConfig()['getresponse']['enabled']==GETRESPONSE_DISABLED){
            return null;
        }else{

            if(empty($account)){
                $account = $this->getConfig()['getresponse']['default_account'];
            }

            if(!isset($this->getConfig()['getresponse']['accounts'][$account])){
                throw new \Exception("Getresponse account $account not configured");
            }

            if(!isset($this->getresponse_clients[$account])){

                try{

                    if(empty($this->getConfig()['getresponse']['accounts'][$account]['api_key'])){
                        throw new \Exception("Getresponse account `$account` doesn't have an API Key specified");
                    }

                    if(empty($this->getConfig()['getresponse']['accounts'][$account]['api_url'])){
                        throw new \Exception("Getresponse account `$account` doesn't have an API URL specified");
                    }

                    $this->getresponse_clients[$account] = new \GetResponse($this->getConfig()['getresponse']['accounts'][$account]['api_key'],
                                                                            $this->getConfig()['getresponse']['accounts'][$account]['api_url']);

                    if($this->getConfig()['getresponse']['accounts'][$account]['enterprise_domain']){
                        $this->getresponse_clients[$account]->enterprise_domain = $this->getConfig()['getresponse']['accounts'][$account]['enterprise_domain'];
                    }

                }catch(\Exception $e){
                    throw $e;
                }

            }

            return $this->getresponse_clients[$account];

        }

    }

    public function getGetresponseClients(){
        $accounts = $this->getGetresponseAccounts();
        foreach($accounts as $account){
            $this->getGetresponseClient($account);
        }
        return $this->getresponse_clients;
    }

}