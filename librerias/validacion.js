function soloLetras(e) {
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = [8, 37, 39, 46];

    tecla_especial = false
    for(var i in especiales) {
        if(key == especiales[i]) {
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla) == -1 && !tecla_especial)
        return false;
}



$(document).ready(function(){
        $("#idseccion").change(function () {
            $("#idseccion option:selected").each(function () {
                id_secciones = $(this).val();
                
                $.ajax({
                    type: "POST",
                    url: "materias.php",
                    data:"id_secciones="+id_secciones,

                    success: function(datos){

                        $("#idmateria_buscar").html(datos);
                    }

                });

            });
        });
    });





/*
Guardar usuario*/
$(document).ready(function(){

  $('#btn-searchnota').click(function(e){
    e.preventDefault();
    var errores = '';
    if ($('#idseccion').val()==0) {
      errores += "* Seleccione una sección<br>";
      $('#idseccion').focus();

    }
    if ($('#idmateria_buscar').val()==0) {
      errores += "* Seleccione una Materia<br>";
      $('#idmateria_buscar').focus();

    
    }
   



    if (errores!='') {
      toastr.error(errores, '¡Verifique lo siguiente!<br>', {timeOut: 5000})

      errores='';
      return;

    }else{

$("#loader").fadeIn('slow');
 var idmateria = $('#idmateria_buscar').val();
 var idseccion = $('#idseccion').val();
     $.ajax({
      type: "POST",
      url: "../notas/cargarnotas.php",
      data:"idseccion="+idseccion+"&idmateria="+idmateria,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
        $('#loader').html('<img src="../librerias/loading.gif"> Cargando su busqueda...');
      },
      success: function(datos){
         $(".vertabla").html(datos).fadeIn('slow');
          $('#loader').html('');

      }

    });
   }

 });
});

//Funcion de validacion para que un input solo acepte numeros.
function justNumbers(e)
        {
        var keynum = window.event ? window.event.keyCode : e.which;
        if ((keynum == 8) || (keynum == 37) || (keynum == 39) || (keynum == 46))
        return true;
         
        return /\d/.test(String.fromCharCode(keynum));
        }

function crear_matricula(idseccion,idestudiante)
{

   $.ajax({
      type: "POST",
      url: "g_m.php",
      data: "accion_gm=guardar&id_est="+idestudiante+"&idtb_seccion="+idseccion,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
      },
      success: function(datos){
        if (datos=='matriculadoe') {
           toastr.success(" Matrícula registrada","¡Excelente!",{timeOut:5000});
           setTimeout(function(){ window.location='matricula.php?idseccion='+idseccion; }, 3000);
        }else if (datos=='vacantes') {
           toastr.error(" No hay vacantes en la sección seleccionada","¡Error!",{timeOut:5000});
        }else if (datos=='matriculado') {
           toastr.error(" estudiante ya se encuentra matriculado en esta sección","¡Error!",{timeOut:5000});
        }else if (datos=='matriculados') {
           toastr.error(" Estudiante ya se encuentra registrado en una sección,<br> en el año seleccionado.","¡Error!",{timeOut:5000});
        }else if (datos=='error_a') {
           toastr.error(" Error al guardar.","¡Error!",{timeOut:5000});
        }else{
           toastr.error("- Ha ocurrido un error inesperado, Intentalo de Nuevo","¡Error!",{timeOut:5000});
        }
       


      }

    });


};







    function loadfami(){

      var q= $("#id_estudiante").val();

      $("#loader").fadeIn('slow');
      $.ajax({
        type: 'GET',
        url:'../estudiante/familiar.php?q='+q,
         beforeSend: function(objeto){
         $('#loader').html('<img src="../librerias/loading.gif"> Cargando...');
        },
        success:function(data){
          $(".vertabla").html(data).fadeIn('slow');
          $('#loader').html('');
          
        }
      });
    };


function load_seccion(valor){



      $("#loader").fadeIn('slow');
      $.ajax({
        type: 'GET',
        url:'../m_reporte/cargar_estudiantes.php?id_seccion='+valor,
         beforeSend: function(objeto){
         $('#loader').html('<img src="../librerias/loading.gif"> Cargando...');
        },
        success:function(data){
          $(".vertabla").html(data).fadeIn('slow');
          $('#loader').html('');
          
        }
      });

};

    /*Funcion para cambiar de año escolar*/
