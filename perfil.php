<?php
require 'vendor/autoload.php'; // Carga la biblioteca de MongoDB
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == null) {
    print "<script>alert(\"Necesitas estar registrado para acceder!\");window.location='index.php';</script>";
}

include "assets/php/conexion.php";

// Selecciona la colección de usuarios
$collection = $db->usuarios;

// Recupera los datos del usuario de MongoDB utilizando su ID de sesión
$datos = $collection->findOne(['_id' => new MongoDB\BSON\ObjectId($_SESSION["user_id"])]);
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

        <!-- Cabecera -->
        <header id="header" class="alt">
            <div class="logo"><a href="index.php">Bienvenido a<span> DRAM</span></a></div>
            <a href="#menu"><?php echo isset($_SESSION['user_username']) ? htmlspecialchars($_SESSION['user_username']) : 'Menu'; ?></a>
        </header>

        <!-- Menu de navegacion -->
        <nav id="menu">
            <!-- ... -->
        </nav>

        <!-- Titulo principal -->
        <section id="One" class="wrapper style3">
            <!-- ... -->
        </section>

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
                                        <!-- La contraseña no debe mostrarse -->
                                        <th>Fecha de creación del perfil</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><?php echo htmlspecialchars($datos['_id']); ?></td>
                                        <td><?php echo htmlspecialchars($datos['fullname']); ?></td>
                                        <td><?php echo htmlspecialchars($datos['username']); ?></td>
                                        <td><?php echo htmlspecialchars($datos['email']); ?></td>
                                        <td><?php echo htmlspecialchars($datos['created_at']->toDateTime()->format('Y-m-d H:i:s')); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pie de pagina -->
        <footer id="footer">
            <!-- ... -->
        </footer>

        <!-- Scripts -->
        <script src="assets/javascript/jquery.min.js"></script>
        <!-- ... Resto de scripts ... -->

    </body>
</html>
