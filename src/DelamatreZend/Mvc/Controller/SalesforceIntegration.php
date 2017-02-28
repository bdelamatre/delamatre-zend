<?php

namespace DelamatreZend\Mvc\Controller;

use GeoIp2\WebService\Client;
use GeoIp2\Database\Reader;

trait SalesforceIntegration{

    /**
     * @return \SforceEnterpriseClient
     * @throws \Exception
     */
    public function getSalesForceEnterpriseClient(){

        if($this->getConfig()['salesforce']['enabled']==SALESFORCE_DISABLED){
            return null;
        }else{

            try{

                if(empty($this->getConfig()['salesforce']['api']['wsdl'])){
                    throw new \Exception('Salesforce API WSDL file not specified');
                }

                if(!file_exists($this->getConfig()['salesforce']['api']['wsdl'])){
                    throw new \Exception('Salesforce API WSDL file `'.$this->getConfig()['salesforce']['api']['wsdl'].'` not specified');
                }

                if(empty($this->getConfig()['salesforce']['api']['username'])){
                    throw new \Exception('Salesforce API Username not specified');
                }

                if(empty($this->getConfig()['salesforce']['api']['password'])){
                    throw new \Exception('Salesforce API Password not specified');
                }

                if(empty($this->getConfig()['salesforce']['api']['token'])){
                    throw new \Exception('Salesforce Token not specified');
                }

                $client = new \SforceEnterpriseClient();

                $connection = $client->createConnection($this->getConfig()['salesforce']['api']['wsdl']);
                $login = $client->login($this->getConfig()['salesforce']['api']['username'], $this->getConfig()['salesforce']['api']['password'] . $this->getConfig()['salesforce']['api']['token']);

                return $client;

            }catch(\Exception $e){
                throw $e;
            }

        }

    }


}
