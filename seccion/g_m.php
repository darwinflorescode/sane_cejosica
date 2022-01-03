<?php 
//Archivo donde se encuentra la conexion de la DB para hacer el puente
require'../conexionpdo/config.php';
	//Variable que almacena la conexion
session_start();
$conn = conexion();

if (isset($_POST['accion_gm'])) {

	$id_estudiante = $_POST['id_est'];
	$idtb_seccion = $_POST['idtb_seccion'];

	if (($id_estudiante!=0) && ($idtb_seccion!=0) ) {

	//Consulta Donde se comprueba  que el usuario existe
		$sql = "SELECT tb_seccion.*,tb_anio_escolar.* FROM tb_seccion inner join tb_anio_escolar on  tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar where idtb_seccion='$idtb_seccion' and tb_anio_escolar.anio=".$_SESSION['anio_escolar'];
			//Ejecuta ala consulta
		$datos = $conn->query($sql);
		$seccion = $datos->fetch(PDO::FETCH_ASSOC);
		$vacantes = $seccion['sec_vacante'];


		$sqll = "SELECT * FROM tb_matricula where matri_idtb_seccion=$idtb_seccion";
			//Ejecuta ala consulta
		$datoss = $conn->query($sqll);

		if ($datoss->rowcount()>=$vacantes) {



			echo "vacantes";
		}else{

			$sqle = "SELECT * FROM tb_matricula where (matri_idestudiante= $id_estudiante and matri_idtb_seccion=$idtb_seccion)";
			//Ejecuta ala consulta
			$datose = $conn->query($sqle);

			if ($datose->rowcount()) {


				echo "matriculado";

			}else
			{

			$retornar=false;
				$sqlee = "SELECT tb_seccion.*,tb_anio_escolar.* FROM tb_seccion inner join tb_anio_escolar on  tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar where tb_anio_escolar.anio=".$_SESSION['anio_escolar'];
			//Ejecuta ala consulta
				$resultado = $conn->query($sqlee);


				$registros = $resultado->fetchAll();

				foreach ($registros as $registrar) { 
					$sqlm = "SELECT * FROM tb_matricula where matri_idestudiante=$id_estudiante and matri_idtb_seccion = ".$registrar['idtb_seccion'];
					$encontro  = $conn->query($sqlm);
					if ($encontro->rowcount())
					{
						$retornar = true;
						break;

					}
				

				}

				if ($retornar==1) {
				echo "matriculados";
				}else{

					$sqlinsert = "INSERT INTO tb_matricula (matri_fecha,matri_idestudiante,matri_idtb_seccion,matri_idtb_usuario) values(NOW(),$id_estudiante,$idtb_seccion,".$_SESSION['idtb_usuario_ingreso'].");";

					if ($conn->query($sqlinsert)){
						echo "matriculadoe";
	}else{
		echo "error_a";
	}
				}
	

			}
		}
	}else{

		echo "error_a";
	}

}else{
	echo "Error";
}


 ?>