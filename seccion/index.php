<?php include '../principal/header.php'; 
include '../sessionstart/bloq_anio.php';
include '../perfil/permiso.php';
?>

<div  class="myModalseccion modal fade" style="display: none;">
	<div class="modal-dialog  modal-lg" >
		<div class="modal-content">
			<div class="modal-header" style="background: url('../librerias/pattern.png');">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title letra"  style="text-align: center; font-size: 30px;"><i class="fa fa-plus"></i> <span id="titulosec">Agregar una Sección</span>  <i class="fa fa-briefcase"></i></h5>
			</div>
			<div class="modal-body">
				<form class="" id="form_seccion_g" name="form_seccion_g" autocomplete="off" method="POST" action="./" >
					<div align="right">
						<span>*</span> Datos Obligatorios
					</div>

					<input type="hidden" name="accion_gsec" id="accion_gsec" value="guardar">
					<input type="hidden" name="id_seccion" id="id_seccion" value="0">
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Ingrese la Siguiente Informaci&oacute;n: </legend>
						<table width="100%" class="responsive" >
							<tr>
								<td align="right">Servicio Educativo: <span>*</span>&nbsp;</td><td>
									<select class="form-control inputstl" name="sec_ser_edu" id="sec_ser_edu" >
										<option value="">[Seleccione...]</option>
										<option value="-3">Parvularia 4 A&ntilde;os</option>
										<option value="-2">Parvularia 5 A&ntilde;os</option>
										<option value="-1">Parvularia 6 A&ntilde;os</option>
										<option value="1">1° Grado</option>
										<option value="2">2° Grado</option>
										<option value="3">3° Grado</option>
										<option value="4">4° Grado</option>
										<option value="5">5° Grado</option>
										<option value="6">6° Grado</option>
										<option value="7">7° Grado</option>
										<option value="8">8° Grado</option>
										<option value="9">9° Grado</option>
									</select>
								</td><td align="right">Identificador: <span>*</span>&nbsp;</td>
								<td><select class="form-control inputstl" name="sec_identificador" id="sec_identificador">
										<option value="">[Seleccione...]</option>
										<?php 
											for ($i='A'; $i <= 'N'; $i++) { 
												echo "<option value='".$i."'>".$i."</option>";
											}
										 ?>

	
									</select></td>

							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr><td align="right">Turno: <span>*</span>&nbsp;</td>
								<td><select class="form-control inputstl" name="sec_turno" id="sec_turno">
										<option value="">[Seleccione...]</option>
										<option value="Mañana">Mañana</option>
										<option value="Tarde">Tarde</option>
										<option value="Mañana y Tarde">Mañana y Tarde</option>
										<option value="Noche">Noche</option>
										
									</select></td>
								<td align="right">Vacantes: <span>*</span>&nbsp;</td><td><input type="number"  class="form-control inputstl" name="sec_vacante" id="sec_vacante" placeholder="Cantidad" min="0" ></td></tr>

								<tr><td colspan="2">&nbsp;</td></tr>
								<tr><td align="right">Tipo Sección: <span>*</span>&nbsp;</td>
								<td><select class="form-control inputstl" name="sec_tipo" id="sec_tipo">
										<option value="">[Seleccione...]</option>
										<option value="Pura">Pura</option>
										<option value="Integrada">Integrada</option>
															
									</select></td>

									<td align="right">Docente Responsable: <span>*</span>&nbsp;</td>
									<td>
										<select class="form-control inputstl" name="sec_idtbuser" id="sec_idtbuser">
										<option value="">[Seleccione...]</option>

										<?php $sql = "SELECT * FROM tb_usuario where user_estado='Activo'";

										$result = $conn->query($sql);

										$rows = $result->fetchAll();

										$select  = "";
										foreach ($rows as $row) { 

											
											echo "<option  value='";
											echo $row['idtb_usuario'];           

											echo "'>";
											echo $row['user_nombre']." ".$row['user_apellido']; 

										echo "</option>";
										}

										?>
										
									</select>

									</td></tr>
								
							</table>


						</fieldset>


						<div class="modal-footer">
							<button type="reset" class="btn btn-info" ><i class="fa fa-eraser"></i> Limpiar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
							<button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> <l  id="btnguardarseccion">Guardar</l></button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>








<script type="text/javascript">
	
	$(document).ready(function() {

    //datatables
    table = $('#seccion_s').DataTable({
    	"pageLength":5,
    	"order":[[0,"desc"]]
    });
});

	
</script>
<div class="todo">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-book"></i> Mantenimiento de Secciones</h2>
				</div>
				<div class="box-content">
					<table width="100%" ><tr><td><button class="btn btn-info" data-toggle="modal" data-target=".myModalseccion" onclick="limpiar_formulario_seccion();" > <span class="fa fa-plus"></span> Nuevo</button></td><td align="right"><div class='btn-group pull-right'>
