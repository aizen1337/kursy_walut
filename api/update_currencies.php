<?php
require_once 'classes/Fetch.php';
require_once 'classes/Database.php';
require_once 'config/database_config.php';
$database = new Database($HOST,$USERNAME,$PASSWORD,$DATABASE);
$response_data = Fetch::request("https://api.nbp.pl/api/exchangerates/tables/a/?format=json", array(
    'headers' => array(
        'Content-Type' => 'application/json',
        'cache' => 'no-cache'
    ),
));
$rates = $response_data[0]['rates'];
foreach($rates as $rate) {
    $code = $rate['code'];
    $currency = $rate['currency'];
    $mid = $rate['mid'];
    $database->query("INSERT IGNORE INTO `kursy`( `kod`, `nazwa_waluty`, `kurs`) VALUES ('$code', '$currency', $mid)");
};
header("Location: ../index.php");
?>
