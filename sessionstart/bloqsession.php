<?php 
//Permite solo que ingrese el usuario que ha iniciado sesion.
//con la session amacenada al ingresar con los datos correctos
session_start();
if (!$_SESSION["ok"])

{

//redirecciona al index.php del sistema o login si no existe la session
  header("location:../");

}

 ?>