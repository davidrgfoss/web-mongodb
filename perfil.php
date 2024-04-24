<?php
require __DIR__ . '/../../vendor/autoload.php'; // Asegúrate de que la ruta es correcta
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == null) {
    echo "<script>alert('Necesitas estar registrado para acceder!');window.location='index.php';</script>";
    exit;
}

// La conexión ya se maneja en login.php
// Suponiendo que login.php y perfil.php están correctamente enlazados y las variables de sesión se establecen correctamente

if (!isset($_SESSION['datos_usuario']) || !isset($_SESSION['productos']) && $_SESSION['username'] === 'raul') {
    echo "<script>alert('No se pudo cargar la información del usuario o de los productos.');window.location='index.php';</script>";
    exit;
}
$datos = $_SESSION['datos_usuario'];
$productos = $_SESSION['productos']; // Esto solo estará disponible si el usuario es 'raul'
?>

<!DOCTYPE HTML>
<html lang="es">
    <head>
        <title>.:DRAM:.</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <link rel="stylesheet" href="assets/css/main.css" />
    </head>
    <body>
        <!-- Cabecera y navegación ... -->

        <!-- Información del usuario -->
        <section id="two" class="wrapper style2">
            <div class="inner">
                <div class="box">
                    <div class="content">
                        <p>A continuación verás una tabla con tu información personal</p>
                        <div class="table-wrapper">
                            <table class="alt">
                                <thead>
                                    <tr>
                                        <th>Identificación</th>
                                        <th>Nombre real completo</th>
                                        <th>Nombre de usuario</th>
                                        <th>Correo electrónico</th>
                                        <th>Fecha de creación del perfil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo htmlspecialchars($datos['_id']); ?></td>
                                        <td><?php echo htmlspecialchars($datos['fullname']); ?></td>
                                        <td><?php echo htmlspecialchars($datos['username']); ?></td>
                                        <td><?php echo htmlspecialchars($datos['email']); ?></td>
                                        <td><?php echo isset($datos['create_at']) ? $datos['create_at']->toDateTime()->format('Y-m-d H:i:s') : 'No disponible'; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Tabla de productos, solo si el usuario es Raul -->
        <?php if ($_SESSION['username'] === 'raul' && !empty($productos)): ?>
        <section id="productos" class="wrapper style2">
            <div class="inner">
                <header class="align-center">
                    <h2>Datos de los productos</h2>
                </header>
                <div class="table-wrapper">
                    <table class="alt">
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
                </div>
            </div>
        </section>
        <?php endif; ?>

        <!-- Pie de página ... -->

    </body>
</html>
