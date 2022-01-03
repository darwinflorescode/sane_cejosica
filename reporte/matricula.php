<?php


if (isset($_GET['idseccion'])) {
	# code...

	//Captura con variables que vienen del el login. para comproar el usuario
	$id = $_GET['idseccion'];


	$titulo = 'MATRÍCULA OFICIAL DE ALUMNOS/AS';
	$img = '';

	$html = '';
	include 'encabezado.php';
	include '../perfil/permiso.php';

	//Exception de error de pdo
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	//Consulta Donde se comprueba  que el usuario existe
	$sql = "SELECT  tb_seccion.*,tb_anio_escolar.* FROM tb_seccion inner join tb_anio_escolar on  tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar where tb_anio_escolar.anio=" . $_SESSION['anio_escolar'] . " and idtb_seccion = " . $id;
	//Ejecuta ala consulta
	$datos = $conn->query($sql);

	if ($datos->rowcount()) {

		$seccion = $datos->fetch(PDO::FETCH_ASSOC);
		$servicio = $seccion['sec_servicio_ed'];
		$turno = $seccion['sec_turno'];
		$identificador = $seccion['sec_identificador'];
		$tipo = $seccion['sec_tipo_seccion'];



		$html .= '<p style="text-align: left;"><span style="font-size: 12px;"><strong>
			&nbsp;*&nbsp;N&oacute;mina de alumnos que han cumplido con la documentaci&oacute;n requerida y que se procesara a matricularlo oficialmente</strong></span></p><br>
<fieldset class="scheduler-border">
<legend class="scheduler-border">DATOS DE SECCIÓN</legend><br>
	<table style="width: 100%;  font-size: 12px; text-transform:Uppercase;" >
		<tbody>
			
			<tr style="height: 100%;">
				<td style="width: 20%;"  ><strong>SERVICIO EDUCATIVO</strong></td>
				<td><strong>:</strong>&nbsp;';


		if ($servicio == -1) {
			$html .= "Parvularia 6 Años";
			$nivel = "Parvularia 6 Años";
		} else if ($servicio == -2) {
			$html .= "Parvularia 5 Años";
			$nivel = "Parvularia 6 Añ;os";
		} else if ($servicio == -3) {
			$html .= "Parvularia 4 Años";
			$nivel = "Parvularia 4 Años";
		} else {
			$html .= $servicio . "° Grado";
			$nivel = $servicio . "° Grado";
		}
		$html .= " \"" . $identificador . "\"";
		$html .= '</td>';
		$html .= '</tr>

<tr style="height: 12px;">
				<td ><strong>TIPO SECCIÓN</strong></td>
				<td><strong>:</strong>&nbsp;' . $tipo . '</td>

			</tr>
			<tr style="height: 12px;">
				<td ><strong>TURNO</strong></td>
				<td><strong>:</strong>&nbsp;' . $turno . '</td>

			</tr>
			<tr style="height: 12px;" >
				<td  ><strong>AÑO</strong></td>
				<td><strong>:</strong>&nbsp;';
		$html .= $_SESSION['anio_escolar'] . '</td>

			</tr>
		</tbody>
	</table></fieldset>
	<table id="usuarios">

		<thead>
			<tr class="">
				<th>N°</th>
				<th>NIE</th>
				<th>Nombre Alumno(a)</th>
				<th>Sexo</th>
				<th>Fecha Nacimiento</th>
				<th>Partida</th>
				<th>Observaciones</th>
			</tr>
		</thead>
		<tbody>'; //Consulta Donde se comprueba  que el usuario existe
		$sql = "SELECT tb_matricula.*, tb_estudiante.* FROM tb_matricula inner join tb_estudiante on tb_matricula.matri_idestudiante = tb_estudiante.idestudiante where matri_idtb_seccion = " . $id . " order by est_apellido asc";
		//Ejecuta ala consulta
		$datos = $conn->query($sql);


		$rows = $datos->fetchAll();
		$i = 1;
		$m = 0;
		$f = 0;

		if ($datos->rowcount()) {
			# code...

			foreach ($rows as $row) {
				if ($row['est_sexo'] == "Masculino") {
					$m++;
				} else {
					$f++;
				}
				$dat = new DateTime($row['est_fecha_nace']);

				$html .= '<tr>';
				$html .= '<td>' . $i . '</td>';
				$html .= '<td>' . $row['est_nie'] . '</td>';
				$html .= '<td>' . $row['est_nombre'] . ' ' . $row['est_apellido'] . '</td>';
				$html .= '<td>' . $row['est_sexo'] . '</td>';
				$html .= '<td>' . $dat->format('d-m-Y') . '</td>';
				$html .= '<td>' . $row['est_partida'] . '</td>';
				$html .= '<td></td>';
				$html .= '</tr>';
				$i++;
			}
		} else {

			$html .= '<tr><td colspan="8"><div class="alert alert-danger alert-dismissable" align="center">
		
		<h4>¡Aviso!</h4>No hay estudiantes matriculados en esta sección
		</div></td></tr>';
		}


		$html .= '</tbody></table><br><table width="100%"  ><tr style="vertical-align: top">
	<td><p style="font-size: 12px;">Esta nómina ampara ' . ($i - 1) . ' Alumnos</p>
</td>
<td width="5%"><table id="usuarios" style="width: 100px; text-align: center;">
	<tr align="center">
		<td colspan="2">Alumnos</td>
	</tr>
	<tr>
		<td>Masculinos</td>
		<td>' . $m . '</td>
	</tr>
	<tr>
		<td>Femeninos</td>
		<td>' . $f . '</td>
	</tr>
	<tr>
		<td align="right"><b>Total</b></td>
		<td><b>' . ($i - 1) . '</b></td>
	</tr>
</table></td></tr></table>

';

		include 'pie.php';
		$html .= '</body>
</html>';

		$options = $dompdf->getOptions();
		$options->set('chroot', '/');

		$dompdf->loadHtml($html);

		$dompdf->setpaper("Letter");
		$dompdf->render();
		$dompdf->stream("Reporte de Matrícula de " . $nivel . " " . $fecha . ".pdf", array("Attachment" => 0));
	} else {
		echo '<div class="alert alert-danger alert-dismissable" align="center">
		
		<h4>¡Aviso!</h4>No existe la seccion que buscas
		</div>';
	}
} else {

	echo '<div class="alert alert-danger alert-dismissable" align="center">
		
		<h4>¡Aviso!</h4>No hay estudiantes matriculados en esta sección
		</div>';
}
