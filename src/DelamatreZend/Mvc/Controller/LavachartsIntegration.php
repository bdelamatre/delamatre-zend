<?php

namespace DelamatreZend\Mvc\Controller;


use Khill\Lavacharts\Lavacharts;

trait LavachartsIntegration{

    protected $lavachart;

    /**
     * @return Lavacharts
     */
    public function getLavachart(){

        if(!isset($this->lavachart)){
            $this->lavachart = new Lavacharts();
        }

        return $this->lavachart;

    }


}