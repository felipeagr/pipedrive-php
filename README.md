# pipedrive-php
Cliente em php para API do Pipedrive

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
