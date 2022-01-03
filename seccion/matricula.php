<?php 
include '../principal/header.php'; 
include '../sessionstart/bloq_anio.php';
include '../perfil/permiso.php';


	//Variable que almacena la conexion

if (isset($_GET['idseccion'])) {
	

	//Captura con variables que vienen del el login. para comproar el usuario
$id= $_GET['idseccion'];



	//Exception de error de pdo
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


	//Consulta Donde se comprueba  que el usuario existe
$sql = "SELECT tb_seccion.*,tb_anio_escolar.* FROM tb_seccion inner join tb_anio_escolar on  tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar where tb_anio_escolar.anio=".$_SESSION['anio_escolar']." and idtb_seccion = ".$id;
			//Ejecuta ala consulta
$datos = $conn->query($sql);

if ($datos->rowcount()) {

	$seccion = $datos->fetch(PDO::FETCH_ASSOC);
	$servicio = $seccion['sec_servicio_ed'];
	$turno = $seccion['sec_turno'];
	$identificador = $seccion['sec_identificador'];
	$tipo = $seccion['sec_tipo_seccion'];
}else{
	 echo "<script>window.location='./';</script>";
}

}else
{
	echo "<script>window.location='./';</script>";
}


?>
<script type="text/javascript">

	
	$(document).ready(function() {

    //datatables
    table = $('#estudiante_view').DataTable({
    	"pageLength":5,
    	"order":[[1,"desc"]]
    });

});


	

		
</script>
<div  class="myModalMatricula modal fade" style="display: none;">
	<div class="modal-dialog  modal-lg" >
		<div class="modal-content">
			<div class="modal-header" style="background: url('../librerias/pattern.png');">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title letra"  style="text-align: center; font-size: 30px;"><i class="fa fa-graduation-cap"></i> Matrícula de Alumnos/as <i class="fa fa-pencil"></i></h5>
			</div>
			<div class="modal-body">

				<div class="table-responsive">
						<table id="estudiante_view" class="table table-striped table-bordered table-hover"  >
							<thead class="btn-success">
								<tr>
									<th width="5%">Foto</th>
									<th>NIE</th>
									<th>Nombre Alumno/a</th>
									<th>Sexo</th>
									<th>Estado Civil</th>
									<th>Fecha Naci..</th>
									<th width="4%" >Estado</th>

									<th width="10%">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php


									$sql = "SELECT * FROM tb_estudiante where est_estado='Activo'";

										$result = $conn->query($sql);

										$rows = $result->fetchAll();

										foreach ($rows as $row) { 
											echo "<tr>";

											?>

											<?php 
											

												$imprimir = 'open_share("../reporte/fichaestudiante.php?id='.$row['idestudiante'].'");';
											
											if ($row['est_foto']!=null && file_exists($row['est_foto'])) {
												$fotografia = $row['est_foto'];
											}else{
												$fotografia ="../librerias/estudiante.jpg";
											}

											echo "<td ><a href='javascript:void();' onclick='".$imprimir."' ><img src='".$fotografia."' width='70px' height='80px' class='img-thumbnail'></a></td>";
											echo "<td><strong>".$row['est_nie']."</strong></td>";
											echo "<td >".$row['est_nombre']." ".$row['est_apellido']."</td>";
											echo "<td>".$row['est_sexo']."</td>";
											echo "<td>".$row['est_estado_civil']."/a</td>";
											echo "<td>".$row['est_fecha_nace']."</td>";
											if ($row['est_estado'] == "Activo") {
												$clase = "label label-success";
												
											}else if ($row['est_estado'] == "Desertó") {
												$clase = "label label-warning";
												
											}else
											{
												$clase = "label label-danger";
											}
										

											echo "<td><span class='".$clase."'>".$row['est_estado']."</span></td>";
											
echo "<td><a href='javascript:void();' onclick='crear_matricula($id,".$row['idestudiante'].");' title='Matrícular Alumno/a'><img src='../librerias/matricular.png' width='60px' height='50px'><a></td></tr>";
											

									
										}

 
										


										?>


								</tbody>

							</table><br><br><br></div>
				<div class="modal-footer">
						
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
							
						</div>

				</div>
			</div>
		</div>
	</div>
<div class="todo">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-book"></i> Estudiantes Matrículados en <?php 


				if ($servicio==-1) {
												echo "Parvularia 6 A&ntilde;os";
											}else if ($servicio==-2) {
												echo "Parvularia 5 A&ntilde;os";
											}else if ($servicio==-3) {
												echo "Parvularia 4 A&ntilde;os";
											}else{
												echo $servicio."° Grado";
											}
											echo " \"".$identificador."\" [ ".$tipo." ]";




				 ?></h2>
				</div><br><table align="center" ><tr><td><div align="right"><button class="btn btn-success" data-toggle="modal" data-target=".myModalMatricula" ><i class="fa fa-edit"></i> Matricular Alumno/a</button></div></td><td>&nbsp;</td><td><div align="right"><button class="btn btn-info" onclick="open_share('../reporte/matricula.php?idseccion='+<?php echo $id; ?>);"><i class="fa fa-print"></i> Imprimir Matrículas</button></div></td></tr></table>
				<div class="box-content">


