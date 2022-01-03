<?php 
//Archivo donde se encuentra la conexion de la DB para hacer el puente
require'../conexionpdo/config.php';
	//Variable que almacena la conexion
session_start();
$conn = conexion();
if (isset($_GET['action'])) {
	$id = $_GET['id'];
	$clave = $_GET['c1'];

	$stmt = "UPDATE tb_usuario SET user_clave= md5('$clave') WHERE idtb_usuario = ".$id;
				
				if ($conn->query($stmt)){ 
					echo "modificado";
				}else{ 

					echo "Error";
				}
	
}else{
	echo "Error";
}



 ?>