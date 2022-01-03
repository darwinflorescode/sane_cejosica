<?php include '../principal/header.php';
include '../sessionstart/bloq_anio.php';
include '../perfil/permiso.php';
$mensaje = "";
if (isset($_POST['btn-gmatricula'])) {

	$id_estudiante = $_POST['id_est'];
	$idtb_seccion = $_POST['idtb_seccion'];

	if (($id_estudiante != 0) && ($idtb_seccion != 0)) {

		//Consulta Donde se comprueba  que el usuario existe
		$sql = "SELECT tb_seccion.*,tb_anio_escolar.* FROM tb_seccion inner join tb_anio_escolar on  tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar where idtb_seccion='$idtb_seccion' and tb_anio_escolar.anio=" . $_SESSION['anio_escolar'];
		//Ejecuta ala consulta
		$datos = $conn->query($sql);
		$seccion = $datos->fetch(PDO::FETCH_ASSOC);
		$vacantes = $seccion['sec_vacante'];


		$sqll = "SELECT * FROM tb_matricula where matri_idtb_seccion=$idtb_seccion";
		//Ejecuta ala consulta
		$datoss = $conn->query($sqll);

		if ($datoss->rowcount() >= $vacantes) {



			$mensaje = "<div class='alert alert-danger alert-dismissable' align='center'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<h4>¡Aviso!</h4><b>¡Error!</b> Ya no hay vacantes en esta seccion. Supera los $vacantes Estudiantes en sección.</div>";
		} else {

			$sqle = "SELECT * FROM tb_matricula where (matri_idestudiante= $id_estudiante and matri_idtb_seccion=$idtb_seccion)";
			//Ejecuta ala consulta
			$datose = $conn->query($sqle);

			if ($datose->rowcount()) {


				$mensaje = "<div class='alert alert-danger alert-dismissable' align='center'>
				<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
				<h4>¡Aviso!</h4><b>¡Error!</b> Estudiante ya se encuentra matriculado en esta sección</div>";
			} else {

				$retornar = false;
				$sqlee = "SELECT tb_seccion.*,tb_anio_escolar.* FROM tb_seccion inner join tb_anio_escolar on  tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar where tb_anio_escolar.anio=" . $_SESSION['anio_escolar'];
				//Ejecuta ala consulta
				$resultado = $conn->query($sqlee);


				$registros = $resultado->fetchAll();

				foreach ($registros as $registrar) {
					$sqlm = "SELECT * FROM tb_matricula where matri_idestudiante=$id_estudiante and matri_idtb_seccion = " . $registrar['idtb_seccion'];
					$encontro  = $conn->query($sqlm);
					if ($encontro->rowcount()) {
						$retornar = true;
						break;
					}
				}

				if ($retornar == 1) {
					$mensaje = "<div class='alert alert-danger alert-dismissable' align='center'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4>¡Aviso!</h4>Estudiante ya se encuentra registrado en una sección, en el año seleccionado.
		</div";
				} else {

					$sqlinsert = "INSERT INTO tb_matricula (matri_fecha,matri_idestudiante,matri_idtb_seccion,matri_idtb_usuario) values(NOW(),$id_estudiante,$idtb_seccion," . $_SESSION['idtb_usuario_ingreso'] . ");";

					if ($conn->query($sqlinsert)) {
						$imprimir = 'open_share("../reporte/fichaestudiante.php?id=' . $id_estudiante . '");';

						$mensaje = "<div class='alert alert-success alert-dismissable' align='center'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4>¡Aviso!</h4><b>¡Excelente!</b> Matrícula Registrada con éxito. ¿Desea imprimir la ficha de estudiante?. <a class='btn btn-info' href='javascript:void();' onclick='" . $imprimir . "'><span class='fa fa-print'></span></a>
		</div";
					} else {
						$mensaje = "<div class='alert alert-danger alert-dismissable' align='center'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4>¡Aviso!</h4>Error al almacenar los datos.
		</div";
					}
				}
			}
		}
	} else {

		$mensaje = "<div class='alert alert-danger alert-dismissable' align='center'>
		<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
		<h4>¡Aviso!</h4>* Complete los campos, son obligatorios
		</div";
	}
} else {
	$mensaje = "";
}

