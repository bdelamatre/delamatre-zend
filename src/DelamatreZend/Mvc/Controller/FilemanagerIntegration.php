<?php

namespace DelamatreZend\Mvc\Controller;


trait FilemanagerIntegration{

    /**
     * @var \Doctrine\ORM\EntityManager
     */
    protected $filemanager_connector;

    /**
     * @return \Doctrine\ORM\EntityManager
     */
    public function getFilemanager()
    {
        if (null === $this->filemanager_connector) {

            $config = $this->getFilemanagerConfig();

            $this->filemanager_connector = new \elFinderConnector(new \elFinder($config));

        }
        return $this->filemanager_connector;
    }

    public function getFilemanagerConfig(){

        $config = $this->getConfig()['filemanager'];

        foreach($config['roots'] as $key=>$root){
            $config['roots'][$key]['URL'] = $this->getConfig()['myapp']['baseurl'].$root['URL'];
        }

        return $config;
    }

}