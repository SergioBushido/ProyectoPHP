<?php

if(!isset($_SESSION)){
   session_start(); 
}


if(!isset($_SESSION['usuario'])){
    header("Location: index.php");
}
/* 
 Si no hay una sesion abierta nos reenvia a la pagina principal
 */

