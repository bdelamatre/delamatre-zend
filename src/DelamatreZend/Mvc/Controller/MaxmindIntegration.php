<?php

namespace DelamatreZend\Mvc\Controller;

use GeoIp2\WebService\Client;
use GeoIp2\Database\Reader;

trait MaxmindIntegration{

    /**
     * @var Client
     */
    protected $maxmind_client;

    /**
     * @return Client
     * @throws \Exception
     */
    public function getGeoIP2Client(){

        if($this->getConfig()['maxmind']['enabled']==MAXMIND_DISABLED){
            return null;
        }else{

            if(empty($this->getConfig()['maxmind']['service_id'])){
                throw new \Exception('No Service ID specified for Maxmind service');
            }

            if(empty($this->getConfig()['maxmind']['service_key'])){
                throw new \Exception('No Service Key specified for Maxmind service');
            }

            if(!isset($this->maxmind_client)){
                $this->maxmind_client = new Client($this->getConfig()['maxmind']['service_id'],$this->getConfig()['maxmind']['service_key']);
            }

            return $this->maxmind_client;
        }

    }

}