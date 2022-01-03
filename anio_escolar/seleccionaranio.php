<?php include '../principal/header.php'; ?>

</script>
<div class="todo container">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-calendar"></i> Te recomendamos que selecciones un año escolar</h2>
				</div>
				
				<div class="box-content">

					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Año Escolar</legend>
						<form action="./" id="form_anio" method="post" name="form_anio" accept-charset="utf-8"   autocomplete="off" role="form">

							<table  width="50%"  style="text-align: right; " >

								<tr><td><label for="user1">Año: <label class="fa fa-calendar"> &nbsp;</label> </label><span>*</span>&nbsp;</td><td>
									<select class="form-control inputstl" name="anio" id="anio" >
										<option value="">Seleccione el Año Escolar</option>
										<?php


										$sql = "SELECT * FROM tb_anio_escolar   order by anio desc";

										$result = $conn->query($sql);

										$rows = $result->fetchAll();

										$select  = "";
										foreach ($rows as $row) { 

											if ($row['anio']==date('Y')) {
												$select = "selected";
											}else{
												$select = "";
											}


											echo "<option $select value='";
											echo $row['anio'];           

											echo "'>";
											echo $row['anio']; 


											echo "</option>";
										}

										?>

									</select></td></tr>

									<tr><td colspan="2">&nbsp;</td></tr>

									<tr><td colspan="2" align="center"><div class="panel-footer">

										<button id="btn_registrar" type="submit" class="btn btn-danger"><i class="ace-icon fa fa-arrow-right bigger-110"></i> Continuar...</button>


									</div></td></tr> 
								</table> 
							</form>
						</fieldset>




					</div>
				</div>
			</div>
			<!--/span-->

		</div><!--/row-->


	</div>
<br><br><br><br><br>

	<?php include '../principal/footer.php'; ?>