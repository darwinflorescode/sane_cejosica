function cambiarestado_anio(id){
if (confirm("Estimado Usuario.\n¿Realmente desea cerrar este año escolar?\n\n ---------------------------------------\nAdvertencia:\n-Ya no podrá realizar todas las acciones\n-Es posible que vuelva a seleccionar el año escolar")) {
	$.ajax({
      type: "POST",
      url: "../anio_escolar/anio_g.php",
      data:"accion_d=0&idanio="+id,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:1500});
      },
      success: function(datos){
         if (datos == "anio_del") {
          toastr.success("A&ntilde;o Escolar cerrado con &eacute;xito","¡Excelente!",{timeOut:5000});
          setTimeout(function(){ window.location='./'; }, 3000);
          
        }else{
          toastr.error("- Error al cambiar estado, Intentalo de Nuevo","¡Error!",{timeOut:5000});
        }

      }

    });

}else{
	return false;
}
};


function editar_anio(id)
{

  var titulo = document.getElementById('titulo').innerHTML="Modificar A&ntilde;o Escolar";
 var Modificar = document.getElementById('btnguardaranio').innerHTML="Modificar";
$('#accion_g').val("modificar");
$('#id_anio').val(id);

var anio_es = $('#anio_'+id).val();
var fecha_ini = $('#fecha_inicio'+id).val();
var fecha_fn = $('#fecha_fin'+id).val();
var descrip = $('#anio_descripcion'+id).val();
var estado = $('#anio_estado'+id).val();

$('#anio_es').val(anio_es);
$('#fecha_inicio').val(fecha_ini);
$('#fecha_fin').val(fecha_fn);
$('#descripcion').val(descrip);
$('#estado').val(estado);

};

function editar_seccion(id)
{

  var titulo = document.getElementById('titulosec').innerHTML="Modificar Seccion";
 var Modificar = document.getElementById('btnguardarseccion').innerHTML="Modificar";
$('#accion_gsec').val("modificar");
$('#id_seccion').val(id);
var sec_edu = $('#sec_edu_'+id).val();
var sec_iden = $('#sec_iden_'+id).val();
var sec_tipo = $('#sec_tipo_'+id).val();
var sec_turno= $('#sec_turno_'+id).val();
var sec_vacante= $('#sec_vacante_'+id).val();
var idtbuser= $('#sec_idtbuser_'+id).val();

$('#sec_ser_edu').val(sec_edu);
$('#sec_identificador').val(sec_iden);
$('#sec_tipo').val(sec_tipo);
$('#sec_turno').val(sec_turno);
$('#sec_vacante').val(sec_vacante);
$('#sec_idtbuser').val(idtbuser);
};

function limpiar_formulario_seccion()
{
 var titulo = document.getElementById('titulosec').innerHTML="Agregar una Seccion";
 var guardar = document.getElementById('btnguardarseccion').innerHTML="Guardar";
$('#accion_gsec').val("guardar");
$('#id_seccion').val(0);
  $('#form_seccion_g')[0].reset();
};

function eliminar_seccion(id){
if (confirm("Estimado Usuario.\n¿Realmente desea eliminar esta seccion?\n\n ---------------------------------------\nAdvertencia:\n-Se eliminaran todos los datos relacionados")) {
  $.ajax({
      type: "POST",
      url: "../seccion/seccion_g.php",
      data:"accion_gsec=eliminar&id_seccion="+id,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:1500});
      },
      success: function(datos){
         if (datos == "seccion_del") {
          toastr.success("Seccion Eliminada con &eacute;xito","¡Excelente!",{timeOut:5000});
          setTimeout(function(){ window.location='./'; }, 3000);
          
        }else{
          toastr.error("- Error al eliminar, Intentalo de Nuevo","¡Error!"+datos,{timeOut:5000});
        }

      }

    });

}else{
  return false;
}
};


function limpiar_formulario_usuario()
{
 var titulo = document.getElementById('titulouser').innerHTML="Agregar un Usuario";
 var guardar = document.getElementById('btnguardaruser').innerHTML="Guardar";
$('#accion_guser').val("guardar");
$('#id_user').val(0);
  $('#form_user_g')[0].reset();
};

