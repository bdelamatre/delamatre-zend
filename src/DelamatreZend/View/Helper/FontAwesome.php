<?php

namespace DelamatreZend\View\Helper;

class FontAwesome extends AbstractHelper
{

    public function __invoke($icon=null,$size='',$additionalClasses='')
    {
        return "<i class=\"fa $icon $size $additionalClasses\" aria-hidden=\"true\"></i>";
    }

}