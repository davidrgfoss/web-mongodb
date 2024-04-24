<?php
require __DIR__ . '/../../vendor/autoload.php'; // Carga la biblioteca de MongoDB

// Conexión a la base de datos de usuarios
$host = 'localhost';
$puerto = '32769';
$usuario = 'davidrg';
$contrasena = '98I7VkyhpWbhqz';
$nombreBaseDeDatosUsuarios = 'prueba';

$clientUsuarios = new MongoDB\Client("mongodb://$usuario:$contrasena@$host:$puerto/$nombreBaseDeDatosUsuarios?directConnection=true&serverSelectionTimeoutMS=2000&authSource=admin");
$dbUsuarios = $clientUsuarios->selectDatabase($nombreBaseDeDatosUsuarios);

session_start();
if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == null) {
    echo "<script>alert('Necesitas estar registrado para acceder!');window.location='index.php';</script>";
    exit;
}

$collectionUsuarios = $dbUsuarios->usuarios;
$datosUsuario = $collectionUsuarios->findOne(['_id' => new MongoDB\BSON\ObjectId($_SESSION["user_id"])]);

// Verificar si el usuario logueado es "raul"
if (isset($datosUsuario['username']) && strtolower($datosUsuario['username']) === 'raul') {
    // Conexión a la base de datos de productos
    $nombreBaseDeDatosProductos = 'gnrec';
    $clientProductos = new MongoDB\Client("mongodb://$usuario:$contrasena@$host:$puerto/$nombreBaseDeDatosProductos?directConnection=true&serverSelectionTimeoutMS=2000&authSource=admin");
    $dbProductos = $clientProductos->selectDatabase($nombreBaseDeDatosProductos);

    try {
        $collectionProductos = $dbProductos->productos;
        $productos = $collectionProductos->find()->toArray();
    } catch (Exception $e) {
        echo "<p>Error al cargar la información de los productos: " . $e->getMessage() . "</p>";
    }
}
?>
