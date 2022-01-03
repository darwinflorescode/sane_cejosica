<?php 
//Archivo donde se encuentra la conexion de la DB para hacer el puente
require'../conexionpdo/config.php';
	//Variable que almacena la conexion
session_start();
$conn = conexion();

if (isset($_GET['action'])) {
	$idest = $_GET['idest'];
	$idfam = $_GET['idfam'];
	$idparent = $_GET['idparent'];
	$idrespon = $_GET['idrespon'];

	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //realizamos una consulta para verificar q no exista o se repita un dato
	$sql = "SELECT * FROM tb_parentesco_estudiante  where   tb_estudiante_id = '$idest' and ((tb_tipo='Mamá' or tb_tipo='Papá') and tb_tipo='$idparent')";
	$datos = $conn->query($sql);


	if ($datos->rowcount()) {

		echo "Existe_fam_p";

	}else{

   //realizamos una consulta para verificar q no exista o se repita un dato
	$sql = "SELECT * FROM tb_parentesco_estudiante  where   tb_parentesco_id = '$idfam' and tb_estudiante_id ='$idest'";
	$datos = $conn->query($sql);



	if ($datos->rowcount()) {

		echo "Existe_fam";

	}else{

 //realizamos una consulta para verificar q no exista o se repita un dato
	$sql = "SELECT * FROM tb_parentesco_estudiante  where tb_responsable='$idrespon' and tb_estudiante_id ='$idest'";
	$datos = $conn->query($sql);
	$student = $datos->fetch(PDO::FETCH_ASSOC);


	if ($student['tb_responsable'] == 'SI') {

		echo "Responsable";

	}else{

		$stmt = "INSERT INTO tb_parentesco_estudiante(tb_parentesco_id,tb_estudiante_id,tb_tipo,tb_responsable) VALUES('$idfam','$idest','$idparent','$idrespon');";

			
			if ($conn->query($stmt)){ 
				echo "Guardado";
			}else{ 

				echo "Error";
			}
}
		}

	

	}
}


if (isset($_GET['actionn'])) {
	$id = $_GET['id'];
		//Query de leiminacion delete
		$sql = "DELETE FROM tb_parentesco_estudiante WHERE tbid_parent_est = ".$id;

		if ($conn->query($sql)) {
			echo "del";
		}else
		{
			echo "Error";
		}
}


?>