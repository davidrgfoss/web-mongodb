<?php
require __DIR__ . '/../../vendor/autoload.php'; // Carga la biblioteca de MongoDB

$host = 'localhost';
$puerto = '32769';
$usuario = 'davidrg';
$contrasena = '98I7VkyhpWbhqz';
$nombreBaseDeDatos = 'prueba';

// Crear una conexión a MongoDB con autenticación
$client = new MongoDB\Client("mongodb://$usuario:$contrasena@$host:$puerto/$nombreBaseDeDatos?directConnection=true&serverSelectionTimeoutMS=2000&authSource=admin");

// Seleccionar la base de datos
$db = $client->selectDatabase($nombreBaseDeDatos);
?>
