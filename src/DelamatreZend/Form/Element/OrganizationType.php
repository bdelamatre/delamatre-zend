<?php

namespace DelamatreZend\Form\Element;

use Zend\Form\Element\Select;

class OrganizationType extends Select{

    const TYPE_CLIENT   = 'user';
    const TYPE_ADMIN    = 'admin';

    public $valueOptions = array(
        self::TYPE_CLIENT => 'User',
        self::TYPE_ADMIN => 'Admin',
    );

    public function valueOptions(){
        return $this->valueOptions;
    }

    public function __construct($name=null,$options=array()){

        parent::__construct($name,$options);

        $this->setValueOptions($this->valueOptions());
        $this->setLabel('Organization Type');

    }

}