function editar_usuario(id)
{

  var titulo = document.getElementById('titulouser').innerHTML="Modificar Datos Usuario";
 var Modificar = document.getElementById('btnguardaruser').innerHTML="Modificar";
$('#accion_guser').val("modificar");
$('#idtb_usuario').val(id);

var user_nombre= $('#user_nombre_'+id).val();
var user_apellido= $('#user_apellido_'+id).val();
var user_dui= $('#user_dui_'+id).val();
var user_nit= $('#user_nit_'+id).val();
var user_telefono= $('#user_telefono_'+id).val();
var user_profe= $('#user_profesion_'+id).val();
var user_email= $('#user_email_'+id).val();
var user_user= $('#user_usuario_'+id).val();
var user_contra= $('#user_contra_'+id).val();
var user_tipo= $('#user_tipo_'+id).val();
var user_estado= $('#user_estado_'+id).val();

$('#user_nombre').val(user_nombre);
$('#user_apellido').val(user_apellido);
$('#user_dui').val(user_dui);
$('#user_nit').val(user_nit);
$('#user_telefono').val(user_telefono);
$('#user_profesion').val(user_profe);
$('#user_email').val(user_email);
$('#user_usuario').val(user_user);
$('#user_contra').val(user_contra);
$('#user_tipo').val(user_tipo);
$('#user_estado').val(user_estado);
};



function limpiar_formulario_materia()
{
 var titulo = document.getElementById('titulomate').innerHTML="Agregar una Asignatura";
 var guardar = document.getElementById('btnguardarmateria').innerHTML="Guardar";
$('#accion_gmate').val("guardar");
$('#id_mate').val(0);
  $('#form_mate_g')[0].reset();
};

function editar_materia(id)
{

  var titulo = document.getElementById('titulomate').innerHTML="Modificar Datos Asignatura";
 var Modificar = document.getElementById('btnguardarmateria').innerHTML="Modificar";
$('#accion_gmate').val("modificar");
$('#id_mate').val(id);

var mate_cod= $('#mate_cod_'+id).val();
var mate_nombre= $('#mate_nombre_'+id).val();
var mate_descripcion= $('#mate_descripcion_'+id).val();

$('#mate_cod').val(mate_cod);
$('#mate_nombre').val(mate_nombre);
$('#mate_descripcion').val(mate_descripcion);
};

function eliminar_materia(id){
if (confirm("Estimado Usuario.\n¿Realmente desea eliminar esta Materia?\n\n ---------------------------------------\nAdvertencia:\n-Se eliminaran todos los datos relacionados")) {
  $.ajax({
      type: "POST",
      url: "../asignatura/materia_g.php",
      data:"accion_gmate=eliminar&id_mate="+id,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:1500});
      },
      success: function(datos){
         if (datos == "Materia_del") {
          toastr.success("Asignatura Eliminada con &eacute;xito","¡Excelente!",{timeOut:5000});
          setTimeout(function(){ window.location='./'; }, 3000);
          
        }else{
          toastr.error("- Error al eliminar, Intentalo de Nuevo","¡Error!"+datos,{timeOut:5000});
        }

      }

    });

}else{
  return false;
}
};



function limpiar_formulario_parentesco()
{
 var titulo = document.getElementById('tituloparent').innerHTML="Agregar una Parentesco";
 var guardar = document.getElementById('btnguardarparent').innerHTML="Guardar";
$('#accion_gparent').val("guardar");
$('#id_parentesco').val(0);
  $('#form_parent_g')[0].reset();
};

function editar_parentesco(id)
{

  var titulo = document.getElementById('tituloparent').innerHTML="Modificar Datos Parentesco";
 var Modificar = document.getElementById('btnguardarparent').innerHTML="Modificar";
$('#accion_gparent').val("modificar");
$('#id_parentesco').val(id);


var parent_nombre= $('#parent_nombre_'+id).val();
var parent_dui= $('#parent_dui_'+id).val();
 var parent_telefono= $('#parent_telefono_'+id).val();
 var parent_trabajo= $('#parent_trabajo_'+id).val();
 var parent_direccion= $('#parent_direccion_'+id).val();


$('#parent_nombre').val(parent_nombre);
 $('#parent_dui').val(parent_dui);
$('#parent_telefono').val(parent_telefono);
$('#parent_trabajo').val(parent_trabajo);
$('#parent_direccion').val(parent_direccion);
};

