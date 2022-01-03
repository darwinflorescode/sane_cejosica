<?php include '../principal/header.php';
include '../sessionstart/bloq_anio.php';

?>


<div class="todo">

	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-pencil-square"></i> Notas</h2>
				</div>
				<div class="box-content">
					<form action="./" method="POST" accept-charset="utf-8">
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">
								<h3>Registro de Notas</h3>
							</legend>
							<table width="100%">


								<tr>
									<td align="right" col>Sección: &nbsp;<span>*</span>&nbsp;</td>
									<td width="20%" colspan="2"><select class="form-control inputstl" name="idseccion" id="idseccion">
											<option value="0">[Seleccione...]</option>
											<?php $sql = "SELECT tb_seccion.*,tb_anio_escolar.* FROM tb_seccion inner join tb_anio_escolar on  tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar where tb_anio_escolar.anio=" . $_SESSION['anio_escolar'] . $sqlautorizo . " order by sec_servicio_ed asc";

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
								<tr>
									<td>&nbsp;</td>
								</tr>
								<tr>
								<tr>
									<td align="right" width="20%">Materia &nbsp;: <span>*</span>&nbsp;</td>
									<td><select class="form-control inputstl" name="idmateria_buscar" id="idmateria_buscar">
											<option value="0">[Seleccione...]</option>

										</select></td>
									<td width="50%">&nbsp;</td>
								</tr>

							</table><br>
							<div align="center">

								<button type="button" name="btn-searchnota" id="btn-searchnota" class="btn btn-info"><i class="fa fa-search"></i>
									<l>Filtrar</l>
								</button> <a href="./" class="btn btn-danger"><i class="fa fa-close"></i> Cancelar</a>
							</div>

							<div id="loader" style="position: absolute; text-align: left; top: 320px;  width: 100%;display:none;"></div>
							<div class="vertabla"></div>

							<br><br><br><br><br><br><br><br><br><br>
				</div>
			</div>
		</div>
	</div>
</div>

</div>

<script>
	$(".my-select").chosen({
		width: "70%"
	});
</script>




<?php include '../principal/footer.php'; ?>