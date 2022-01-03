<?php include '../principal/header.php';
include '../sessionstart/bloq_anio.php';
?>

<div class="todo">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-pencil-square"></i> Reporte de Notas</h2>
				</div>
				<div class="box-content">

					<fieldset class="scheduler-border">
						<legend class="scheduler-border">SELECIONE UNA SECCIÓN PARA VERIFICAR LAS NOTAS DE SUS ALUMNOS/AS</legend>
						<table width="60%">
							<tr>
								<td align="right">Sección: &nbsp;<span style="color: red">*</span>&nbsp;</td>
								<td><select class="form-control" name="idtb_seccion" id="idtb_seccion" onchange="load_seccion(this.value);">
										<option value="0">[Seleccione...]</option>
										<?php $sql = "SELECT tb_seccion.*,tb_anio_escolar.* FROM tb_seccion inner join tb_anio_escolar on  tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar where tb_anio_escolar.anio=" . $_SESSION['anio_escolar'] . $sqlautorizo . " order by sec_servicio_ed desc";

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

						<br>
						<div id="loader" style="position: absolute; text-align: left; top: 300px;  width: 100%;display:none;"></div>
						<div class="vertabla"></div>
					</fieldset>

					<br><br><br><br><br><br><br><br><br>



				</div>
			</div>
		</div>
	</div>
	<!--/span-->

</div>
<!--/row-->
<script>
	$(".my-select").chosen({
		width: "70%"
	});
</script>
<?php include '../principal/footer.php'; ?>