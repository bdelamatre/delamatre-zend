<?php

namespace DelamatreZend\View\Helper;

class FormatKpiPercent extends AbstractHelper
{

    public function __invoke($perecent,$target=null,$warningThreshold=.1,$criticalThresholdMax=.25)
    {

        if(is_null($target)){
            $target = $perecent;
        }

        $additionalClasses = '';

        if($perecent>0){
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