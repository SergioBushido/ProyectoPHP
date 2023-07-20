<?php

function mostrarError($errores, $campo){
    $alerta ='';
    if(isset($errores[$campo]) && !empty($campo)){
      $alerta = "<div class='alerta alerta-error'>".$errores[$campo].'</div>' ; 
}
return $alerta; 
}


function borrarErrores(){
    $borrado = false;
    
    if(isset($_SESSION['errores'])){
        $_SESSION['errores'] = null;  
        $borrado = true;
    }
    
    if(isset($_SESSION['completado'])){
        $_SESSION['completado'] = null;
        $borrado = true;
    }
    if(isset($_SESSION['errores_entrada'])){
        $_SESSION['errores_entrada'] = null;
        $borrado = true;
    }
    
    return $borrado;
}


function conseguirCategorias($conexion){
    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($conexion, $sql);
    
    $result = array();
    if($categorias && mysqli_num_rows($categorias) >= 1){//Este condicional verifica si se obtuvieron resultados de la consulta y si hay al menos una fila de categoría en los resultados.
        while($row = mysqli_fetch_assoc($categorias)){
            $result[] = $row;
        }
    }
    return $result;
}

function conseguirEntradas($conexion, $limit = null) {
    $sql = "SELECT e.*, c.nombre AS 'categoria'
            FROM blog_master.entradas e
            INNER JOIN blog_master.categorias c ON e.categoria_id = c.id 
            ORDER BY e.id DESC";
    
    if ($limit !== null) { // Modificar la condición para verificar si $limit no es nulo
        // Agregar un espacio antes de "LIMIT" para evitar errores de sintaxis
        $sql .= " LIMIT $limit";
    }
    
    $result = mysqli_query($conexion, $sql);
    $resultado = array();
    
    if ($result && mysqli_num_rows($result) >= 1) {
        while ($fila = mysqli_fetch_assoc($result)) {
            $resultado[] = $fila;
        }
    }
    
    return $resultado;
}




