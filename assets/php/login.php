<?php
require '/vendor/autoload.php'; // Carga la biblioteca de MongoDB

if (!empty($_POST)) {
    if (isset($_POST['username']) && isset($_POST['password'])) {
        if ($_POST['username'] != "" && $_POST['password'] != "") {
            include "conexion.php";

            $collection = $db->usuarios; // Selecciona la colección

            // En MongoDB, debes usar find() para buscar documentos
            $usuario = $collection->findOne([
                'username' => $_POST['username'],
                // No debes guardar o verificar contraseñas en texto plano
                // 'password' => $_POST['password']
            ]);

            // Verifica que el usuario exista y que la contraseña sea correcta
            // Asegúrate de usar una función de hash para la contraseña al crear los usuarios
            if ($usuario && password_verify($_POST['password'], $usuario['password'])) {
                session_start();
                $_SESSION['user_id'] = (string) $usuario['_id']; // MongoDB usa objetos del tipo ObjectId
                $_SESSION['user_username'] = $usuario['username'];

                print "<script>window.location='../../index.php';</script>";
            } else {
                print "<script>alert(\"No has introducido los datos correctamente.\");window.location='../formulario de acceso/index.php';</script>";
            }
        }
    }
}
?>

