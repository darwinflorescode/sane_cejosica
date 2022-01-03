<?php include '../principal/header.php';
include '../sessionstart/bloq_anio.php';
include '../perfil/permiso.php';
?>
<script type="text/javascript">
	$(function($) {

		$("#user_dui").mask("99999999-9");
		$("#user_nit").mask("9999-999999-999-9");
		$("#user_telefono").mask("9999-9999");


	});
</script>

<div class="myModalusuario modal fade" style="display: none;">
	<div class="modal-dialog  modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background: url('../librerias/pattern.png');">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title letra" style="text-align: center; font-size: 30px;"><i class="fa fa-plus"></i> <span id="titulouser">Agregar un Usuario</span> <i class="fa fa-users"></i></h5>
			</div>
			<div class="modal-body">
				<form class="" id="form_user_g" name="form_user_g" autocomplete="off" method="POST" action="./">

					<input type="hidden" name="accion_guser" id="accion_guser" value="guardar">
					<input type="hidden" name="idtb_usuario" id="idtb_usuario" value="0">
					<div align="right">
						<span>*</span> Datos Obligatorios
					</div>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#datosp">Datos Personales</a></li>
						<li><a data-toggle="tab" href="#datosacc">Datos de Acceso</a></li>

					</ul><br>

					<div class="tab-content">
						<div id="datosp" class="tab-pane fade in active">
							<table width="100%" class="responsive">
								<tr>
									<td align="right">Nombres: <span>*</span>&nbsp;</td>
									<td><input type="text" name="user_nombre" id="user_nombre" onkeypress="return soloLetras(event)" onkeyup="this.value = this.value.toUpperCase();" onpaste="return false" placeholder="Nombres" class="form-control inputstl"></td>
									<td align="right">Apellidos: <span>*</span>&nbsp;</td>
									<td><input type="text" name="user_apellido" onkeypress="return soloLetras(event)" onkeyup="this.value = this.value.toUpperCase();" onpaste="return false" id="user_apellido" placeholder="Apellidos" class="form-control inputstl"></td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>

									<td align="right">DUI:&nbsp; </td>
									<td><input type="text" name="user_dui" id="user_dui" placeholder="DUI" class="form-control inputstl"></td>
									<td align="right">NIT:&nbsp;</td>
									<td><input type="text" name="user_nit" id="user_nit" placeholder="NIT" class="form-control inputstl"></td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>

									<td align="right">Tel&eacute;fono:&nbsp; </td>
									<td><input type="text" placeholder="Tel&eacute;fono" name="user_telefono" id="user_telefono" placeholder="Dui" class="form-control inputstl"></td>

								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>

									<td align="right">Profesi&oacute;n:&nbsp; </td>
									<td colspan="3"><textarea class="form-control inputstl" placeholder="Profesi&oacute;n" name="user_profesion" id="user_profesion"></textarea> </td>

								</tr>
							</table>


						</div>
						<div id="datosacc" class="tab-pane fade">
							<table width="100%" class="responsive">
								<tr>
									<td align="right">E-mail: &nbsp;</td>
									<td colspan="3"><input type="text" name="user_email" id="user_email" placeholder="E-mail" class="form-control inputstl"></td>

								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
									<td align="right">Usuario: <span>*</span>&nbsp;</td>
									<td><input type="text" name="user_usuario" id="user_usuario" placeholder="Usuario" class="form-control inputstl"></td>

									<td align="right">Contrase&ntilde;a: <span>*</span>&nbsp; </td>
									<td><input type="password" name="user_contra" id="user_contra" placeholder="Contrase&ntilde;a" class="form-control inputstl"></td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>

									<td align="right">Tipo Usuario: <span>*</span>&nbsp;</td>
									<td>
										<select class="form-control inputstl" name="user_tipo" id="user_tipo">
											<option value="">Seleccione...</option>
											<?php


											$sql = "SELECT * FROM tb_tipo_usuario   order by idtb_tipo_usuario desc";

											$result = $conn->query($sql);

											$rows = $result->fetchAll();

											$select  = "";
											foreach ($rows as $row) {

												echo "<option  value='";
												echo $row['idtb_tipo_usuario'];

												echo "'>";
												echo $row['nombre'];
												echo "</option>";
											}

											?>
										</select>


									</td>
									<td align="right">Estado: <span>*</span>&nbsp; </td>
									<td><select class="form-control inputstl" name="user_estado" id="user_estado">
											<option value="Activo">Activo</option>
											<option value="Inactivo">Inactivo</option>
										</select></td>

								</tr>


							</table>
						</div>
						<br>
					</div>





					<div class="modal-footer">
						<button type="reset" class="btn btn-info"><i class="fa fa-eraser"></i> Limpiar</button>
						<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
						<button type="submit" class="btn btn-danger"><i class="fa fa-save"></i>
							<l id="btnguardaruser">Guardar</l>
						</button>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {

		//datatables
		table = $('#usuario_view').DataTable({
			"pageLength": 5
		});
	});
