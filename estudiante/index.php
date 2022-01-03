<?php include '../principal/header.php'; 
include '../sessionstart/bloq_anio.php';
include '../perfil/permiso.php';
?>
<script type="text/javascript">
	$(function($){

	$("#est_dui").mask("99999999-9");
	
		

});
$(document).ready(function(){
      loadfami();
    });

</script>
<div  class="myModalestudiante modal fade" style="display: none;">
	<div class="modal-dialog  modal-lg" >
		<div class="modal-content">
			<div class="modal-header" style="background: url('../librerias/pattern.png');">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title letra"  style="text-align: center; font-size: 30px;"><i class="fa fa-plus"></i> <span id="tituloest">Agregar un Estudiante</span> <span class="fa fa-graduation-cap"></span></h5>
			</div>
			<div class="modal-body">
				<form class="" id="form_est_g" name="form_est_g" autocomplete="off" method="POST" action="./"  enctype="multipart/form-data">

					<input type="hidden" name="accion_gest" id="accion_gest" value="guardar">
					<input type="hidden" name="id_estudiante" id="id_estudiante" value="0">
					<div align="right">
						<span>*</span> Datos Obligatorios
					</div>
						<ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#datosp">Datos Personales</a></li>
    <li id="fami"><a data-toggle="tab" href="#datosres">Familiares</a></li>
    <li><a data-toggle="tab" href="#datosacc">Otros Datos</a></li>

  </ul><br>

  <div class="tab-content">
    <div id="datosp" class="tab-pane fade in active">
     <table width="100%" class="responsive">
     	<tr>
     		<td align="right">NIE:&nbsp;</td>
     		<td><input type="text" name="est_nie" onkeypress="return justNumbers(event);" maxlength ="8" id="est_nie" placeholder="NIE" class="form-control inputstl"></td>
     		
     	</tr>
     	<tr><td colspan="4">&nbsp;</td></tr>
     	<tr>
     		<td align="right">Nombre: <span>*</span>&nbsp;</td>
     		<td><input type="text" name="est_nombre" onkeypress="return soloLetras(event)"onkeyup="this.value = this.value.toUpperCase();" onpaste="return false"  id="est_nombre" placeholder="Nombre" class="form-control inputstl"></td>
     		<td align="right">Apellido:<span>*</span>&nbsp; </td>
     		<td><input type="text" name="est_apellido" id="est_apellido" onkeypress="return soloLetras(event)"onkeyup="this.value = this.value.toUpperCase();" onpaste="return false" placeholder="Apellido" class="form-control inputstl"></td>
     		
     	</tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr><td align="right" >Sexo: <span>*</span>&nbsp; </td>
     		<td ><select class="form-control inputstl" name="est_sexo" id="est_sexo">
     			<option value="">Seleccione</option>
     			<option value="Masculino">Masculino</option>
     			<option value="Femenino">Femenino</option>
     		</select></td> 
     		<td align="right" >Estado Civil: <span>*</span>&nbsp; </td>
     		<td ><select class="form-control inputstl" name="est_estado_civil" id="est_estado_civil">
     			<option value="">Seleccione</option>
     			<option value="Soltero">Soltero</option>
     			<option value="Casado">Casado</option>
     			<option value="Viudo">Viudo</option>
     			<option value="Acompañado">Acompañado</option>
     		</select></td>      		
     	</tr>
     		<tr><td colspan="2">&nbsp;</td></tr>
	<tr>
		<td align="right">Subir Foto:&nbsp; </td>
     		<td><input type="file" name="est_foto"  id="est_foto" style="width: 200px" class="form-control inputstl"></td>  
     		<td align="right">Nacimiento:<span>*</span>&nbsp; </td>
     		<td><input type="date" placeholder="Fecha Nacimiento" name="est_fecha_nace" id="est_fecha_nace" class="form-control inputstl"></td>
     		
   		
     	</tr>
     	<tr><td colspan="2">&nbsp;</td></tr>
     	<tr>
     		<td align="right" >Partida: <span>*</span>&nbsp; </td>
     		<td ><select class="form-control inputstl" name="est_partida" id="est_partida">
     			<option value="">Seleccione</option>
     			<option value="SI">SI</option>
     			<option value="No">NO</option>
     		</select></td>
     		<td align="right">DUI:&nbsp;</td>
     		<td><input type="text" name="est_dui" id="est_dui" placeholder="DUI" class="form-control inputstl"></td>
     	</tr>
     	
     	<tr><td colspan="2">&nbsp;</td></tr>
