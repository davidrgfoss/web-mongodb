<?php
require 'vendor/autoload.php'; // Carga la biblioteca de MongoDB
session_start();

if (!isset($_SESSION["user_id"]) || $_SESSION["user_id"] == null) {
    print "<script>alert(\"Necesitas estar registrado para acceder!\");window.location='index.php';</script>";
}

include "assets/php/conexion.php";

// Buscar la información del usuario en la base de datos
$collectionUsuarios = $db->usuarios;
$datosUsuario = $collectionUsuarios->findOne(['_id' => new MongoDB\BSON\ObjectId($_SESSION["user_id"])]);
$productos = [];  // Inicializa la variable productos
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
				<ul class="links">
				<li><a href="index.php">Inicio</a></li>
				<?php if(!isset($_SESSION["user_id"])):?>
					<li><a href="assets/formulario de registro/index.php">Registrate</a></li>
					<li><a href="assets/formulario de acceso/index.php">Accede</a></li>
					<li><a href="conocenos.php">Conoce la empresa</a></li>
					<?php else:?>
					<li><a href="cpu.php">Nuevos desarrollos</a></li>
					<li><a href="enseñanzas.php">¿Quieres aprender?</a></li>
					<li><a href="contactar.php">Ayuda</a></li>
					<li><a href="assets/php/logout.php">Desconectar usuario</a></li>
					<?php endif;?>
				</ul>
			</nav>

        <!-- Titulo principal -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>Tu informacion</p>
						<h2>Porque lo sabemos todo de ti</h2>
					</header>
				</div>
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
                                        <td><?php echo isset($datos['create_at']) ? $datos['create_at']->toDateTime()->format('Y-m-d H:i:s') : 'No disponible'; ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
<?php
// Comprobar si el usuario logueado es "raul" y cargar la información de productos
if (strtolower($datosUsuario['username']) === 'raul') {
    // Cambiar la conexión a la base de datos 'gnrec'
    $clientProductos = new MongoDB\Client("mongodb://$usuario:$contrasena@$host:$puerto/gnrec?directConnection=true&serverSelectionTimeoutMS=2000&authSource=admin");
    $dbProductos = $clientProductos->selectDatabase('gnrec');
    $collectionProductos = $dbProductos->productos;
    $productos = $collectionProductos->find()->toArray(); // Obtener todos los productos
}
?>
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
	    
        <!-- Pie de pagina -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="https://twitter.com/DRAMSA231" target="_blank" class="icon fa-twitter"><span class="label">Twitter</span></a></li>
						<li><a href="https://www.facebook.com/DRAMSA231" target="_blank" class="icon fa-facebook"><span class="label">Facebook</span></a></li>
						<li><a href="https://www.instagram.com/DRAMSA231/" target="_blank" class="icon fa-instagram"><span class="label">Instagram</span></a></li>
						<li><a href="mailto:DRAM@dram.com" class="icon fa-envelope-o"><span class="label">Email</span></a></li>
					</ul>
				</div>
				<div class="copyright">
					&copy; DRAM. Todos los derechos reservados.
				</div>
			</footer>

        <!-- Scripts -->
        <script src="assets/javascript/jquery.min.js"></script>
    </body>
</html>
