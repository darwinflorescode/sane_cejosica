<?php include '../principal/header.php'; 
include '../sessionstart/bloq_anio.php';
include '../perfil/permiso.php';
?>

<div class="todo">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-database"></i> Copia de Seguridad de Base de Datos</h2>
				</div>
				<div class="box-content">
					
				<button class="btn btn-danger" onclick="generar_backup();"><span class="fa fa-database"></span> Crear Backup</button>
					
			<br><br>
<table  class="table table-striped table-bordered table-hover">
						<thead class="btn-success">
						<tr >
							<th>N°</th>
							<th>Nombre, Fecha y Hora de base de datos</th>
							<th  width="10%" >Acciones</th>
						  </tr>
						  </thead>
						  <tbody>
			<?php 

			  $ruta='copiasDB/';
			  $i=1;
        if(is_dir($ruta)){
          if($aux=opendir($ruta)){
             while (($archivo = readdir($aux)) !== false){

               if ($archivo!="."&&$archivo!=".."){
                    $nombrearchi= str_replace(".sql","",$archivo);
                      $nombrearchivo=str_replace("-","/",$nombrearchi);
                      $nombrear=str_replace(".",":",$nombrearchivo);
                     $ruta_completa=$ruta.$archivo;
                      if(is_dir($ruta_completa)){
                      }else{
                        echo'<tr><td>'.$i.'</td><td>'.$nombrear.'</td><td><a title="Descargar SQL de Base de datos" href="'.$ruta_completa.'"><span class="fa fa-download"></span></a> | <a title="Eliminar" href="javascript:eliminarBackup(\''.$ruta_completa.'\');"><span class="fa fa-trash"></span></a></td></tr>';
                        $i++;
                      }
                   }

                   
                    }
                 closedir($aux);
               }
            }else{
    echo $ruta." no es ruta valida";
  }

			 ?>
					

</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<!--/span-->

</div><!--/row-->
<?php include '../principal/footer.php'; ?>