?>


<div class="todo">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-book"></i> Estudiante</h2>
				</div>
				<div class="box-content">
					<form action="./" method="POST" accept-charset="utf-8">
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">
								<h3>Matrícula de estudiantes</h3>
							</legend>
							<table width="100%">

								<tr>
									<td align="right" width="15%">Estudiante &nbsp;: <span>*</span>&nbsp;</td>
									<td><select class="form-control" name="id_est">
											<option value="0">[Seleccione...]</option>
											<?php $sql = "SELECT * FROM tb_estudiante where est_estado = 'Activo' order by idestudiante desc";

											$result = $conn->query($sql);

											$rows = $result->fetchAll();

											foreach ($rows as $row) {


												echo "<option  value='";
												echo $row['idestudiante'];

												if ($row['est_foto'] != null && file_exists($row['est_foto'])) {
													$fotografia = $row['est_foto'];
												} else {
													$fotografia = "../librerias/estudiante.jpg";
												}

												echo "' data-img-src='" . $fotografia . "'>&nbsp;[ " . $row['est_nie'] . " ] - " . $row['est_nombre'] . " " . $row['est_apellido'];

												echo "</option>";
											}

											?>

										</select></td>
								</tr>
								<tr>
									<td>&nbsp;</td>
								</tr>


								<tr>
									<td align="right">Sección: &nbsp;<span>*</span>&nbsp;</td>
									<td><select class="form-control" name="idtb_seccion" id="idtb_seccion">
											<option value="0">[Seleccione...]</option>
											<?php $sql = "SELECT tb_seccion.*,tb_anio_escolar.* FROM tb_seccion inner join tb_anio_escolar on  tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar where tb_anio_escolar.anio=" . $_SESSION['anio_escolar'] . " order by sec_servicio_ed desc";

											$result = $conn->query($sql);

											$rows = $result->fetchAll();

											foreach ($rows as $row) {


												echo "<option  value='";
												echo $row['idtb_seccion'];

												echo "'>";

												if ($row['sec_servicio_ed'] == -1) {
													echo "Parvularia 6 A&ntilde;os";
												} else if ($row['sec_servicio_ed'] == -2) {
													echo "Parvularia 5 A&ntilde;os";
												} else if ($row['sec_servicio_ed'] == -3) {
													echo "Parvularia 4 A&ntilde;os";
												} else {
													echo $row['sec_servicio_ed'] . "° Grado";
												}
												echo " \" " . $row['sec_identificador'] . " \" - [ " . $row['sec_tipo_seccion'] . " ]";

												echo "</option>";
											}

											?>

										</select></td>


								</tr>
							</table>
							<hr>
							<div align="center">
								<a href="./" class="btn btn-info"><i class="fa fa-eraser"></i> Cancelar</a>

								<button type="submit" name="btn-gmatricula" class="btn btn-success"><i class="fa fa-save"></i>
									<l>MATRICULAR</l>
								</button>

								<button type="button" class="btn btn-warning" onclick="enviarmatricula();">Ver Matrículas</button>

							</div>
						</fieldset>

					</form>

					<?php echo $mensaje; ?>

					<br><br><br><br><br><br>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<script type="text/javascript">
	function enviarmatricula() {
		var id = document.getElementById('idtb_seccion').value;
		if (id != 0) {
			window.location = '../seccion/matricula.php?idseccion=' + id;
		} else {
			toastr.error("- Seleccione una sección<br> Para continuar...", "¡Upss!", {
				timeOut: 5000
			});
		}
	}
</script>
<script>
	$(".my-select").chosen({
		width: "70%"
	});
</script>
<?php include '../principal/footer.php'; ?>