<?php 
include "../app/vistas/includes/librerias.php";
include "../app/vistas/includes/header.php";
?>
<!DOCTYPE html>
<html>
<head>
	<title>Manejador Archivos</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL; ?>/library/bootstrap-4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="<?php echo RUTA_URL; ?>/css/indexCss/style.css">
</head>
<body >
	
	<div class="container p-4" style="justify-content: center;display: flex;">
		
		<ul id="compositions-list" class="pure-tree main-tree">
			
			
		</ul>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="alerts">

					</div>
					<div class="container_modal_body">
						
						
					</div>
					
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<div class="container_button">
						<button id="action_modal" type="button" class="btn btn-primary">Save changes</button>
					</div>
					
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript" src="<?php echo RUTA_URL."js/indexJs/main.js" ?>"></script>


</body>
</html>







