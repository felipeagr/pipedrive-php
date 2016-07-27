<?php
/**
 * Created by PhpStorm.
 * User: Felipe Aguiar
 * Date: 25/07/2016
 * Time: 16:59
 */

namespace App\Entity;


use App\Api, Exception;


class Deal
{

    protected $api;
    protected $endPoint = 'deals';


    /**
     * Deal constructor.
     * @param Api $api
     */
    function __construct(Api $api){

        $this->api = $api;

    }

    /**
     * @param $id
     * @return mixed
     */
    public function getDeal($id=null){

        return $this->api->get($this->endPoint, $id);

    }

    /**
     * @param $params
     * @return string
     * @throws \App\APIException
     */
    public function getDeals($queryString = array()){

        $defaultParams = array(
            'filter_id',
            'start',
            'limit',
            'sort_by',
            'sort_mode',
            'owned_by_you',
        );


        try{

           $this->api->validQueryString($queryString, $defaultParams);
           $queryString = http_build_query($queryString);
           return $this->api->get($this->endPoint, $queryString);

        }catch (Exception $e){

            echo "Error:" . $e->getMessage();
        }
    }

    /**
     * @param array $data
     */
    public function insertDeal($data = array()){

        $valid = true;
        
        if(empty($data['title'])){

           $valid = !$valid;
        }

        if(!$valid){

           return false;
        }

        return $this->api->post($this->endPoint, $data);

    }

    /**
     * @param $id
     * @param array $data
     */
    public function updateDeal($id=null, $data=array()){

        $valid = true;

        if(empty($data['id'])){

            $valid = !$valid;

        }

        if(!$valid){

            return false;
        }
        
        return $this->api->put($this->endPoint."/".$id, $data);

    }

    public function deleteDeal($id=null, $data=array()){

        if(empty($data['id'])){

            throw new \Exception('Campo necessário');

        }

        return $this->api->delete($this->endPoint."/".$id, $data);
    }




}