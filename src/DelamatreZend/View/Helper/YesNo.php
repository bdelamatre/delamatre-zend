<?php

namespace DelamatreZend\View\Helper;

class YesNo extends AbstractHelper
{

    public function __invoke($value=0,$yesClass='',$noClass='')
    {

        $additionalClasses = '';

        if($value==1){
            $additionalClasses .= $yesClass;
            $text = 'Yes';
        }else{
            $additionalClasses .= $noClass;
            $text = 'No';
        }

        $return = '<span class="'.$additionalClasses.'">'.$text.'</span>';

        return $return;
    }

}