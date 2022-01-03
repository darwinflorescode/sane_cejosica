	<?php 

	include_once('../conexionpdo/config.php');
	$conn = conexion();
	if (isset($_GET['q'])) {
		# code...
	
	$idestudiante= $_GET['q'];

	//Consulta Donde se comprueba  que el usuario existe


	$sql = "SELECT tb_parentesco_estudiante.*,tb_parentesco.* FROM tb_parentesco_estudiante inner join tb_parentesco on tb_parentesco_estudiante.tb_parentesco_id = tb_parentesco.idtb_parentesco where tb_parentesco_estudiante.tb_estudiante_id = $idestudiante order by tbid_parent_est desc";

	$result = $conn->query($sql);

	$rows = $result->fetchAll();


	?>

	<table class="table table-striped table-bordered table-hover">
		<caption align="center"><strong>Listado de Familiares de Estudiante</strong></caption>
		<thead class="btn-info">
			<tr>
				<th>Nombre Completo</th>
				<th>DUI</th>
				<th>Parentesco</th>
				<th>Responsable</th>
				<th width="5%">Acciones</th>
			</tr>
		</thead>
<tbody>

		<?php 
$clase ="";
		if ($result->rowcount()) {

			foreach ($rows as $row) { 
				echo "<tr>";

				echo "<td >".$row['parent_nombre']."</td>";
				echo "<td >".$row['parent_dui']."</td>";
				echo "<td>".$row['tb_tipo']."</td>";
if ($row['tb_responsable']=="SI") {
	$clase = "label label-success";
}else{
	$clase = "label label-default";
}


				echo "<td align='center'><label class='".$clase."'>".$row['tb_responsable']."</label></td>";
				echo "<td align='center'><a href='javascript:void();' title='Quitar' onclick='quitar_fam(".$row['tbid_parent_est'].");'><i style='font-size: 25px;' class='fa fa-trash'><i></a></td>";
				echo "</tr>";



			}

		}else{ ?>

<tr>
	<td colspan="5"><div class='alert alert-danger alert-dismissable' align='center'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<h4>¡Aviso!</h4><b>¡Advertencia!</b> No ha registro de familiares</div></td>
</tr>

		<?php 
}
		 ?>

		</tbody>
	</table>

	<?php 

 }else{

	 ?> 
<div class='alert alert-danger alert-dismissable' align='center'>
			<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
			<h4>¡Aviso!</h4><b>¡Error!</b> No existe ninguna relación con su busqueda</div>

<?php } ?>