</script>
<div class="container-fluid todo">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-users"></i> Mantenimiento de Usuario Personal</h2>
				</div>
				<div class="box-content">
					<table width="100%">
						<tr>
							<td><button class="btn btn-info" data-toggle="modal" data-target=".myModalusuario" onclick="limpiar_formulario_usuario();"> <span class="fa fa-plus"></span> Nuevo</button></td>
							<td align="right">
								<div class='btn-group pull-right'>
									<button type='button' class='btn btn-warning dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <i class='fa fa-print'></i> Reportes <span class='fa fa-caret-down'></span></button>
									<ul class="dropdown-menu">
										<li><a href="javascript:void();" onclick="open_share('../reporte/reporte_usuario.php');"><i class="fa fa-file-pdf-o"></i> PDF</a></li>

									</ul>

								</div>
							</td>
						</tr>
					</table><br>
					<div class="table-responsive">
						<table id="usuario_view" class="table table-striped table-bordered table-hover">
							<thead class="btn-success">
								<tr>
									<th>Nombres</th>
									<th>Dui</th>
									<th>Teléfono</th>
									<th>E-mail</th>
									<th>Usuario</th>
									<th>Seccion Responsable</th>
									<th>Tipo Usuario</th>
									<th>Estado</th>
									<th width="10%">Acciones</th>
								</tr>
							</thead>
							<tbody>

								<?php


								$sql = "SELECT tb_usuario.*,tb_tipo_usuario.* FROM tb_usuario inner join tb_tipo_usuario on tb_usuario.user_idtb_tipo_usuario = tb_tipo_usuario.idtb_tipo_usuario  ORDER BY idtb_usuario DESC";

								$result = $conn->query($sql);

								$rows = $result->fetchAll();

								foreach ($rows as $row) {
									echo "<tr>";
								?>
									<input type="hidden" id="user_nombre_<?php echo $row['idtb_usuario']; ?>" value="<?php echo $row['user_nombre']; ?>">
									<input type="hidden" id="user_apellido_<?php echo $row['idtb_usuario']; ?>" value="<?php echo $row['user_apellido']; ?>">

									<input type="hidden" id="user_dui_<?php echo $row['idtb_usuario']; ?>" value="<?php echo $row['user_dui']; ?>">

									<input type="hidden" id="user_nit_<?php echo $row['idtb_usuario']; ?>" value="<?php echo $row['user_nit']; ?>">
									<input type="hidden" id="user_telefono_<?php echo $row['idtb_usuario']; ?>" value="<?php echo $row['user_telefono']; ?>">
									<input type="hidden" id="user_profesion_<?php echo $row['idtb_usuario']; ?>" value="<?php echo $row['user_profesion']; ?>">
									<input type="hidden" id="user_email_<?php echo $row['idtb_usuario']; ?>" value="<?php echo $row['user_email']; ?>">

									<input type="hidden" id="user_contra_<?php echo $row['idtb_usuario']; ?>" value="<?php echo $row['user_clave']; ?>">

									<input type="hidden" id="user_usuario_<?php echo $row['idtb_usuario']; ?>" value="<?php echo $row['user_usuario']; ?>">

									<input type="hidden" id="user_tipo_<?php echo $row['idtb_usuario']; ?>" value="<?php echo $row['user_idtb_tipo_usuario']; ?>">

									<input type="hidden" id="user_estado_<?php echo $row['idtb_usuario']; ?>" value="<?php echo $row['user_estado']; ?>">
								<?php

									echo "<td>" . $row['user_nombre'] . " " . $row['user_apellido'] . "</td>";

									echo "<td>" . $row['user_dui'] . "</td>";
									echo "<td>" . $row['user_telefono'] . "</td>";
									echo "<td>" . $row['user_email'] . "</td>";
									echo "<td>" . $row['user_usuario'] . "</td><td>";

									$sqll = "SELECT tb_seccion.*,tb_anio_escolar.* FROM tb_seccion inner join tb_anio_escolar on tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar where tb_seccion.sec_idtbuser= " . $row['idtb_usuario'] . " and tb_anio_escolar.anio = " . $_SESSION['anio_escolar'];

									$resulta = $conn->query($sqll);

									$filas = $resulta->fetchAll();
									if ($resulta->rowcount()) {


										foreach ($filas as $mostrar) {
											if ($mostrar['sec_servicio_ed'] == -1) {
												echo "<br>Parvularia 6 A&ntilde;os";
											} else if ($mostrar['sec_servicio_ed'] == -2) {
												echo "<br>Parvularia 5 A&ntilde;os";
											} else if ($mostrar['sec_servicio_ed'] == -3) {
												echo "<br>Parvularia 4 A&ntilde;os";
											} else {
												echo $mostrar['sec_servicio_ed'] . "° Grado " . $mostrar['sec_identificador'] . "<br>";
											}
										}
									} else {
										echo "<label class='label label-default'>No hay Seccion asignado</label>";
									}


									echo "</td><td>" . $row['nombre'] . "</td>";

									$clase = "";

									if ($row['user_estado'] == "Activo") {
										$clase = "label label-success";
									} else {
										$clase = "label label-danger";
									}

									echo "<td><span class='" . $clase . "'>" . $row['user_estado'] . "</span></td>";
									echo "<td><div class='btn-group pull-right'>
<button  type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <i class='fa fa-cog'></i> Acciones <span class='fa fa-caret-down'></span></button>
												<ul class='dropdown-menu'>
													<li><a href='javascript:void();' onclick='editar_usuario(" . $row['idtb_usuario'] . ");' data-toggle='modal' data-target='.myModalusuario'><i class='fa fa-edit'></i> Editar</a></li>

													<li><a href='javascript:void();' onclick='eliminar_usuario(" . $row['idtb_usuario'] . ");' ><i class='fa fa-trash'></i> Eliminar</a></li>


												</ul>

											</div></td></tr>";
								}





								?>


							</tbody>

						</table><br><br><br>
					</div>



				</div>
			</div>
		</div>
		<!--/span-->

	</div>
	<!--/row-->


</div>
<?php include '../principal/footer.php'; ?>