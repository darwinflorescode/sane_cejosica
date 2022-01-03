<?php 
if (($_SESSION['tipo_user'] == "Administrador") || ($_SESSION['tipo_user'] =="Director")) {
	
}else{
	echo "<script>window.location = '../principal/?denegado';</script>";
}

 ?>