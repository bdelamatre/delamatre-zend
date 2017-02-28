<?php

namespace DelamatreZend\Mvc\Controller;


trait DoctrineIntegration{

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
     * @param $sql
     * @return string
     */
    public function quoteSQL($sql){
        return $this->getEntityManager()->getConnection()->quote($sql);
    }


}