<tr>
	<td align="right">Direcci&oacute;n: &nbsp; </td>
     		<td colspan="3"><textarea class="form-control inputstl" placeholder="Direcci&oacute;n&nbsp;" name="est_direccion" id="est_direccion"></textarea> </td>

</tr>
     </table>


    </div>

    
    <div id="datosres" class="tab-pane fade">
    	  <table width="100%" class="responsive">
     	<tr>
     		<td  align="right">Nombre familiar:  <span>*</span>&nbsp;</td>
     		<td><select class="form-control inputstl my-select"  name="est_fami" id="est_fami" style="width: 100% !important">
     			<option value="">[Seleccione un nombre,apellido, dui de familiar...]</option>
     				
										<?php


										$sql = "SELECT * FROM tb_parentesco   order by idtb_parentesco desc";

										$result = $conn->query($sql);

										$rows = $result->fetchAll();

										foreach ($rows as $row) { 

										


											echo "<option  value='";
											echo $row['idtb_parentesco'];           

											echo "'>";
											echo $row['parent_nombre']." - [ ".$row['parent_dui']." ]"; 


											echo "</option>";
										}

										?>
     			
     			
     		</select></td>
     		<td  align="right" >Tipo parentesco: <span>*</span>&nbsp;</td>
     		<td ><select class="form-control inputstl" name="est_pa" id="est_pa">
     			<option  value="">Seleccione</option>
     			<option >Mamá</option>
     			<option >Papá</option>
     			<option>Hermano/a</option>
     			<option>Tio/a</option>
     			<option>Abuelo/a</option>
     			<option>Otro</option>
     			
     			
     		</select></td>
     		
     	</tr>
     	<tr><td colspan="2">&nbsp;</td></tr>
     	<tr><td  align="right" >Es responsable:  <span>*</span>&nbsp;</td>
     		<td ><select class="form-control inputstl" name="est_respon" id="est_respon">
     			<option value="">Seleccione</option>
     			<option value="SI">SI</option>
     			<option value="NO">NO</option>
     			
     			
     			
     		</select></td></tr>
     </table><br>
     <div class="panel-footer" >

									<a href="javascript:void();" onclick="add_fami();" id="btn_g_f" class="btn btn-success"><i class="fa fa-plus"></i> Agregar</a>


									</div><br>
									<div id="loader" style="position: absolute; text-align: left; top: 320px;  width: 100%;display:none;"></div>
								 <div class="vertabla"></div>
								
    </div>

    <div id="datosacc" class="tab-pane fade">
        <table width="100%" class="responsive">
     	<tr>
     		<td align="right">Transporte: &nbsp;</td>
     		<td colspan="3"><input type="text" name="est_transporte" id="est_transporte" placeholder="Peatonal, Público, Privado o propio" class="form-control inputstl"></td>
     		
     	</tr>
     	<tr><td colspan="2">&nbsp;</td></tr>
     	<tr>
     		<td align="right" >Último año estudió:&nbsp; </td>
     		<td ><input type="number" min="1950" placeholder="2018"  onchange="return justNumbers(event);" class="form-control inputstl" name="est_anio_ult" id="est_anio_ult">
     				</td>
     		<td align="right" >Convivencia:&nbsp; </td>
     		<td ><select class="form-control inputstl" name="est_convivencia" id="est_convivencia">
     			<option value="">Seleccione</option>
     			<option value="Padre">Padre</option>
     			<option value="Madre">Madre</option>
     			<option value="Padre y Madre" >Padre  y Madre</option>
     			<option value="Familiares">Familiares</option>
     			<option value="Otros">Otros</option>
     		</select></td>

     	</tr>	
     	<tr><td colspan="2">&nbsp;</td></tr>
     	<tr>
     		<td align="right">Discapacidad: &nbsp;</td>
     		<td><input type="text" name="est_discapacidad" id="est_discapacidad" placeholder="Especifique,Ceguera,Sordera, ratardo mental, etc." class="form-control inputstl"></td>
     		<td align="right">Actividad Econ&oacute;mica :&nbsp;</td>
     		<td><input type="text" name="est_economica" id="est_economica" placeholder="No trabaja,pesca,caña de azucar, etc." class="form-control inputstl"></td>
     	</tr>
     	<tr><td >&nbsp;</td></tr>
     	<tr>
     		<td align="right" >Estado:&nbsp; </td>
     		<td ><select class="form-control inputstl" name="est_estado" id="est_estado">
     			<option value="Activo">Activo</option>
     			<option value="Inhabilitado">Inhabilitado</option>
     			<option value="Desertó">Desertó</option>
     		</select></td>
     	</tr>
     </table>
    </div>
