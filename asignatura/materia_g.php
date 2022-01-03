<?php 
//Archivo donde se encuentra la conexion de la DB para hacer el puente
require'../conexionpdo/config.php';
	//Variable que almacena la conexion
session_start();
$conn = conexion();
if (isset($_POST['accion_gmate'])) {


	if ($_POST['accion_gmate']=="guardar") {
		
		$mate_cod = $_POST['mate_cod'];
	$mate_nombre = $_POST['mate_nombre'];

	$mate_descripcion = $_POST['mate_descripcion'];
		
		



		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //realizamos una consulta para verificar q no exista o se repita un dato
		$sql = "SELECT * FROM tb_materia  where mate_nombre='$mate_nombre' or cod_materia='$mate_cod'";
		$datos = $conn->query($sql);
	

			if ($datos->rowcount()) {

				echo "Existe_materia";

			}else{


				$stmt = "INSERT INTO  tb_materia (cod_materia,mate_nombre,mate_descripcion) VALUES ('$mate_cod','$mate_nombre','$mate_descripcion')";

				
				if ($conn->query($stmt)){ 
					echo "guardado";
				}else{ 

					echo "Error";
				}


			}
		

	}else if ($_POST['accion_gmate']=="modificar") {

		$idtb_materia = $_POST['id_mate'];
$mate_cod = $_POST['mate_cod'];
	$mate_nombre = $_POST['mate_nombre'];

	$mate_descripcion = $_POST['mate_descripcion'];

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //realizamos una consulta para verificar q no exista o se repita un dato
	$sql = "SELECT * FROM tb_materia  where mate_nombre='$mate_nombre' ";
		$datoss = $conn->query($sql);
	

			if ($datoss->rowcount()) {

				$stmt = "UPDATE tb_materia SET  cod_materia='$mate_cod', mate_descripcion='$mate_descripcion' WHERE idtb_materia = ".$idtb_materia;
				
				if ($conn->query($stmt)){ 
					echo "modificado_existe";
				}else{ 

					echo "Error";
				}

			}else{


				$stmt = "UPDATE tb_materia SET  cod_materia='$mate_cod',mate_nombre='$mate_nombre',mate_descripcion='$mate_descripcion' WHERE idtb_materia = ".$idtb_materia;
				
				if ($conn->query($stmt)){ 
					echo "modificado";
				}else{ 

					echo "Error";
				}


			
		}
		
		
	}else if ($_POST['accion_gmate']=="eliminar"){
	$idtb_materia = $_POST['id_mate'];
		//Query de leiminacion delete
		$sql = "DELETE FROM tb_materia WHERE idtb_materia = ".$idtb_materia;

		if ($conn->query($sql)) {
			echo "Materia_del";
		}else
		{
			echo "Error";
		}
	}else
	{
		echo "Error";
	}
}



?>