$(function(){
  var ENV_WEBROOT = "../";


    $("#btn_g_f").off("click");
  $("#btn_g_f").on("click", function(e) {

    var idest = $('#id_estudiante').val();
    var idfam= $('#est_fami').val();
     var est_parent= $('#est_pa').val();
      var est_resp= $('#est_respon').val();
    var errores = '';
    if (idest=='' || idest ==0) {
      errores += "* Solo puede agregar cuando<br>  estudiante existe (Editar)<br>";
      
    }

    if (idfam=='' || idfam ==0) {
      errores += "* Seleccione nombre familiar<br>";
      
    }

if (est_parent=='' || est_parent ==0) {
      errores += "* Seleccione Tipo Parentesco<br>";
      
    }
    if (est_resp=='' || est_resp ==0) {
      errores += "* Seleccione Si es responsable<br>";
      
    }

    if (errores!='') {
      toastr.error(errores, '¡Verifique lo siguiente!<br>', {timeOut: 5000})

      errores='';
      return;

    }else{
      $("#loader").fadeIn('slow');
      $.ajax({
      type: 'POST',
      url:'../estudiante/add_fami.php?action=g&idest='+idest+"&idfam="+idfam+"&idparent="+est_parent+"&idrespon="+est_resp,
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
      },
      success: function(datos){

         if (datos == "Existe_fam") {
          toastr.error(" Familiar ya existe registrado","¡Error!",{timeOut:5000});
         
        }else if (datos == "Guardado") {
          toastr.success(" Guardado Correctamente","¡Excelente!",{timeOut:5000});
          loadfami();
         
        }else if (datos == "Existe_fam_p") {
          toastr.error(" Tipo Parentesco Mamá o Papá no<br> se pueden repetir","¡Error!",{timeOut:5000});
        
         
        }else if (datos == "Responsable") {
          toastr.error(" Solo debe existir un responsable de estudiante","¡Error!",{timeOut:5000});
        
         
        }else{
          toastr.error("- Ha ocurrido un error inesperado, Intentalo de Nuevo"+datos,"¡Error!",{timeOut:5000});
        }

      }

    });
   }

 });
});




function quitar_fam(id){
if (confirm("Estimado Usuario.\n¿Realmente desea quitar la relacion familiar de este estudiante?\n\n ---------------------------------------\nAdvertencia:\n-Ya no podrá realizar todas las acciones\n")) {
  $.ajax({
      type: "GET",
      url: "../estudiante/add_fami.php?actionn=g&id="+id,
    
      beforeSend: function(objeto){
        toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:1500});
      },
      success: function(datos){
         if (datos == "del") {
          toastr.success("Eliminado con &eacute;xito","¡Excelente!",{timeOut:5000});
         loadfami();
          
        }else{
          toastr.error("- Error el quitar, Intentalo de Nuevo","¡Error!",{timeOut:5000});
        }

      }

    });

}else{
  return false;
}
};

  function cambiarPass(id) {
              var errores = '';
              var clave1  = $('#clave1').val();
              var clave2 = $('#clave2').val();
              if (clave1=='') {
                errores += "* Ingrese una contraseña<br>";
                $('#clave1').focus();

              }
              if (clave2=='') {
                errores += "* Repita su contraseña<br>";
                $('#clave1').focus();

              }

              if (clave1!=clave2) {
                errores += "* Sus contraseñas no coinciden<br>";
                $('#clave1').focus();
              }

              if (errores!='') {
                toastr.error(errores, '¡Verifique lo siguiente!<br>', {timeOut: 5000})

                errores='';
                return;

              }else{

                $.ajax({
                  type: "GET",
                  url: "../perfil/g_perfil.php?action=1&c1="+clave1+"&c2="+clave2+"&id="+id,
                  beforeSend: function(objeto){
                    toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
                  },
                  success: function(datos){
                    if (datos == "modificado") {
                      toastr.success(" Clave Modificada","¡Exito!",{timeOut:5000});
                      setTimeout(function(){ window.location='../sessionstart/closesession.php'; }, 3000);

                    }else{
                      toastr.error("- Error al modificar datos","¡Error!",{timeOut:5000});
                    }


                  }

                });
              }
            };

    function generar_backup(){


if (confirm("¿Seguro que deseas generar copia de seguridad de la base de datos?")) {
      $("#loader").fadeIn('slow');
      $.ajax({
        type: 'GET',
        url:'../backup/generate_backup_.php?action=1',
         beforeSend: function(objeto){
         toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
        },
        success:function(data){
         if (data=='exito'){
          toastr.success("¡Backup Generado Con exito!","¡Excelente!",{timeOut:2000});
          setTimeout(function(){ window.location='./'; }, 3000);
       }else{
        toastr.error(" - No se pudo generar su copia de seguridad"+data,"¡Error!",{timeOut:2000});
       }
          
        }
       
      });
    }else{
      return false;
    };

};

function eliminarBackup(ruta)
  {
    if (confirm("¿Seguro que deseas eliminar la copia de seguridad de la base de datos?")) {
       $.ajax({
        type: 'GET',
        url:'../backup/generate_backup_.php?action=2&ruta='+ruta,
         beforeSend: function(objeto){
         toastr.warning("¡Se esta procesando su petición!","¡Espere...!",{timeOut:2000});
        },
        success:function(data){
         if (data=='exito'){
          toastr.success("¡Backup eliminado Con exito!","¡Excelente!",{timeOut:2000});
          setTimeout(function(){ window.location='./'; }, 3000);
       }else{
        toastr.error(" - No se pudo generar su copia de seguridad"+data,"¡Error!",{timeOut:2000});
       }
          
        }
       
      });
    }else{
      return false;
    }
  }