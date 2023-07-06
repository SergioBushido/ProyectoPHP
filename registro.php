<?php
    if(isset($_POST)){
       $nombre = isset($_POST['nombre'])? $_POST['nombre']: false ;
       $apellidos = isset($_POST['apellidos'])? $_POST['apellidos']: false ;
       $email = isset($_POST['email'])? $_POST['email']: false ;
       $password = isset($_POST['password'])? $_POST['password']: false ;
        
       $errores = array();
       
       //VALIDAR LOS DATOS ANTES DE GUARDARLOS
       if(!empty($nombre) && !is_numeric($nombre) && !preg_match("/[0-9]/",$nombre)){
           $nombre_validado = true;
       }else{
           $nombre_validado = false;
           $errores['nombre']='El nombre no es valido';
       }
       
       if(!empty($apellidos) && !is_numeric($apellidos) && !preg_match("/[0-9]/",$apellidos)){
           $apellidos_validado = true;
       }else{
           $apellidos_validado = false;
           $errores['apellido']='El apellido no es valido';
       }
       
        if(!empty($email) && filter_var($email,FILTER_VALIDATE_EMAIL)){
            $email_validado = true;
       }else{
            $email_validado = false;
           $errores['email']='El email no es valido';
       }
       
        if(!empty( $password)){
          $password_validado = true;
       }else{
             $password_validado = false;
           $errores['password']='El password no es valido';
       }
       $guardar_usuario=false;
       if(count($errores)==0){
          $guardar_usuario=true; 
       }
    }


