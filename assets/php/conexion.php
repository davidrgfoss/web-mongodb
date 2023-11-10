<?php
require 'vendor/autoload.php'; // Asegúrate de haber instalado la librería con composer

// Crear una conexión a MongoDB
$client = new MongoDB\Client("mongodb://localhost:27017");

// Seleccionar la base de datos
$db = $client->nombreDeTuBaseDeDatos;
?>

