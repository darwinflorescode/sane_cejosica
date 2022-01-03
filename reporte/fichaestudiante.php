<?php

if (isset($_GET['id'])) {

	$idestudiante = $_GET['id'];
	$titulo = 'EXPEDIENTE DE ESTUDIANTE';
	$img = '<span ><img width="3%" height="3%" style="text-align: right; float: right; width=34px; height24px;" src="../librerias/will.png" ></span>';

	$html = '';
	include 'encabezado.php';
	$sql = "SELECT * FROM tb_estudiante where idestudiante=$idestudiante ";

	$result = $conn->query($sql);
	if ($result->rowcount()) {
		$row = $result->fetch(PDO::FETCH_ASSOC);
		$dat = new DateTime($row['est_fecha_nace']);
		$datt = new DateTime($row['est_fecha_registro']);



		$html .= '<br><fieldset class="scheduler-border">
		<legend class="scheduler-border">DATOS PERSONALES</legend>
		<br>
		<table style="width: 100%;  font-size: 11px;    text-transform: uppercase;" >
		<tbody>';




		$html .= '<tr height="12%"> ';
		$html .= '<td width="10%"><strong>NIE</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $row['est_nie'] . '</td>';

		if ($row['est_foto'] != null && file_exists($row['est_foto'])) {
			$fotografia = $row['est_foto'];
		} else {
			$fotografia = '../librerias/estudiante.jpg';
		}

		$html .= "<td rowspan='9' align='right'><img class='img-thumbnail' src='" . $fotografia . "' width='100px' height='125px' '></td>";
		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td width="30%"><strong>NOMBRES</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $row['est_nombre'] . '</td>';

		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td width="30%"><strong>APELLIDOS</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $row['est_apellido'] . '</td>';

		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td width="30%"><strong>SEXO</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $row['est_sexo'] . '</td>';

		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td width="30%"><strong>ESTADO CIVIL</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $row['est_estado_civil'] . '/A</td>';

		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td width="30%"><strong>FECHA DE NACIMIENTO</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $dat->format('d-m-Y') . '</td>';

		$html .= '<tr>';
		$html .= '<td width="30%"><strong>EDAD</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $row['est_edad'] . ' AÑO(S)</td>';

		$html .= '</tr>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td width="30%"><strong>DUI</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $row['est_dui'] . '</td>';

		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td width="30%"><strong>PRESENTÓ PARTIDA DE NACIMIENTO</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $row['est_partida'] . '</td>';

		$html .= '</tr>';




		$html .= '</tbody>
		</table></fieldset>
		<fieldset class="scheduler-border">
		<legend class="scheduler-border">DATOS DE RESIDENCIA</legend>
		<br>
		<table style="width: 100%; font-size: 11px;text-transform: uppercase;"  >
		<tbody>';

		$html .= '<tr  style="height: 12px;">';
		$html .= '<td width="30%"><strong>DIRECCIÓN COMPLETA</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $row['est_direccion'] . '</td>';
		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td width="30%"><strong>TRANSPORTE</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $row['est_transporte'] . '</td>';

		$html .= '</tr>';


		$html .= '</tbody>
		</table></fieldset>


		<fieldset class="scheduler-border">
		<legend class="scheduler-border">OTROS DATOS</legend>
		<br>
		<table style="width: 100%;  font-size: 11px;text-transform: uppercase;"  >
		<tbody>';


		$html .= '<tr  style="height: 12px;">';
		$html .= '<td width="30%"><strong>CONVIVENCIA</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $row['est_convivencia'] . '</td>';

		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td width="30%"><strong>ACTIVIDAD ECONÓMICA</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $row['est_dp_economica'] . '</td>';

		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td width="30%"><strong>DISCAPACIDADES</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $row['est_discapacidad'] . '</td>';

		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td width="30%"><strong>ÚLTIMO AÑO DE ESTUDIO</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $row['est_anio_ult'] . '</td>';

		$html .= '</tr>';

		$html .= '<tr>';
		$html .= '<td width="30%"><strong>FECHA REGISTRO EN SISTEMA</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $datt->format('d-m-Y') . '</td>';

		$html .= '</tr>';
		$html .= '<tr>';
		$html .= '<td width="30%"><strong>ESTADO</strong></td>';
		$html .= '<td><strong>:</strong>&nbsp;' . $row['est_estado'] . '</td>';

		$html .= '</tr>';



		$html .= '
		</tbody>
		</table></fieldset>
		<fieldset class="scheduler-border">
		<legend class="scheduler-border">DATOS DE FAMILIARES</legend>
		<br>
		<table id="usuarios" style="">

		<thead>
		<tr>
		<th>Nombre Completo</th>
		<th>DUI</th>
		<th>Otros Datos</th>
		<th>Tipo Parentesco</th>
		<th>Responsable</th>
		</tr>
		</thead>
		<tbody>';



		$sql = "SELECT tb_parentesco_estudiante.*,tb_parentesco.* FROM tb_parentesco_estudiante inner join tb_parentesco on tb_parentesco_estudiante.tb_parentesco_id = tb_parentesco.idtb_parentesco where tb_parentesco_estudiante.tb_estudiante_id = $idestudiante order by tb_responsable desc";

		$result = $conn->query($sql);

		$rows = $result->fetchAll();
		if ($result->rowcount()) {

			foreach ($rows as $row) {

				$html .= '<tr>';
				$html .= '<td>' . $row['parent_nombre'] . '</td>';
				$html .= '<td>' . $row['parent_dui'] . '</td>';
				$html .= '<td><div style="font-size: 10px;"><strong>Teléfono: </strong>' . $row['parent_telefono'] . '<br><strong>Trabajo: </strong>' . $row['parent_trabajo'] . '<br><strong>Dirrección: </strong>' . $row['parent_direccion'] . '<div></td>';
				$html .= '<td>' . $row['tb_tipo'] . '</td>';
				$html .= '<td>' . $row['tb_responsable'] . '</td>';
				$html .= '</tr>';
			}
		} else {

			$html .= '<tr><td colspan="5"><div style="background-color: #f2f2f2;" align="center">

			<h4>¡Aviso!</h4>No hay familiares agregados a este estudiante<br><br>
			</div></td></tr>';
		}
		$html .= '</tbody>
		</table>
		</fieldset>
		<fieldset class="scheduler-border">
		<legend class="scheduler-border">HISTORIAL DE MATRÍCULA ESCOLAR</legend>
		<br>
		<table id="usuarios"  >

		<thead>
		<tr>
		<th>Grado</th>
		<th>Año Escolar</th>
		<th>Responsable Grado</th>
		<th>Fecha Matrícula</th>
		</tr>
		</thead>
		<tbody>';
		$sql = "SELECT tb_matricula.*, tb_seccion.* FROM tb_matricula inner join tb_seccion on tb_matricula.matri_idtb_seccion=tb_seccion.idtb_seccion where tb_matricula.matri_idestudiante = $idestudiante;";

		$result = $conn->query($sql);

		$rows = $result->fetchAll();



		if ($result->rowcount()) {

			foreach ($rows as $row) {
				if ($row['sec_servicio_ed'] == -1) {

					$nivel = "Parvularia 6 Años";
				} else if ($row['sec_servicio_ed'] == -2) {

					$nivel = "Parvularia 6 Añ;os";
				} else if ($row['sec_servicio_ed'] == -3) {

					$nivel = "Parvularia 4 Años";
				} else {
					$nivel = $row['sec_servicio_ed'] . "° Grado";
				}

				$html .= '<tr>';
				$html .= '<td>' . $nivel . ' "' . $row['sec_identificador'] . '" - ' . $row['sec_tipo_seccion'] . '</td>';
				$sql = "SELECT * FROM tb_anio_escolar where idtb_anio_escolar=" . $row['sec_idtb_anio_escolar'];
				//Ejecuta ala consulta
				$datos = $conn->query($sql);
				$anio_Esco = $datos->fetch(PDO::FETCH_ASSOC);

				$html .= '<td>' . $anio_Esco['anio'] . '</td>';

				$sqll = "SELECT * FROM tb_usuario where idtb_usuario=" . $row['sec_idtbuser'];
				//Ejecuta ala consulta
				$datoss = $conn->query($sqll);
				$user = $datoss->fetch(PDO::FETCH_ASSOC);

				$html .= '<td>' . $user['user_nombre'] . ' ' . $user['user_apellido'] . '</td>';
				$html .= '<td>' . $row['matri_fecha'] . '</td>';
				$html .= '</tr>';
			}
		} else {

			$html .= '<tr><td colspan="4"><div style="background-color: #f2f2f2;" align="center">

			<h4>¡Aviso!</h4>No hay matriculas registradas de este estudiante<br><br>
			</div></td></tr>';
		}

		$html .= '</tbody>
		</table>
		</fieldset>';


		include 'pie.php';
		$html .= '</body>
		</html>';
		// $options = $dompdf->getOptions();
		// $options->set('chroot', '/');

		// $dompdf->loadHtml($html);

		// $dompdf->setpaper("Letter");
		// $dompdf->render();

		// $dompdf->stream("reportepdf.pdf", array("Attachment" => false));

		echo $html;
	} else {
		echo '<div class="alert alert-danger alert-dismissable" align="center">

		<h4>¡Aviso!</h4>Error al cargar los datos,o no exite el estudiante
		</div>';
	}
} else {

	echo '<div class="alert alert-danger alert-dismissable" align="center">

	<h4>¡Aviso!</h4>Error al cargar los datos
	</div>';
}
