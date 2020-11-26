<?php 
error_reporting(true);
class Folder{
    function __construct(){
        $this->db = new CRUD;

    }

    function main(){
            //var_dump("conectado");
        $data = isset($_POST["data"]) ? json_decode($_POST["data"]) : (isset($_GET["data"]) ? json_decode($_GET["data"]) :  null);

        $resp = $this->session->sessionActive();

        if($resp['sessionActive'] == "true"){
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
        }else{
            echo json_encode($resp);
        }
    }

    function exist_folder_name($folder_name){
        //var_dump($folder_name);
        //public function insert($tabla, $campos = array(), $valores = array())<br>
        //public function update($tabla, $campos = array(), $valores = array(),$and = NULL)<br>
        //public function delete($tabla, $campo, $valor)<br>
        //public function listar($campos, $tabla, $where = NULL, $orderBy = NULL, $AscDesc = NULL, $limit = NULL)<br>
        //public function buscarRegistro($campo, $tabla, $elemento, $busqueda, $and = null)<br>
        //public function maxId($campo, $tabla)<br>
        //public function freeQuery($query)
        $resp = $this->db->buscarRegistro("name","folders","name",$folder_name);
        //var_dump($resp);
        if ($resp["estado"] == "success") {
            $respuesta = array("error"=>"false","exist"=>"true");
        }else{
            $respuesta = array("error"=>"true","exist"=>"false","msg"=>"La carpeta ya existe");
        }

        return $respuesta;
    }

    function create($folder_name){
        //var_dump(RUTA_APP);
        $path = RUTA_APP."/modelos/uploads/".$folder_name;
        $createdDir = mkdir($path,0700);
        //var_dump($createdDir);
        if ($createdDir == true) {
            //save directory
            $respInsert = $this->db->insert("folders",array("name"),array($folder_name));
            if ($respInsert["estado"] == "success") {
                $respuesta = array("error"=>"false","msg"=>"Carpeta creada con éxito");
            }else{
                $respuesta = array("error"=>"false","msg"=>"Error al guardar el registro de la carpeta");
            }
        }else{
            //error
            $respuesta = array("error"=>"false","msg"=>"Error al crear la carpeta");
        }
        return $respuesta;
    }

}
?>