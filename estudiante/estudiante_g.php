<?php 
//Archivo donde se encuentra la conexion de la DB para hacer el puente
require'../conexionpdo/config.php';
	//Variable que almacena la conexion
session_start();
$conn = conexion();
if (isset($_POST['accion_gest'])) {


	if ($_POST['accion_gest']=="guardar") {
		
		$est_nie = $_POST['est_nie'];

		$est_nombre = $_POST['est_nombre'];

		$est_apellido = $_POST['est_apellido'];

		$est_sexo = $_POST['est_sexo'];

		$est_estado_civil = $_POST['est_estado_civil'];

		$est_fecha_nace = $_POST['est_fecha_nace'];


		$est_partida = $_POST['est_partida'];

		$est_dui = $_POST['est_dui'];

		$est_direccion = $_POST['est_direccion'];

		$est_transporte = $_POST['est_transporte'];

		$est_anio_ult = $_POST['est_anio_ult'];

		$est_convivencia = $_POST['est_convivencia'];

		$est_discapacidad = $_POST['est_discapacidad'];

		$est_economica = $_POST['est_economica'];

		$est_estado = $_POST['est_estado'];

		$edad_ = new DateTime($est_fecha_nace);
		$hoy =  new DateTime();
		$anios_ = $hoy->diff($edad_);
		$edad = $anios_->y;
		
		$url  ="";

		if ($_FILES['est_foto']['name']!=null) {
	# code...

	//Consulta Donde se comprueba  que el usuario existe
			$sql = "SELECT max(idestudiante) as ultimo FROM tb_estudiante;";
			//Ejecuta ala consulta
			$datos = $conn->query($sql);

			
			$estud = $datos->fetch(PDO::FETCH_ASSOC);
			$idest = $estud['ultimo']+1;

			$type=explode('.', $_FILES['est_foto']['name']);

			$type=$type[count($type)-1];

			$url='../fotos/'.$idest.'.'.$type;
			if (in_array($type,array('jpg','gif','png','jpeg','JPG','PNG','GIF','JPEG'))) 
			{
				if (is_uploaded_file($_FILES['est_foto']['tmp_name'])) {
					if(move_uploaded_file($_FILES['est_foto']['tmp_name'],$url)){

					}
					
				}else{
					echo "errorimg";
					exit();
				}


			}else
			{
				echo "tipoImg";
				exit();

			}
		}
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //realizamos una consulta para verificar q no exista o se repita un dato
		$sql = "SELECT * FROM tb_estudiante  where est_nie='$est_nie'";
		$datos = $conn->query($sql);

		
		if ($datos->rowcount()) {

			echo "Existe_estudiante";

		}else{


			$stmt = "INSERT INTO tb_estudiante (est_nie,est_nombre,est_apellido,est_sexo,est_foto,est_estado_civil,est_fecha_nace,est_edad,est_partida,est_dui,est_direccion,est_transporte,est_anio_ult,est_convivencia,est_discapacidad,est_dp_economica,est_fecha_registro,est_estado) VALUES ('$est_nie','$est_nombre','$est_apellido','$est_sexo','$url','$est_estado_civil','$est_fecha_nace','$edad','$est_partida','$est_dui','$est_direccion','$est_transporte',$est_anio_ult,'$est_convivencia','$est_discapacidad','$est_economica',now(),'$est_estado')";

			
			if ($conn->query($stmt)){ 
				echo "guardado";
			}else{ 

				echo "Error";
			}


		}
		

	}else if ($_POST['accion_gest']=="modificar") {
		$id_estudiante = $_POST['id_estudiante'];

		$est_nie = $_POST['est_nie'];

		$est_nombre = $_POST['est_nombre'];

		$est_apellido = $_POST['est_apellido'];

		$est_sexo = $_POST['est_sexo'];

		$est_estado_civil = $_POST['est_estado_civil'];

		$est_fecha_nace = $_POST['est_fecha_nace'];


		$est_partida = $_POST['est_partida'];

		$est_dui = $_POST['est_dui'];

		$est_direccion = $_POST['est_direccion'];

		$est_transporte = $_POST['est_transporte'];

		
		$est_anio_ult = $_POST['est_anio_ult'];

		$est_convivencia = $_POST['est_convivencia'];

		$est_discapacidad = $_POST['est_discapacidad'];

		$est_economica = $_POST['est_economica'];

		$est_estado = $_POST['est_estado'];
		$edad_ = new DateTime($est_fecha_nace);
		$hoy =  new DateTime();
		$anios_ = $hoy->diff($edad_);
		$edad = $anios_->y;
		$url  ="";

		if ($_FILES['est_foto']['name']!=null) {
			

			$type=explode('.', $_FILES['est_foto']['name']);

			$type=$type[count($type)-1];

			$url='../fotos/'.$id_estudiante.'.'.$type;
			



			if (file_exists($url)) {
				unlink($url);
			}

			$foto = "est_foto='$url',";

			
			if (in_array($type,array('jpg','gif','png','jpeg','JPG','PNG','GIF','JPEG'))) 
			{
				if (is_uploaded_file($_FILES['est_foto']['tmp_name'])) {
					if(move_uploaded_file($_FILES['est_foto']['tmp_name'],$url)){
						
					}
					
				}else{
					echo "errorimg";
					exit();
				}


			}else
			{
				echo "tipoImg";
				exit();

			}
		}else{
			$foto = "";
		}


		

		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //realizamos una consulta para verificar q no exista o se repita un dato
		$sql = "SELECT * FROM tb_estudiante  where est_nie='$est_nie' and est_dui = '$est_dui'";
		$datoss = $conn->query($sql);
		

		if ($datoss->rowcount()) {

			$stmt = "UPDATE tb_estudiante SET est_nombre='$est_nombre',est_apellido='$est_apellido',est_sexo='$est_sexo',".$foto."est_estado_civil='$est_estado_civil',est_fecha_nace='$est_fecha_nace',est_edad='$edad',est_partida='$est_partida',est_dui='$est_dui',est_direccion='$est_direccion',est_transporte='$est_transporte',est_anio_ult='$est_anio_ult',est_convivencia='$est_convivencia',est_discapacidad='$est_discapacidad',est_dp_economica='$est_economica',est_estado='$est_estado' WHERE idestudiante = ".$id_estudiante;
			
			if ($conn->query($stmt)){ 
				echo "modificado_existe";
			}else{ 

				echo "Error";
			}

		}else{


			$stmt = "UPDATE tb_estudiante SET est_nie='$est_nie',est_nombre='$est_nombre',est_apellido='$est_apellido',est_sexo='$est_sexo',".$foto."est_estado_civil='$est_estado_civil',est_fecha_nace='$est_fecha_nace',est_edad='$edad',est_partida='$est_partida',est_dui='$est_dui',est_direccion='$est_direccion',est_transporte='$est_transporte',est_anio_ult='$est_anio_ult',est_convivencia='$est_convivencia',est_discapacidad='$est_discapacidad',est_dp_economica='$est_economica',est_estado='$est_estado' WHERE idestudiante = ".$id_estudiante;
			
			if ($conn->query($stmt)){ 
				echo "modificado";
			}else{ 

				echo "Error";
			}


			
		}
		
		
	}else if ($_POST['accion_gest']=="eliminar"){
		$idestudiante= $_POST['idestudiante'];
		$sqld = "SELECT * FROM tb_estudiante where idestudiante=$idestudiante ";

		$result = $conn->query($sqld);

		$img = $result->fetch(PDO::FETCH_ASSOC);
		$foto = $img['est_foto'];


		//Query de leiminacion delete
		$sql = "DELETE FROM tb_estudiante WHERE idestudiante = ".$idestudiante;

		if ($conn->query($sql)) {
			if (file_exists($foto)) {
				unlink($foto);
			}

			echo "estudiante_del";
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