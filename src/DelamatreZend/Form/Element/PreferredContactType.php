<?php

namespace Application\Form\Element;

use Zend\Form\Element\Select;

class PreferredContactType extends Select{

    const PREFERRED_EMAIL   = 'EMAIL';
    const PREFERRED_PHONE   = 'PHONE';
    const PREFERRED_MOBILE  = 'MOBILE';
    const PREFERRED_FAX     = 'FAX';

    public $options = array(
        ''                      => '',
        self::PREFERRED_EMAIL   => 'E-Mail',
        self::PREFERRED_PHONE   => 'Phone',
        self::PREFERRED_MOBILE  => 'Mobile',
        self::PREFERRED_FAX     => 'Fax',
    );

    public function valueOptions(){
        $options = $this->options;
        return $options;
    }

    public function __construct($name=null,$options=array()){

        parent::__construct($name,$options);

        $this->setValueOptions($this->valueOptions());
        $this->setLabel('Preferred Contact');
    }

}