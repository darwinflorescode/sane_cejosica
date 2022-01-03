<?php 
include_once('../conexionpdo/config.php');
$conn = conexion();
if (isset($_POST['idmateria']) && isset($_POST['idseccion'])) {
	$id_seccion = $_POST['idseccion'];
	$id_materia = $_POST['idmateria'];
	

	$sql = "SELECT * FROM tb_materia where idtb_materia = ".$id_materia;
			//Ejecuta ala consulta
	$datos = $conn->query($sql);
	$materia = $datos->fetch(PDO::FETCH_ASSOC);
	$nombre_mate = "[".$materia['cod_materia']."] - ".$materia['mate_nombre'];


	$sql = "SELECT * FROM tb_seccion where idtb_seccion = ".$id_seccion;
			//Ejecuta ala consulta
	$datos = $conn->query($sql);
	$seccion = $datos->fetch(PDO::FETCH_ASSOC);
	$servicio_ed = $seccion['sec_servicio_ed'];
	$identificador = $seccion['sec_identificador'];
	$grado="";
	if ($servicio_ed==-1) {
		$grado =  "Parvularia 6 A&ntilde;os";
	}else if ($servicio_ed==-2) {
		$grado =  "Parvularia 5 A&ntilde;os";
	}else if ($servicio_ed==-3) {
		$grado =  "Parvularia 4 A&ntilde;os";
	}else{
		$grado =  $servicio_ed."° Grado";
	} 
	$grado .=  " \" ".$identificador." \"";

	?>

   <script>
      $(document).ready(function(){
        $(".numeronotas").inputmask();
      });
    </script>
	<script type="text/javascript">
		function validarnota(act,nombre, valor){
			
			if (parseFloat(valor)<0.00 || parseFloat(valor)>10.00) {
				document.getElementById(nombre).value=0.00;
				toastr.error("Lo siento, nota inválida en "+act+"<br>&nbsp;Ingrese nota en el rango de 0-10","¡Upss!",{timeOut:5000});
				
			}
		}

		function promedio(promp1,act1,act2,act3){

			var promedio=0.0,nota1=0.0,nota2=0.0,nota3=0.0;
			nota1 = document.getElementById(act1).value;
			nota2 = document.getElementById(act2).value;
			nota3 = document.getElementById(act3).value;
			promedio = ((nota1*0.35)+(nota2*0.35)+(nota3*0.30));
			document.getElementById(promp1).innerHTML =promedio.toFixed(1);

		}

		function promedioGeneral(){

			var cont = document.getElementById('contador_').value;
			var sum1 = 0.0;
			for (var i = 1; i <=cont; i++) {
				sum1+=parseFloat(document.getElementById('promedio1'+i).innerHTML);
			}
			document.getElementById('promedioI_').innerHTML = (parseFloat(sum1/cont)).toFixed(1);

			sum2 = 0.0;
			for (var i = 1; i <=cont; i++) {
				sum2+=parseFloat(document.getElementById('promedio2'+i).innerHTML);
			}
			document.getElementById('promedioII_').innerHTML = (parseFloat(sum2/cont)).toFixed(1);


			sum3 = 0.0;
			for (var i = 1; i <=cont; i++) {
				sum3+=parseFloat(document.getElementById('promedio3'+i).innerHTML);
			}
			document.getElementById('promedioIII_').innerHTML = (parseFloat(sum3/cont)).toFixed(1);


			pfinal = 0.0;
			for (var i = 1; i <=cont; i++) {
				pfinal+=parseFloat(document.getElementById('promediof'+i).innerHTML);
			}
			document.getElementById('promediociclo').innerHTML = (parseFloat(pfinal/cont)).toFixed(1);
			return true;
		}

		function promedioFinal(estado,promf,promp1,promp2,promp3){

			var promediof=0.0,prom1=0.0,prom2=0.0,prom3=0.0;
			prom1 = document.getElementById(promp1).innerHTML;
			prom2 = document.getElementById(promp2).innerHTML;
			prom3 = document.getElementById(promp3).innerHTML;
			promediof = ((parseFloat(prom1)+parseFloat(prom2)+parseFloat(prom3)) / 3);
			document.getElementById(promf).innerHTML =promediof.toFixed(1);

			var element =document.getElementById(estado);
			if (parseFloat(promediof)<4.5) {
				
				element.classList.add('label-danger');
				document.getElementById(estado).innerHTML ='Reprobado';
			}else{
				document.getElementById(estado).innerHTML ='Aprobado';
				element.classList.remove('label-danger');
				element.classList.add("label-success");
			}

		}
		function roundNumber(num, dec) {
			var result = Math.round(num.value*Math.pow(10,dec))/Math.pow(10,dec);
			num.value = result;
		}


		$(document).ready(function(){
			$(".numeronotas").inputmask();
		});

	</script>
	<style type="text/css">
	table tbody tr td input{
		width: 38px;

	}
	table thead tr th{
		text-align: center;

	}
	.tbody{
		text-align: center;

	}

	.letrasa{
		text-align:center; font-weight:bold; letter-spacing:5px;
	}

	.cart-view-table-front{
		font-size: 0.7em;
		position: fixed;
		right: 0px;
		bottom:  300px;
		max-width: 350px;
		font-family: Arial
	}
	.cart-view-table-front h3{
		text-align: center;
		padding: 0;
		margin: 0px 0px 6px 0px;
	}


</style>

<script type="text/javascript">
$(document).ready(function(){
  $('#_gnotas').submit(function(e){
    e.preventDefault();
    var errores = '';
    if ($('#contador_').val()=='' || $('#contador_').val()<=0) {
      errores += "* No hay estudiantes matrículados<br>";
      

    }


    if (errores!='') {
      toastr.error(errores, '¡Verifique lo siguiente!<br>Ingreso de Notas<br>', {timeOut: 5000})

      errores='';
      return;

    }else{


     var parametros = $(this).serialize();
     $.ajax({
      type: "POST",
      url: "g_notas_.php",
      data: parametros+"&accion_nota=updateNotes",
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
      },
      success: function(datos){
      	if (datos=='modificado_n') {
      		 toastr.success(" Se guardaron los cambios de notas","¡Excelente!",{timeOut:5000});
      	}else if (datos=='error_n') {
      		 toastr.error(" No se actualizaron las notas correctamente","¡Error!",{timeOut:5000});
      	}else{
      		 toastr.error("- Ha ocurrido un error inesperado, Intentalo de Nuevo","¡Error!",{timeOut:5000});
      	}
       


      }

    });
   }

 });
});
</script>

