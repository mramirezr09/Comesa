// JavaScript Document

$('.FormularioAjax').submit(function(e){// Captura eventos de envio de formularios por AJAX
  e.preventDefault(); //Redirecciona a vista del elemento

  var form=$(this);// Guarda elemento de registro

  var tipo=form.attr('data-form'); // contiene tipo de form a enviar
  var accion=form.attr('action'); //  Selecciona formulario por atributo data-form
  var metodo=form.attr('method');  // Selecciona atributo del mettodo POST
  var respuesta=form.children('.RespuestaAjax'); // Respuesta de la llamada de AJAX

  var msjError="<script>swal('Algo anda mal','Por favor recargue la página','error');</script>"; // Error de logica en Javascript
  var formdata = new FormData(this); // arreglo de los datos que se enviaran a la base de datos


  var textoAlerta; // Confirmaciones de envio a la BBDD
  if(tipo==="save"){ // DML insert
    textoAlerta="El evento quedará registrado en el sistema";
  }else if(tipo==="delete"){ // DML Delete
    textoAlerta="No tiene permitida esta accion consulte al administrador";
  }else if(tipo==="update"){  // DML Update
    textoAlerta="El registro sera actualizado";
  }else if(tipo==="vali"){  // Verificación de documentos
    textoAlerta="Esta apunto de autorizar la generación de un documento";
  }else {
    textoAlerta="Quieres realizar la operación solicitada"; // confirmacion
  }

  swal({
    title: "Confirmar",
    text: textoAlerta,
    type: "info",
    showCancelButton: true,
    confirmButtonText: "Aceptar",
    cancelButtonText: "Cancelar"
  }).then(function () {
    $.ajax({
      type: metodo,
      url: accion,
      data: formdata ? formdata : form.serialize(), // definicion del formulario sa enviar
      cache: false,
      contentType: false,
      processData: false,
      xhr: function(){ // Envio de PDF para Reportes de asistencia
        var xhr = new window.XMLHttpRequest();
        xhr.upload.addEventListener("progress", function(evt) {
          if (evt.lengthComputable) {
            var percentComplete = evt.loaded / evt.total;
            percentComplete = parseInt(percentComplete * 100);
            if(percentComplete<100){
              respuesta.html('<p class="text-center">Procesado... ('+percentComplete+'%)</p><div class="progress progress-striped active"><div class="progress-bar progress-bar-info" style="width: '+percentComplete+'%;"></div></div>'); // Estilo de material desing transaccion entre interfaz y MSSQL
            }else {
              respuesta.html('<p class="text-center"></p>');
            }
          }
        }, false);
        return xhr;
      },
      success: function (data) {
        respuesta.html(data);
      },
      error: function() {
        respuesta.html(msjError);
      }
    });
    return false; // devuleve respuesta
  });
});
