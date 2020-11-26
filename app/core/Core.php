<?php 

	/**
	* Mapear la url ingresada en el navegador,
	1.- controlador
	2.- método (funcion)
	3.- parametros
	Ejemplo: /articulo/actualizar/4
	*/

	class Core{
		protected $controladorActual = 'Inicio';
		protected $metodoActual = 'index';
		protected $parametros = [];

		//contructor
		public function __construct(){
			
			$url = $this->getUrl();
			//echo "hola";
			//var_dump($this->getUrl());
            
			//evaluar si el archivo existe
			//ucwords convierte primera letra a mayuscula
			//buscar en controladores si el controlador existe
			
			if(count($url) != 0){
			    
				//var_dump(file_exists('../app/controladores/'.ucwords($url[0].".php")));
    			if(file_exists('../app/controladores/'.ucwords($url[0]).'.php')){
    				//si existe se setea como controlador por defecto
    				$this->controladorActual = ucwords($url[0]);
    				
    
    				//unset indice
    				unset($url[0]);
    			}else{
    			    
    			  
    			    
    			    
    			}
            }
            //var_dump($url);
			///requerir el controlador
			
			require_once '../app/controladores/'.$this->controladorActual.'.php';
			//var_dump(new $this->controladorActual);
			$this->controladorActual = new $this->controladorActual;
            //var_dump(count($url) != 0);
			//chequear la segunda parte de la url que seria el metodo
			//var_dump(method_exists($this->controladorActual, $url[1]));
			if(count($url) != 0){
    			if(isset($url[1])){
    				if(method_exists($this->controladorActual, $url[1])){
    					//checaamos el metodo
    					$this->metodoActual = $url[1];
    					//unset indice
    					unset($url[1]);
    				}
    			}
			}
			//para probar traer metodo
			//echo $this->metodoActual;

			//obtener los posibles parametros

			$this->parametros = count($url) != 0 ? ($url) : [];
            //var_dump($this->parametros);
			//llamar callback con parametros array
			
			echo call_user_func_array([$this->controladorActual,$this->metodoActual],$this->parametros);

		}

		public function getUrl(){

			//echo $_GET['url']; 
            $url = [];
			if(isset($_GET['url'])){
				$url = rtrim($_GET['url'],'/');
				$url = filter_var($url,FILTER_SANITIZE_URL);
				$url = explode('/',$url);
				
			}
			return $url;
			
		}
	}