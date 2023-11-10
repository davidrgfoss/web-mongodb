<?php
session_start();
session_destroy(); // Esto eliminará todas las variables de sesión
print "<script>window.location='../../index.php';</script>"; // Redirige al usuario al index.php
?>

