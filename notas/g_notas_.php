<?php 
//Archivo donde se encuentra la conexion de la DB para hacer el puente
require'../conexionpdo/config.php';
	//Variable que almacena la conexion
session_start();
$conn = conexion();

if (isset($_POST['accion_nota'])) {
	
	if ($_POST['accion_nota']=="updateNotes") {
		
		$cont = $_POST['contador_'];
		$i  = 1;
		$bandera = 1;
		for ($i=1; $i <=$cont ; $i++) { 

			$idmatricula = $_POST['idmatricula'.$i];
			$idmateria= $_POST['idasignatura'.$i];

			$nota1p11 = $_POST['nota1p1'.$i];
			$nota2p11 = $_POST['nota2p1'.$i];
			$nota3p11 = $_POST['nota3p1'.$i];

			$promedio11 = number_format((($nota1p11*0.35)+($nota2p11*0.35)+ ($nota3p11*0.30)),1);

			$nota1p12 = $_POST['nota1p2'.$i];
			$nota2p12 = $_POST['nota2p2'.$i];
			$nota3p12 = $_POST['nota3p2'.$i];

			$promedio21 = number_format((($nota1p12*0.35)+($nota2p12*0.35)+ ($nota3p12*0.30)),1);


			$nota1p13 = $_POST['nota1p3'.$i];
			$nota2p13 = $_POST['nota2p3'.$i];
			$nota3p13 = $_POST['nota3p3'.$i];

			$promedio31 = number_format((($nota1p13*0.35)+($nota2p13*0.35)+ ($nota3p13*0.30)),1);

			$promediof1 = number_format((($promedio11) + ($promedio21) + ($promedio31)) / 3,1);

			$sql = "UPDATE `tb_nota` SET `not_p1_act1` = '$nota1p11', `not_p1_act2` = '$nota2p11', `not_p1_act3` = '$nota3p11', `not_p1_promuno` = '$promedio11', `not_p2_act1` = '$nota1p12', `not_p2_act2` = '$nota2p12', `not_p2_act3` = '$nota3p12', `not_p2_prom2` = '$promedio21', `not_p3_act1` = '$nota1p13', `not_p3_act2` = '$nota2p13', `not_p3_act3` = '$nota3p13', `not_p3_prom3` = '$promedio31', `nota_prom_final` = '$promediof1' WHERE `tb_nota`.`not_idtb_materia` = $idmateria AND `tb_nota`.`not_idtb_matricula` = $idmatricula";

			if ($conn->query($sql)){ 
				$bandera = 1;
					

				}else{ 

					$bandera = 0;
					break;
					
				}

	}

	if ($bandera == 1) {
		echo "modificado_n";
	}else{
		echo "error_n";
	}

	}else{
		echo "Error";
	}

}else{
	echo "Error";
}



 ?>