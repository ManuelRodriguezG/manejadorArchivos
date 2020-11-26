<?php 
   
    class File{
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
        
        
        
    }
?>