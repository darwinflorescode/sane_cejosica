<?php 


if (isset($_GET['idmatricula'])) {
	# code...

	//Captura con variables que vienen del el login. para comproar el usuario
$id= $_GET['idmatricula'];


$titulo = ' COMPROBANTE DE INSCRIPCIÓN DE ALUMNO/A';
$img ='';

$html='';
 include 'encabezado.php';


	//Exception de error de pdo
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	//Consulta Donde se comprueba  que el usuario existe
$sql = "SELECT tb_matricula.*, tb_estudiante.* ,tb_seccion.* FROM tb_matricula inner join tb_estudiante ON tb_matricula.matri_idestudiante = tb_estudiante.idestudiante INNER JOIN tb_seccion ON tb_matricula.matri_idtb_seccion = tb_seccion.idtb_seccion WHERE tb_matricula.idtb_matricula=$id";
			//Ejecuta ala consulta
$datos = $conn->query($sql);

if ($datos->rowcount()) {

	$imprimirdatos = $datos->fetch(PDO::FETCH_ASSOC);
	$servicio = $imprimirdatos['sec_servicio_ed'];
	$identificador = $imprimirdatos['sec_identificador'];
	$turno = $imprimirdatos['sec_turno'];
	$tipo = $imprimirdatos['sec_tipo_seccion'];
	$dat = new DateTime($imprimirdatos['est_fecha_nace']);

$html .= '<p style="text-align: left;"><span style="font-size: 12px;"><strong>
			&nbsp;*&nbsp;Alumno/a correctamente matriculado</strong></span></p>
			<fieldset class="scheduler-border">
	<legend class="scheduler-border">DATOS PERSONALES</legend>
	<br>
	<table style="width: 100%;  font-size: 11px;    text-transform: uppercase;" >
	<tbody>';

	$html.= '<tr height="12%"> ';
	$html.= '<td width="10%"><strong>NIE</strong></td>';
	$html.='<td><strong>:</strong>&nbsp;'.$imprimirdatos['est_nie'].'</td>';

	if ($imprimirdatos['est_foto']!=null && file_exists($imprimirdatos['est_foto'])) {
		$fotografia = $imprimirdatos['est_foto'];
	}else{
		$fotografia ='../librerias/estudiante.jpg';
	}

	$html.= "<td rowspan='9' align='right'><img class='img-thumbnail' src='".$fotografia."' width='100px' height='125px' '></td>";
	$html.= '</tr>';
	$html.= '<tr>';
	$html.= '<td width="30%"><strong>NOMBRES</strong></td>';
	$html.='<td><strong>:</strong>&nbsp;'.$imprimirdatos['est_nombre'].'</td>';

	$html.= '</tr>';
	$html.= '<tr>';
	$html.= '<td width="30%"><strong>APELLIDOS</strong></td>';
	$html.='<td><strong>:</strong>&nbsp;'.$imprimirdatos['est_apellido'].'</td>';

	$html.= '</tr>';
	$html.= '<tr>';
	$html.= '<td width="30%"><strong>SEXO</strong></td>';
	$html.='<td><strong>:</strong>&nbsp;'.$imprimirdatos['est_sexo'].'</td>';

	$html.= '</tr>';

	$html.= '<tr>';
	$html.= '<td width="30%"><strong>ESTADO CIVIL</strong></td>';
	$html.='<td><strong>:</strong>&nbsp;'.$imprimirdatos['est_estado_civil'].'/A</td>';

	$html.= '</tr>';
	$html.= '<tr>';
	$html.= '<td width="30%"><strong>FECHA DE NACIMIENTO</strong></td>';
	$html.='<td><strong>:</strong>&nbsp;'.$dat->format('d-m-Y').'</td>';

	$html.= '<tr>';
	$html.= '<td width="30%"><strong>EDAD</strong></td>';
	$html.='<td><strong>:</strong>&nbsp;'.$imprimirdatos['est_edad'].' AÑOS</td>';

	$html.= '</tr>';
	$html.= '</tr>';

	$html.= '<tr>';
	$html.= '<td width="30%"><strong>DUI</strong></td>';
	$html.='<td><strong>:</strong>&nbsp;'.$imprimirdatos['est_dui'].'</td>';

	$html.= '</tr>';

	$html.= '<tr>';
	$html.= '<td width="30%"><strong>PRESENTÓ PARTIDA DE NACIMIENTO</strong></td>';
	$html.='<td><strong>:</strong>&nbsp;'.$imprimirdatos['est_partida'].'</td>';

	$html.= '</tr>';
	$html.='</tbody>
	</table></fieldset>
<fieldset class="scheduler-border">
<legend class="scheduler-border">DATOS DE SECCIÓN DE MATRÍCULA</legend><br>
	<table style="width: 100%;  font-size: 12px; text-transform:Uppercase;" >
		<tbody>
			
			<tr style="height: 100%;">
				<td style="width: 30%;"  ><strong>SERVICIO EDUCATIVO</strong></td>
				<td><strong>:</strong>&nbsp;';


				if ($servicio==-1) {
												$html .="Parvularia 6 Años";
												$nivel = "Parvularia 6 Años";
											}else if ($servicio==-2) {
												$html .="Parvularia 5 Años";
												$nivel = "Parvularia 6 Añ;os";
											}else if ($servicio==-3) {
												$html .="Parvularia 4 Años";
												$nivel="Parvularia 4 Años";
											}else{
												$html .= $servicio."° Grado";
												$nivel = $servicio."° Grado";
											}
											$html .= " \"".$identificador."\"";
											$html.='</td>';
			$html.='</tr>

<tr style="height: 12px;">
				<td ><strong>TIPO SECCIÓN</strong></td>
				<td><strong>:</strong>&nbsp;'.$tipo.'</td>

			</tr>
			<tr style="height: 12px;">
				<td ><strong>TURNO</strong></td>
				<td><strong>:</strong>&nbsp;'.$turno.'</td>

			</tr>
			<tr style="height: 12px;" >
				<td  ><strong>AÑO</strong></td>
				<td><strong>:</strong>&nbsp;';
				$html.=$_SESSION['anio_escolar'].'</td>

			</tr>
		</tbody>
	</table></fieldset>';
include 'pie.php';
$html .='</body>
</html>';

$dompdf->set_paper("Letter");
$html=utf8_decode(utf8_encode($html));
// load the html content
$dompdf->load_html($html);
$dompdf->render();

$dompdf->stream("Comprobante de Matrícula en ".$nivel." ".$fecha.".pdf",array("Attachment"=>0));

}else{
	echo '<div class="alert alert-danger alert-dismissable" align="center">
		
		<h4>¡Aviso!</h4>No existe la seccion que buscas
		</div>';
}

}else{

	echo '<div class="alert alert-danger alert-dismissable" align="center">
		
		<h4>¡Aviso!</h4>No hay estudiantes matriculados en esta sección
		</div>';
}
?>


