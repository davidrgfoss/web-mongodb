<?php
require __DIR__ . '/vendor/autoload.php';

try {
    $client = new MongoDB\Client("mongodb://davidrg:98I7VkyhpWbhqz@localhost:32768/?directConnection=true&serverSelectionTimeoutMS=2000&authSource=admin");
    $db = $client->selectDatabase('prueba');
    $collection = $db->selectCollection('usuarios');

    // Realiza una consulta simple para probar la conexión
    $document = $collection->findOne();
    var_dump($document);
} catch (MongoDB\Driver\Exception\Exception $e) {
    echo 'Error al conectar a MongoDB: ', $e->getMessage();
}
