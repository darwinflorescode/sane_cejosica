<?php include '../principal/header.php'; 
include '../sessionstart/bloq_anio.php';

$sqll = "SELECT * FROM tb_usuario where idtb_usuario=".$_SESSION["idtb_usuario_ingreso"];
$datas = $conn->query($sqll);

$user_perfil = $datas->fetch(PDO::FETCH_ASSOC);
?>

<div class="todo">
	<div class="row">
		<div class="box col-md-12">
			<div class="box-inner">
				<div class="box-header well" data-original-title="">
					<h2><i class="fa fa-user"></i> Perfil de Usuario</h2>
				</div>
				<div class="box-content">
					<b><font color="red">* Solo puedes cambiar tu contraseña</font></b><br><br>
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Datos de Usuario : </legend>
						<table width="100%">
							<tr>
								<td width="10%"><b>Nombre Completo</b></td><td><b>:</b></td><td><input class="form-control" type="text" name="" readonly="" value="<?php echo $_SESSION["nom_completo"]; ?>"></td>

								<td>&nbsp;</td><td width="5%" align="right"><b>DUI</b> </td><td><b>:</b></td><td width="10%"> <input class="form-control" placeholder="DUI" type="text" name="" readonly="" value="<?php echo $user_perfil["user_dui"]; ?>"></td>

								<td>&nbsp;</td><td width="5%" align="right"><b>NIT</b> </td><td><b>:</b></td><td width="10%"> <input class="form-control" placeholder="NIT" type="text" name="" readonly="" value="<?php echo $user_perfil["user_nit"]; ?>"></td>

								<td>&nbsp;</td><td width="5%" align="right"><b>Teléfono</b> </td><td><b>:</b></td><td width="10%"> <input class="form-control" type="text" placeholder="Teléfono" name="" readonly="" value="<?php echo $user_perfil["user_telefono"]; ?>"></td>

								<td>&nbsp;</td><td width="5%" align="right"><b>Profesión</b> </td><td><b>:</b></td><td width="10%"><textarea class="form-control" placeholder="Profesión" readonly=""><?php echo $user_perfil["user_profesion"]; ?></textarea></td>
							</tr>
						</table>
					</fieldset>
					<fieldset class="scheduler-border">
						<legend class="scheduler-border">Datos de Acceso : </legend>
						<table width="40%">
							<tr>
								<td width="30%" align="right"><b>E-mail</b> </td><td><b>&nbsp;:</b></td><td> <input class="form-control" type="text" name="" placeholder="E-mail" readonly="" value="<?php echo $user_perfil["user_email"]; ?>"></td>


							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td  align="right"><b>Usuario</b> </td><td><b>&nbsp;:</b></td><td> <input class="form-control" type="text" name="" readonly="" value="<?php echo $user_perfil["user_usuario"]; ?>"></td>


							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td  align="right"><b>Contraseña</b> </td><td><b>: <font color="red">*</font></b></td><td> <input class="form-control" type="password" id="clave1" placeholder="Nueva Contraseña" value=""></td>


							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>
								<td align="right"><b>Repetir Contraseña</b> </td><td><b>: <font color="red">*</font></b></td><td> <input class="form-control" type="password" id="clave2" placeholder="Repetir Contraseña" value=""></td>


							</tr>
							<tr><td>&nbsp;</td></tr>
							<tr>

								<td align="right" colspan="3"><button class="btn btn-success" onclick="cambiarPass(<?php echo $_SESSION["idtb_usuario_ingreso"]; ?>);"><span class="fa fa-unlock"></span> Cambiar Clave</button></td>


							</tr>
						</table>
					</fieldset>
					

				</div>
			</div>
		</div>
	</div>
	<!--/span-->

</div><!--/row-->
<?php include '../principal/footer.php'; ?>