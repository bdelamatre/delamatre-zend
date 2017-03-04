<?php

namespace DelamatreZend\View\Helper;

use Zend\Form\Element\Text;

class FormElfinder extends AbstractHelper
{

    public function __invoke(Text $element)
    {
        //if no
        if(!$element->getAttribute('id')){
            $element->setAttribute('id',$element->getName());
        }

        $html = "<div class=\"form-group\">
            <label>{$element->getLabel()}</label>
            <div class=\"input-group\">
                <input type=\"text\" name=\"{$element->getName()}\" id=\"{$element->getAttribute('id')}\" class=\"form-control\" placeholder=\"Browse files...\" value=\"{$element->getValue()}\" >
                <span class=\"input-group-btn\">
                    <button class=\"btn btn-default find-file\" data-for=\"#{$element->getAttribute('id')}\" type=\"button\">Browse Files</button>
                </span>
            </div>
        </div>";

        return $html;
    }

}