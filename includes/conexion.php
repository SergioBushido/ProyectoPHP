<?php
$servidor='localhost';
$usuario='root';
$password='';
$basedatos='blog_master';
$db=mysqli_connect($servidor,$usuario,$password,$basedatos);

mysqli_query($db,"SET NAMES 'utf8'");

if(!isset($_SESSION)){
   session_start(); 
}