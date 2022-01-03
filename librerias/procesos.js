function enfocar(){
$('#btn_mostrar').hide();
  document.iniciarS.user1.focus();
};

/*Funcion que me permite loguearme*/
$(document).ready(function(){
$('#btn_mostrar').hide();

  $('#form_acceso').submit(function(e){
    e.preventDefault();

    var errores = '';
    if ($('#user1').val()=='') {
      errores += "* Usuario Requerido<br>";
      $('#user1').focus();

    }
    if ($('#pass1').val()=='') {
      errores += "* Contraseña Requerida";
      $('#user1').focus();

    }
 
    if (errores!='') {
      toastr.error(errores, '¡Verifique lo siguiente!<br>', {timeOut: 5000})

      errores='';
      return;

    }else{
   

      var parametros = $(this).serialize();
      $.ajax({
        type: "POST",
        url: "sessionstart/login.php",
        data: parametros+"&accion",
        beforeSend: function(objeto){

          toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
             $(":submit").attr("disabled",true);
             
    },
 
        success: function(datos){
          if (datos=="Error") {
            toastr.error("- Usuario y/o Contraseña Incorrecta","¡Error!",{timeOut:5000});
          }else if (datos=="userDesact") {
            toastr.info("- Usuario Inactivo, no puede ingresar","¡Información Importante!",{timeOut:5000});
          }else if (datos == "Ok") {
         
          $(":submit").attr("disabled",true);
           $("#btn_mostrar").attr("disabled",true);
          $(":submit").button("loading");
          $("#btn_mostrar").show();
          $("#btn_mostrar").attr("value","Espere...");
          $("#btn_acceder_sistema").hide();
            toastr.success(" ¡Bienvenido! "+$('#user1').val(),"¡Excelente!",{timeOut:5000});
            setTimeout(function(){ window.location='./anio_escolar/seleccionaranio.php'; }, 3000);
          }else{
            toastr.error("- Ha ocurrido un error al Iniciar Sesión","¡Error!",{timeOut:5000});
          }

           $(":submit").attr("disabled",false);
        }


      });


    
    }

  });
});
/*Funcion para salir del sistema*/
function salir(){


  if (confirm("Estimado Usuario.\n¿Realmente está seguro que desea salir?")) {
    toastr.success("- Cerrando Sesión...","¡Espera!",{timeOut:6000});
    setTimeout(function(){ window.location='../sessionstart/closesession.php'; }, 3000);
  }else{
    toastr.info(" Continua...","¡No cerrar sesión!",{timeOut:5000});
    return false;
  }
}

//Funcion para seleccionar un año escolar
$(document).ready(function(){

  $('#form_anio').submit(function(e){
    e.preventDefault();
    var errores = '';
    if ($('#anio').val()=='') {
      errores += "* A&ntilde;o Requerido<br>";
      $('#anio').focus();

    }


    if (errores!='') {
      toastr.error(errores, '¡Verifique lo siguiente!<br>', {timeOut: 5000})

      errores='';
      return;

    }else{


     var parametros = $(this).serialize();
     $.ajax({
      type: "POST",
      url: "../sessionstart/login.php",
      data: parametros+"&accion_anio",
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
      },
      success: function(datos){

         if (datos == "anio_exito") {
          toastr.success("A&ntilde;o Escolar: "+$('#anio').val(),"¡Excelente!",{timeOut:5000});
          setTimeout(function(){ window.location='../principal/'; }, 3000);
        }else{
          toastr.error("- Ha ocurrido un error inesperado, Intentalo de Nuevo","¡Error!",{timeOut:5000});
        }

      }

    });
   }

 });
});



function open_share(url)
{
    var w = 900;
    var h = 520; 
    var left = (screen.width / 2)-(w / 2);
    var top = 125;
    window.open(url, "Ventana", "status = 1, height = "+ h +", width = "+ w +", resizable = 0, top = "+ top +", left = "+ left);

}

function imprimirSeleccion(titulo,nombre) {

    var w = 900;
    var h = 460; 
    var left = (screen.width / 2)-(w / 2);
    var top = 130;
      var ficha = document.getElementById(nombre);
    var ventimp = window.open('','', "status = 1, height = "+ h +", width = "+ w +", resizable = 0, top = "+ top +", left = "+ left);
      ventimp.document.write("<title>"+titulo+"</title>");
      ventimp.document.write('<link rel="stylesheet" type="text/css" href="../librerias/bootstrap.css">');
    ventimp.document.write( ficha.innerHTML );
    ventimp.document.close();
    ventimp.print( );
    ventimp.close();
  }

