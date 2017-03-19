<?php

namespace DelamatreZend\Form\Element;

class DisplayOnWeb extends YesNo{

    public function __construct($name=null,$options=array()){

        parent::__construct($name,$options);

        $this->setLabel('Display On Website');

    }

}