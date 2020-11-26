 var FilesManager;

 $(document).ready(function(){
  //Create folder event
  $("#create_folder").click(function(){

    clear_class_action_modal();
    $(".container_modal_body").html('<label for="basic-url">Nombre de la Carpeta</label><div class="input-group mb-3"><input type="text" class="form-control" pattern="[A-Za-z0-9]{1,15}" id="folder_name" aria-describedby="basic-addon3"></div>');
    $("#exampleModalLabel").html("Crear Carpeta");
    $(".container_button").html('<button id="action_modal" type="button" class="btn btn-primary">Save changes</button>');
    $("#exampleModal").modal("show");
    $("#action_modal").html("Crear Carpeta");
    $("#action_modal").addClass("create_folder");

    //Event keypress, valid input folder name
    jQuery('#folder_name').keypress(function (tecla) {
      tecla = tecla.charCode;
      console.log(tecla);
      //Tecla de retroceso para borrar, siempre la permite
      if (tecla == 8) {
        return true;
      }

      // Patron de entrada, en este caso solo acepta numeros y letras
      patron = /[A-Za-z0-9 _]/;
      tecla_final = String.fromCharCode(tecla);
      
      return patron.test(tecla_final);
    });

    //Event click create folder
    $(".create_folder").click(function(){

      var folder_name = $("#folder_name").val();
      if (folder_name) {
        // Promise Show folders
        const createFolder = new Promise((resolve, reject) => {

          $.get('http://localhost/manejadorArchivos/FilesManager', `data=${JSON.stringify({
            action: 'create_folder',
            folder_name
          })}`,function(response){

            response = JSON.parse(response);
            response.error == "false" ? resolve(response.msg) : reject(response.msg);

          });
        });

        createFolder
        .then(data => 

          $(".alerts").html('<div class="alert alert-success" role="alert">'+data+'</div>'),
          setTimeout(function(){
            $(".alerts").html("");
            print_folders_and_files();
            $("#exampleModal").modal("hide");
          },2000)

          
          )
        .catch(error => 
          $(".alerts").html('<div class="alert alert-danger" role="alert">'+error+'</div>'),
          setTimeout(function(){
            $(".alerts").html("");
          },2000)

          );
      }else{
        $(".alerts").html('<div class="alert alert-danger" role="alert">El nombre de la carpeta está vacío</div>');
        setTimeout(function(){
          $(".alerts").html("");
        },2000)
      }
    });
  });

  //Upload File
  $("#upload_file").click(function(){
    console.log("click");
    $("#exampleModalLabel").html("Subir Archivo");
    $("#exampleModal").modal("show");
    $(".container_button").html('<button id="action_modal" type="button" class="btn btn-primary">Save changes</button>');
    $("#action_modal").html("Subir Archivo");
    clear_class_action_modal();
    $("#action_modal").addClass("upload_file");
    $(".container_modal_body").html('<div class="accordion" id="accordionExample"><div class="card"><div class="card-header" id="headingOne"><h2 class="mb-0"><button class="btn btn-link btn-block text-left" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">Lista de Carpetas<span style="float: right;display: none;" id="option_selected">Seleccionada:<span class="folder_span">Adobe</span></span></button></h2></div><div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample"><div class="card-body"><ul class="list-group" id="list_folders"></ul></div></div></div></div><div style="position: relative;"><div class="frame"><div class="center"><div class="bar"></div><div class="title">Drop file to upload</div><div class="dropzone"><div class="content"><img src="https://100dayscss.com/codepen/upload.svg" class="upload"><span class="filename"></span><form id="form_file"><input type="file" name="file" class="input" id="input_file"></form></div></div><img src="https://100dayscss.com/codepen/syncing.svg" class="syncing"><img src="https://100dayscss.com/codepen/checkmark.svg" class="done"></div></div></div>')

    create_folders_list();
    //Event click create folder
    $(".upload_file").click(function(){
      var selected = false;
      var folder_name = null;
      $(".input_check_folder").each(function(){
        console.log(this.checked);
        if (this.checked == true) {
          selected = true;
          folder_name = this.id.substring(12);
        }

      });

      console.log(selected);
      if(selected == true){
        var form = $("#form_file")[0];
        var formData = new FormData(form);
        console.log(formData.get("file").size);
        if (formData.get("file").size > 0) {
          formData.set("folder_name",folder_name);
          $.ajax({

            url: "http://localhost/manejadorArchivos/FilesManager",

            type: "post",

            dataType: "html",

            data: formData,

            cache: false,

            contentType: false,

            processData: false,

            success : function(data) {
              console.log(data);
              var response = JSON.parse(data);
              if(response.error == "false"){
                $(".alerts").html('<div class="alert alert-success" role="alert">'+response.msg+'</div>'),
                setTimeout(function(){
                  print_folders_and_files();
                  $("#exampleModal").modal("hide");
                  $(".alerts").html("");
                },2000)
              }else{
                $(".alerts").html('<div class="alert alert-danger" role="alert">'+response.msg+'</div>'),
                setTimeout(function(){
                  $(".alerts").html("");
                },2000)
              }
            }

          })
        }else{
          $(".alerts").html('<div class="alert alert-danger" role="alert">Seleccionar archivo para continuar</div>'),
          setTimeout(function(){
            $(".alerts").html("");
          },2000)
        }
      }else{
        $(".alerts").html('<div class="alert alert-danger" role="alert">Seleccionar carpeta para continuar</div>'),
        setTimeout(function(){
          $(".alerts").html("");
        },2000);
      }

      console.log("click  upload_file");
      console.log($("#input_file"));
      
      
      console.log(formData.get("file"));
      console.log(formData);
      
      /*var folder_name = $("#folder_name").val();
      if (folder_name) {
        // Promise Show folders
        const createFolder = new Promise((resolve, reject) => {

          $.get('http://localhost/manejadorArchivos/FilesManager', `data=${JSON.stringify({
            action: 'create_folder',
            folder_name
          })}`,function(response){
            console.log(response);
            response = JSON.parse(response);
            response.error == "false" ? resolve(response.msg) : reject(response.msg);

          });
        });

        createFolder
        .then(data => 

          $(".alerts").html('<div class="alert alert-success" role="alert">'+data+'</div>'),
          setTimeout(function(){
            $(".alerts").html("");
            print_folders_and_files();
            $("#exampleModal").modal("hide");
          },2000)

          
          )
        .catch(error => 
          $(".alerts").html('<div class="alert alert-danger" role="alert">'+error+'</div>'),
          setTimeout(function(){
            $(".alerts").html("");
          },2000)

          );
      }else{
        $(".alerts").html('<div class="alert alert-danger" role="alert">El nombre de la carpeta está vacío</div>');
        setTimeout(function(){
          $(".alerts").html("");
        },2000)
      }*/
    });
  });

  

  print_folders_and_files();

})

 function print_folders_and_files(){
  //Remove Folder View
  $("#compositions-list").html("");
  // Promise Show folders
  const showFolders = new Promise((resolve, reject) => {

    $.get('http://localhost/manejadorArchivos/FilesManager', `data=${JSON.stringify({
      action: 'get_folders_and_files'
    })}`,function(response){
      console.log(response);
      response = JSON.parse(response);
      if (response.empty == "false") {
        FilesManager = response.data_folders;
      }
      response.empty == "false" ? resolve(response.data_folders)  : reject("error");

    });
  });

  showFolders
  .then(data => 
  //console.log(data)
  
  Object.keys(data).forEach(function(folder_name){
    //console.log(folder_name + ' - ' + data[folder_name]);
    print_folder(folder_name);
    Object.keys(data[folder_name]).forEach(function(i){
      print_files_to_folder(folder_name,data[folder_name][i]);
      //console.log(folder_name + ' - ' + data[folder_name][i]);
    })
  })
  )
  .catch(error => console.error(error));
}

