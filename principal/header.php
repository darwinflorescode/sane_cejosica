<?php
include '../sessionstart/bloqsession.php';
include_once('../conexionpdo/config.php');
$conn = conexion();

$sql = "SELECT * FROM tb_anio_escolar where anio = " . $_SESSION['anio_escolar'];
//Ejecuta ala consulta
$valores = $conn->query($sql);
if (!$valores->rowcount()) {
	$_SESSION['anio_escolar'] = 0;
}


if (($_SESSION['tipo_user'] == "Administrador") || ($_SESSION['tipo_user'] == "Director")) {
	$sqlautorizo = "";
} else {
	$sqlautorizo = " and sec_idtbuser=" . $_SESSION["idtb_usuario_ingreso"];
}



?>
<!DOCTYPE html>

<html>

<head lang="es">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<link rel="shortcut icon" href="../librerias/cejosicalogo.png" />
	<title>SANE-CEJOSICA</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="../librerias/micss.css">


	<script src="../librerias/jquery.min.js"></script>

	<script src="../librerias/select/chosen.jquery.js"></script>
	<script src="../librerias/select/ImageSelect.jquery.js"></script>
	<script src="../librerias/bootstrap.min.js"></script>
	<script type="text/javascript" src="../datatables/jquery.dataTables.min.js"></script>
	<script src="../librerias/toastr.min.js"></script>
	<script type="text/javascript" src="../librerias/procesos.js"></script>
	<script type="text/javascript" src="../librerias/deledit.js"></script>
	<script type="text/javascript" src="../iconos_fa/jquery.maskedinput.min.js"></script>
	<script type="text/javascript" src="../librerias/jquery.inputmask.bundle.min.js"></script>
	<script src="../librerias/validacion.js"></script>
</head>

