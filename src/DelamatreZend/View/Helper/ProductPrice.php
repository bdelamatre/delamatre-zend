<?php

namespace DelamatreZend\View\Helper;

class ProductPrice extends AbstractHelper
{

    public function __invoke($price=0,$link=null,$discount=0,$showFullPrice=true,$zeroText='Call For Pricing')
    {

        if($price==0){
            $text = $zeroText;
        }else{
            $text = $this->view->currencyFormat($price,'USD');
            if($discount){
                $priceWithDiscount = $price-$discount;
                if($showFullPrice==true){
                    $text = '<strike>'.$text.'</strike>';
                    $text .= ' '.$this->view->currencyFormat($priceWithDiscount,'USD');
                }else{
                    $text = $this->view->currencyFormat($priceWithDiscount,'USD');
                }
            }
        }

        if($link){
            $text = "< a href=\"$link\">$text</a>";
        }

        return $text;
    }

}