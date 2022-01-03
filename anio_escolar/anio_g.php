<?php 
//Archivo donde se encuentra la conexion de la DB para hacer el puente
require'../conexionpdo/config.php';
	//Variable que almacena la conexion
$conn = conexion();
if (isset($_POST['accion_g'])) {
	if ($_POST['accion_g']=="guardar") {
		

		$anio = $_POST['anio_es'];
		$fecha_inicio = $_POST['fecha_inicio'];
		$fecha_fin = $_POST['fecha_fin'];
		$descripcion = $_POST['descripcion'];
		$estado = $_POST['estado'];



		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //realizamos una consulta para verificar q no exista o se repita un dato
		$sql = ("SELECT * FROM tb_anio_escolar where anio = ".$anio);
		$datos = $conn->query($sql);
		if ($fecha_inicio > $fecha_fin) {
			echo "Error_fecha";
		}else{

			if ($datos->rowcount()) {

				echo "anio_existe";

			}else{


				$stmt = "INSERT INTO tb_anio_escolar(anio, anio_fecha_inicio, anio_fecha_final,anio_descrip, anio_estado) VALUES ('".$anio."','".$fecha_inicio."','".$fecha_fin."','".$descripcion."','".$estado."')";
				
				if ($conn->query($stmt)){ 
					echo "guardado";
				}else{ 

					echo "Error";
				}


			}
		}

	}else if ($_POST['accion_g']=="modificar") {

		$idtb_anio = $_POST['id_anio'];
		$anio = $_POST['anio_es'];
		$fecha_inicio = $_POST['fecha_inicio'];
		$fecha_fin = $_POST['fecha_fin'];
		$descripcion = $_POST['descripcion'];
		$estado = $_POST['estado'];

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //realizamos una consulta para verificar q no exista o se repita un dato
		$sql = ("SELECT * FROM tb_anio_escolar where anio = ".$anio);
		$datoss = $conn->query($sql);
		if ($fecha_inicio > $fecha_fin) {
			echo "Error_fecha";
		}else{

			if ($datoss->rowcount()) {

				$stmt = "UPDATE tb_anio_escolar SET anio_fecha_inicio='".$fecha_inicio."',anio_fecha_final='".$fecha_fin."',anio_descrip = '".$descripcion."',anio_estado = '".$estado."' WHERE idtb_anio_escolar = ".$idtb_anio;
				
				if ($conn->query($stmt)){ 
					echo "modificado_existe";
				}else{ 

					echo "Error";
				}

			}else{


				$stmt = "UPDATE tb_anio_escolar SET anio = ".$anio.",anio_fecha_inicio='".$fecha_inicio."',anio_fecha_final='".$fecha_fin."',anio_descrip = '".$descripcion."',anio_estado = '".$estado."' WHERE idtb_anio_escolar = ".$idtb_anio;
				
				if ($conn->query($stmt)){ 
					echo "modificado";
				}else{ 

					echo "Error";
				}


			}
		}
		
	}else
	{
		echo "Error";
	}
}


//Elminar año escolar
if (isset($_POST['accion_d'])) {

	//Query de leiminacion delete
		$sql = "UPDATE tb_anio_escolar SET anio_estado='Inactivo' WHERE idtb_anio_escolar=".$_POST['idanio'];

		if ($conn->query($sql)) {
			echo "anio_del";
		}else
		{
			echo "anio_error";
		}

	

}
?>