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
    
    return $borrado;
}


function conseguirCategorias($conexion){
    $sql = "SELECT * FROM categorias ORDER BY id ASC;";
    $categorias = mysqli_query($conexion, $sql);
    
    $result = array();
    if($categorias && mysqli_num_rows($categorias) >= 1){
        while($row = mysqli_fetch_assoc($categorias)){
            $result[] = $row;
        }
    }
    return $result;
}
