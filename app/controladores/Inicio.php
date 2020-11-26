<?php

	class Inicio extends Controlador{
		public function __construct(){
			//echo 'Controlador Pagina cargada';
			
		}
		
		
		public function index(){

			
			//método de la página inicial
			//$this->showFolders = $this->modelo('ManejadorArchivos');
			//$this->dataFolders = $this->showFolders->get_folders_and_files();
//
//			//$datos = [
//			//	'dataFolders'=>$this->dataFolders,
//			//	
			//];
			
			$this->vista('inicio');
		}
		

		
		
	}