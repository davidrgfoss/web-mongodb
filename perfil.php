<?php
require __DIR__ . '/../../vendor/autoload.php'; // Asegúrate que la ruta es correcta
session_start();

if (!isset($_SESSION["user_id"])) {
    echo "<script>alert('Necesitas estar registrado para acceder!');window.location='index.php';</script>";
    exit;
}

// Incluir el script de conexión que tiene la configuración de la base de datos 'prueba'
include "conexion.php";  // Este script debe definir la variable $db que apunta a la base de datos de usuarios

// Buscar la información del usuario en la base de datos
$collectionUsuarios = $db->usuarios;
$datosUsuario = $collectionUsuarios->findOne(['_id' => new MongoDB\BSON\ObjectId($_SESSION["user_id"])]);
$productos = [];  // Inicializa la variable productos

// Comprobar si el usuario logueado es "raul" y cargar la información de productos
if (strtolower($datosUsuario['username']) === 'raul') {
    // Cambiar la conexión a la base de datos 'gnrec'
    $clientProductos = new MongoDB\Client("mongodb://$usuario:$contrasena@$host:$puerto/gnrec?directConnection=true&serverSelectionTimeoutMS=2000&authSource=admin");
    $dbProductos = $clientProductos->selectDatabase('gnrec');
    $collectionProductos = $dbProductos->productos;
    $productos = $collectionProductos->find()->toArray(); // Obtener todos los productos
}
?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <title>Perfil de Usuario</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>
    <body>
        <!-- Resto de la estructura HTML -->

        <!-- Información del usuario -->
        <h2>Bienvenido, <?php echo htmlspecialchars($datosUsuario['username']); ?></h2>
        <!-- Aquí otros detalles del usuario -->

        <!-- Tabla de productos, solo si el usuario es Raul -->
        <?php if (!empty($productos)): ?>
        <h3>Productos de GNREC</h3>
        <table>
            <thead>
                <tr>
                    <th>Código</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><?php echo htmlspecialchars($producto['codigo']); ?></td>
                    <td><?php echo htmlspecialchars($producto['descripcion']); ?></td>
                    <td><?php echo htmlspecialchars($producto['precio']); ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>

        <!-- Resto del HTML, pie de página, etc. -->
    </body>
</html>