function create_folders_list(){
  console.log(FilesManager);
  Object.keys(FilesManager).forEach(function(folder_name){
    //console.log(folder_name + ' - ' + data[folder_name]);
    print_folder(folder_name);
    $("#list_folders").append('<li class="list-group-item">'+
      '<div class="form-group form-check">'+
      '<input type="radio" name="name_folder" class="form-check-input input_check_folder" id="folder_list_'+folder_name+'">'+
      '<label class="form-check-label" for="folder_list_'+folder_name+'">'+folder_name+'</label>'+
      '</div>'+
      '</li>');
  })
  $(".input_check_folder").change(function(){
    $('#collapseOne').collapse("hide");
    console.log(this.id.substring(12));
    var folder_name = this.id.substring(12);
    $("#option_selected .folder_span").html(folder_name);
    $("#option_selected").css("display","block");
  })
}

function clear_class_action_modal(){
  $("#action_modal").removeClass("create_folder");
  $("#action_modal").removeClass("upload_file");
}

function print_folder(folder_name){
  var folderCode = '<li id="'+folder_name+'">'+
  '<input class="input_folders" type="checkbox" id="folder-'+folder_name+'">'+
  '<label for="folder-'+folder_name+'">'+folder_name+'</label>'+
  '<ul class="pure-tree">  '+
  '</ul>'+
  '</li>';
  $("#compositions-list").append(folderCode);
}

function print_files_to_folder(folder_name,file_name){
  var fileCode = '<li class="pure-tree_link"><a href="#">'+file_name+'</a></li>';
  $("#"+folder_name+" .pure-tree").append(fileCode);
}




var droppedFiles = false;
var fileName = '';
var $dropzone = $('.dropzone');
var $button = $('.upload-btn');
var uploading = false;
var $syncing = $('.syncing');
var $done = $('.done');
var $bar = $('.bar');
var timeOut;

$dropzone.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
  e.preventDefault();
  e.stopPropagation();
})
.on('dragover dragenter', function() {
  $dropzone.addClass('is-dragover');
})
.on('dragleave dragend drop', function() {
  $dropzone.removeClass('is-dragover');
})
.on('drop', function(e) {
  droppedFiles = e.originalEvent.dataTransfer.files;
  fileName = droppedFiles[0]['name'];
  $('.filename').html(fileName);
  $('.dropzone .upload').hide();
});

$button.bind('click', function() {
  startUpload();
});

$("input:file").change(function (){
  fileName = $(this)[0].files[0].name;
  $('.filename').html(fileName);
  $('.dropzone .upload').hide();
});

function startUpload() {
  if (!uploading && fileName != '' ) {
    uploading = true;
    $button.html('Uploading...');
    $dropzone.fadeOut();
    $syncing.addClass('active');
    $done.addClass('active');
    $bar.addClass('active');
    timeoutID = window.setTimeout(showDone, 3200);
  }
}

function showDone() {
  $button.html('Done');
}