<?php

namespace App;
use App\Entity\Deal, App\Entity\Person;

class Pipedrive{


    function __construct($key){

        $this->api = new Api($key);
        $this->deal = new Deal($this->api);
        $this->person = new Person($this->api);

    }

    public function api(){

        return $this->api;

    }

    public function deal(){

        return $this->deal;
    }


}
