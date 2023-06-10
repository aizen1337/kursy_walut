<?php 
require_once 'classes/Database.php';
require_once 'config/database_config.php';
$database = new Database($HOST,$USERNAME,$PASSWORD,$DATABASE);
$history = $database->query('SELECT * FROM `historia_przewalutowan`')->fetch_all(MYSQLI_ASSOC);