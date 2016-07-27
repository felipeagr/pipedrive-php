<?php
/**
 * Created by PhpStorm.
 * User: INVOLVES
 * Date: 27/07/2016
 * Time: 11:04
 */

namespace App\Entity;
use App\Api, Exception;

class Person
{
    protected $api;

    function __construct(Api $api){

        $this->api = $api;

    }

}