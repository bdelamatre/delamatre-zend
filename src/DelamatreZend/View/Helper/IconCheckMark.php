<?php

namespace DelamatreZend\View\Helper;

class IconCheckMark extends AbstractHelper
{

    public function __invoke($value=0,$size='',$additionalClasses='')
    {

        if($value==true){
            $iconClass = 'fa-check-circle';
            $additionalClasses .=' text-success';
        }else{
            $iconClass = 'fa-times-circle';
            $additionalClasses .= '';
        }

        $helper = new FontAwesome;
        $icon = $helper($iconClass,$size,$additionalClasses);

        return $icon;
    }

}