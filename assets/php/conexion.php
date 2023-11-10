<?php
require '/vendor/autoload.php';

$host = 'localhost';
$puerto = '32773';
$usuario = 'davidrg';
$contrasena = '1';
$nombreBaseDeDatos = 'prueba';

// Crear una conexión a MongoDB con autenticación
$client = new MongoDB\Client("mongodb://$usuario:$contrasena@$host:$puerto/$nombreBaseDeDatos");

// Seleccionar la base de datos
$db = $client->$nombreBaseDeDatos;
?>
