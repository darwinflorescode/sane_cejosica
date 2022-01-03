<?php 
include_once('../conexionpdo/config.php');
$conn = conexion();
if (isset($_GET['id_seccion'])) {
	$id_seccion = $_GET['id_seccion'];

	
	$sql = "SELECT * FROM tb_seccion where idtb_seccion = ".$id_seccion;
			//Ejecuta ala consulta
	$datos = $conn->query($sql);
	$seccion = $datos->fetch(PDO::FETCH_ASSOC);
	$servicio_ed = $seccion['sec_servicio_ed'];
	$identificador = $seccion['sec_identificador'];
	$tipo = $seccion['sec_tipo_seccion'];
	$grado="";
	if ($servicio_ed==-1) {
		$grado =  "Parvularia 6 A&ntilde;os";
	}else if ($servicio_ed==-2) {
		$grado =  "Parvularia 5 A&ntilde;os";
	}else if ($servicio_ed==-3) {
		$grado =  "Parvularia 4 A&ntilde;os";
	}else{
		$grado =  $servicio_ed."° Grado";
	} 
	$grado .=  " \"".$identificador."\"".' ['.$tipo.']';
	if ($datos->rowcount()) {
	

	?>
	<link rel="stylesheet" type="text/css" href="../reporte/reporte.css">
	<div style="text-align:center; padding-bottom:10px;" class="alert alert-success">
	<strong>
		<div><h3>Reporte de notas de Alumnos(as) de <b><?php echo $grado; ?></b></h3></div>

	</strong>
	<div>Nómina de alumnos(as) matrículados(as)</div>
</div>
<div class="table-responsive">	
	<form method="POST" action="./" id="_gnotas" name="_gnotas" autocomplete="off">
		<table id="usuarios" class="table-hover" >
	
			<thead style="background-color: #f1f1f1 !important" >
				<tr><th colspan="10" style="
		text-align:center; font-weight:bold; letter-spacing:5px;
	}"><strong>DATOS PERSONALES DE ALUMNOS(AS)</strong></th></tr>
			</thead>
			<thead class="btn-success" ">
				<tr>
					<th>N°</th>
					<th >NIE</th>
					<th>Nombre Completo Alumno(a)</th>
					<th>Sexo</th>
					<th>Estado Civil</th>
					<th>Edad</th>
					<th>Fecha Nacimiento</th>
					<th>Partida</th>
					<th align="center">Imprimir Documentos</th>

				</tr>

			
			</thead>
<tbody>
	<?php 
$sql = "SELECT tb_matricula.*, tb_estudiante.* FROM `tb_matricula` INNER JOIN tb_estudiante on tb_matricula.matri_idestudiante = tb_estudiante.idestudiante where tb_matricula.matri_idtb_seccion=".$id_seccion." ORDER BY est_apellido asc";

				$result = $conn->query($sql);
			
				$rows = $result->fetchAll();
				$i=1;
				if ($result->rowcount()){


					
				
					foreach ($rows as $row) {
				$dat = new DateTime($row['est_fecha_nace']);
				?>



	<tr>
		<td><?php echo $i; ?></td>
		<td><b><?php echo $row['est_nie'] ?></b></td>
		<td><?php echo $row['est_nombre']." ".$row['est_apellido'] ?></td>
		<td><?php echo $row['est_sexo'] ?></td>
		<td><?php echo $row['est_estado_civil'] ?>/a</td>
		<td><?php echo $row['est_edad'] ?> Año(s)</td>
		<td><?php echo $dat->format('d-m-Y'); ?></td>
		<td><?php echo $row['est_partida'] ?></td>
		<td><a href="javascript:open_share('../reporte/fichaestudiante.php?id=<?php echo $row['idestudiante']; ?>');"><span  class="fa fa-file-pdf-o"></span> Ficha</a>&nbsp;|&nbsp;<a href="javascript:open_share('../reporte/notas_parciales.php?id=<?php echo $row['idtb_matricula']; ?>');"><span  class="fa fa-file-pdf-o"></span> Notas Parciales</a>&nbsp;|&nbsp;<a href="javascript:open_share('../reporte/libreta_notas.php?id=<?php echo $row['idtb_matricula']; ?>');"><span  class="fa fa-file-pdf-o"></span> Libreta Notas</a></td>
			</tr>		

					<?php 
					$i++;
					}
				}else
				{
					echo '<tr><td colspan="10"><div class="alert alert-danger" align="center">
  
  <h4>¡Aviso!</h4>No hay estudiantes matrículados en esta sección
  </div></td></tr>';
				}
	 ?>
	
</tbody>
	</table><br>
	<p style="font-size: 12px;">Esta nómina ampara <?php  echo $i-1; ?> Alumnos</p>
		</form></div>
	</fieldset>


	<?php 
		# code...
	}else{
		echo '<div class="alert alert-danger" align="center">
  
  <h4>¡Aviso!</h4>La sección, no existe, seleccione...
  </div>';
	}

}else{
	echo "Error";
}