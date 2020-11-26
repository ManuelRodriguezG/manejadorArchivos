<?php 

	//Clase contorlador principal
	//Se encarga de poder cargar los modelos y las vistas

	class Controlador{

		//Cargar modelo
		public function modelo($modelo){
			//carga
			require_once '../app/modelos/'.$modelo.'.php';
			//var_dump(('../app/modelos/'.$modelo.'.php'));
			//instanciar el modelo
			return new $modelo();
		}
		
		//Cargar vista
		public function vista($vista,$datos = []){
			//checar si el archivo vista existe

			if(file_exists('../app/vistas/paginas/'.$vista.'.php')){
				require_once '../app/vistas/paginas/'.$vista.'.php';	
			}else{
				//si el archivo de la vista no existe
				die('la vista no existe');
			}
		}

	}
	
?>	