<br>
  </div>
						<div class="modal-footer">
							<button type="reset" class="btn btn-info" ><i class="fa fa-eraser"></i> Limpiar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
							<button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> <l  id="btnguardarest">Guardar</l></button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>




<script type="text/javascript">

	
	$(document).ready(function() {

    //datatables
    table = $('#estudiante_view').DataTable({
    	"pageLength":5,
    	"order":[[0,"desc"]]
    });

});


	

		
</script>
<div class="container-fluid todo">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-graduation-cap"></i> Mantenimiento de Estudiantes</h2>
				</div>
				<div class="box-content">
					<table width="100%" ><tr><td><button class="btn btn-info" data-toggle="modal" data-target=".myModalestudiante" onclick="limpiar_formulario_estudiante();" > <span class="fa fa-plus"></span> Nuevo</button>
						</td><td align="right"><div class='btn-group pull-right'>

<button  type='button' class='btn btn-warning dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <i class='fa fa-print'></i> Reportes <span class='fa fa-caret-down'></span></button>
							<ul class="dropdown-menu">
								<li><a href="javascript:open_share('../reporte/reporte_gnral_estudiante.php');"><i class="fa fa-file-pdf-o" ></i> Reporte General</a></li>
								<li><a href="javascript:void();" data-toggle="modal" data-target=".myModal_reporte_est" align="right"> <span class="fa fa-file-pdf-o"></span>  Reporte Matrícula</a></li>

							</ul>

						</div></td></tr></table><br>
						<div class="table-responsive">
						<table id="estudiante_view" class="table table-striped table-bordered table-hover" >
							<thead class="btn-success">
								<tr>
									<th width="1%">ID</th>
									<th width="5%">Foto</th>
									<th>NIE</th>
									<th>Nombre Completo</th>
									<th>Sexo</th>
									<th>Estado Civil</th>
									<th>Fecha Naci..</th>
									<th width="4%" >Estado</th>

									<th width="10%">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php


									$sql = "SELECT * FROM tb_estudiante";

										$result = $conn->query($sql);

										$rows = $result->fetchAll();

										foreach ($rows as $row) { 


											echo "<tr>";
											$edad_ = new DateTime($row['est_fecha_nace']);
		$hoy =  new DateTime();
		$anios_ = $hoy->diff($edad_);
		$edad = $anios_->y;

		$update_ = "UPDATE tb_estudiante SET est_edad='$edad' where idestudiante=".$row['idestudiante'];
 if ($conn->query($update_)) {
 	
 }

											?>

			<input type="hidden" id="est_nie_<?php echo $row['idestudiante']; ?>" value="<?php echo $row['est_nie']; ?>">

			<input type="hidden" id="est_nombre_<?php echo $row['idestudiante']; ?>" value="<?php echo $row['est_nombre']; ?>">

			<input type="hidden" id="est_apellido_<?php echo $row['idestudiante']; ?>" value="<?php echo $row['est_apellido']; ?>">

			<input type="hidden" id="est_sexo_<?php echo $row['idestudiante']; ?>" value="<?php echo $row['est_sexo']; ?>">

			<input type="hidden" id="est_estado_civil_<?php echo $row['idestudiante']; ?>" value="<?php echo $row['est_estado_civil']; ?>">

			<input type="hidden" id="est_fecha_nace_<?php echo $row['idestudiante']; ?>" value="<?php echo $row['est_fecha_nace']; ?>">

			<input type="hidden" id="est_partida_<?php echo $row['idestudiante']; ?>" value="<?php echo $row['est_partida']; ?>">

			<input type="hidden" id="est_dui_<?php echo $row['idestudiante']; ?>" value="<?php echo $row['est_dui']; ?>">

			<input type="hidden" id="est_direccion_<?php echo $row['idestudiante']; ?>" value="<?php echo $row['est_direccion']; ?>">

			<input type="hidden" id="est_transporte_<?php echo $row['idestudiante']; ?>" value="<?php echo $row['est_transporte']; ?>">


			<input type="hidden" id="est_anio_ult_<?php echo $row['idestudiante']; ?>" value="<?php echo $row['est_anio_ult']; ?>">

			<input type="hidden" id="est_convivencia_<?php echo $row['idestudiante']; ?>" value="<?php echo $row['est_convivencia']; ?>">

			<input type="hidden" id="est_discapacidad_<?php echo $row['idestudiante']; ?>" value="<?php echo $row['est_discapacidad']; ?>">

			<input type="hidden" id="est_economica_<?php echo $row['idestudiante']; ?>" value="<?php echo $row['est_dp_economica']; ?>">

			<input type="hidden" id="est_estado_<?php echo $row['idestudiante']; ?>" value="<?php echo $row['est_estado']; ?>">



											<?php 
											

												$imprimir = 'open_share("../reporte/fichaestudiante.php?id='.$row['idestudiante'].'");';
											
											if ($row['est_foto']!=null && file_exists($row['est_foto'])) {
												$fotografia = $row['est_foto'];
											}else{
												$fotografia ="../librerias/estudiante.jpg";
											}
											echo "<td >".$row['idestudiante']."</td>";
											echo "<td ><a href='javascript:void();' onclick='".$imprimir."' ><img src='".$fotografia."' width='90px' height='100px' class='img-thumbnail'></a></td>";
											echo "<td >".$row['est_nie']."</td>";
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
											
echo "<td><div class='btn-group pull-right'>
<button  type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <i class='fa fa-cog'></i> Acciones <span class='fa fa-caret-down'></span></button>
												<ul class='dropdown-menu'>
													<li><a href='javascript:void();' onclick='editar_estudiante(".$row['idestudiante'].");' data-toggle='modal' data-target='.myModalestudiante'><i class='fa fa-edit'></i> Editar</a></li>
													<li><a href='javascript:void();' onclick='".$imprimir."' ><i class='fa fa-archive'></i> Ficha</a></li>

													<li><a href='javascript:void();' onclick='eliminar_estudiante(".$row['idestudiante'].");' ><i class='fa fa-trash'></i> Eliminar</a></li>

												</ul>

											</div></td></tr>";
											

									
										}

 
										


										?>


								</tbody>

							</table><br><br><br></div>



						</div>
					</div>
				</div>
				<!--/span-->

			</div><!--/row-->


		</div>


		<!-- modal de cambio de año escolar -->
