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

        try{

            $client = new \SforceEnterpriseClient();		
	

$connection = $client->createConnection($this->getConfig()['salesforce']['api']['wsdl']);
	$login = $client->login($this->getConfig()['salesforce']['api']['username'], $this->getConfig()['salesforce']['api']['password'] . $this->getConfig()['salesforce']['api']['token']);

            return $client;

        }catch(\Exception $e){
            throw $e;
        }

    }


}
