# pipedrive-php

<h1>Cliente em php para API do Pipedrive</h1>

Uso:

<?php
require_once 'vendor/autoload.php';
use App\Pipedrive;
$pipedrive = new Pipedrive('apikey');
$params = array(
    'id' => 7,
    
);
var_dump($pipedrive->deal->deleteDeal(7, $params));
?>