function eliminar_parent(id){
if (confirm("Estimado Usuario.\n¿Realmente desea eliminar estos Datos?\n\n ---------------------------------------\nAdvertencia:\n-Se eliminaran todos los datos relacionados")) {
  $.ajax({
      type: "POST",
      url: "../parentesco/parentesco_g.php",
      data:"accion_gparent=eliminar&idtb_parentesco="+id,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:1500});
      },
      success: function(datos){
         if (datos == "Parentesco_del") {
          toastr.success("Datos Eliminados con &eacute;xito","¡Excelente!",{timeOut:5000});
          setTimeout(function(){ window.location='./'; }, 3000);
          
        }else{
          toastr.error("- Error al eliminar, Intentalo de Nuevo","¡Error!"+datos,{timeOut:5000});
        }

      }

    });

  return false;
}else{
}
};

  function add_asignatura()
{
  var id= $('#id_materia').val();
  var nivel= $('#nivel_a').val();
  var nivel_a= $('#nivel_aa').val();

   var errores = '';
    if ($('#id_materia').val()=='') {
      errores += "* Seleccione una asignatura<br>";
      $('#idtb_materia').focus();

    }

     if (errores!='') {
      toastr.error(errores, '¡Verifique lo siguiente!<br>', {timeOut: 5000})

      errores='';
      return;

    }else{
  
  $.ajax({
      type: "POST",
      url: "../seccion-asignatura/add_a.php",
      data:"accion_ga=add&idtb_materia="+id+"&nivel="+nivel,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:1500});
      },
      success: function(datos){
         if (datos == "guardado") {
          toastr.success("Materia agregada con &eacute;xito","¡Excelente!",{timeOut:5000});
          setTimeout(function(){ window.location = "?idnivel="+nivel_a; }, 3000);
          
        }else if (datos == "Existe") {
          toastr.error("Ya existe esta materia en el nivel","¡Advertencia!",{timeOut:5000});
         
          
        }else if (datos == "Error_existe") {
          toastr.warning("no existe secciones en este nivel","¡Advertencia!",{timeOut:5000});
          setTimeout(function(){ window.location = "?idnivel="+nivel_a; }, 3000);
          
        }else{
          toastr.error("- Error al procesar datos, Intentalo de Nuevo","¡Error!"+datos,{timeOut:5000});
        }

      }

    });
}
};


function eliminar_materia_seccion(id,sec_nivel){
    var nivel_a= $('#nivel_aa').val();
if (confirm("Estimado Usuario.\n¿Realmente desea eliminar esta Materia?\n\n ---------------------------------------\nAdvertencia:\n-Se eliminaran todos los datos relacionados")) {
  $.ajax({
      type: "POST",
      url: "../seccion-asignatura/add_a.php",
      data:"accion_ga=del&idtb_materia="+id+"&nivel="+sec_nivel,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:1500});
      },
      success: function(datos){
         if (datos == "Materia_del") {
          toastr.success("Asignatura Eliminada con &eacute;xito","¡Excelente!",{timeOut:5000});
            setTimeout(function(){ window.location = "?idnivel="+nivel_a; }, 3000);
          
        }else  if (datos == "Erro_del") {
          toastr.error(" No se eliminó","¡Error!",{timeOut:5000});
            setTimeout(function(){ window.location = "?idnivel="+nivel_a; }, 3000);
          
        }else{
          toastr.error("- Error al eliminar, Intentalo de Nuevo","¡Error!"+datos,{timeOut:5000});
        }

      }

    });

}else{
  return false;
}
};






  function eliminarMatricula(idmatricula,idseccion)
{
  if (confirm("Estimado Usuario.\n¿Realmente desea eliminar esta matrícula de esta sección?")) {
  $.ajax({
      type: "POST",
      url: "../seccion/seccion_g.php",
      data:"accion_gsec=delm&idmatricula="+idmatricula,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:1500});
      },
      success: function(datos){
         if (datos == "exitom") {
          toastr.success("Matrícula eliminada con &eacute;xito","¡Excelente!",{timeOut:5000});
          setTimeout(function(){ window.location = "./matricula.php?idseccion="+idseccion; }, 3000);
          
        }else if (datos == "errorm") {
          toastr.warning(" Error al eliminar esta materia","¡Error!",{timeOut:5000});
         
          
        }else{
          toastr.error("- Error al procesar datos, Intentalo de Nuevo","¡Error!"+datos,{timeOut:5000});
        }

      }

    });
}else{
  return false;
}
};





