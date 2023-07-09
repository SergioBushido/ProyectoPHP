<?php
    if(isset($_POST)){
        
        require_once 'includes/conexion.php';//para poder insertar el usuario
       
        
        
       //RECOGE LOS VALORES DEL FORMULARIO DE REGISTRO
        
       $nombre = isset($_POST['nombre'])? $_POST['nombre']: false ;
       $apellidos = isset($_POST['apellidos'])? $_POST['apellidos']: false ;
       $email = isset($_POST['email'])? $_POST['email']: false ;
       $password = isset($_POST['password'])? $_POST['password']: false ;
        
       //CREAMOS UN ARRAY PARA GUARDAR ERRORES
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
          
          //CIFRAR CONTRASEÑA************************************************
          
          $password_segura= password_hash($password,PASSWORD_BCRYPT,['cost'=>4]);//cost en el numero de veces que cifra la contraseña
        
          /* var_dump($password);
          var_dump($password_segura);
          var_dump( password_verify($password,$password_segura));//compara la contraseña con el hash para ver si es correcta
          die();*/
          
          //INSERTAR USUARIO EN LA TABLA DE USUARIOS DE LA BBDD***************
          
          $sql="INSERT INTO USUARIOS VALUES(null,'$nombre','$apellidos','$email','$password_segura',curdate());";
          $guardar= mysqli_query($db, $sql);
          
          if($guardar){
              $_SESSION['completado'] = "El registro se ha completado";
       }else{
           $_SESSION['errores']['general'] = "Fallo al insertar";
       }
       }else{
           $_SESSION['errores'] = $errores;
          
       }
    }

 header('location: index.php');//UNA VEZ EJECUTADO TODO EL CODIGO VOLVEMOS AL INDEX
