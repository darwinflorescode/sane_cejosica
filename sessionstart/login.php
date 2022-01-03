<?php 
session_start();
if (isset($_POST['accion'])) {
	//Archivo donde se encuentra la conexion de la DB para hacer el puente
	require'../conexionpdo/config.php';
	//Variable que almacena la conexion
	$conn = conexion();


	//Captura con variables que vienen del el login. para comproar el usuario
	$usuario= addslashes($_POST['user1']);
	$clave= addslashes($_POST['pass1']);


	//Exception de error de pdo
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	//Consulta Donde se comprueba  que el usuario existe
	$sql = "SELECT tb_usuario.*, tb_tipo_usuario.* from tb_usuario inner JOIN tb_tipo_usuario on tb_usuario.user_idtb_tipo_usuario = tb_tipo_usuario.idtb_tipo_usuario  where (user_email='$usuario' or user_usuario='$usuario') and user_clave=md5('$clave');";
			//Ejecuta ala consulta
			$datos = $conn->query($sql);

			if ($datos->rowcount()) {
					
					$user = $datos->fetch(PDO::FETCH_ASSOC);
					$estado = $user['user_estado'];
					$idt = $user['user_idtb_tipo_usuario'];
					$nombre_completo = $user['user_nombre'] . " " .$user['user_apellido'];
					$nombretipo = $user['nombre'];
					$idtb_usuario = $user['idtb_usuario'];
					if ($estado=="Activo") {
						//Guarda la session en las siguientes variables
					//Session del nombre usuario
					$_SESSION["user_session"]=$usuario;
					//session de la contraseña correcta ingresada
			          $_SESSION["pass_session"]=$clave;
			          $_SESSION["id_tipo"]=$idt;
			          $_SESSION["anio_escolar"]=0;
			          $_SESSION["nom_completo"]=$nombre_completo;
			          $_SESSION["tipo_user"] = $nombretipo;
			 		  $_SESSION["idtb_usuario_ingreso"] = $idtb_usuario;
			          //Ok para verificar si ha iniciado session correctamnte y usarlo para verificar redireccinar al index
					$_SESSION["ok"]=1;
					// redirecciona al menu .
					echo "Ok";
				
					}else{
						echo "userDesact";
					}


				}else
				{
					echo "Error";
				}
			
}else if (isset($_POST['accion_anio']))
{
	if ($_POST['accion_anio']==1) {
		$anio_es= addslashes($_POST['anio_cambio']);
		echo "anio_cambio";
	}else{
		$anio_es= addslashes($_POST['anio']);
		echo "anio_exito";
	}

	
	$_SESSION["anio_escolar"]=$anio_es;
	
}else
{
	echo "error";
}

 ?>