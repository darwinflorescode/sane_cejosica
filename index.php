<!DOCTYPE html>

<html lang="es">
<head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <link rel="shortcut icon" href="librerias/cejosicalogo.png"/>
		<title>SANE-CEJOSICA</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" type="text/css" href="./librerias/micss.css">
<script>
  $(document).ready(function(){
$('#btn_mostrar').hide();
});
  
</script>
         <script src="./librerias/funcion_script.js"></script>
    <script src="librerias/jquery.min.js">  </script>
     <script type="text/javascript" src="librerias/bootstrap.min.js"></script>
      <script type="text/javascript" src="librerias/toastr.min.js"></script> 
     <script type="text/javascript" src="librerias/procesos.js"></script>

	</head>
	<body onload="enfocar();">
				
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

      <a class="navbar-brand" href="#"><l class="textopar parpadea">SANE-CEJOSICA </l><img src="./librerias/cejosicalogo.png" class="" height="50px" alt="">
      </a>

    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
    <ul class="nav navbar-nav navbar-right">
    
                           <li><a target="_blank" href="https://www.facebook.com/Complejo-Educativo-Jos%C3%A9-Sime%C3%B3n-Ca%C3%B1as-1862498180640853/"><i class="fa fa-facebook-official"  aria-hidden="true"></i></a></li>
                       
    </ul>

              

       
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
		
		<!--INICIO DE BANNER-->
		
		<div class="banner">
			
			<img src="./librerias/Logo_nuevo.png" alt="Logo de Complejo Educativo José Simeón Cañas" class="logo">
			
			<img src="./librerias/cejosicalogo.png" alt="Logo Universidad de El Salvador" class="loguito">
			<span class="letra ">Sistema de Administración de Notas Escolar, Complejo Educativo José Simeón Cañas (SANE-CEJOSICA)</span>
		</div><!--Acá termina el banner-->

		<!--Linea bajo el banner-->

		<!--INICIO DE CUERPO DE PÁGINA (MACRO) DE 2 COLUMNAS-->

		<div class="container-fluid" ><!--Nuevo contenedor para el cuerpo-->
			<div class="row-fluid ">
        <div class="col-md-3"> </div>
				<div class="col-md-6"  ><!--Inicio cuadros para contenido-->
					<div class="todo">
						<div class="panelp letra"><span class="fa fa-user"></span> INICIAR SESIÓN</div><br>
						<div class="row-fluid">
              <fieldset class="scheduler-border">
                <legend class="scheduler-border">Datos de Acceso</legend>
                <form action="./" id="form_acceso" method="POST" name="iniciarS" accept-charset="utf-8"   autocomplete="off" role="form">

                  <table  width="65%" style="text-align: right; " >
                    
                    <tr><td><label for="user1">Usuario: <label class="fa fa-users"> &nbsp;</label></label></td><td>
                    <input type="text" name="user1" id="user1" class="form-control inputstl"  placeholder="Usuario o correo"></td></tr>
                    <tr><td colspan="2">&nbsp;</td></tr>
                    <tr><td><label for="pass1">Constraseña: <label class="fa fa-lock"></label>&nbsp;&nbsp;&nbsp;</label></td><td>
                    <input type="password" name="pass1"  id="pass1" class="form-control inputstl"  placeholder="Constraseña"></td></tr>
                  </table>

                  <br>
                 
                                <div class="row" style="text-align: right;" >
                                    <div class="col-lg-3">
                                       
                                            
                                            <button id="btn_acceder_sistema" type="submit" class="btn btn-danger" ><i class="ace-icon fa fa-sign-in"></i> Acceder</button>
                                            <input  id="btn_mostrar" type="button" value="Acceder" class="btn btn-danger" >
                                        
                                    </div>
                                </div>
                            
                </form>
              </fieldset>
							
					
				</div><!--fin cuadros para contenido-->
			</div>
			
		</div><!--Fin nuevo contenedor para el cuerpo-->
  </div> </div><br>
<br>
<div id="foot">
      <div class="container">
          <div class="row-fluid">
            <div class="col-md-12">
              <script type="text/javascript">
                var fecha = new Date();
                var anio = fecha.getFullYear();
              
                document.write("ESCUELA ESPECIALIZADA EN INGENIERIA ITCA FEPADE MEGATEC-ZACATECOLUCA, " +anio+".");
              </script>
              <br><div>&copy; Complejo Educativo José Simeón Cañas. Todos los derechos reservados</div>
            </div>
            
                  
          </div>
        </div>
       </div>

</div></body></html>
