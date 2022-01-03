<?php 
//Archivo donde se encuentra la conexion de la DB para hacer el puente
require'../conexionpdo/config.php';
	//Variable que almacena la conexion
session_start();
$conn = conexion();
if (isset($_POST['accion_guser'])) {


	if ($_POST['accion_guser']=="guardar") {
		
	$user_nombre = $_POST['user_nombre'];

	$user_apellido = $_POST['user_apellido'];

	$user_dui = $_POST['user_dui'];

	$user_nit = $_POST['user_nit'];

	$user_telefono = $_POST['user_telefono'];

	$user_profesion = $_POST['user_profesion'];

	$user_email = $_POST['user_email'];

	$user_usuario = $_POST['user_usuario'];

	$user_contra=md5($_POST['user_contra']);

	$user_estado = $_POST['user_estado'];

	$user_tipo = $_POST['user_tipo'];

		
		



		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //realizamos una consulta para verificar q no exista o se repita un dato
		$sql = "SELECT * FROM tb_usuario  where user_dui='$user_dui' and user_nit='user_nit'";
		$datos = $conn->query($sql);
	
			if ($datos->rowcount()) {

				echo "Existe_usuario";

			}else{


				$stmt = "INSERT INTO tb_usuario (user_nombre,user_apellido,user_dui,user_nit,user_telefono,user_profesion,user_email,user_usuario,user_clave,user_estado,user_fecha_registro,user_idtb_tipo_usuario) VALUES ('$user_nombre','$user_apellido','$user_dui','$user_nit','$user_telefono','$user_profesion','$user_email','$user_usuario','$user_contra','$user_estado',now(),'$user_tipo')";

				
				if ($conn->query($stmt)){ 
					echo "guardado";
				}else{ 

					echo "Error";
				}


			}
		

	}else if ($_POST['accion_guser']=="modificar") {
	$idtb_usuario = $_POST['idtb_usuario'];	

	$user_nombre = $_POST['user_nombre'];

	$user_apellido = $_POST['user_apellido'];

	$user_dui = $_POST['user_dui'];

	$user_nit = $_POST['user_nit'];

	$user_telefono = $_POST['user_telefono'];

	$user_profesion = $_POST['user_profesion'];


	$user_email = $_POST['user_email'];

	$user_usuario = $_POST['user_usuario'];

	
	$user_contra=$_POST['user_contra'];

	$user_estado = $_POST['user_estado'];

	$user_tipo = $_POST['user_tipo'];
		
		


//Sacar contraseña
		$sqll = "SELECT * FROM tb_usuario where idtb_usuario=$idtb_usuario ";

	$result = $conn->query($sqll);
	$contra = $result->fetch(PDO::FETCH_ASSOC);
	$user_pass = $contra['user_clave'];

if ($user_contra==$user_pass) {
	$new_pass = $user_contra;
}else{
	$new_pass = md5($user_contra);
}

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //realizamos una consulta para verificar q no exista o se repita un dato
	$sql = "SELECT * FROM tb_usuario  where user_dui='$user_dui' and user_nit='user_nit'";
		$datoss = $conn->query($sql);
	

			if ($datoss->rowcount()) {

				
				$stmt = "UPDATE tb_usuario SET user_nombre='$user_nombre',user_apellido='$user_apellido',user_dui='$user_dui',user_nit='$user_nit',user_telefono='$user_telefono',user_profesion='$user_profesion',user_email='$user_email',user_usuario='$user_usuario',user_clave='$new_pass',user_estado='$user_estado',user_idtb_tipo_usuario='$user_tipo' WHERE idtb_usuario = ".$idtb_usuario;
				
				if ($conn->query($stmt)){ 
					echo "modificado_existe";
				}else{ 

					echo "Error";
				}

			}else{


				$stmt = "UPDATE tb_usuario SET user_nombre='$user_nombre',user_apellido='$user_apellido',user_dui='$user_dui',user_nit='$user_nit',user_telefono='$user_telefono',user_profesion='$user_profesion',user_email='$user_email',user_usuario='$user_usuario',user_clave='$new_pass',user_estado='$user_estado',user_idtb_tipo_usuario='$user_tipo' WHERE idtb_usuario = ".$idtb_usuario;
				
				if ($conn->query($stmt)){ 
					echo "modificado";
				}else{ 

					echo "Error";
				}


			
		}
		
		
	}else if ($_POST['accion_guser']=="eliminar"){
	$idtb_usuario= $_POST['idtb_usuario'];
		//Query de leiminacion delete
		$sql = "DELETE FROM tb_usuario WHERE idtb_usuario = ".$idtb_usuario;

		if ($conn->query($sql)) {
			echo "usuario_del";
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