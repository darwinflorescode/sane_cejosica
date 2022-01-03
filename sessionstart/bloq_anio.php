<?php 


if (isset($_GET['destruir_anio'])) {
	
	$_SESSION['anio_escolar'] =0;
	echo "<script>window.location='../anio_escolar/seleccionaranio.php';</script>";
}else{
if ($_SESSION["anio_escolar"]==0) {
	echo "<script>window.location='../anio_escolar/seleccionaranio.php';</script>";
}
	
}
 ?>
