<?php 
include_once('../conexionpdo/config.php');
$conn = conexion();
$idtb_seccion = $_POST['id_secciones'];

	//Consulta Donde se comprueba  que el usuario existe
$sqls = "SELECT * FROM tb_seccion where idtb_seccion=".$idtb_seccion;
			//Ejecuta ala consulta
$datos = $conn->query($sqls);
$secc = $datos->fetch(PDO::FETCH_ASSOC);
$servicio_ed = $secc['sec_servicio_ed'];

$sql = "SELECT tb_seccion_materia.*,tb_materia.*,tb_seccion.* FROM `tb_seccion_materia` inner join tb_materia on tb_seccion_materia.sec_mate_idtb_materia = tb_materia.idtb_materia inner join tb_seccion on tb_seccion_materia.sec_mate_idtb_seccion = tb_seccion.idtb_seccion
where tb_seccion.sec_nivel='$servicio_ed' or tb_seccion.sec_servicio_ed='$servicio_ed' GROUP by tb_materia.mate_nombre order by tb_materia.mate_nombre asc";

$result = $conn->query($sql);

$rows = $result->fetchAll();

if ($result->rowcount()) {

	foreach ($rows as $row) { 


		$html .= '<option value="'.$row['sec_mate_idtb_materia'].'">'."[".$row['cod_materia'].'] - '.$row['mate_nombre'].'</option>';
	}


}else{
	$html .= '<option value="0">[Seleccione...]</option>';
}
echo $html;
?>

