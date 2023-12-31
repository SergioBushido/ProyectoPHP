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
function conseguirEntradas($conexion, $limit = null, $categoria = null, $busqueda = null) {
    $sql = "SELECT e.*, c.nombre AS 'categoria'
            FROM blog_master.entradas e
            INNER JOIN blog_master.categorias c ON e.categoria_id = c.id";
    
    // Usar la cláusula "AND" si hay más de una condición
    if (!empty($categoria) && !empty($busqueda)) {
        $sql .= " WHERE e.categoria_id = $categoria AND e.titulo LIKE '%$busqueda%'";
    } elseif (!empty($categoria)) {
        $sql .= " WHERE e.categoria_id = $categoria";
    } elseif (!empty($busqueda)) {
        $sql .= " WHERE e.titulo LIKE '%$busqueda%'";
    }
    
    if ($limit !== null) {
        // Agregar un espacio antes de "LIMIT" para evitar errores de sintaxis
        $sql .= " ORDER BY e.id DESC LIMIT $limit";
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




function conseguirCategoria($conexion, $id) {
    $sql = "SELECT * FROM categorias WHERE id= $id;";
    $categorias = mysqli_query($conexion, $sql);

    $result = array();
    if ($categorias && mysqli_num_rows($categorias) >= 1) {
        while ($row = mysqli_fetch_assoc($categorias)) {
            $result[] = $row;
        }
    } else {
        // No se encontró ninguna categoría con el ID proporcionado
        // Aquí puedes agregar un manejo de errores o mensaje de error si lo deseas
        echo "No se encontró ninguna categoría con el ID proporcionado: $id";
    }

    

    return $result;
}
function conseguirEntrada($conexion, $id){
    $sql = "SELECT e.*, c.nombre AS 'categoria', CONCAT (u.nombre,' ', u.apellidos) AS usuario"
            . " FROM entradas e ".
            "INNER JOIN categorias c ON e.categoria_id = c.id ".
            "INNER JOIN usuarios u ON e.usuario_id = u.id ".
            "WHERE e.id = $id";
    $entrada = mysqli_query($conexion, $sql);
    
    if ($entrada && mysqli_num_rows($entrada) >= 1) {
        $entrada_actual = mysqli_fetch_assoc($entrada);
        return $entrada_actual;
    } else {
        return null;
    }
}


/*function conseguirEntrada($conexion, $id){
    $sql = "SELECT e.*, c.nombre AS 'categoria' FROM entradas e ".
            "INNER JOIN categorias c ON e.categoria_id = c.id ".
            "WHERE e.id = $id";
    $entrada = mysqli_query($conexion, $sql);
    
    $result = array();
    if($entrada && mysqli_num_rows($entrada) >= 1){
        $result = mysqli_fetch_assoc($entrada);
    }
    return $result;
}*/




