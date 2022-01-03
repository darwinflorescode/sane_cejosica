<?php include '../principal/header.php'; 
include '../sessionstart/bloq_anio.php';
include '../perfil/permiso.php';
?>
<script type="text/javascript">
	$(function($){

	$("#parent_dui").mask("99999999-9");
	$("#parent_telefono").mask("9999-9999");
		

});

</script>
<div  class="myModalparent modal fade" style="display: none;">
	<div class="modal-dialog  modal-lg" >
		<div class="modal-content">
			<div class="modal-header" style="background: url('../librerias/pattern.png');">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title letra"  style="text-align: center; font-size: 30px;"><i class="fa fa-plus"></i> <span id="tituloparent">Agregar Familiares</span>  <i class="fa fa-briefcase"></i></h5>
			</div>
			<div class="modal-body">
				<form class="" id="form_parent_g" name="form_parent_g" autocomplete="off" method="POST" action="./" >
					<div align="right">
						<span>*</span> Datos Obligatorios
					</div>

					<input type="hidden" name="accion_gparent" id="accion_gparent" value="guardar">
					<input type="hidden" name="id_parentesco" id="id_parentesco" value="0">
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Ingrese la Siguiente Informaci&oacute;n: </legend>
						<table width="100%" class="responsive" >
							<tr>
												<td align="right">Nombre Completo: <span>*</span>&nbsp;</td><td>
									<input type="text" id="parent_nombre" onkeypress="return soloLetras(event)"onkeyup="this.value = this.value.toUpperCase();" onpaste="return false" name="parent_nombre" placeholder="Nombre Completo" class="form-control inputstl"  >
								</td><td align="right">DUI: <span>*</span>&nbsp;</td>
								<td><input type="text" id="parent_dui" name="parent_dui" placeholder="Dui" class="form-control inputstl"></td>

							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr><td align="right">Telef&oacute;no:&nbsp;</td>

								<td><input type="text" name="parent_telefono" id="parent_telefono" placeholder="Telef&oacute;no" class="form-control inputstl"></td>
								<td align="right">Trabajo: &nbsp;</td><td>
									<input type="text"  class="form-control inputstl" name="parent_trabajo" id="parent_trabajo" placeholder="Trabajo" min="0" ></td></tr>

									<tr><td colspan="2">&nbsp;</td></tr>
									<tr>
										<td align="right">Direcci&oacute;n:&nbsp; </td>
     							<td colspan="3"><textarea class="form-control inputstl" placeholder="Direcci&oacute;n" name="parent_direccion" id="parent_direccion"></textarea> </td>
									</tr>

							</table>


						</fieldset>


						<div class="modal-footer">
							<button type="reset" class="btn btn-info" ><i class="fa fa-eraser"></i> Limpiar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
							<button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> <l  id="btnguardarparent">Guardar</l></button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>






<script type="text/javascript">

	
	$(document).ready(function() {

    //datatables
    table = $('#parentesco_view').DataTable({
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
					<h2><i class="fa fa-user"></i> Mantenimiento de Familiares</h2>
				</div>
				<div class="box-content">
					<table width="100%" ><tr><td><button class="btn btn-info" data-toggle="modal" data-target=".myModalparent" onclick="limpiar_formulario_parentesco();" > <span class="fa fa-plus"></span> Nuevo</button></td><td align="right"><div class='btn-group pull-right'>
<button  type='button' class='btn btn-warning dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <i class='fa fa-print'></i> Reportes <span class='fa fa-caret-down'></span></button>
							<ul class="dropdown-menu">
								<li><a href="javascript:void();" onclick="open_share('../reporte/reporte_parentesco.php');" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a></li>

							</ul>

						</div></td></tr></table><br>
						<div class="table-responsive">
						<table id="parentesco_view" class="table table-striped table-bordered table-hover" >
							<thead class="btn-success">
								<tr><th>ID</th>
									<th>Nombre</th>
									<th>DUI</th>
									<th>Telef&oacute;no</th>
									<th>Trabajo</th>
									<th>Direcci&oacute;n</th>

									<th width="10%">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php


										$sql = "SELECT * FROM tb_parentesco  ORDER BY parent_nombre DESC";

										$result = $conn->query($sql);

										$rows = $result->fetchAll();

										foreach ($rows as $row) { 



										
											
											echo "<tr><td>".$row['idtb_parentesco']."</td>";
												?>
											<input type="hidden" id="parent_nombre_<?php echo $row['idtb_parentesco']; ?>" value="<?php echo $row['parent_nombre']; ?>">
											<input type="hidden" id="parent_dui_<?php echo $row['idtb_parentesco']; ?>" value="<?php echo $row['parent_dui']; ?>">

											<input type="hidden" id="parent_telefono_<?php echo $row['idtb_parentesco']; ?>" value="<?php echo $row['parent_telefono']; ?>">

											<input type="hidden" id="parent_trabajo_<?php echo $row['idtb_parentesco']; ?>" value="<?php echo $row['parent_trabajo']; ?>">

											<input type="hidden" id="parent_direccion_<?php echo $row['idtb_parentesco']; ?>" value="<?php echo $row['parent_direccion']; ?>">


											<?php 
											echo "<td>".$row['parent_nombre']."</td>";
											echo "<td>".$row['parent_dui']."</td>";
											echo "<td>".$row['parent_telefono']."</td>";
											echo "<td>".$row['parent_trabajo']."</td>";
											echo "<td>".$row['parent_direccion']."</td>";
echo "<td><div class='btn-group pull-right'>
<button  type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <i class='fa fa-cog'></i> Acciones <span class='fa fa-caret-down'></span></button>
												<ul class='dropdown-menu'>
													<li><a href='javascript:void();' onclick='editar_parentesco(".$row['idtb_parentesco'].");' data-toggle='modal' data-target='.myModalparent' ><i class='fa fa-edit'></i> Editar</a></li>	

													<li><a href='javascript:void();' onclick='eliminar_parent(".$row['idtb_parentesco'].");' ><i class='fa fa-trash'></i> Eliminar</a></li>							
												
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
		<?php include '../principal/footer.php'; ?>