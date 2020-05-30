
<?php
/*
CRUD con PostgreSQL y PHP
================================
Este archivo lista todos los
datos de la tabla, obteniendo a
los mismos como un arreglo
================================
*/
?>

<?php
	include_once "config.php";
	$sql = $databasePDO->query("select id_reporte, tipo, descripcion, usuario from reporte");
	$resultados = $sql->fetchAll(PDO::FETCH_OBJ);
?>




<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="lib/leaflet/leaflet.css" />
	<script src="lib/leaflet/leaflet.js"></script>
	
	<link rel="stylesheet" href="lib/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.min.css" />
	<script src="lib/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.min.js"></script>
	
	<link rel="stylesheet" href="lib/leaflet-easybutton/easy-button.css" />
	<script src="lib/leaflet-easybutton/easy-button.js"></script>


	<!-- importar libreria JQuery -->
	<script src="lib/jquery/jquery-3.4.1.js"></script>

	<!-- Importtar la libreria  jQuery Modal -->
	<!-- Se esta usando un CDN -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />



	<!--Mapa de Calor Clase 15 -->
	<!-- https://github.com/Leaflet/Leaflet.heat -->

	<script src="lib/leaflet-heat.js"></script>

	 <!-- Mapa Cluster Clase 15 -->
	 <link rel="stylesheet" href="lib/leaflet-markercluster/MarkerCluster.css" />
	<link rel="stylesheet" href="lib/leaflet-markercluster/MarkerCluster.Default.css" />
	<script src="lib/leaflet-markercluster/leaflet.markercluster.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
	<script src="js/bootstrap.min.js"></script>
	<script src="js/popper.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css"/>



</head>
<body>
	<div class="container-fluid">
	<div class=" col-12 col-sm-12 col-md-12 col-lg-1 col-xl-5 text-center"></div>
	<div class=" col-12 col-sm-12 col-md-12 col-lg-8 col-xl-12 text-center"> 

	<div class="row">
	<div class="col-xs-6 text-center">
		<h1>Qué reporte desea actualizar</h1>
		<br>
		<div>
			<table clas="table table-hover table condensed tanle bordered table-centered" border=8 >
				<thead>
					<tr>
						<th>ID</th>
						<th>Tipo</th>
						<th>Descripcion</th>
						<th>Usuario</th>
						<th>Actualizar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($resultados as $edificio){ ?>
						<tr>
							<td><?php echo $edificio->id_reporte ?></td>
							<td><?php echo $edificio->tipo ?></td>
							<td><?php echo $edificio->descripcion ?></td>
							<td><?php echo $edificio->usuario ?></td>
							<td><a href="<?php echo "update_form.php?id_reporte=" . $edificio->id_reporte?>">Actualizar 📝</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
</div>
	<div class=" col-12 col-sm-12 col-md-12 col-lg-1 col-xl-1 text-center"> 

</div>

<br>
<a  href='semana15.php?logueado=si'>Volver al Geovisor</a>

</body>
</html>

