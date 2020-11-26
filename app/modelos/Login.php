<?php 
	/**
	* 
	*/
	class Login 
	{
		
		function __construct()
		{
			# code...
			//var_dump("modelo login");
			$this->db = new CRUD;
		}

		function main(){
			$data = isset($_POST["data"]) ? json_decode($_POST["data"]) : (isset($_GET["data"]) ? json_decode($_GET["data"]) :  null);
            
            //$resp = $this->session->sessionActive();
           
            //if($resp['sessionActive'] == "true"){
                if(isset($data) && $data->action == 'sign-up'){
                    echo json_encode($this->sign_up($data));
                }elseif(isset($data) && $data->action == 'sign-in'){
                    echo json_encode($this->sign_in($data));
                }
            //}else{
            //    echo json_encode($resp);
            //}
		}
		

		function sign_up($data){
			//var_dump($data);
			$respMail = $this->exist_mail($data->infoUser->email,$data->module);
			if ($respMail["exist"] == false) {
				
			
				$modules = array(
					"dashboard"=>"dashboard_user",
					"page"=>"page_user"
				);
				if (function_exists('random_bytes')){
					$hash = bin2hex(random_bytes(32));
				}
				else if (function_exists('mcrypt_create_iv')){
					$hash = bin2hex(mcrypt_create_iv(32, MCRYPT_DEV_URANDOM));
				}
				else if (function_exists('openssl_random_pseudo_bytes')) {
				    $hash = bin2hex(openssl_random_pseudo_bytes(32));
				}
				$hashedPW =  $data->infoUser->password . $hash;
				$passwordHashed = hash('sha256', $hashedPW);
				$date = DATE_NOW;
				//insert($tabla, $campos = array(), $valores = array())
				$resp = $this->db->insert($modules[$data->module],array("name","password","hash","mail","created_date","updated_date"),array($data->infoUser->user,$passwordHashed,$hash,$data->infoUser->email,$date,$date));
				//var_dump($resp);
				if ($resp["estado"] == "success") {
					$respuesta = array("error" => false,"msg"=>"Registro realizado con éxito");
				}else{
					$respuesta = array("error" => true,"msg"=>"Ocurrió un error en el registro");
				}
			}else{
				$respuesta = array("error" => true,"msg"=>"Ya se encuentra registrado");
			}
			return $respuesta;
		}

		function sign_in($data){
			//var_dump($data);
			$respMail = $this->exist_mail($data->infoUser->email,$data->module);
			if ($respMail["exist"] == false) {
				
				$respuesta = array("error" => true,"msg"=>"No existe Email Address");
				
			}else{
				//var_dump($respMail);
				$hashedPW =  $data->infoUser->password . $respMail['data']['hash'];
				$passwordHashed = hash('sha256', $hashedPW);
				if ($passwordHashed == $respMail['data']['password']) {
					$respuesta = array("error" => false,"msg"=>"Login con éxito",'url'=>RUTA_URL.'dashboard');
				}else{
					$respuesta = array("error" => true,"msg"=>"Error en la contraseña");
				}
				
			}
			return $respuesta;
		}

		function exist_mail($email,$module){
			$modules = array(
				"dashboard"=>"dashboard_user",
				"page"=>"page_user"
			);
			//public function buscarRegistro($campo, $tabla, $elemento, $busqueda, $and = null)
			$resp = $this->db->buscarRegistro("*",$modules[$module],"mail",$email);
			//var_dump($resp);
			if ($resp["estado"] == "success") {
				$respuesta = array("error" => false,"exist" => true,'data'=>$resp["respuesta"]);
			}else{
				$respuesta = array("error" => true,"exist" => false);
			}
			return $respuesta;
		}
	}
?>