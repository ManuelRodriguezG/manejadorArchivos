<?php 

class File{
    function __construct(){
        $this->db = new CRUD;

    }

    function main(){
            //var_dump("conectado");
        $data = isset($_POST["data"]) ? json_decode($_POST["data"]) : (isset($_GET["data"]) ? json_decode($_GET["data"]) :  null);

        $resp = $this->session->sessionActive();


        if(isset($data) && $data->action == 'codeVehiculos'){
            echo json_encode($this->codigoSeccionVehiculos());
        }elseif(isset($data) && $data->action == 'nuevaMarca'){
                     //var_dump($resp);
            echo json_encode($this->nuevaMarca($data));
        }elseif(isset($data) && $data->action == 'actualizarMarca'){
                     //var_dump($resp);
            echo json_encode($this->actualizarMarca($data));
        }elseif(isset($data) && $data->action == 'update-modelo'){
                     //var_dump($resp);
            echo json_encode($this->actualizarModelo($data));
        }elseif(isset($data) && $data->action == 'insert-modelo'){
                     //var_dump($resp);
            echo json_encode($this->insertarModelo($data));
        }

    }

    function delete($id_folder,$file_name,$folder_name){
        var_dump($id_folder);
        var_dump($file_name);
        $path = RUTA_APP."/modelos/uploads/".$folder_name."/".$file_name;
        //var_dump($path);
        $delete = unlink($path);
        var_dump($delete);
        if($delete == true){
            $respId = $this->get_id_file_folder($id_folder,$file_name);
            if($respId["estado"] == "success"){
                //public function delete($tabla, $campo, $valor)<br>
                $resp = $this->db->delete("files","id",$respId["respuesta"]["id"]);
                if($resp["estado"] == "success"){
                    $respuesta = array("error"=>"false","msg"=>"Eliminado con éxito");
                }else{
                    $respuesta = array("error"=>"false","msg"=>"Error al eliminar");
                }    
            }else{
                $respuesta = array("error"=>"false","msg"=>"Error al eliminar");
            }
            
        }else{
            $respuesta = array("error"=>"true","msg"=>"Error al eliminar");
        }
        return $respuesta;

    }

    function get_id_file_folder($id_folder,$file_name){
        //public function buscarRegistro($campo, $tabla, $elemento, $busqueda, $and = null)<br>
        $resp = $this->db->buscarRegistro("id","files","id_folder",$id_folder,"AND name = '".$file_name."'");
        return $resp;
    }

    function save($id_folder,$file_name){

        $resp = $this->db->insert("files",array("id_folder","name"),array($id_folder,$file_name));
        return $resp;

    }



}
?>