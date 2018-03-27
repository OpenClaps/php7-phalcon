<?php

namespace Store\Toys;

use Phalcon\Mvc\Model;

class Robots extends Model
{

    public function getAll(){
        return array(
            array(
                "id" => 1,
                "name" => "Robo1"
            ),
            array(
                "id" => 2,
                "name" => "Robo2"
            ),
            
        );
    }
    
}