<?php
session_start();
if(!isset($_SESSION["user_id"]) || $_SESSION["user_id"]==null){
	print "<script>alert(\"Necesitas estar registrado para acceder!\");window.location='index.php';</script>";
}

?>

<!DOCTYPE HTML>
<!--
	Hielo by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
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
			<header id="header">
				<div class="logo"><a href="index.php">Bienvenido a<span> la web de DRAM</span></a></div>
				<a href="#menu">Menu</a>
			</header>

		<!-- Menu de navegacion -->
			<nav id="menu">
				<ul class="links">
				<li><a href="index.php">Inicio</a></li>
				<?php if(!isset($_SESSION["user_id"])):?>
					<li><a href="assets/formulario de registro/index.php">Registrate</a></li>
					<li><a href="assets/formulario de acceso/index.php">Accede</a></li>
					<?php else:?>
					<li><a href="cpu.php">Nuevos desarrollos</a></li>
					<li><a href="enseñanzas.php">¿Quieres aprender?</a></li>
					<li><a href="perfil.php">Mi perfil/datos(AplicacionBD)</a></li>
					<li><a href="contactar.php">Ayuda</a></li>
					<li><a href="assets/php/logout.php">Desconectar usuario</a></li>
					<?php endif;?>
					<li><a href="conocenos.php">Conoce la empresa</a></li>
				</ul>
			</nav>

		<!-- Introduccion -->
			<section id="One" class="wrapper style3">
				<div class="inner">
					<header class="align-center">
						<p>Repartiendo nuestra gran sabiduria porque podemos y queremos</p>
						<h2>Asi de simple es DRAM </h2>
					</header>
				</div>
			</section>

		<!-- Contenido -->
			<section id="two" class="wrapper style2">
				<div class="inner">
					<div class="box">
						<div class="content">
							<header class="align-center">
								<p>Por un mundo mas sano</p>
								<h2>Por un mundo mas DRAM</h2>
							</header>
							<p>Para nuestra empresa es muy importante el futuro de los demas, pues vuestro futuro es el nuestro. Siempre ofrecemos talleres gratuitos para profesores y alumnos que quieran entrar en el maravilloso mundo de los iDRAM</p>
							<p>A lo largo de la historia hemos ido abriendo escuelas en distintos sitios donde cada vez hay mas personas que forman parte de nuestra familia OS-D, a continuacion veremos algunas cifras de lo que hablamos porque nosotros nunca mentimos </p>
							<div class="table-wrapper">
									<table class="alt">
										<thead>
											<tr>
												<th>Pais</th>
												<th>Motivo</th>
												<th>Personas ayudadas</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>España</td>
												<td>Bajo nivel en cultura tecnologica.</td>
												<td>3.237.987 Habitantes</td>
											</tr>
											<tr>
												<td>Rusia</td>
												<td>Les enseñamos a sonreir con la sonrisa de nuestro iDRAM.</td>
												<td>15.234.145.980 Habitantes</td>
											</tr>
											<tr>
												<td>Japon</td>
												<td>Al final ellos nos enseñaron a nosotros</td>
												<td>-767.457 Empleados/Trabajadores</td>
											</tr>
											<tr>
												<td>China</td>
												<td>Tiraron los iDram con patadas voladoras.</td>
												<td>-800.000€</td>
											</tr>
											<tr>
												<td>Andorra</td>
												<td>Necesitaban un software para estafar a hacienda/td>
												<td>3</td>
											</tr>
										</tbody>
										<tfoot>
											<tr>
												<td colspan="2"></td>
												<td>15.236.616.513 Personas ayudadas</td>
											</tr>
										</tfoot>
									</table>
								</div>

						</div>
							
							</div>
					</div>
				</div>
			</section>

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
			<script src="assets/javascript/jquery.scrollex.min.js"></script>
			<script src="assets/javascript/skel.min.js"></script>
			<script src="assets/javascript/util.js"></script>
			<script src="assets/javascript/main.js"></script>

	</body>
</html>