<button  type='button' class='btn btn-warning dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <i class='fa fa-print'></i> Reportes <span class='fa fa-caret-down'></span></button>
							<ul class="dropdown-menu">
								<li><a href="javascript:void();" onclick="open_share('../reporte/reporte_seccion.php');"><i class="fa fa-file-pdf-o"></i> PDF</a></li>

							</ul>

						</div></td></tr></table>
						<br>
						<div class="table-responsive">

					<table id="seccion_s" class="table table-striped table-bordered table-hover">
						<thead class="btn-success">
						<tr >
							<th>ID</th>
							<th>Servicio Educativo</th>
							<th>Turno</th>
							<th>Identificador</th>
							<th>Tipo Sección</th>
							<th>Nivel</th>
							<th>Capacidad Estudiantes</th>
							<th>Docente Responsable</th>
							<th>A&ntilde;o Escolar</th>
							<th width="10%">Acciones</th>
						  </tr>
						  </thead>
						  <tbody>
							
								<?php


										$sql = "SELECT tb_seccion.*,tb_anio_escolar.*, tb_usuario.* FROM tb_seccion inner join tb_anio_escolar on  tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar inner join tb_usuario on tb_seccion.sec_idtbuser=tb_usuario.idtb_usuario where tb_anio_escolar.anio=".$_SESSION['anio_escolar'] ;

										$result = $conn->query($sql);

										$rows = $result->fetchAll();

										foreach ($rows as $row) { 
											echo "<tr><td>".$row['idtb_seccion']."</td>";
											?>

											<input type="hidden" id="sec_edu_<?php echo $row['idtb_seccion']; ?>" value="<?php echo $row['sec_servicio_ed']; ?>">

											<input type="hidden" id="sec_iden_<?php echo $row['idtb_seccion']; ?>" value="<?php echo $row['sec_identificador']; ?>">
											<input type="hidden" id="sec_tipo_<?php echo $row['idtb_seccion']; ?>" value="<?php echo $row['sec_tipo_seccion']; ?>">

											<input type="hidden" id="sec_turno_<?php echo $row['idtb_seccion']; ?>" value="<?php echo $row['sec_turno']; ?>">

											<input type="hidden" id="sec_vacante_<?php echo $row['idtb_seccion']; ?>" value="<?php echo $row['sec_vacante']; ?>">

											<input type="hidden" id="sec_idtbuser_<?php echo $row['idtb_seccion']; ?>" value="<?php echo $row['idtb_usuario']; ?>">
											<?php 
											if ($row['sec_servicio_ed']==-1) {
												echo "<td>Parvularia 6 A&ntilde;os</td>";
											}else if ($row['sec_servicio_ed']==-2) {
												echo "<td>Parvularia 5 A&ntilde;os</td>";
											}else if ($row['sec_servicio_ed']==-3) {
												echo "<td>Parvularia 4 A&ntilde;os</td>";
											}else{
												echo "<td>".$row['sec_servicio_ed']."° Grado</td>";
											}
											
											echo "<td>".$row['sec_turno']."</td>";
											echo "<td>\"".$row['sec_identificador']."\"</td>";
											echo "<td>".$row['sec_tipo_seccion']."</td>";
											if ($row['sec_servicio_ed']<0) {
												echo "<td>".$row['sec_nivel']."</td>";
											}else
											{
												echo "<td>".$row['sec_nivel']." Ciclo</td>";
											}
											
											echo "<td>".$row['sec_vacante']."</td>";
											echo "<td>".$row['user_nombre']." ".$row['user_apellido']."</td>";
											echo "<td>".$row['anio']."</td>";

											echo "<td><div class='btn-group pull-right'>
<button  type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <i class='fa fa-cog'></i> Acciones <span class='fa fa-caret-down'></span></button>
												<ul class='dropdown-menu'>
													<li><a href='javascript:void();' onclick='editar_seccion(".$row['idtb_seccion'].");' data-toggle='modal' data-target='.myModalseccion' ><i class='fa fa-edit'></i> Editar</a></li>	
	<li><a href='matricula.php?idseccion=".$row['idtb_seccion']."'  ><i class='fa fa-pencil'></i> Matrículas</a></li>

													<li><a href='javascript:void();' onclick='eliminar_seccion(".$row['idtb_seccion'].");' ><i class='fa fa-trash'></i> Eliminar</a></li>							
												
												</ul>

											</div></td></tr>";
											

									
										}

 
										


										?>
							

</tbody>
					</table>
					<br><br><br>
					</div>
					

</div>
					</div>
				</div>
			</div>
			<!--/span-->

		</div><!--/row-->
		<?php include '../principal/footer.php'; ?>