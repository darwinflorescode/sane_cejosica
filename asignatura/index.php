<?php include '../principal/header.php'; 
include '../sessionstart/bloq_anio.php';
include '../perfil/permiso.php';
?>

<div  class="myModalmateria modal fade" style="display: none;">
	<div class="modal-dialog  modal-lg" >
		<div class="modal-content">
			<div class="modal-header" style="background: url('../librerias/pattern.png');">
				<button type="button" class="close" data-dismiss="modal">×</button>
				<h5 class="modal-title letra"  style="text-align: center; font-size: 30px;"><i class="fa fa-plus"></i> <span id="titulomate">Agregar Asignaturas</span>  <i class="fa fa-book"></i></h5>
			</div>
			<div class="modal-body">
				<form class="" id="form_mate_g" name="form_mate_g" autocomplete="off" method="POST" action="./" >
					<div align="right">
						<span>*</span> Datos Obligatorios
					</div>

					<input type="hidden" name="accion_gmate" id="accion_gmate" value="guardar">
					<input type="hidden" name="id_mate" id="id_mate" value="0">
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Ingrese la Siguiente Informaci&oacute;n: </legend>
						<table width="60%" class="responsive" >
							<tr>
								<td align="right">C&oacute;digo Asignatura: <span>*</span>&nbsp;</td><td>
									<input type="text" id="mate_cod" name="mate_cod" placeholder="C&oacute;digo Asignatura" class="form-control inputstl">
								
										</td>
							</tr><tr><td colspan="2">&nbsp;</td></tr>
							<tr>
								<td align="right">Nombre Asignatura: <span>*</span>&nbsp;</td><td>
									<input type="text" id="mate_nombre" onkeypress="return soloLetras(event)"onkeyup="this.value = this.value.toUpperCase();" onpaste="return false"  name="mate_nombre" placeholder="Nombre Asignatura" class="form-control inputstl">
								
										</td>
							</tr>
							<tr><td colspan="2">&nbsp;</td></tr>
							<tr></td><td align="right">Descripci&oacute;n: &nbsp;</td>
								<td><textarea type="text" id="mate_descripcion" name="mate_descripcion" placeholder="Descripci&oacute;n" class="form-control inputstl"></textarea></td></tr>

							</table>
						</fieldset>


						<div class="modal-footer">
							<button type="reset" class="btn btn-info" ><i class="fa fa-eraser"></i> Limpiar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
							<button type="submit" class="btn btn-danger"><i class="fa fa-save"></i> <l  id="btnguardarmateria">Guardar</l></button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>






<script type="text/javascript">
	
	$(document).ready(function() {

    //datatables
    table = $('#materia_view').DataTable({
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
					<h2><i class="fa fa-book"></i> Mantenimiento de Asignaturas</h2>
				</div>
				<div class="box-content">
					<table width="100%" ><tr><td><button class="btn btn-info" data-toggle="modal" data-target=".myModalmateria" onclick="limpiar_formulario_materia();" > <span class="fa fa-plus"></span> Nuevo</button></td><td align="right"><div class='btn-group pull-right'>
<button  type='button' class='btn btn-warning dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <i class='fa fa-print'></i> Reportes <span class='fa fa-caret-down'></span></button>
							<ul class="dropdown-menu">
								<li><a href="javascript:void();" onclick="open_share('../reporte/reporte_asignatura.php');"><i class="fa fa-file-pdf-o"></i> PDF</a></li>

							</ul>

						</div></td></tr></table><br>
						<div class="table-responsive">
						<table id="materia_view" class="table table-striped table-bordered table-hover" >
							<thead class="btn-success">
								<tr><th>ID</th>
									<th>Código Asignatura</th>
									<th>Nombre Asignatura</th>
									<th>Descripci&oacute;n</th>
									<th width="10%">Acciones</th>
								</tr>
							</thead>
							<tbody>
								<?php


										$sql = "SELECT * FROM tb_materia ";

										$result = $conn->query($sql);

										$rows = $result->fetchAll();

										foreach ($rows as $row) { 
											
											echo "<tr><td>".$row['idtb_materia']."</td>";
											?>
											<input type="hidden" id="mate_cod_<?php echo $row['idtb_materia']; ?>" value="<?php echo $row['cod_materia']; ?>">
											<input type="hidden" id="mate_nombre_<?php echo $row['idtb_materia']; ?>" value="<?php echo $row['mate_nombre']; ?>">

											<input type="hidden" id="mate_descripcion_<?php echo $row['idtb_materia']; ?>" value="<?php echo $row['mate_descripcion']; ?>">

											<?php 
											echo "<td>".$row['cod_materia']."</td>";
											echo "<td>".$row['mate_nombre']."</td>";
											echo "<td>".$row['mate_descripcion']."</td>";



											
echo "<td><div class='btn-group pull-right'>
<button  type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <i class='fa fa-cog'></i> Acciones <span class='fa fa-caret-down'></span></button>
												<ul class='dropdown-menu'>
													<li><a href='javascript:void();' onclick='editar_materia(".$row['idtb_materia'].");' data-toggle='modal' data-target='.myModalmateria' ><i class='fa fa-edit'></i> Editar</a></li>	

													<li><a href='javascript:void();' onclick='eliminar_materia(".$row['idtb_materia'].");' ><i class='fa fa-trash'></i> Eliminar</a></li>							
												
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