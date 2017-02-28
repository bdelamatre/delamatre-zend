<?php

namespace DelamatreZend\Form\Element;

use Zend\Form\Element\Select;

class Active extends Select{

    const STATUS_ACTIVE     = 1;
    const STATUS_INACTIVE   = 0;

    public $valueOptions = array(
        self::STATUS_ACTIVE => 'Active',
        self::STATUS_INACTIVE => 'Inactive',
    );

    public function valueOptions(){
        return $this->valueOptions;
    }

    public function __construct($name=null,$options=array()){

        parent::__construct($name,$options);

        $this->setValueOptions($this->valueOptions());
        $this->setLabel('Status');

    }

}