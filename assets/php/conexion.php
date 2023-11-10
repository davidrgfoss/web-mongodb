<?php
require __DIR__ . '/../../vendor/autoload.php'; // Carga la biblioteca de MongoDB

$host = 'localhost';
$puerto = '32773';
$usuario = 'davidrg';
$contrasena = 'QG0N2thg';
$nombreBaseDeDatos = 'prueba';

// Crear una conexión a MongoDB con autenticación
$client = new MongoDB\Client("mongodb://$usuario:$contrasena@$host:$puerto/$nombreBaseDeDatos?authMechanism=SCRAM-SHA-256");

// Seleccionar la base de datos
$db = $client->selectDatabase($nombreBaseDeDatos);
?>