<div  class="myModal_reporte_est modal fade" style="display: none;">
	<div class="modal-dialog  modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background: url('../librerias/pattern.png');">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title letra" style="text-align: center; font-size: 30px;"> Reportes  de Estudiantes <i class="fa fa-graduation-cap"></i></h5>
			</div>
			<div class="modal-body">
			
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Reporte por sección : </legend>
						<table width="90%" class="responsive">
							<tr>
								<td align="right">Sección: <span>*</span>&nbsp;</td><td>
									<select class="form-control inputstl" name="tb_seccion" id="tb_seccion" >
										<option value="">[Seleccione...]</option>
										<?php $sql = "SELECT tb_seccion.*,tb_anio_escolar.* FROM tb_seccion inner join tb_anio_escolar on  tb_seccion.sec_idtb_anio_escolar = tb_anio_escolar.idtb_anio_escolar where tb_anio_escolar.anio=".$_SESSION['anio_escolar']." order by sec_servicio_ed desc";

											$result = $conn->query($sql);

											$rows = $result->fetchAll();

											foreach ($rows as $row) { 


												echo "<option  value='";
												echo $row['idtb_seccion'];           

												echo "'>";

												if ($row['sec_servicio_ed']==-1) {
													echo "Parvularia 6 A&ntilde;os";
												}else if ($row['sec_servicio_ed']==-2) {
													echo "Parvularia 5 A&ntilde;os";
												}else if ($row['sec_servicio_ed']==-3) {
													echo "Parvularia 4 A&ntilde;os";
												}else{
													echo $row['sec_servicio_ed']."° Grado";
												} 
												echo " \" ".$row['sec_identificador']." \" - [ ".$row['sec_tipo_seccion']." ]";

												echo "</option>";
											}

											?>
									</select>
								</td>
							</tr>	
						</table>


						</fieldset>


						<div class="modal-footer">
							
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
							<button onclick="if ($('#tb_seccion').val()=='') {alert('Seleccione una Sección');}else{open_share('../reporte/matricula.php?idseccion='+$('#tb_seccion').val());}" class="btn btn-info" ><i class="fa fa-print"></i> Imprimir</button>
						</div>
				

				</div>
			</div>
		</div>
	</div>
	<script>
		$(".my-select").chosen({width:"100%"});
	</script>
		<?php include '../principal/footer.php'; ?>