<hr>

<div style="text-align:center; padding-bottom:10px;">
	<strong>
		<div>REGISTRO DE NOTAS DE <b><?php echo $grado; ?></b></div>

	</strong>
	<div>Listado de estudiantes matrículados</div>
</div>
<div class="table-responsive">	
	<form method="POST" action="./" id="_gnotas" name="_gnotas" autocomplete="off">
		<table class="table table-bordered table-condensed alinear" style="font-size: 12px;">

			<thead class="alert btn-success">
				<tr><th colspan="17" >NOMBRE ASIGNATURA: <strong><?php echo $nombre_mate; ?></strong></th></tr>
			</thead>
			<thead style="background-color: #f1f1f1" >
				<tr><th colspan="17" class="letrasa" ><strong>REGISTRO DE NOTAS</strong></th></tr>
			</thead>
			<thead style="background-color: #f4f4f4">
				<tr>
					<th rowspan="2">N°<br><br></th>
					<th rowspan="2" >NIE<br><br></th>
					<th rowspan="2">NOMBRE COMPLETO<br><br></th>

					<th colspan="4">I TRIMESTRE</th>
					<th colspan="4">II TRIMESTRE</th>
					<th colspan="4">III TRIMESTRE</th>
					<th rowspan="2">PROMEDIO FINAL<br><br></th>
					<th rowspan="2">ESTADO<br><br></th>
				</tr>

				<tr>
					<?php 
					$i=0;
					while($i<3){
						?>
						<th>Act #1<br>35%</th>
						<th>Act #2<br>35%</th>
						<th>Exam<br>30%</th>
						<th>PROM</th>

						<?php 
						$i++;
					}
					?>


				</tr>
			</thead>

			<tbody class="tbody">
				<?php 


				$sql = "SELECT tb_matricula.*, tb_estudiante.*, tb_seccion.* FROM `tb_matricula` INNER JOIN tb_estudiante on tb_matricula.matri_idestudiante = tb_estudiante.idestudiante inner join tb_seccion on tb_matricula.matri_idtb_seccion = tb_seccion.idtb_seccion where tb_matricula.matri_idtb_seccion=".$id_seccion." ORDER BY est_apellido asc";

				$result = $conn->query($sql);
					$promedioI="0.0";
					$promedioII="0.0";
					$promedioIII="0.0";
					$promF="0.0";
				$rows = $result->fetchAll();
				if ($result->rowcount()){


					$i=1;
				
					foreach ($rows as $row) {

						$sql = "SELECT * FROM tb_nota WHERE not_idtb_matricula=".$row['idtb_matricula']." AND not_idtb_materia=".$id_materia;

						$result = $conn->query($sql);

						$rows = $result->fetchAll();
						if (!$result->rowcount()){
							$stmt = "INSERT INTO tb_nota (not_p1_act1,not_p1_act2,not_p1_act3,not_p1_promuno,not_p2_act1,not_p2_act2,not_p2_act3,not_p2_prom2,not_p3_act1,not_p3_act2,not_p3_act3,not_p3_prom3,not_idtb_materia,not_idtb_matricula) VALUES (0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,0.0,$id_materia,".$row['idtb_matricula'].")";

							if ($conn->query($stmt)){  }
						}

					?>


					<tr>

						<input type="hidden" name="idmatricula<?php echo $i;?>" value="<?php echo $row['idtb_matricula']; ?>">
						<input type="hidden" name="idasignatura<?php echo $i;?>" value="<?php echo $id_materia; ?>">
						<td><?php echo $i; ?></td>
						<th><?php echo $row['est_nie']; ?></th>
						<td align="left"><?php echo $row['est_nombre']." ". $row['est_apellido']; ?></td>

						<?php  

						for ($m=1; $m <=3 ; $m++) { 
							$sqln = "SELECT * FROM tb_nota WHERE not_idtb_matricula=".$row['idtb_matricula']." AND not_idtb_materia=".$id_materia;

							$resultado = $conn->query($sqln);
							$notas_m = $resultado->fetch(PDO::FETCH_ASSOC);
							
							if ($m==1) {
								$nota1 = $notas_m['not_p1_act1'];
								$nota2 = $notas_m['not_p1_act2'];
								$nota3 = $notas_m['not_p1_act3'];
								$promedio= $notas_m['not_p1_promuno'];
								$promedioI +=$promedio;

							}else if ($m==2) {
								$nota1 = $notas_m['not_p2_act1'];
								$nota2 = $notas_m['not_p2_act2'];
								$nota3 = $notas_m['not_p2_act3'];
								$promedio= $notas_m['not_p2_prom2'];
								$promedioII +=$promedio;
							}else{
								$nota1 = $notas_m['not_p3_act1'];
								$nota2 = $notas_m['not_p3_act2'];
								$nota3 = $notas_m['not_p3_act3'];
								$promedio= $notas_m['not_p3_prom3'];
								$promedioIII +=$promedio;
							}
							if ($nota1 ==0.0) {
								$nota1 = '';
							}
							if ($nota2 ==0.0) {
								$nota2 = '';
							}
							if ($nota3 ==0.0) {
								$nota3 = '';
							}
							$notapromf = ($notas_m['nota_prom_final']);
							

							?>

							<td><input  type="text"  onblur="roundNumber(this,1);" class="numeronotas" onkeyup="validarnota('Act #1','nota1p<?php echo $m.$i;?>',this.value); promedioGeneral(); promedio('promedio<?php echo $m.$i;?>','nota1p<?php echo $m.$i;?>','nota2p<?php echo $m.$i;?>','nota3p<?php echo $m.$i;?>'); promedioFinal('estado_final<?php echo $i;?>','promediof<?php echo $i;?>','promedio1<?php echo $i;?>','promedio2<?php echo $i;?>','promedio3<?php echo $i;?>');" onkeydown="validarnota('Act #1','nota1p<?php echo $m.$i;?>',this.value); promedioGeneral(); promedio('promedio<?php echo $m.$i;?>','nota1p<?php echo $m.$i;?>','nota2p<?php echo $m.$i;?>','nota3p<?php echo $m.$i;?>'); promedioFinal('estado_final<?php echo $i;?>','promediof<?php echo $i;?>','promedio1<?php echo $i;?>','promedio2<?php echo $i;?>','promedio3<?php echo $i;?>');" onchange="promedioGeneral();" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" placeholder="0.00" name="nota1p<?php echo $m.$i;?>" id="nota1p<?php echo $m.$i;?>" value="<?php echo $nota1;?>"></td>


							<td><input type="text" onblur="roundNumber(this,1);;" class="numeronotas" onkeyup ="validarnota('Act #2','nota2p<?php echo $m.$i;?>',this.value); promedioGeneral(); promedio('promedio<?php echo $m.$i;?>','nota1p<?php echo $m.$i;?>','nota2p<?php echo $m.$i;?>','nota3p<?php echo $m.$i;?>'); promedioFinal('estado_final<?php echo $i;?>','promediof<?php echo $i;?>','promedio1<?php echo $i;?>','promedio2<?php echo $i;?>','promedio3<?php echo $i;?>');" onkeydown ="validarnota('Act #2','nota2p<?php echo $m.$i;?>',this.value); promedioGeneral(); promedio('promedio<?php echo $m.$i;?>','nota1p<?php echo $m.$i;?>','nota2p<?php echo $m.$i;?>','nota3p<?php echo $m.$i;?>'); promedioFinal('estado_final<?php echo $i;?>','promediof<?php echo $i;?>','promedio1<?php echo $i;?>','promedio2<?php echo $i;?>','promedio3<?php echo $i;?>');" onchange="promedioGeneral();"  data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" placeholder="0.00" name="nota2p<?php echo $m.$i;?>" id="nota2p<?php echo $m.$i;?>" value="<?php echo $nota2;?>"></td>


							<td><input type="text" onblur="roundNumber(this,1);" class="numeronotas" onkeyup ="validarnota('Examen','nota3p<?php echo $m.$i;?>',this.value); promedioGeneral(); promedio('promedio<?php echo $m.$i;?>','nota1p<?php echo $m.$i;?>','nota2p<?php echo $m.$i;?>','nota3p<?php echo $m.$i;?>'); promedioFinal('estado_final<?php echo $i;?>','promediof<?php echo $i;?>','promedio1<?php echo $i;?>','promedio2<?php echo $i;?>','promedio3<?php echo $i;?>');" onkeydown ="validarnota('Examen','nota3p<?php echo $m.$i;?>',this.value); promedioGeneral(); promedio('promedio<?php echo $m.$i;?>','nota1p<?php echo $m.$i;?>','nota2p<?php echo $m.$i;?>','nota3p<?php echo $m.$i;?>'); promedioFinal('estado_final<?php echo $i;?>','promediof<?php echo $i;?>','promedio1<?php echo $i;?>','promedio2<?php echo $i;?>','promedio3<?php echo $i;?>');" onchange="promedioGeneral();" data-inputmask="'alias': 'numeric', 'autoGroup': true, 'digits': 2, 'digitsOptional': false, 'placeholder': '0'" placeholder="0.00" name="nota3p<?php echo $m.$i;?>" id="nota3p<?php echo $m.$i;?>" value="<?php echo $nota3;?>"></td>

							<td style="background-color: #f9f9f9"><b id="promedio<?php echo $m.$i;?>" ><?php echo number_format($promedio,1); ?></b></td>



							<?php  }
							$promF +=$notapromf;
							?>
							<td style="color: blue; font-size: 18px;"><b id="promediof<?php echo $i;?>"><?php echo number_format($notapromf,1); ?></b></td>
							<td><?php if ($notapromf<4.5) {
					echo '<label class="label label-danger" id="estado_final'.$i.'">Reprobado</label>';
				}else{
					echo '<label class="label label-success" id="estado_final'.$i.'">Aprobado</label>';
				}
				 ?></td>
						</tr>

						<?php $i++;
					}
				}else{
					$i=1;
					?>

					<tr><td colspan='18'><div class='alert alert-danger alert-dismissable' align='center'>
						<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>
						<h4>¡Aviso!</h4>No hay estudiantes matriculados en esta sección
					</div></td></tr>

					<?php } ?>

				</tbody>

				<tfoot style="background-color: #f4f4f4" >
					<tr><td colspan="6" align="right"><b>PROMEDIO I TRIMESTRE</b></td>
						<td style=" text-align: center;"><b id="promedioI_"><?php if ($i>1) {
							echo number_format(($promedioI/($i-1)),1);
						}else{
							echo $promedioI;
						} ?></b></td>
						<td  colspan="3"  align="right"><b>PROMEDIO II TRIMESTRE</b></td><td style="text-align: center;"><b id="promedioII_"><?php if ($i>1) {
							echo number_format(($promedioII/($i-1)),1);
						}else{
							echo $promedioII;
						} ?></b></td>
						<td  colspan="3" align="right"><b>PROMEDIO III TRIMESTRE</b></td><td style="text-align: center;"><b id="promedioIII_"><?php if ($i>1) {
							echo number_format(($promedioIII/($i-1)),1);
						}else{
							echo $promedioIII;
						} ?></b></td>
						<td style="color: blue; font-size: 18px;" align="center"><b id="promediociclo"><?php if ($i>1) {
							echo number_format(($promF/($i-1)),1);
						}else{
							echo $promF;
						} ?></b></td><td></td>
					</tr>
				</tfoot>
			</table>
			<input type="hidden" name="contador_" id="contador_" value="<?php echo ($i-1); ?>">
			<div class="cart-view-table-front">
				<button type="submit" id="_gnot" name="_gnot" class="alert alert-success"><img src="../librerias/save.png" width="18px"></button>
			</div><!-- View Cart Box End -->
		</form></div>
	</fieldset>


	<?php 

}else{
	echo "Error";
}
?>