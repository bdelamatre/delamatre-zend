<?php

namespace DelamatreZend\Mvc\Controller;

use GeoIp2\WebService\Client;
use GeoIp2\Database\Reader;

trait MaxmindIntegration{

    /**
     * @return Reader
     * @throws \Exception
     */
    public function getGeoIP2Reader(){

        //use the city database
        if($this->getConfig()['maxmind']['use_city']==true){

            //make sure that the city db file exists
            if(!file_exists($this->getConfig()['maxmind']['city_db_file'])){
                throw new \Exception('Maxmind City DB files `'.$this->getConfig()['maxmind']['city_db_file'].'` doesn\'t exist');
            }

            $reader = new Reader($this->getConfig()['maxmind']['city_db_file']);

            //else use the country database
        }else{

            //make sure that the country db file exists
            if(!file_exists($this->getConfig()['maxmind']['country_db_file'])){
                throw new \Exception('Maxmind Country DB files `'.$this->getConfig()['maxmind']['country_db_file'].'` doesn\'t exist');
            }

            $reader = new Reader($this->getConfig()['maxmind']['country_db_file']);

        }

        return $reader;

    }

    /**
     * @return Client
     * @throws \Exception
     */
    public function getGeoIP2Client(){

        $client = new Client($this->getConfig()['maxmind']['service_id'],$this->getConfig()['maxmind']['service_key']);

        return $client;
    }

}