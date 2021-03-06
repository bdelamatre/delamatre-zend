<?php

namespace DelamatreZend\Entity;

use Doctrine\ORM\Mapping as ORM;
use Zend\InputFilter\InputFilterAwareInterface;
use Zend\InputFilter\InputFilterInterface;

abstract class AbstractEntity implements InputFilterAwareInterface{

    protected $inputFilter;

    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property){
        /*if(method_exists($this,'get'.ucfirst($property))){

        }*/
        return $this->$property;
    }

    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value){
        $this->$property = $value;
    }

    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function getArrayCopy(){
        return get_object_vars($this);
    }

    /**
     * Convert an array to property objects
     *
     * @param array $data
     */
    public function exchangeArray(array $data)
    {
        foreach ($data as $name => $value) {
            if(property_exists($this, $name)) {
                if(strstr($name,'_id')
                    && empty($value)){
                    $this->$name = null;
                }else{
                    $this->$name = $value;
                }
            }
        }
    }

    function getInputFilter(){

    }

    public function setInputFilter(InputFilterInterface $inputFilter){
        throw new \Exception("Not used");
    }

    public function getRecordType(){

        $className =  str_replace('\\', '/',get_class($this));
        $name = basename($className);
        return $name;
    }

}