<?php
if (isset($_POST)) {
    // CONEXION A LA BASE DE DATOS
    require_once 'includes/conexion.php';

    $nombre = isset($_POST['nombre']) ? mysqli_real_escape_string($db, $_POST['nombre']) : '';

    $errores = array();
    if (!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/", $nombre)) {
        $nombre_validado = true;
    } else {
        $nombre_validado = false;
        $errores['nombre'] = 'El nombre no es válido';
    }
       
    if (count($errores) == 0) {
        $sql = "INSERT INTO categorias VALUES(NULL, '$nombre');";
        $guardar = mysqli_query($db, $sql);
        if ($guardar) {
            header("Location: index.php");
            exit;
        } else {
            $errores['db'] = 'Error al guardar en la base de datos';
        }
    }
}
?>

header("Location: index.php");