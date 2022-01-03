<?php 
include 'header.php'; 
require_once  '../sessionstart/bloq_anio.php';
					 if ((($_SESSION['tipo_user'] == "Administrador") || ($_SESSION['tipo_user'] =="Director")) && $_SESSION["anio_escolar"]>0) {
					?>
		<div class="container-fluid" ><!--Nuevo contenedor para el cuerpo-->
			<div class="row-fluid ">
				<div class="col-md-2" id="contenido2"><!--Inicio barra de navegación lateral-->
					<ul class="nav nav-pills nav-stacked main-menu" id="navLateral">
						<li role="navigation" class="active"><a href="./"><span class="fa fa-home"></span> Inicio</a></li>
						<li role="navigation" class=""><a href="../anio_escolar/"><span class="fa fa-calendar"></span> Año escolar</a></li>
						
						<li role="navigation"><a href="../estudiante/"><span class="fa fa-graduation-cap"></span> Estudiantes</a></li>
						<li role="navigation"><a href="../matricula/"><span class="fa fa-pencil-square-o"></span> Matricular</a></li>
					
						<li id="interes" class="active"><span class="fa fa-cog"></span> Otras Opciones</li>
						<li role="navigation"><a href="https://www.facebook.com/Complejo-Educativo-Jos%C3%A9-Sime%C3%B3n-Ca%C3%B1as-1862498180640853/" target="_blank"><span class="fa fa-facebook-square"></span> Facebook</a></li>
						<li role="navigation"><a href="../programmers/" target="_blank"><span class="fa fa-male"></span> Programadores <span class="fa fa-copyright"></span></a></li>
						
					</ul>
				</div><!--Fin barra de navegación lateral-->
				

	
				<div class="col-md-10" ><!--Inicio cuadros para contenido-->
					<div class="todo">
						<div class="panelp letra"><span class="fa fa-desktop"></span> MENU PRINCIPAL</div><br>
						<div class="row-fluid">

							<div class="col-md-4 icons">
								<a href="../usuario/"><div class="cuadros" id="cuadro1">
								<span class="fa fa-user"></span>
								<h5>Usuario Personal</h5>
								</div></a>
							</div>
							<div class="col-md-4 icons">
								<a href="../anio_escolar/"><div class="cuadros" id="cuadro2">
								<span class="fa fa-calendar"></span>
								<h5>Año Escolar</h5>
								</div></a>
							</div>
							<div class="col-md-4 icons">
								<a href="../seccion/"><div class="cuadros" id="cuadro3">
								<span class="fa fa-tags"></span>
								<h5>Secciones</h5>
								</div></a>
							</div>
						</div>
						<div class="row-fluid">
							<div class="col-md-4 icons">
								<a href="../asignatura/"><div class="cuadros" id="cuadro4">
								<span class="fa fa-book"></span>
								<h5>Asignaturas</h5>
								</div></a>
							</div>
							<div class="col-md-4 icons">
								<a href="../m_reporte/"><div class="cuadros" id="cuadro5">
								<span class="fa fa-line-chart"></span>
								<h5>Reporte de Notas</h5>
								</div></a>
							</div>
							<div class="col-md-4 icons">
								<a href="../backup/"><div class="cuadros" id="cuadro6">
								<span class="fa fa-database"></span>
								<h5>Backup</h5>
								</div></a>
							</div>
						</div>

					
				</div><!--fin cuadros para contenido-->
			</div>
			
		</div><!--Fin nuevo contenedor para el cuerpo-->
	
</div>

<br>

<?php 
}else{

	echo "<table><tr><td><div><img src='../librerias/profesor.gif'></div></td><td><div align='center'><h1>¡BIENVENIDO!</h1>";
	echo "Solo para docentes registrados.
	<br><li>Docentes: Solo pueden registrar notas de Alumnos/as e imprimir sus respectivos documentos, (Ficha, Notas Parciales y Libreta de Notas).</li><div></td></tr></table>
		<br><br><br><br>";
}
include 'footer.php'; ?>