<?php
if (isset($_GET['id']) && intval($_GET['id'])) {

	$idmatricula = $_GET['id'];
	$img = '<span ><img width="3%" height="3%" style="text-align: right; float: right; width=34px; height24px;" src="../librerias/will.png" ></span>';
	$titulo = 'CONSTANCIA OFICIAL DE NOTAS';

	$img = '';
	$html = '';
	include 'encabezado.php';
	$sql = "SELECT tb_matricula.*, tb_estudiante.* ,tb_seccion.* FROM tb_matricula inner join tb_estudiante ON tb_matricula.matri_idestudiante = tb_estudiante.idestudiante INNER JOIN tb_seccion ON tb_matricula.matri_idtb_seccion = tb_seccion.idtb_seccion where tb_matricula.idtb_matricula=" . $idmatricula;

	$result = $conn->query($sql);
	if ($result->rowcount()) {
		$estu = $result->fetch(PDO::FETCH_ASSOC);
		$servicio = $estu['sec_servicio_ed'];
		$identificador = $estu['sec_identificador'];
		$turno = $estu['sec_turno'];
		$tipo = $estu['sec_tipo_seccion'];
		$dat = new DateTime($estu['est_fecha_nace']);
		$html .= '<br>
<fieldset class="scheduler-border">
	<legend class="scheduler-border">DATOS DE ESTUDIANTE</legend>
	<br>
<table style="width: 100%; height: 120px; font-size: 11px;"  >
<tbody style="text-transform: upperCase;">
<tr style="height: 12px;">
<td style="width: 20%;" ><strong>NIE</strong></td>
<td><strong>:</strong>&nbsp;' . $estu['est_nie'] . '</td>';

		if ($estu['est_foto'] != null && file_exists($estu['est_foto'])) {
			$fotografia = $estu['est_foto'];
		} else {
			$fotografia = '../librerias/estudiante.jpg';
		}

		$html .= '<td rowspan="8" align="right"><img class="img-thumbnail" src="' . $fotografia . '" width="100" height="100"></td>
</tr>

<tr>
<td><strong>NOMBRES</strong></td>
<td><strong>:</strong>&nbsp;' . $estu['est_nombre'] . '</td>

</tr>
<tr >
<td><strong>APELLIDOS</strong></td>
<td><strong>:</strong>&nbsp;' . $estu['est_apellido'] . '</td>

</tr>
<tr >
<td><strong>FECHA NACIMIENTO</strong></td>
<td><strong>:</strong>&nbsp;' . $dat->format('d-m-Y') . '</td>

</tr>
<tr >
<td><strong>EDAD</strong></td>
<td><strong>:</strong>&nbsp;' . $estu['est_edad'] . ' Año(s)</td>

</tr>
<tr >
<td><strong>PARTIDA</strong></td>
<td><strong>:</strong>&nbsp;' . $estu['est_partida'] . '</td>

</tr>
<tr>
<td style="width: 5%;" ><strong>GRADO</strong></td>
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
		$html .= " \"" . $identificador . "\" - " . $tipo;
		$html .= '</td>';

		$sq = "SELECT tb_seccion.*, tb_anio_escolar.* FROM tb_seccion inner join tb_anio_escolar on tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar where tb_seccion.idtb_seccion=" . $estu['idtb_seccion'];

		$resulta = $conn->query($sq);
		$anio = $resulta->fetch(PDO::FETCH_ASSOC);


		$html .= '</tr><tr >
<td><strong>AÑO ESCOLAR</strong></td>
<td><strong>:</strong>&nbsp;' . $anio['anio'] . '</td>

</tr>

</tbody>
</table></fieldset>
<fieldset class="scheduler-border">
	<legend class="scheduler-border">NOTAS OBTENIDAS POR EL ESTUDIANTE</legend>
	<br>
	<table id="estilonota" style="font-size: 11px !important;">
		<thead> 
			<tr>
			<th rowspan="2" width="4%">N°</th>
		<th ROWSPAN="2" >MATERIAS</th>
			<th colspan="3" align="center">PROMEDIOS POR TRIMESTRE</th>
			<th ALIGN="center" ROWSPAN="2" >PROMEDIO FINAL</th>
	</tr>
	<tr>
		<th align="center"> I TRIMESTRE</th> <th align="center"> II TRIMESTRE</th> <th align="center">III TRIMESTRE</th>
	</tr></thead>
	<tbody align="center" style="text-transform:upperCase;">';

		$sql = "SELECT tb_nota.*, tb_materia. * FROM `tb_nota` INNER JOIN tb_materia on tb_nota.not_idtb_materia = tb_materia.idtb_materia  where tb_nota.not_idtb_matricula = " . $idmatricula . " order by mate_nombre asc";

		$result = $conn->query($sql);

		$rows = $result->fetchAll();
		if ($result->rowcount()) {
			$i = 1;

			foreach ($rows as $row) {

				$html .= '<tr>';
				$html .= '<td>' . $i . '</td>';
				$html .= '<td>' . $row['mate_nombre'] . '</td>';
				$html .= '<td>' . number_format($row['not_p1_promuno'], 1) . '</td>';
				$html .= '<td>' . number_format($row['not_p2_prom2'], 1) . '</td>';
				$html .= '<td>' . number_format($row['not_p3_prom3'], 1) . '</td>';
				$html .= '<td>' . number_format($row['nota_prom_final'], 1) . '</td>';
				$html .= '</tr>';
				$i++;
			}
		} else {

			$html .= '<tr><td colspan="6"><div style="background-color: #f2f2f2;" align="center">
		
		<h4>¡Aviso!</h4>No hay notas registradas<br><br>
		</div></td></tr>';
		}
		$html .= '</tbody>
	</table></fieldset>';

		include 'pie.php';
		$html .= '</body>
</html>';

		$options = $dompdf->getOptions();
		$options->set('chroot', '/');

		$dompdf->loadHtml($html);

		$dompdf->setpaper("Letter");
		$dompdf->render();

		$dompdf->stream("libreta de notas de - " . $estu['est_nie'] . ".pdf", array("Attachment" => 0));
	} else {
		echo '<div class="alert alert-danger alert-dismissable" align="center">

	<h4>¡Aviso!</h4>Error al cargar los datos
	</div>';
	}
} else {
	echo '<div class="alert alert-danger alert-dismissable" align="center">

	<h4>¡Aviso!</h4>Error al cargar los datos
	</div>';
}
