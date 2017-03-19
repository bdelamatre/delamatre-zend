<?php

namespace DelamatreZend\View\Helper;

use Application\Form\Element\ProductDiscountType;

class ProductDiscount extends AbstractHelper
{

    public function __invoke($value=0,$discountType=ProductDiscountType::OPTION_PERCENT,$cssClass='discount')
    {

        if($value==0){
            $text = '';
        }else{
            $text = abs($value)*-1;
            if($discountType==ProductDiscountType::OPTION_PERCENT){
                $text .= '%';
            }elseif($discountType==ProductDiscountType::OPTION_FLAT){
                //fix-me: we should make this international
                $text .= '$';
            }
        }

        if($cssClass){
            $text = "<span class=\"$cssClass\">$text</a>";
        }

        return $text;
    }

}