function eliminar_estudiante(id){
if (confirm("Estimado Usuario.\n¿Realmente desea eliminar estos Datos?\n\n ---------------------------------------\nAdvertencia:\n-Se eliminaran todos los datos relacionados")) {
  $.ajax({
      type: "POST",
      url: "../estudiante/estudiante_g.php",
      data:"accion_gest=eliminar&idestudiante="+id,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:1500});
      },
      success: function(datos){
         if (datos == "estudiante_del") {
          toastr.success("Datos Eliminados con &eacute;xito","¡Excelente!",{timeOut:5000});
          setTimeout(function(){ window.location='./'; }, 3000);
          
        }else{
          toastr.error("- Error al eliminar, Intentalo de Nuevo","¡Error!"+datos,{timeOut:5000});
        }

      }

    });

  return false;
}else{
}
};






function eliminar_usuario(id){
if (confirm("Estimado Usuario.\n¿Realmente desea eliminar estos Datos?\n\n ---------------------------------------\nAdvertencia:\n-Se eliminaran todos los datos relacionados")) {
  $.ajax({
      type: "POST",
      url: "../usuario/usuario_g.php",
      data:"accion_guser=eliminar&idtb_usuario="+id,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:1500});
      },
      success: function(datos){
         if (datos == "usuario_del") {
          toastr.success("Datos Eliminados con &eacute;xito","¡Excelente!",{timeOut:5000});
          setTimeout(function(){ window.location='./'; }, 3000);
          
        }else{
          toastr.error("- Error al eliminar, Intentalo de Nuevo","¡Error!"+datos,{timeOut:5000});
        }

      }

    });

  return false;
}else{
}
};


function limpiar_formulario_estudiante()
{
 var titulo = document.getElementById('tituloest').innerHTML="Registrar un Alumno/a";
 var guardar = document.getElementById('btnguardarest').innerHTML="Guardar";
$('#accion_gest').val("guardar");

  $('#form_est_g')[0].reset();
  $('#id_estudiante').val(0);
  $('#fami').css("display","none");
};

function editar_estudiante(id)
{

  var titulo = document.getElementById('tituloest').innerHTML="Modificar Datos Del Alumno/a";
 var Modificar = document.getElementById('btnguardarest').innerHTML="Modificar";
$('#accion_gest').val("modificar");
$('#id_estudiante').val(id);
$('#fami').css("display","block");

var est_nie= $('#est_nie_'+id).val();
var est_nombre= $('#est_nombre_'+id).val();
var est_apellido= $('#est_apellido_'+id).val();
var est_sexo= $('#est_sexo_'+id).val();
var est_estado_civil= $('#est_estado_civil_'+id).val();
var est_estado_civil= $('#est_estado_civil_'+id).val();
var est_fecha_nace= $('#est_fecha_nace_'+id).val();
var est_partida= $('#est_partida_'+id).val();
var est_dui= $('#est_dui_'+id).val();
var est_direccion= $('#est_direccion_'+id).val();
var est_transporte= $('#est_transporte_'+id).val(); 
var est_anio_ult= $('#est_anio_ult_'+id).val();
var est_convivencia= $('#est_convivencia_'+id).val();
var est_discapacidad= $('#est_discapacidad_'+id).val(); 
var est_economica= $('#est_economica_'+id).val();
var est_estado= $('#est_estado_'+id).val();



$('#est_nie').val(est_nie);
$('#est_nombre').val(est_nombre);
$('#est_apellido').val(est_apellido);
$('#est_sexo').val(est_sexo);
$('#est_estado_civil').val(est_estado_civil);
$('#est_fecha_nace').val(est_fecha_nace);
$('#est_partida').val(est_partida);
$('#est_dui').val(est_dui);
$('#est_direccion').val(est_direccion);
$('#est_transporte').val(est_transporte);
$('#est_anio_ult').val(est_anio_ult);
$('#est_convivencia').val(est_convivencia);
$('#est_discapacidad').val(est_discapacidad);
$('#est_economica').val(est_economica);
$('#est_estado').val(est_estado);
loadfami();

};


