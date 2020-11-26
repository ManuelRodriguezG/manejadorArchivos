<?php

	class FilesManager extends Controlador{
		public function __construct(){
			//echo 'Controlador Pagina cargada';
			
		}
		
		
		public function index(){

			
			//método de la página inicial
			$this->manejadorArchivos = $this->modelo('ManejadorArchivos');
			$this->manejadorArchivos->main();

			
			
			
		}
		

		
		
	}