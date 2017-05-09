<?php

namespace DelamatreZend\Navigation;

use DelamatreZendCms\Entity\Content;
use DelamatreZendCms\Navigation\DynamicNavigation;
use Doctrine\ORM\EntityManager;

class Navigation extends DynamicNavigation
{

    /**
     * @return string
     */
    protected function getName()
    {
        return 'menu';
    }

    /**
     * @param EntityManager $em
     * @param $configuration
     * @return mixed
     */
    public static function recursiveSearch(EntityManager $em,$configuration){

        //cycle through the navigation configuration and add the dynamic content
        foreach($configuration as $key=>$page){

            $route = false;
            $queryBuilder = $em->createQueryBuilder();
            $queryBuilder->select('e');

            //if an entity is specified, use that entity
            if(!empty($page['entity'])
                    && $page['entity']!=Content::class){
                $isCustomEntity=true;
                $queryBuilder->from($page['entity'],'e');
            //else use the default cms content entity
            }else{
                $isCustomEntity=false;
                $queryBuilder->from('DelamatreZendCms\Entity\Content','e');
            }

            if($isCustomEntity==true){

                //get active sorted content
                $queryBuilder->where('e.active=1');
                $queryBuilder->orderBy("e.sortOrder",'ASC');
                $queryBuilder->addOrderBy("e.title",'ASC');

                $results = $queryBuilder->getQuery()->getArrayResult();

                //if we are getting multiple levels, use a recursive search until the specified depth is reached
                if(isset($page['depth']) && $page['depth']>0){

                    self::recursiveAddPages($em,$configuration[$key]['pages'],$route,$results);

                //else, just add the current results
                }else{

                    foreach($results as $result){

                        $configuration[$key]['pages'][] = array(
                            'label'=> $result['title'],
                            'route'=>$route,
                            'params'=>array('key' => $result['key']),
                            'result'=>$result,
                        );

                    }

                }

            //else handle this item as general content
            //fix-me: I probably don't need to break this out
            }else{

                $queryBuilder->where('e.active=1');
                $queryBuilder->andWhere('e.key=:key');
                $queryBuilder->setParameter('key',$page['route']);
                $result = $queryBuilder->getQuery()->getArrayResult();
                if(!empty($result)){

                    $result = $result[0];

                    $configuration[$key]['result'] = $result;

                }

                if(!empty($page['pages'])){
                    $configuration[$key]['pages'] = self::recursiveSearch($em,$configuration[$key]['pages']);
                }

            }

        }

        return $configuration;

    }

}