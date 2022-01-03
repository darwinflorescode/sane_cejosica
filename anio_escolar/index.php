<?php include '../principal/header.php';
include '../sessionstart/bloq_anio.php';
include '../perfil/permiso.php';
 ?>


<script type="text/javascript">
	
	$(document).ready(function() {

    //datatables
    table = $('#anio_escolar_view').DataTable({
    	"pageLength":5
    });
});
</script>
<div class="todo">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-calendar"></i> Mantenimiento de A&ntilde;o Escolar</h2>
				</div>
				<div class="box-content">
					<table width="100%" ><tr><td><button class="btn btn-info" onclick="limpiarformularioanio();" data-toggle="modal" data-target=".myModalanio" > <span class="fa fa-plus"></span> Nuevo</button></td><td align="right"><div class='btn-group pull-right'>
<button  type='button' class='btn btn-warning dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <i class='fa fa-print'></i> Reportes <span class='fa fa-caret-down'></span></button>
							<ul class="dropdown-menu">
								<li><a href="javascript:void();" onclick="open_share('../reporte/reporte_anio.php');" ><i class="fa fa-file-pdf-o"></i> PDF</a></li>

							</ul>

						</div></td></tr></table>
						<br>
						<div class="table-responsive">

					<table id="anio_escolar_view" class="table table-striped table-bordered table-hover">
						<thead class="btn-success">
						<tr >
							<th>ID</th>
							<th>A&ntilde;o</th>
							<th>Desde</th>
							<th>Hasta</th>
							<th>Descripci&oacute;n</th>
							<th>Estado</th>
							<th  width="10%" >Acciones</th>
						  </tr>
						  </thead>
						  <tbody>
							
								<?php


										$sql = "SELECT * FROM tb_anio_escolar  ORDER BY anio DESC";

										$result = $conn->query($sql);

										$rows = $result->fetchAll();

										foreach ($rows as $row) { 


											echo "<tr><td>".$row['idtb_anio_escolar']."</td>";

											?>
											<input type="hidden" id="anio_<?php echo $row['idtb_anio_escolar']; ?>" value="<?php echo $row['anio']; ?>">
											
											<input type="hidden" id="fecha_inicio<?php echo $row['idtb_anio_escolar']; ?>" value="<?php echo $row['anio_fecha_inicio']; ?>">

											<input type="hidden" id="fecha_fin<?php echo $row['idtb_anio_escolar']; ?>" value="<?php echo $row['anio_fecha_final']; ?>">

											<input type="hidden" id="anio_descripcion<?php echo $row['idtb_anio_escolar']; ?>" value="<?php echo $row['anio_descrip']; ?>">

											<input type="hidden" id="anio_estado<?php echo $row['idtb_anio_escolar']; ?>" value="<?php echo $row['anio_estado']; ?>">

											<?php 


											echo "<td>".$row['anio']."</td>";
											echo "<td>".$row['anio_fecha_inicio']."</td>";
											echo "<td>".$row['anio_fecha_final']."</td>";
											echo "<td>".$row['anio_descrip']."</td>";

											$clase = "";
											$close ="";
											if ($row['anio_estado'] == "Activo") {
												$clase = "label label-success";
												$close="<li><a href='javascript:void();' onclick='cambiarestado_anio(".$row['idtb_anio_escolar'].");'><i class='fa fa-close'></i> Cerrar A&ntilde;o</a></li>";
											}else
											{
												$clase = "label label-danger";
											}

											echo "<td><span class='".$clase."'>".$row['anio_estado']."</span></td>";


											echo "<td><div class='btn-group pull-right'>
<button  type='button' class='btn btn-danger dropdown-toggle' data-toggle='dropdown' aria-expanded='false'> <i class='fa fa-cog'></i> Acciones <span class='fa fa-caret-down'></span></button>
												<ul class='dropdown-menu'>
													<li><a href='javascript:void();' onclick='editar_anio(".$row['idtb_anio_escolar'].");'  data-toggle='modal' data-target='.myModalanio'><i class='fa fa-edit'></i> Editar</a></li>".$close."								
												
												</ul>

											</div></td></tr>";
											


									
										}

 
										


										?>
							

</tbody>
					</table>
					<br><br>
					</div>
					

</div>
					</div>
				</div>
			</div>
			<!--/span-->

		</div><!--/row-->
		<?php include '../principal/footer.php'; ?>