<body>


	<!--INICIO DE LA BARRA DE NAVEGACIÓN-->

	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container-fluid">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">

				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<a class="navbar-brand" href="./">
					<l class="textopar parpadea">SANE-CEJOSICA </l><img src="../librerias/cejosicalogo.png" class="" height="50px" alt="">
				</a>

			</div>

			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav navbar-left">
					<li><a href="../principal/"><span class="fa fa-home"> </span> Inicio</a></li>


					<?php if (($_SESSION['tipo_user'] == "Administrador") || ($_SESSION['tipo_user'] == "Director")) { ?>

						<li><a style="cursor: pointer;" onclick="limpiarformularioanio();" data-toggle="modal" data-target=".myModalanio"><span class="fa fa-calendar-o"> </span> Administrar año</a></li>
					<?php  }

					if ($_SESSION['tipo_user'] == "Docente" && $_SESSION["anio_escolar"] > 0) { ?>


						<li class="dropdown ">

							<a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-graduation-cap"></span> Procesos para Docentes <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="../notas/"><span class="fa fa-pencil-square"></span> Registro de Notas de estudiantes</a></li>
								<li><a href="../m_reporte/"><span class="fa fa-line-chart"></span> Reporte de Notas</a></li>
							</ul>
						</li>

					<?php
					}


					if ((($_SESSION['tipo_user'] == "Administrador") || ($_SESSION['tipo_user'] == "Director")) && $_SESSION["anio_escolar"] > 0) {
					?>

						<li class="dropdown ">

							<a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-university"></span> Sede <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="../anio_escolar/"><span class="fa fa-calendar"></span> Administrar A&ntilde;o Escolar</a></li>
								<li><a href="../usuario/"><span class="fa fa-users"></span> Administrar Usuario Personal</a></li>
								<li class="divider"></li>
								<li><a href="../seccion/"><span class="fa fa-tags"></span> Administrar Secciones</a></li>
								<li><a href="../seccion-asignatura/"><span class="fa fa-tags"></span> Asignar Asignaturas a Secciones</a></li>
								<li class="divider"></li>
								<li><a href="../asignatura/"><span class="fa fa-book"></span> Administrar Asignaturas</a></li>

								<li class="divider"></li>
								<li><a href="../backup/"><span class="fa fa-database"></span> Copia De Seguridad</a></li>

							</ul>
						</li>

						<li class="dropdown ">

							<a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-graduation-cap"></span> Estudiantes <b class="caret"></b></a>
							<ul class="dropdown-menu">
								<li><a href="../parentesco/"><span class="fa fa-group"></span> Familiares de Estudiantes</a></li>
								<li><a href="../estudiante/"><span class="fa fa-graduation-cap"></span> Estudiantes</a></li>
								<li><a href="../matricula/"><span class="fa fa-pencil-square-o"></span> Matricula</a></li>

								<li class="divider"></li>

								<li><a href="../notas/"><span class="fa fa-pencil-square"></span> Registro de Notas</a></li>

							</ul>
						</li>

						<li class="dropdown ">

							<a href="" class="dropdown-toggle" data-toggle="dropdown"><span class="fa fa-line-chart"></span> Reportes <b class="caret"></b></a>
							<ul class="dropdown-menu">

								<li><a href="../m_reporte/"><span class="fa fa-pencil-square"></span> Reporte de Notas</a></li>



							</ul>
						</li>
					<?php  } ?>

					<li><a href="https://www.facebook.com/Complejo-Educativo-Jos%C3%A9-Sime%C3%B3n-Ca%C3%B1as-1862498180640853/" target="_blank"><i class="fa fa-facebook-official" aria-hidden="true"></i></a></li>

				</ul>
				<ul class="nav navbar-nav navbar-right">
					<?php if ($_SESSION["id_tipo"] > 0 && $_SESSION["anio_escolar"] > 0) : ?>
						<li><a href="javascript:void();" data-toggle="modal" data-target=".myModal_cambio_anio"><span class="fa fa-calendar"></span> A&ntilde;o Escolar: <?php echo $_SESSION['anio_escolar']; ?></a></li>
					<?php endif ?>
					<li class="dropdown">
						<a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-user-circle-o"></i>&nbsp;<?php echo strtoupper($_SESSION['user_session']) . " (" . $_SESSION['tipo_user'] . ") ";

																																			if ((@$_SESSION["tipo_user"] != "Administrador")) {
																																				//echo $_SESSION['grado']."° Grado \"".$_SESSION['seccion']."\"";
																																			}
																																			?> <i class="caret"></i>

						</a>
						<ul class="dropdown-menu">
							<li>
								<a href="../perfil/"><span class="fa fa-user-o"></span> Perfil</a>
							</li>

							<li class="divider"></li>
							<li>
								<a href="javascript: void();" onclick="salir();"><span class="fa fa-power-off"></span> Salir</a>
							</li>
						</ul>
					</li>
				</ul>


			</div><!-- /.navbar-collapse -->
		</div><!-- /.container-fluid -->
	</nav>

	<!--INICIO DE BANNER-->

	<div class="banner" style="text-align: center;">



		<img src="../librerias/cejosicalogo.png" alt="Logo Universidad de El Salvador" class="loguito">
		<span class="letra">&nbsp;Sistema de Administración de Notas Escolar, Complejo Educativo José Simeón Cañas (SANE-CEJOSICA)</span>
	</div>
	<!--Acá termina el banner-->


	<div class="myModalanio modal fade" style="display: none;">
		<div class="modal-dialog  modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background: url('../librerias/pattern.png');">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title letra" style="text-align: center; font-size: 30px;"><i class="fa fa-plus"></i> <span id="titulo">Agregar un Año Escolar</span> <i class="fa fa-calendar"></i></h5>

				</div>
				<div class="modal-body">
					<form class="" id="form_anio_g" name="form_anio_g" autocomplete="off" method="POST" action="./">
						<div align="right">
							<span>*</span> Datos Obligatorios
						</div>

						<input type="hidden" name="accion_g" id="accion_g" value="guardar">
						<input type="hidden" name="id_anio" id="id_anio" value="0">
						<fieldset class="scheduler-border">
							<legend class="scheduler-border">Ingrese la Siguiente Informaci&oacute;n: </legend>
							<table width="100%" class="responsive">
								<tr>
									<td align="right">A&ntilde;o: <span>*</span>&nbsp;</td>
									<td><input type="number" min="2010" placeholder="Año Escolar" name="anio_es" id="anio_es" class="form-control inputstl"></td>

								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
									<td align="right">Fecha Inicio: <span>*</span>&nbsp;</td>
									<td><input type="date" name="fecha_inicio" id="fecha_inicio" value="<?php echo date('Y-m-d'); ?>" class="form-control inputstl"></td>
									<td align="right">Fecha Fin: <span>*</span>&nbsp;</td>
									<td><input type="date" min="" name="fecha_fin" value="<?php echo date('Y-m-d'); ?>" id="fecha_fin" class="form-control inputstl"></td>
								</tr>

								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
									<td align="right">Descripci&oacute;n: &nbsp;</td>
									<td colspan="3"><textarea class="form-control inputstl" name="descripcion" id="descripcion" placeholder="Descripci&oacute;n"></textarea></td>
								</tr>
								<tr>
									<td colspan="2">&nbsp;</td>
								</tr>
								<tr>
									<td align="right">Estado: <span>*</span>&nbsp;</td>
									<td colspan="1"><select name="estado" id="estado" class="form-control inputstl">
											<option selected="" value="Activo">Activo</option>
											<option value="Inactivo">Inactivo</option>
										</select></td>
								</tr>
							</table>


						</fieldset>


						<div class="modal-footer">
							<button type="reset" class="btn btn-info"><i class="fa fa-eraser"></i> Limpiar</button>
							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
							<button type="submit" class="btn btn-danger"><i class="fa fa-save"></i>
								<l id="btnguardaranio">Guardar</l>
							</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>
	<!-- modal de cambio de año escolar -->
	<div class="myModal_cambio_anio modal fade" style="display: none;">
		<div class="modal-dialog  modal-lg">
			<div class="modal-content">
				<div class="modal-header" style="background: url('../librerias/pattern.png');">
					<button type="button" class="close" data-dismiss="modal">×</button>
					<h5 class="modal-title letra" style="text-align: center; font-size: 30px;"><i class="fa fa-plus"></i> Cambio de Año Escolar <i class="fa fa-calendar"></i></h5>
				</div>
				<div class="modal-body">
					<form class="" id="form_anio_cambio" name="form_anio_cambio" autocomplete="off" method="POST" action="./">


						<fieldset class="scheduler-border">
							<legend class="scheduler-border">Año Escolar: </legend>
							<table width="40%" class="responsive">
								<tr>
									<td align="right">A&ntilde;o: <span>*</span>&nbsp;</td>
									<td><select class="form-control inputstl" name="anio_cambio" id="anio_cambio">
											<option value="">Seleccione el Año Escolar</option>
											<?php


											$sql = "SELECT * FROM tb_anio_escolar order by anio desc ";

											$result = $conn->query($sql);

											$rows = $result->fetchAll();

											$select  = "";
											foreach ($rows as $row) {

												if ($row['anio'] == $_SESSION['anio_escolar']) {
													$select = "selected";
												} else {
													$select = "";
												}


												echo "<option $select value='";
												echo $row['anio'];

												echo "'>";
												echo $row['anio'];


												echo "</option>";
											}

											?>

										</select></td>

								</tr>
							</table>


						</fieldset>


						<div class="modal-footer">

							<button type="button" class="btn btn-default" data-dismiss="modal"><i class="fa fa-close"></i> Cerrar</button>
							<button type="submit" class="btn btn-danger"><i class="fa fa-edit"></i> Cambiar</button>
						</div>
					</form>

				</div>
			</div>
		</div>
	</div>

	<?php if (isset($_GET['denegado'])) {
		echo "<script>toastr.error('- No tienes permiso para esta opción','¡Validando permisos!',{timeOut:8000});</script>";
	} ?>