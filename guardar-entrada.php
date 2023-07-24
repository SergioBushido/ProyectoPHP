<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // CONEXION A LA BASE DE DATOS
    require_once 'includes/conexion.php';

    $titulo = isset($_POST['titulo']) ? mysqli_real_escape_string($db, $_POST['titulo']) : false;
    $descripcion = isset($_POST['descripcion']) ? mysqli_real_escape_string($db, $_POST['descripcion']) : false;
    $categoria = isset($_POST['categoria']) ? (int)$_POST['categoria'] : false;
    $usuario = $_SESSION['usuario']['id'];
    $errores = array();
    
    if (empty($titulo)) {
        $errores['titulo'] = 'El título no puede estar vacío.';
    }
    
    if (empty($descripcion)) {
        $errores['descripcion'] = 'La descripción no puede estar vacía.';
    }  
    
    if (empty($categoria) || !is_numeric($categoria)) {
        $errores['categoria'] = 'La categoría no es válida.';
    }  
    
    if (count($errores) == 0) {
        if(isset($_GET['editar'])){
            $entrada_id = $_GET['editar'];
            $usuario_id =$_SESSION['usuario']['id'];
            
            $sql = "UPDATE entradas SET titulo='$titulo', descripcion='$descripcion', categoria_id=$categoria ".
                   " WHERE id= $entrada_id AND usuario_id = $usuario_id";
        }else{
           $sql = "INSERT INTO entradas VALUES(NULL, $usuario, $categoria, '$titulo', '$descripcion', CURDATE());"; 
        }
        $guardar = mysqli_query($db, $sql);

        if ($guardar) {
            // Redireccionar al índice después de guardar la entrada
            header("Location: index.php");
            exit; // Importante: detener la ejecución del script después de redireccionar
        } else {
            // Manejar el error de inserción en la base de datos
            echo "Error al guardar la entrada: " . mysqli_error($db);
        }
    } else {
        $_SESSION["errores_entrada"] = $errores;
        if(isset($_GET['editar'])){
            header("Location: editar-entrada.php?id=".$_GET['editar']);
        }else{
                header("Location: crear-entradas.php");
        exit; // Importante: detener la ejecución del script después de redireccionar 
        }
        
    }
}
?>
