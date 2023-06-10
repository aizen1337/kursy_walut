<?php
session_start();
include 'classes/Exchange.php';
include 'classes/Currency.php';
include 'classes/Database.php';
include 'config/database_config.php';
if (!isset($_POST['amount']) or empty($_POST['amount'])) {
    header('Location: ../index.php?error=amount_empty');
}
else if (!isset($_POST['source']) or !isset($_POST['target'])) {
    header('Location: ../index.php?error=currencies');
}
else if (json_decode($_POST['source']) == json_decode($_POST['target'])) {
    header('Location: ../index.php?error=currencies');
}
$amount = $_POST['amount'];
$source = json_decode($_POST['source'],true);
$target = json_decode($_POST['target'],true);
$sourceCurrency = new Currency($source['nazwa_waluty'],$source['kurs'],$source['kod']);
$targetCurrency = new Currency($target['nazwa_waluty'],$target['kurs'],$target['kod']);
$database = new Database($HOST,$USERNAME,$PASSWORD,$DATABASE);
$database->query("INSERT INTO `historia_przewalutowan`(`kwota`,`waluta_zrodlowa`, `waluta_docelowa`) values ('$amount','$sourceCurrency->code','$targetCurrency->code')");
$exchange = new Exchange($amount, $sourceCurrency, $targetCurrency);
header("Location: ../index.php");
