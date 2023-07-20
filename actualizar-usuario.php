<?php
session_start();

if (isset($_POST['submit'])) {
    require_once 'includes/conexion.php'; // Para poder insertar el usuario

    // RECOGE LOS VALORES DEL FORMULARIO DE ACTUALIZACION
    $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : '';
    $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';

    // CREAMOS UN ARRAY PARA GUARDAR ERRORES
    $errores = array();

    // VALIDAR LOS DATOS ANTES DE GUARDARLOS
    // ...

    $guardar_usuario = false;
    if (count($errores) == 0) {
        $guardar_usuario = true;

        // ACTUALIZAR UN USUARIO EN LA TABLA DE USUARIOS DE LA BBDD ***************
        $usuario = $_SESSION['usuario'];
        $sql = "UPDATE usuarios SET " . // Agrega un espacio después de "SET"
               "nombre = ?, " . // Utiliza ? como marcadores de posición
               "apellidos = ?, " . // Utiliza ? como marcadores de posición
               "email = ? " . // Utiliza ? como marcadores de posición
               "WHERE id = ?"; // Utiliza ? como marcadores de posición

        // Validar que el email no esté vacío antes de ejecutar la consulta
        if (!empty($email)) {
            $stmt = mysqli_prepare($db, $sql);
            mysqli_stmt_bind_param($stmt, "sssi", $nombre, $apellidos, $email, $usuario['id']);

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['usuario']['nombre'] = $nombre;
                $_SESSION['usuario']['apellidos'] = $apellidos;
                $_SESSION['usuario']['email'] = $email;
                $_SESSION['completado'] = "Tus datos se han actualizado";
            } else {
                $_SESSION['errores']['general'] = "Fallo al actualizar";
            }

            mysqli_stmt_close($stmt);
        } else {
            $_SESSION['errores']['email'] = "El email no puede estar vacío";
        }
    } else {
        $_SESSION['errores'] = $errores;
    }
}

header('Location: mis-datos.php'); // Corregir la función header, no debe llevar espacio después de ":"
