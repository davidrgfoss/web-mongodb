<?php
require __DIR__ . '/../../vendor/autoload.php'; // Carga la biblioteca de MongoDB

if (!empty($_POST)) {
    if (isset($_POST["username"]) && isset($_POST["fullname"]) && isset($_POST["email"]) && isset($_POST["password"]) && isset($_POST["confirm_password"])) {
        if ($_POST["username"] != "" && $_POST["fullname"] != "" && $_POST["email"] != "" && $_POST["password"] != "" && $_POST["password"] == $_POST["confirm_password"]) {
            include "conexion.php";

            $collection = $db->usuarios; // Selecciona la colección de usuarios

            // Comprobar si el nombre de usuario o el correo electrónico ya están registrados
            $existingUser = $collection->findOne([
                '$or' => [
                    ['username' => $_POST['username']],
                    ['email' => $_POST['email']]
                ]
            ]);

            if ($existingUser) {
                print "<script>alert(\"Nombre de usuario o email ya están registrados.\");window.location='/assets/formulario de registro/index.php';</script>";
            } else {
                // Insertar el nuevo usuario
                $insertResult = $collection->insertOne([
                    'username' => $_POST['username'],
                    'fullname' => $_POST['fullname'],
                    'email' => $_POST['email'],
                    'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), // Encriptación de la contraseña
                    'create_at' => new MongoDB\BSON\UTCDateTime()
                ]);

                if ($insertResult->getInsertedCount() == 1) {
                    print "<script>alert(\"Registrado correctamente, Bienvenido a DRAM\");window.location='../../index.php';</script>";
                }
            }
        }
    }
}
?>

