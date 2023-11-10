<?php
require 'vendor/autoload.php';

// Crear una conexión a MongoDB
$client = new MongoDB\Client("mongodb://localhost:27017");

// Seleccionar la base de datos
$db = $client->nombreDeTuBaseDeDatos;
?>

