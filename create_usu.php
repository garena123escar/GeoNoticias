<?php
/*
================================
Este archivo muestra un formulario que
se envía a create_Edificio.php, el cual guardará
los datos
================================
*/
?>
<<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>	registro de usuario</title>
<title>proyecto sig 3</title>
	<meta charset="utf-8">
	<meta name="viewport"  content="device-width, initial-scale=1,shrink-to-fit=no">
	<meta http-equiv="x-ua-compatible" content="ie-edge" >
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" href="lib/leaflet/leaflet.css" />
	<link rel="stylesheet" href="lib/leaflet-easybutton/easy-button.css" />
	<link rel="stylesheet" href="lib/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.min.css" />
	<link rel="stylesheet" href="lib/leaflet-markercluster/MarkerCluster.css" />
	<link rel="stylesheet" href="lib/leaflet-markercluster/MarkerCluster.Default.css" />
	<link rel="stylesheet" href="css/bootstrap.min.css"/>
	<script src="lib/leaflet/leaflet.js"></script>
	<script src="js/popper.min.js.map"></script>
	<script src="lib/leaflet-groupedlayercontrol/leaflet.groupedlayercontrol.min.js"></script>
	<script src="lib/leaflet-easybutton/easy-button.js"></script>
	<script src="lib/jquery/jquery-3.4.1.js"></script>	
	<script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="lib/leaflet-heat.js"></script>
	<script src="lib/leaflet-markercluster/leaflet.markercluster.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.js"></script>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
	<style type="text/css">.borde1{
		background-color: red;
		width: 100px;
		height: 160px;
		
	}
</style>

	<style type="text/css">.borde2{
		background-color: red;
		height: 80px
	}
		</style>

<style>
		.slider{
		background: url(img/bg-1.jpg);
		height: 100vh;
		background-size: cover;
		background-position: center;
	}.slider2{
		background-color: #FAFAFA;
		height: 100vh;
		background-size: cover;
		background-position: center;
	}
</style>
</head>
<body>

<div class="container-fluid">
<div class="row">
	
		<div class="display-2 col-8 col-sm-7 col-md-7 col-lg-10 col-xl-10  text-center border"><p> Registrar usuario</p>GeoNoticias <br><br> <br> Universidad del valle</div>
		<div class="display-6 col-4 col-sm-5 col-md-5 col-lg-2 col-xl-2 text-left border"><p></p>
			<form action="create1.php" method="POST">
			<div>
				<label for="usuario">Nombre usuario: &nbsp;&nbsp;&nbsp;&nbsp;</label>
				<input required name="usuario" type="text" id="usuario" placeholder="Nombre de usuario">
			</div>
<br>
			<div>
				<label for="nombre">Ingrese su nombre:&nbsp;</label>
				<input required name="nombre" type="text" id="nombre" placeholder="Ingrese su nombre">
			</div>
<br>
			<div>
				<label for="apellido"> Ingrese su apellido:&nbsp;</label>
				<input required name="apellido" type="text" id="apellido" placeholder="Apellido">
			</div>	
<br>	
			<div>
				<label for="telefono"> Ingrese su telefono:</label>
				<input required name="telefono" type="text" id="telefono" placeholder="Ingrese su telefono">
			</div>	
<br>	
			<div>
				<label for="contrasena">contrasena: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
				<input required name="contrasena" type="password" id="contrasena" placeholder="contrasena">
			</div>	
<br>	
			<div>
				<label for="correo">correo: &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;;</label>
				<input required name="correo" type="text" id="correo" placeholder="correo">
			</div>	
<br>		
			<button type="submit">Registrar usuario</button>
			<br><br>
			<!-- Enlace a listado de Edificios -->
			<a href="sig3/PaginaWeb/index.php">iniciar Sesión</a>
		</form>
		</div>

		</div>

	</div>
<div class="container-fluid">
<br><br><br><br><br><br>	
	<div class="row">
		<div class="display-6 col-4 col-sm-4 col-md-2 col-lg-2 col-xl-4 border text-center"><p>MODELAMIENTO DE DATOS SIG EN WEB 	<br><br> PROYECTO FINAL</p></div>
		<div class="display-6 col-4 col-sm-4 col-md-8 col-lg-8 col-xl-4 borde2 text-center"><p>UNIVERSIDAD DEL VALLE <br>ESCUELA DE INGENIERÍA CIVIL Y GEOMÁTICA <br> INGENIERÍA TOPOGRÁFICA</p></div>
		<div class="display-6 col-4 col-sm-4 col-md-2 col-lg-2 col-xl-4 border text-center"><p>GeoNoticias <br> Santiago de Cali <br> 2020</p></div>

	</div>
</div>
</div>
	
</body>
</html>
