<?php
require __DIR__ . '/../../vendor/autoload.php'; // Asegura que la ruta al autoload es correcta
session_start(); // Inicia sesión al principio del script

// Parámetros de conexión
$host = 'localhost';
$puerto = '32769';
$usuario = 'davidrg';
$contrasena = '98I7VkyhpWbhqz';
$nombreBaseDeDatosUsuarios = 'prueba';

// Crear una conexión a MongoDB con autenticación
$clientUsuarios = new MongoDB\Client("mongodb://$usuario:$contrasena@$host:$puerto/$nombreBaseDeDatosUsuarios?directConnection=true&serverSelectionTimeoutMS=2000&authSource=admin");
$dbUsuarios = $clientUsuarios->selectDatabase($nombreBaseDeDatosUsuarios);
$collectionUsuarios = $dbUsuarios->usuarios;

// Asumiendo que estos datos vienen de un formulario de login
if (isset($_POST['username']) && isset($_POST['password'])) {
    $usuario = $collectionUsuarios->findOne(['username' => $_POST['username']]);

    if ($usuario && password_verify($_POST['password'], $usuario['password'])) {
        $_SESSION['user_id'] = (string) $usuario['_id']; // Convierte ObjectId a string
        header("Location: perfil.php");
        exit;
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos.'); window.location='../formulario de acceso/index.php';</script>";
        exit;
    }
}
?>