<fieldset class="scheduler-border">
	<legend class="scheduler-border">DATOS DE SECCIÓN</legend>

	<table style="width: 100%; height: 120px; font-size: 15px;"  >
		<tbody>
		
			<tr >
				<td style="width: 16%;"  ><strong>SERVICIO EDUCATIVO</strong></td>
				<td><strong>:</strong>&nbsp; <?php 


				if ($servicio==-1) {
												echo "Parvularia 6 A&ntilde;os";
											}else if ($servicio==-2) {
												echo "Parvularia 5 A&ntilde;os";
											}else if ($servicio==-3) {
												echo "Parvularia 4 A&ntilde;os";
											}else{
												echo $servicio."° Grado";
											}
											echo " \"".$identificador."\"";




				 ?></td>
			</tr>
<tr>
				<td ><strong>TIPO SECCIÓN</strong></td>
				<td><strong>:</strong>&nbsp;<?php echo $tipo; ?></td>

			</tr>
			<tr>
				<td ><strong>TURNO</strong></td>
				<td><strong>:</strong>&nbsp;<?php echo $turno; ?></td>

			</tr>
			<tr >
				<td  ><strong>AÑO</strong></td>
				<td><strong>:</strong>&nbsp;<?php echo $_SESSION['anio_escolar']; ?></td>

			</tr>
		</tbody>
	</table></fieldset>
	<script type="text/javascript">
	
	$(document).ready(function() {

    //datatables
    table = $('#seccion_ss').DataTable({
    	"pageLength":5,
    	"order":[[0,"asc"]]
    });


});

	
</script>
	<table id="seccion_ss" class="table table-striped table-bordered table-hover" >

		<thead class="btn-success">
			<tr>
				<th>N°</th>
				<th>NIE</th>
				<th>Nombre del Alumno(a)</th>
				<th>Sexo</th>
				<th>Fecha Nacimiento</th>
				<th>Partida</th>
				<th>Observaciones</th>
				<th width="5%">Acciones</th>
			</tr>
		</thead>
		<tbody>

<?php //Consulta Donde se comprueba  que el usuario existe
$sql = "SELECT tb_matricula.*, tb_estudiante.* FROM tb_matricula inner join tb_estudiante on tb_matricula.matri_idestudiante = tb_estudiante.idestudiante where matri_idtb_seccion = ".$id." order by est_apellido asc";
			//Ejecuta ala consulta
$datos = $conn->query($sql);


$rows = $datos->fetchAll();
$i=1;
$m = 0;
$f = 0;

if ($datos->rowcount()) {
	# code...

foreach ($rows as $row) {
	if ($row['est_sexo']=="Masculino") {
		$m++;
	}else{
		$f++;
	}
	$dat = new DateTime($row['est_fecha_nace']);
	?>



	<tr>
		<td><?php echo $i; ?></td>
		<td><?php echo $row['est_nie'] ?></td>
		<td><?php echo $row['est_nombre']." ".$row['est_apellido'] ?></td>
		<td><?php echo $row['est_sexo'] ?></td>
		<td><?php echo $dat->format('d-m-Y'); ?></td>
		<td><?php echo $row['est_partida'] ?></td>
		<td></td>
		<td>

			<div class='btn-group pull-right'>
<button  type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <i class='fa fa-cog'></i> Acciones <span class='fa fa-caret-down'></span></button>
												<ul class='dropdown-menu'>
													<li><a href="javascript:void();" onclick="eliminarMatricula(<?php echo $row['idtb_matricula'].','.$id; ?>)"><i class="fa fa-trash"></i> Eliminar Matrícula</a></li>
													<li><a href="javascript:void();" onclick="open_share('../reporte/comprobante_inscrip.php?idmatricula='+<?php echo $row['idtb_matricula']; ?>);" ><i class="fa fa-print"></i> Comprobante</a></li>

												</ul>

											</div></td>
	</tr>

<?php $i++; }

} ?>
</tbody>
</table><br>
<table width="100%"  ><tr style="vertical-align: top">
	<td><p style="font-size: 12px;">Esta nómina ampara <?php  echo $i-1; ?> Alumnos</p>
</td>
<td width="5%"><table class="table table-striped table-bordered table-hover" style="width: 100px; text-align: center;">
	<thead class="alert alert-success"><tr align="center">
		<th colspan="2">Alumnos</th>
	</tr></thead>
	<tr>
		<td>Masculinos</td>
		<td><?php echo $m; ?></td>
	</tr>
	<tr>
		<td>Femeninos</td>
		<td><?php echo $f; ?></td>
	</tr>
	<tr>
		<td align="right"><b>Total</b></td>
		<td><b><?php echo ($i-1); ?></b></td>
	</tr>
</table></td></tr></table>


<br>

</div></div></div></div></div>

<?php include '../principal/footer.php'; ?>
