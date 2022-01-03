<?php 
//Archivo donde se encuentra la conexion de la DB para hacer el puente
require'../conexionpdo/config.php';
	//Variable que almacena la conexion
session_start();
$conn = conexion();
if (isset($_POST['accion_ga'])) {


	if ($_POST['accion_ga']=="add") {
		

		$mate_id= $_POST['idtb_materia'];
		$mate_nivel = $_POST['nivel'];
		if ($_POST['nivel']>'0') {
			$campo='tb_seccion.sec_nivel';

		}else {
			$campo='tb_seccion.sec_servicio_ed';
		}
		


		



		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //realizamos una consulta para verificar q no exista o se repita un dato
		$sql = "SELECT tb_seccion_materia.*,tb_seccion.*,tb_materia.* FROM `tb_seccion_materia` inner join tb_seccion on tb_seccion_materia.sec_mate_idtb_seccion=tb_seccion.idtb_seccion inner join tb_materia ON tb_seccion_materia.sec_mate_idtb_materia = tb_materia.idtb_materia where $campo='$mate_nivel' and tb_materia.idtb_materia='$mate_id'";
		$datos = $conn->query($sql);


		if ($datos->rowcount()) {

			echo "Existe";

		}else{


			$sql = "SELECT * from tb_seccion where $campo ='$mate_nivel'";

			$result = $conn->query($sql);

			$rows = $result->fetchAll();

			if ($result->rowcount()) {


				foreach ($rows as $row) { 


					$sqll = "INSERT INTO tb_seccion_materia(sec_mate_idtb_seccion,sec_mate_idtb_materia) VALUES(".$row['idtb_seccion'].",$mate_id)";
					$conn->query($sqll);
				}
				echo "guardado";



			}else{ 

				echo "Error_existe";
			}


		}



	}else if ($_POST['accion_ga']=="del") {

		$idtb_materia = $_POST['idtb_materia'];
		$nivel = $_POST['nivel'];
		


		$sqll="SELECT tb_seccion_materia.*,tb_materia.*,tb_seccion.* FROM `tb_seccion_materia` inner join tb_materia on tb_seccion_materia.sec_mate_idtb_materia = tb_materia.idtb_materia inner join tb_seccion on tb_seccion_materia.sec_mate_idtb_seccion = tb_seccion.idtb_seccion where (tb_seccion.sec_nivel='$nivel' or tb_seccion.sec_servicio_ed='$nivel') and tb_materia.idtb_materia=".$idtb_materia;

		$result = $conn->query($sqll);

		$rows = $result->fetchAll();

		if ($result->rowcount()) {


			foreach ($rows as $row) { 
				//Query de leiminacion delete
			$sql = "DELETE FROM tb_seccion_materia WHERE sec_mate_id = ".$row['sec_mate_id'];

			if ($conn->query($sql)) {
				
			}

			}
			echo "Materia_del";
		}else{
			echo "Error_del";
		}


		
		}


// 	SELECT tb_seccion_materia.*,tb_materia.*,tb_seccion.* FROM `tb_seccion_materia` inner join tb_materia on tb_seccion_materia.sec_mate_idtb_materia = tb_materia.idtb_materia inner join tb_seccion on tb_seccion_materia.sec_mate_idtb_seccion = tb_seccion.idtb_seccion
// where (tb_seccion.sec_nivel='-3' or tb_seccion.sec_servicio_ed='-3') and tb_materia.idtb_materia=10
	}



	?>