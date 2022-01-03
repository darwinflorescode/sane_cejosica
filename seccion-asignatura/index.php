<?php include '../principal/header.php'; 
include '../sessionstart/bloq_anio.php';
include '../perfil/permiso.php';

$_SESSION['detalle_asignatura'] = array();
?>

<div class="todo">
<div class="row">
	<div class="box col-md-12">
		<div class="box-inner">
			<div class="box-header well" data-original-title="">
				<h2><i class="fa fa-book"></i> Asignaturas a Secciones</h2>
			</div>
			<div class="box-content">
				<fieldset class="scheduler-border">
					<legend class="scheduler-border">Selecciona un nivel: </legend>
					<form action="./" method="POST">
						<table width="40%" class="responsive" >
							<tr>
								<td align="right">Nivel Escolar: <span>*</span>&nbsp;</td><td>
									<select class="form-control inputstl" required="" name="nivel_escolar" id="nivel_escolar" onchange="window.location = './?idnivel='+this.value" >
										<option value="">Seleccione...</option>
										<option value="kinder3">Parvularia 4 A&ntilde;os</option>
										<option value="kinder2">Parvularia 5 A&ntilde;os</option>
										<option value="kinder1">Parvularia 6 A&ntilde;os</option>
										<option value="ciclo1">I Ciclo</option>
										<option value="ciclo2">II Ciclo</option>
										<option value="ciclo3">III Ciclo</option>

									</select>
								</td></tr>


							</table><br>
							<?php 


							if (isset($_GET['idnivel'])) {
								if ($_GET['idnivel']>"") {
									$valor="";
									$sec_nivel = "";
									if ($_GET['idnivel']=="kinder3") {
										$valor = "Parvularia 4 A&ntilde;os";
										$sec_nivel = "-3";
									}else if ($_GET['idnivel']=="kinder2") {
										$valor = "Parvularia 5 A&ntilde;os";
										$sec_nivel = "-2";
									}else if ($_GET['idnivel']=="kinder1") {
										$valor = "Parvularia 6 A&ntilde;os";
										$sec_nivel = "-1";
									}else if ($_GET['idnivel']=="ciclo1") {
										$valor = "I CICLO";
										$sec_nivel = "I";
									}else if ($_GET['idnivel']=="ciclo2") {
										$valor = "II CICLO";
										$sec_nivel = "II";
									}else{
										$valor = "III CICLO";
										$sec_nivel = "III";
									}
									?>
									
									<fieldset class="scheduler-border">
										<legend class="scheduler-border">Agregar Asignaturas para <font color="marroon"> <?php echo $valor; ?></font>: </legend>
										<input type="hidden" name="nivel_a" id="nivel_a" value="<?php echo $sec_nivel; ?>">
										<input type="hidden" name="nivel_aa" id="nivel_aa" value="<?php echo $_GET['idnivel']; ?>">

										<table width="50%">
											<tr>
												<td><select class="form-control inputstl" name="id_materia" id="id_materia" >
													<option value="">[Seleccione...]</option>
													<?php


													$sql = "SELECT * FROM tb_materia order by mate_nombre asc";

													$result = $conn->query($sql);

													$rows = $result->fetchAll();

													$select  = "";
													foreach ($rows as $row) { 



														echo "<option  value='";
														echo $row['idtb_materia'];           

														echo "'>";
														echo "[".$row['cod_materia']."] - ".$row['mate_nombre'];



														echo "</option>";
													}

													?>

												</select></td><td>&nbsp;</td>
												<td><button id="btn_registrate" onclick="add_asignatura();" type="button" class="btn btn-info"><i class="ace-icon fa fa-plus bigger-110"></i> Agregar</button></td>
											</tr>
										</table>


									</fieldset>
									<a href="javascript:void();" onclick="imprimirSeleccion('Impresión de materias por nivel','print_');"><h3><i class="fa fa-print"></i></h3></a>
									<fieldset class="scheduler-border" id="print_">
										<legend class="scheduler-border">Listado de Materias Asignadas a <font color="green"> <?php echo $valor; ?></font>: </legend>
										<table class="table table-striped table-bordered table-hover">
											<thead class="btn-success">
												<tr>
													<td>ID</td>
													<td>Nombre Asignatura</td>
													<td width="3%">Acciones</td></tr>
												</thead>
												<tbody>
													<?php


													$sql = "SELECT tb_seccion_materia.*,tb_materia.*,tb_seccion.* FROM `tb_seccion_materia` inner join tb_materia on tb_seccion_materia.sec_mate_idtb_materia = tb_materia.idtb_materia inner join tb_seccion on tb_seccion_materia.sec_mate_idtb_seccion = tb_seccion.idtb_seccion
													where tb_seccion.sec_nivel='$sec_nivel' or tb_seccion.sec_servicio_ed='$sec_nivel' GROUP by tb_materia.mate_nombre";

													$result = $conn->query($sql);

													$rows = $result->fetchAll();

													if ($result->rowcount()) {


														foreach ($rows as $row) { 



															echo "<tr><td>".$row['sec_mate_idtb_materia']."</td><td>";			
															echo " [".$row['cod_materia']."] - ".$row['mate_nombre'];

															echo "</td><td><a href='javascript:void();' onclick='eliminar_materia_seccion(".$row['sec_mate_idtb_materia'].",\"".$sec_nivel."\");' class='btn btn-danger'><i class='fa fa-trash'> </i></a></td></tr>";
														}
													}else{
														?>
														<tr>
															<td colspan="3" align="center">  <div class="alert alert-danger alert-dismissable">
																<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
																<h4>¡Aviso!</h4> No hay Asignaturas Registradas
															</div></td>
														</tr>

														<?php 
													} ?>
												</tbody>
											</table>

										</fieldset>




										<?php }} ?>
									</fieldset>






								</div>
							</div>
						</div>
					</div>
				</div>
			</div>

















			<?php include '../principal/footer.php'; ?>