<?php
/**
 * Created by PhpStorm.
 * User: Felipe Aguiar
 * Date: 25/07/2016
 * Time: 17:30
 */

namespace App;


class Api
{

    protected $apiToken;
    protected $url = "https://api.pipedrive.com/";
    protected $version = "v1/";
    protected $curl;

    /**
     * Api constructor.
     * @param $apiToken
     */
    function __construct($apiToken){

        $this->apiToken = $apiToken;
        $this->configInitCurl();

    }

    /**
     * @param $token
     */
    public function setApiToken($token){

        $this->apiToken = $token;
    }


    /**
     * @param $version
     */
    public function setVersion($version){

        $this->version = $version;
    }

    /**
     * @param $endPoint
     * @return string
     */
    public function getUrl($endPoint, $params){

         if(empty($params)){

             return $this->url . $this->version . $endPoint . "?api_token=" . $this->apiToken;

         }elseif (is_numeric($params)){

             return $this->url . $this->version . $endPoint . "/". $params . "?api_token=" . $this->apiToken;
         }


             return $this->url . $this->version . $endPoint . "?". $params ."&api_token=" . $this->apiToken;

    }

    /**
     * @param $endPoint
     * @param $params
     * @return mixed
     */
    public function get($endPoint, $params){

        curl_setopt($this->curl, CURLOPT_URL, $this->getUrl($endPoint, $params));
        $result = curl_exec($this->curl);
        curl_close($this->curl);
        return json_decode($result, 1);

    }


    /**
     * @param $endPoint
     * @param $data
     * @return mixed
     */
    public function post($endPoint, $data){

        $url = $this->url . $this->version . $endPoint . "?api_token=" . $this->apiToken;
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_POST, true);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($this->curl);
        curl_close($this->curl);
        return json_decode($result, 1);

    }

    /**
     * @param $endPoint
     * @param $data
     * @return mixed
     */
    public function put($endPoint, $data){

        $url = $this->url . $this->version . $endPoint . "?api_token=" . $this->apiToken;
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "PUT");
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
        $result = curl_exec($this->curl);
        curl_close($this->curl);
        return json_decode($result, 1);

    }

    public function delete($endPoint, $data){

        $url = $this->url . $this->version . $endPoint . "?api_token=" . $this->apiToken;
        curl_setopt($this->curl, CURLOPT_URL, $url);
        curl_setopt($this->curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, $data);
        $result = curl_exec($this->curl);
        curl_close($this->curl);
        return json_decode($result, 1);

    }


    /**
     *
     */
    public function configInitCurl(){

        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, array("Accept: application/json"));
        curl_setopt($this->curl, CURLOPT_SSL_VERIFYPEER, false);

    }

    /**
     * @param $args
     * @param $accepted_params
     * @return bool
     * @throws \Exception
     */
    public function validQueryString($args, $accepted_params){
        foreach ($args as $key => $val) {
            if (!in_array($key, $accepted_params)){
                throw new \Exception('Parametro não aceito');
            }
        }
        return true;
    }
    


}