/*Funcion para cambiar de año escolar*/
$(document).ready(function(){

  $('#form_anio_cambio').submit(function(e){
    e.preventDefault();
    var errores = '';
    if ($('#anio_cambio').val()=='') {
      errores += "* A&ntilde;o Requerido<br>";
      $('#anio').focus();

    }


    if (errores!='') {
      toastr.error(errores, '¡Verifique lo siguiente!<br>', {timeOut: 5000})

      errores='';
      return;

    }else{


     var parametros = $(this).serialize();
     $.ajax({
      type: "POST",
      url: "../sessionstart/login.php",
      data: parametros+"&accion_anio=1",
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
      },
      success: function(datos){

         if (datos == "anio_cambio") {
          toastr.success("Seleccionó un A&ntilde;o Escolar: "+$('#anio_cambio').val(),"¡Cambió A&ntilde;o!",{timeOut:5000});
          setTimeout(function(){ window.location='./'; }, 3000);
        }else{
          toastr.error("- Ha ocurrido un error inesperado, Intentalo de Nuevo","¡Error!",{timeOut:5000});
        }

      }

    });
   }

 });
});


function limpiarformularioanio()
{
 var titulo = document.getElementById('titulo').innerHTML="Agregar A&ntilde;o Escolar";
  var guardar = document.getElementById('btnguardaranio').innerHTML="Guardar";
  $('#accion_g').val("guardar");
  $('#id_anio').val(0);
  $('#form_anio_g')[0].reset();
};
//Guardar Año Escolar
$(document).ready(function(){

  $('#form_anio_g').submit(function(e){
    e.preventDefault();
    var errores = '';
    if ($('#anio_es').val()=='') {
      errores += "* A&ntilde;o Requerido<br>";
      $('#anio_es').focus();

    }
    
      if ($('#fecha_inicio').val()=='') {
      errores += "* Fecha Inicio Requerida<br>";
      $('#anio_es').focus();

    }
     if ($('#fecha_fin').val()=='') {
      errores += "* Fecha Fin Requerida<br>";
      $('#anio_es').focus();

    }


    if (errores!='') {
      toastr.error(errores, '¡Verifique lo siguiente!<br>', {timeOut: 5000})

      errores='';
      return;

    }else{


     var parametros = $(this).serialize();
     $.ajax({
      type: "POST",
      url: "../anio_escolar/anio_g.php",
      data: parametros,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
      },
      success: function(datos){
         if (datos == "anio_existe") {
          toastr.error("A&ntilde;o Escolar: "+$('#anio_es').val()+" ya existe.","¡Error!",{timeOut:5000});
          
        }else if (datos=="guardado") {
toastr.success("Datos Almacenados","¡Excelente!",{timeOut:5000});
        setTimeout(function(){ window.location='./'; }, 3000);
        }else if (datos=="Error_fecha") {
          toastr.error("- Fecha inicio es superior a la final","¡Error!",{timeOut:5000});
        }else if (datos=="modificado") {
          toastr.success(" Datos Modificados Correctamente","¡Excelente!",{timeOut:5000});
          setTimeout(function(){ window.location='./'; }, 3000);
        }else if (datos=="modificado_existe") {
          toastr.success("Datos modificados, excepto el año<br> porque ya existe","¡Excelente!",{timeOut:5000});
          setTimeout(function(){ window.location='./'; }, 3000);
        }else{
          toastr.error("- Error al guardar o modificar los datos, Intentalo de Nuevo","¡Error!",{timeOut:5000});
        }

      }

    });
   }

 });
});








/*Guardar Secciones*/
$(document).ready(function(){

  $('#form_seccion_g').submit(function(e){
    e.preventDefault();
    var errores = '';
    if ($('#sec_ser_edu').val()=='') {
      errores += "* Servicio Educativo Requerido<br>";
      $('#sec_ser_edu').focus();

    }
      if ($('#sec_identificador').val()=='') {
      errores += "* Identificador Requerido<br>";
      $('#sec_ser_edu').focus();

    }

      if ($('#sec_turno').val()=='') {
      errores += "* Turno Requerido<br>";
      $('#sec_ser_edu').focus();

    }

 if ($('#sec_vacante').val()=='') {
      errores += "* Vacantes Requerido<br>";
      $('#sec_ser_edu').focus();

    }
    if ($('#sec_tipo').val()=='') {
      errores += "* Tipo de Sección requerido<br>";
      $('#sec_tipo').focus();

    }

     if ($('#sec_idtbuser').val()=='') {
      errores += "* Docente Responsable es Requerido<br>";
      $('#sec_ser_edu').focus();

    }

    if (errores!='') {
      toastr.error(errores, '¡Verifique lo siguiente!<br>', {timeOut: 5000})

      errores='';
      return;

    }else{


     var parametros = $(this).serialize();
     $.ajax({
      type: "POST",
      url: "../seccion/seccion_g.php",
      data: parametros,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
      },
      success: function(datos){
         if (datos == "Error_seccion") {
          toastr.error("* La seccion que quieres almacenar,<br>&nbsp;&nbsp;ya existe","¡Error!",{timeOut:5000});
          
        
        }else if (datos=="guardado") {
          toastr.success(" Datos Almacenados","¡Excelente!",{timeOut:5000});
          setTimeout(function(){ window.location='./'; }, 3000);
        }else if (datos=="modificado_existe") {
          toastr.success(" Se modificó el Turno y Vacantes<br>&nbsp;&nbsp;Ya que los demas campos existen.","¡Datos Modificados!",{timeOut:5000});
          setTimeout(function(){ window.location='./'; }, 3000);
        }else if (datos=="modificado") {
          toastr.success(" Datos Modificados","¡Excelente!",{timeOut:5000});
          setTimeout(function(){ window.location='./'; }, 3000);
        }else{
          toastr.error("- Error al guardar o modificar los datos, Intentalo de Nuevo"+datos,"¡Error!",{timeOut:5000});
        }

      }

    });
   }

 });
});






