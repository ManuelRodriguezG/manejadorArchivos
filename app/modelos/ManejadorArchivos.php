<?php 
include "File.php";
include "Folder.php";
class ManejadorArchivos{
    function __construct(){
        $this->db = new CRUD;

    }

    function main(){
            //var_dump("conectado");
        $data = isset($_POST["data"]) ? json_decode($_POST["data"]) : (isset($_GET["data"]) ? json_decode($_GET["data"]) :  null);
            //var_dump($data);
        if(isset($data) && $data->action == 'get_folders_and_files'){
            echo json_encode($this->get_folders_and_files());
        }elseif(isset($data) && $data->action == 'create_folder'){
            echo json_encode($this->create_folder($data->folder_name));
        }elseif(isset($data) && $data->action == 'upload_file'){
            echo json_encode($this->upload_file($data));
        }elseif(isset($data) && $data->action == 'rename_folder'){
            echo json_encode($this->rename_folder($data));
        }elseif(isset($data) && $data->action == 'delete_folder'){
            echo json_encode($this->delete_folder($data));
        }elseif(isset($data) && $data->action == 'delete_file'){
            echo json_encode($this->delete_file($data));
        }else{

            $folder_name = $_POST["folder_name"];
            $newPath = "C:/wamp/www/manejadorArchivos/app/modelos/uploads/".$folder_name."/".basename($_FILES["file"]["name"]);

            $oldPath = $_FILES["file"]["tmp_name"];

            $movedFile = move_uploaded_file($_FILES["file"]["tmp_name"],$newPath);
            if($movedFile == true){

                $this->file = new File;
                $this->folder = new Folder;
                $respuesta = $this->folder->get_id_folder($folder_name);
                if($respuesta["estado"] == "success"){
                    $resp = $this->file->save($respuesta["respuesta"]["id"],$_FILES["file"]["name"]);
                        //var_dump($resp);
                    if($resp["estado"] == "success"){
                        $respuesta = array("error"=>"false","msg"=>"Archivo subido con éxito");    
                    }else{
                        $respuesta = array("error"=>"true","msg"=>"Error al guardar archivo");
                    }
                }

            }else{
                $respuesta = array("error"=>"true","msg"=>"Ocurrió un error al subir el");
            }
            echo json_encode($respuesta);
        }

    }

    function delete_file($data){
        $this->file = new File;
        $this->folder = new Folder;
        $respuesta = $this->folder->get_id_folder($data->folder_name);
        if($respuesta["estado"] == "success"){
            $resp = $this->file->delete($respuesta["respuesta"]["id"],$data->file_name,$data->folder_name);
                        
            if($resp["estado"] == "success"){
                $respuesta = array("error"=>"false","msg"=>"Archivo subido con éxito");    
            }else{
                $respuesta = array("error"=>"true","msg"=>"Error al guardar archivo");
            }
        }

        return $resp;
    }

    function delete_folder($data){
        $this->folder = new Folder;
        $respuesta = $this->folder->delete($data->folder_name);
        return $respuesta;
    }

    function rename_folder($data){
            //var_dump($data);
        $this->folder = new Folder;
        $respuesta = $this->folder->rename($data->folder_name,$data->old_folder);
        return $respuesta;
    }

    function create_folder($folder_name){
        $this->folder = new Folder;
            //Validate name
        $resp = $this->folder->exist_folder_name($folder_name);
            //var_dump($resp);
        if ($resp["exist"] == "true") {
                //End of process
            $respuesta = $resp;
        }else{
                //Continue process
            $respuesta = $this->folder->create($folder_name);
                //var_dump($respCreate);
        }
        return $respuesta;
    }

    function get_folders_and_files(){
        $path = RUTA_APP."/modelos/uploads";
        $dir = opendir($path);
        $folders_and_files = array();
            //var_dump(RUTA_APP);
            //var_dump($dir);
            // Read all elements in the uploads folder
        while ($element_folder = readdir($dir)){
            if($element_folder != "." && $element_folder != ".."){

                    //var_dump(is_dir(RUTA_APP."/modelos/uploads/".$element_folder));
                    //Open folder
                if(is_dir(RUTA_APP."/modelos/uploads/".$element_folder)){

                    $folder = $element_folder;
                        //add folder
                    $folders_and_files[$folder] = array();
                    $path_folder_files = RUTA_APP."/modelos/uploads/".$folder;
                    $dir_files = opendir($path_folder_files);
                        //var_dump($path_folder_files);
                        // Read files
                    while ($element_folder_file = readdir($dir_files)){
                        if($element_folder_file != "." && $element_folder_file != ".."){
                                //var_dump($element_folder_file);
                            $file = $element_folder_file;
                            $folders_and_files[$folder][] = $file;
                        }

                    }
                }
                    //var_dump($element_folder);

            }        
        }
            //var_dump($folders_and_files);
        if(count($folders_and_files) == 0){
            $respuesta = array("empty"=>"true");
        }else{
            $respuesta = array("empty"=>"false","data_folders"=>$folders_and_files);
        }
        return $respuesta;
    }

}
?>