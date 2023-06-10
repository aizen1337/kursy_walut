<?php
require_once 'classes/Database.php';
require_once 'config/database_config.php';
$database = new Database($HOST,$USERNAME,$PASSWORD,$DATABASE);
$rates = $database->query('SELECT * FROM `kursy`');