<?php 
//Archivo donde se encuentra la conexion de la DB para hacer el puente
require'../conexionpdo/config.php';
	//Variable que almacena la conexion
session_start();
$conn = conexion();
if (isset($_POST['accion_gsec'])) {


	if ($_POST['accion_gsec']=="guardar") {
		
	$idtb_seccion = $_POST['id_seccion'];

	$servicio = $_POST['sec_ser_edu'];
		$identificador = $_POST['sec_identificador'];
		$turno = $_POST['sec_turno'];
		$vacante = $_POST['sec_vacante'];
		$tipo = $_POST['sec_tipo'];
		$iduser = $_POST['sec_idtbuser'];
		$nivel = "";
		if ($servicio> 0 && $servicio <=3) {
			$nivel = "I";
		}else if ($servicio> 3 && $servicio <=6) {
			$nivel = "II";
		}else if ($servicio> 6 && $servicio <=9){
			$nivel = "III";
	}else{
			$nivel = "Kinder";
		}
		$anio_s = $_SESSION['anio_escolar'];
		



		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //realizamos una consulta para verificar q no exista o se repita un dato
		$sql = "SELECT tb_seccion.*,tb_anio_escolar.* FROM tb_seccion inner join tb_anio_escolar on  tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar where tb_anio_escolar.anio='$anio_s' and tb_seccion.sec_servicio_ed = '$servicio' and tb_seccion.sec_identificador = '$identificador'";
		$datos = $conn->query($sql);
	

			if ($datos->rowcount()) {

				echo "Error_seccion";

			}else{


				$stmt = "INSERT INTO tb_seccion (sec_servicio_ed,sec_turno,sec_identificador,sec_tipo_seccion,sec_nivel,sec_vacante,sec_idtb_anio_escolar,sec_idtbuser) VALUES('$servicio','$turno','$identificador','$tipo','$nivel','$vacante',(SELECT idtb_anio_escolar from tb_anio_escolar where anio = $anio_s),'$iduser');";

				//SELECT idtb_anio_escolar from tb_anio_escolar where anio = 2018
				
				if ($conn->query($stmt)){ 
					echo "guardado";
				}else{ 

					echo "Error";
				}


			}
		

	}else if ($_POST['accion_gsec']=="modificar") {

		$idtb_seccion = $_POST['id_seccion'];

	$servicio = $_POST['sec_ser_edu'];
		$identificador = $_POST['sec_identificador'];
		$tipo = $_POST['sec_tipo'];
		$turno = $_POST['sec_turno'];
		$vacante = $_POST['sec_vacante'];
			$iduser = $_POST['sec_idtbuser'];
		$nivel = "";
		if ($servicio> 0 && $servicio <=3) {
			$nivel = "I";
		}else if ($servicio> 3 && $servicio <=6) {
			$nivel = "II";
		}else if ($servicio> 6 && $servicio <=9){
			$nivel = "III";
	}else{
			$nivel = "Kinder";
		}
		$anio_s = $_SESSION['anio_escolar'];

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //realizamos una consulta para verificar q no exista o se repita un dato
	$sql = "SELECT tb_seccion.*,tb_anio_escolar.* FROM tb_seccion inner join tb_anio_escolar on  tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar where tb_anio_escolar.anio='$anio_s' and tb_seccion.sec_servicio_ed = '$servicio' and tb_seccion.sec_identificador = '$identificador' and tb_seccion.sec_idtbuser ='$iduser'";
		$datoss = $conn->query($sql);
	

			if ($datoss->rowcount()) {

				$stmt = "UPDATE tb_seccion SET sec_turno='$turno',sec_tipo_seccion='$tipo',sec_vacante='$vacante' WHERE idtb_seccion = ".$idtb_seccion;
				
				if ($conn->query($stmt)){ 
					echo "modificado_existe";
				}else{ 

					echo "Error";
				}

			}else{


				$stmt = "UPDATE tb_seccion SET sec_servicio_ed ='$servicio',sec_turno='$turno',sec_identificador='$identificador',sec_tipo_seccion='$tipo',sec_nivel = '$nivel',sec_vacante = '$vacante', sec_idtbuser = '$iduser' WHERE idtb_seccion = ".$idtb_seccion;
				
				if ($conn->query($stmt)){ 
					echo "modificado";
				}else{ 

					echo "Error";
				}


			
		}
		
		
	}else if ($_POST['accion_gsec']=="eliminar"){
	$idtb_seccion = $_POST['id_seccion'];
		//Query de leiminacion delete
		$sql = "DELETE FROM tb_seccion WHERE idtb_seccion = ".$idtb_seccion;

		if ($conn->query($sql)) {
			echo "seccion_del";
		}else
		{
			echo "Error";
		}
	}else if ($_POST['accion_gsec']=="delm"){
	$idtb_matricula= $_POST['idmatricula'];
		//Query de leiminacion delete
		$sql = "DELETE FROM tb_matricula WHERE idtb_matricula = ".$idtb_matricula;

		if ($conn->query($sql)) {
			echo "exitom";
		}else
		{
			echo "errorm";
		}
	}else
	{
		echo "Error";
	}
}



?>