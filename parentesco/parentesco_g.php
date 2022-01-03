<?php 
//Archivo donde se encuentra la conexion de la DB para hacer el puente
require'../conexionpdo/config.php';
	//Variable que almacena la conexion
session_start();
$conn = conexion();
if (isset($_POST['accion_gparent'])) {


	if ($_POST['accion_gparent']=="guardar") {
		
	$parent_nombre = $_POST['parent_nombre'];

	$parent_dui = $_POST['parent_dui'];

	$parent_telefono = $_POST['parent_telefono'];

	$parent_trabajo = $_POST['parent_trabajo'];

	$parent_direccion = $_POST['parent_direccion'];
		
		



		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //realizamos una consulta para verificar q no exista o se repita un dato
		$sql = "SELECT * FROM tb_parentesco  where parent_dui='$parent_dui'";
		$datos = $conn->query($sql);
	

			if ($datos->rowcount()) {

				echo "Existe_parentesco";

			}else{


				$stmt = "INSERT INTO  tb_parentesco (parent_nombre,parent_dui,parent_telefono,parent_trabajo,parent_direccion) VALUES ('$parent_nombre','$parent_dui','$parent_telefono','$parent_trabajo','$parent_direccion')";

				
				if ($conn->query($stmt)){ 
					echo "guardado";
				}else{ 

					echo "Error";
				}


			}
		

	}else if ($_POST['accion_gparent']=="modificar") {

	$id_parentesco = $_POST['id_parentesco'];

	$parent_nombre = $_POST['parent_nombre'];

	$parent_dui = $_POST['parent_dui'];

	$parent_telefono = $_POST['parent_telefono'];

	$parent_trabajo = $_POST['parent_trabajo'];
	
	$parent_direccion = $_POST['parent_direccion'];

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //realizamos una consulta para verificar q no exista o se repita un dato
	$sql = "SELECT * FROM tb_parentesco  where parent_dui='$parent_dui' ";
		$datoss = $conn->query($sql);
	

			if ($datoss->rowcount()) {

				$stmt = "UPDATE tb_parentesco SET parent_nombre='$parent_nombre',parent_telefono='$parent_telefono',parent_trabajo='$parent_trabajo',parent_direccion='$parent_direccion' WHERE idtb_parentesco = ".$id_parentesco;
				
				if ($conn->query($stmt)){ 
					echo "modificado_existe";
				}else{ 

					echo "Error";
				}

			}else{


				$stmt = "UPDATE tb_parentesco SET parent_nombre='$parent_nombre',parent_dui='$parent_dui',parent_telefono='$parent_telefono',parent_trabajo='$parent_trabajo',parent_direccion='$parent_direccion' WHERE idtb_parentesco = ".$id_parentesco;
				
				if ($conn->query($stmt)){ 
					echo "modificado";
				}else{ 

					echo "Error";
				}


			
		}
		
		
	}else if ($_POST['accion_gparent']=="eliminar"){
	$id_parentesco= $_POST['idtb_parentesco'];
		//Query de leiminacion delete
		$sql = "DELETE FROM tb_parentesco WHERE idtb_parentesco = ".$id_parentesco;

		if ($conn->query($sql)) {
			echo "Parentesco_del";
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