/*
Guardar Asignaturas*/
$(document).ready(function(){

  $('#form_mate_g').submit(function(e){
    e.preventDefault();
    var errores = '';
      if ($('#mate_cod').val()=='') {
      errores += "* Código Asignatura Requerido<br>";
      $('#mate_cod').focus();

    }
    if ($('#mate_nombre').val()=='') {
      errores += "* Nombre Asignatura Requerido<br>";
      $('#mate_cod').focus();

    }

    if (errores!='') {
      toastr.error(errores, '¡Verifique lo siguiente!<br>', {timeOut: 5000})

      errores='';
      return;

    }else{


     var parametros = $(this).serialize();
     $.ajax({
      type: "POST",
      url: "../asignatura/materia_g.php",
      data: parametros,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
      },
      success: function(datos){
         if (datos == "Existe_materia") {
          toastr.error("* Ya existe Nombre o Código<br>&nbsp; Asignatura","¡Error!",{timeOut:5000});
          
        
        }else if(datos=="guardado"){
          toastr.success(" Datos Almacenados","Exito!",{timeOut:5000});
           setTimeout(function(){ window.location='./'; }, 3000);
        }else if(datos=="modificado_existe"){
          toastr.success(" Se modificó su Código o Descripción","Exito!",{timeOut:5000});
           setTimeout(function(){ window.location='./'; }, 3000);
        }else if(datos=="modificado"){
          toastr.success(" Datos Modificados","Exito!",{timeOut:5000});
           setTimeout(function(){ window.location='./'; }, 3000);
        }else{
          toastr.error("- Error al guardar o modificar los datos, Intentalo de Nuevo"+datos,"¡Error!",{timeOut:5000});
        }

      }

    });
   }

 });
});






/*
Guardar Asignaturas*/
$(document).ready(function(){

  $('#form_parent_g').submit(function(e){
    e.preventDefault();
    var errores = '';
    if ($('#parent_nombre').val()=='') {
      errores += "* Nombre Completo Requerido<br>";
      $('#parent_nombre').focus();

    }
    if ($('#parent_dui').val()=='') {
      errores += "* Dui Requerido<br>";
      $('#parent_nombre').focus();

    }

    if (errores!='') {
      toastr.error(errores, '¡Verifique lo siguiente!<br>', {timeOut: 5000})

      errores='';
      return;

    }else{


     var parametros = $(this).serialize();
     $.ajax({
      type: "POST",
      url: "../parentesco/parentesco_g.php",
      data: parametros,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
      },
      success: function(datos){
         if (datos == "Existe_parentesco") {
          toastr.error("* Ya Existe Dui","¡Error!",{timeOut:5000});
          
        
        }else if(datos=="guardado"){
          toastr.success(" Datos Almacenados","Exito!",{timeOut:5000});
           setTimeout(function(){ window.location='./'; }, 3000);
        }else if(datos=="modificado_existe"){
          toastr.success(" Se modificaron los Datos, Excepto DUI","Exito!",{timeOut:5000});
           setTimeout(function(){ window.location='./'; }, 3000);
        }else if(datos=="modificado"){
          toastr.success(" Datos Modificados","Exito!",{timeOut:5000});
           setTimeout(function(){ window.location='./'; }, 3000);
        }else{
          toastr.error("- Error al guardar o modificar los datos, Intentalo de Nuevo"+datos,"¡Error!",{timeOut:5000});
        }

      }

    });
   }

 });
});




