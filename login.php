<?php
// INICIAMOS SESION Y CONEXION A BASE DE DATOS (QUE YA ESTA EN INCLUDES.PHP)
require_once 'includes/conexion.php';

if (isset($_POST)) {
    $email = trim($_POST['email']); // limpia espacios si tubiera
    $password = $_POST['password'];

    // CONSULTA PARA COMPROBAR LAS CREDENCIALES DEL USUARIO
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $login = mysqli_query($db, $sql);

    if ($login && mysqli_num_rows($login) == 1) { // si la consulta funciona y hay una linea de datos 
        $usuario = mysqli_fetch_assoc($login); // esos datos se guardan en usuario
        
        // COMPROBAR LA CONTRASEÑA
        $verify = password_verify($password, $usuario['password']);

        if ($verify) {
            // UTLIZAR UNA SESION PARA GUARDAR DATOS DEL USUARIO LOGUEADO
            $_SESSION['usuario'] = $usuario;

            if (isset($_SESSION['error_login'])) {
                unset($_SESSION['error_login']);
            }
        } else {
            // SI ALGO FALLA ENVIAR UNA SESION CON EL ERROR
            $_SESSION['error_login'] = "Login incorrecto";
        }
    } else {
        // mensaje de error
        $_SESSION['error_login'] = "Login incorrecto";
    }
}

// REDIRIGIR AL LOGIN
header('Location: index.php');