/*
Guardar usuario*/
$(document).ready(function(){

  $('#form_user_g').submit(function(e){
    e.preventDefault();
    var errores = '';
    if ($('#user_nombre').val()=='') {
      errores += "* Nombre  Requerido<br>";
      $('#user_nombre').focus();

    }
    if ($('#user_apellido').val()=='') {
      errores += "* Apellido Requerido<br>";
      $('#user_nombre').focus();

    }
    if ($('#user_usuario').val()=='') {
      errores += "* Usuario Requerido<br>";
      $('#user_nombre').focus();

    }

    if ($('#user_contra').val()=='') {
      errores += "* Contraseña Requerida<br>";
      $('#user_nombre').focus();

    }
    if ($('#user_tipo').val()=='') {
      errores += "* Tipo de Usuario Requerido<br>";
      $('#user_nombre').focus();

    }
   



    if (errores!='') {
      toastr.error(errores, '¡Verifique lo siguiente!<br>', {timeOut: 5000})

      errores='';
      return;

    }else{


     var parametros = $(this).serialize();
     $.ajax({
      type: "POST",
      url: "../usuario/usuario_g.php",
      data: parametros,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
      },
      success: function(datos){
         if (datos == "Existe_usuario") {
          toastr.error("* Ya Existe nombre usuario","¡Error!",{timeOut:5000});
        }else if(datos=="guardado"){
          toastr.success(" Datos Almacenados","Exito!",{timeOut:5000});
           setTimeout(function(){ window.location='./'; }, 3000);
        }else if(datos=="modificado_existe"){
          toastr.success(" Se modificaron los Datos, Excepto DUI","Exito!",{timeOut:5000});
           setTimeout(function(){ window.location='./'; }, 3000);
        }else if(datos=="modificado"){
          toastr.success(" Datos Modificados","Exito!",{timeOut:5000});
           setTimeout(function(){ window.location='./'; }, 3000);
        }else{
          toastr.error("- Error al guardar o modificar los datos, Intentalo de Nuevo"+datos,"¡Error!",{timeOut:5000});
        }

      }

    });
   }

 });
});

/*
Guardar estudiante*/
$(document).ready(function(){

  $('#form_est_g').submit(function(e){
    e.preventDefault();
    var errores = '';
    if ($('#est_nombre').val()=='') {
      errores += "* Nombre  Requerido<br>";
      $('#est_nombre').focus();

    }
    if ($('#est_apellido').val()=='') {
      errores += "* Apellido Requerido<br>";
      $('#est_nombre').focus();

    }
    if ($('#est_sexo').val()=='') {
      errores += "* Sexo Requerido<br>";
      $('#est_nombre').focus();

    }
       if ($('#est_estado_civil').val()=='') {
      errores += "* Estado civil  Requerido<br>";
      $('#est_nombre').focus();

    }
     if ($('#est_fecha_nace').val()=='') {
      errores += "* Fecha de Nacimiento  Requerida<br>";
      $('#est_nombre').focus();

    }
     if ($('#est_partida').val()=='') {
      errores += "* Partida  Requerida<br>";
      $('#est_nombre').focus();

    }

    if ($('#est_anio_ult').val()=='' || $('#est_anio_ult').val()<=1950) {
      errores += "* Año Ultimo Requerido o no es válido<br>";
      $('#est_nombre').focus();

    }
    if ($('#est_convivencia').val()=='') {
      errores += "* Convivencia  Requerida<br>";
      $('#est_nombre').focus();

}




    if (errores!='') {
      toastr.error(errores, '¡Verifique lo siguiente!<br>', {timeOut: 5000})

      errores='';
      return;

    }else{

 
     var parametros =new FormData(this);
     $.ajax({

      type: "POST",
      url: "../estudiante/estudiante_g.php",
      data: parametros,
      cache:false,
      contentType: false,
      processData: false,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
      },
      success: function(datos){
         if (datos == "Existe_estudiante") {
          toastr.error("* Ya Existe NIE","¡Error!",{timeOut:5000});
          
        
        }else if(datos=="guardado"){
          toastr.success(" Datos Almacenados","Exito!",{timeOut:5000});
           setTimeout(function(){ window.location='./'; }, 3000);
        }else if(datos=="modificado_existe"){
          toastr.success(" Se modificaron los Datos<br> Excepto NIE o DUI porque existen","Exito!",{timeOut:5000});
           setTimeout(function(){ window.location='./'; }, 3000);
        }else if(datos=="modificado"){
          toastr.success(" Datos Modificados","Exito!",{timeOut:5000});
           setTimeout(function(){ window.location='./'; }, 3000);
        }else if(datos=="tipoImg"){
          toastr.error(" Formato de foto: PNG,JPG,GIF,JPEG<br> estan permitidos ","¡Error!",{timeOut:5000});
        }else if(datos=="errorimg"){
          toastr.error(" Error al procesar imagen ","¡Error!",{timeOut:5000});
        }else{
          toastr.error("- Error al guardar o modificar los datos, Intentalo de Nuevo"+datos,"¡Error!",{timeOut:5000});
        }

      }

    });
   }

 });
});

