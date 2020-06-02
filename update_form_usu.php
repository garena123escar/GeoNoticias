<?php
/*
CRUD con PostgreSQL y PHP
================================
Este archivo muestra un formulario llenado automáticamente
(a partir del ID pasado por la URL) para editar
================================
 */
 
if (!isset($_GET["id_usuario"])) {
    exit();
}

$id_reporte = $_GET["id_usuario"];
include_once "config.php";

$sql = $databasePDO->prepare("select id_usuario, telefono, contrasena, correo from usuarios WHERE id_usuario = ?;");
$sql->execute([$id_usuario]);

$edifico = $sql->fetchObject();

if (!$edifico) {
    #No existe
    echo "¡No existe algun Edificio con ese ID!";
    exit();
}
#Si la mascota existe, se ejecuta esta parte del código
?>
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
<div class="modal fade modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog " role="document" >
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title" id="exampleModalLabel">¿Quienes somos?</h1>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h3>Visión</h3> <p>
        	<h5 class="display-6 text-justify"> En los próximos años, posicionarse como un medio de comunicación alimentado además, creado por y para los usuarios Caleños. <br> <br><br>
	Ser el primer medio de reporte continúo entre autoridades y comunidad. Teniendo en cuenta, qué, no solo se podrán reportar hechos delictivos, sino, manifestaciones, atascos, eventos de gran magnitud, entre otros.
	</h5>	</p>
	        <h3>Misión</h3> <p>
        	<h5 class="display-6 text-justify"> <br>Debido a la creciente necesidad de espacializar la información de último minuto se hace necesario  la creación de herramientas de tipo espacial que permitar realizar dicha acción, teniendo en cuenta  qué según información oficial, la ciudad de Santiago de Cali, es una de las ciudades más peligrosas del país.
        	<br>	<br>	 Sin embargo, la función de este sistema, no es netamente el reporte de la inseguridad, o casos de violencia. Es un sistema innovador que pretende dar conocimiento a la ciudadania sobre las acciones de caracter noticioso que ocurren día a día en la ciudad. Dando así alcance a la ciudadania sobre las acciones que ocurren en su entorno espacial.</h3>
	</h5>	</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid"> 
   <div class="row">
   <div class="display-1 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-8	text-center"> 	

 <!--<div class="display-1 col-6 col-sm-6 col-md-6 col-lg-6 col-xl-8 text-center"></div>-->


    <div class="navbar-header ">
    <div class="display-1 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-4 text-center"> 	
    <a class="navbar-brand text" href='semana15.php?logueado=si'>Volver al Geovisor</a>


    </div>

      
    </div>


    <ul class="nav navbar-nav">
 <li class="active"><a href="#ventana-vision" class=" nav-link btn btn-outline-danger btn-lg" data-toggle="modal" data-target="#exampleModal" aria-haspopup="true" aria-expanded="false">¿Quienes sómos?</a></li> 

        <li class="nav-item dropdown nav navbar-nav">
        <a class="nav-link dropdown-toggle btn btn-outline-danger btn-lg"  id="navbarDropdownMenuLink"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Contáctenos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
          <a class="dropdown-item" href="https://www.facebook.com/esteban8atorres">Facebook</a> <br>
          <a class="dropdown-item" href="https://www.instagram.com">Instragram</a><br>
          <a class="dropdown-item" href="https://www.webwhatsapp.com">Whatsapp</a>       
      </div>
      </li>
      <li class="active"><a id="boton_quienes_somos" href="index.php?op=salir" class="btn btn-outline-danger btn-lg">Cerrar sesión</a></li>
      		<li class="active  ">	<a class="btn btn-outline-danger btn-lg	" href="form_update.php">Volver al Listado de Reportes (Actualizar)</a></li>

    </ul>
<br><br>
</div>
</div>


<div class="container-fluid">
	<div class="row">
	<div class="display-6 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12	text-center"> 	

	<div>
		<h1>Actualizar Datos de Usuario</h1><br>
		<form action="update_usu.php" method="POST">
			<input type="hidden" name="id_usuario" value="<?php echo $edifico->id_usuario; ?>">
			<div class="form-group">
				<label for="telefono">Actualizar Telefono</label>	
				<input value="<?php echo $edifico->telefono; ?>" required name="telefono" type="text" id="telefono" placeholder="telefono">
			</div>
            	<label for="contrasena">Actualizar Contraseña</label>	
				<input value="<?php echo $edifico->contrasena; ?>" required name="contraseña" type="text" id="contraseña" placeholder="contraseña">
			</div>
            	<label for="correo">Actualizar Correo</label>	
				<input value="<?php echo $edifico->correo; ?>" required name="correo" type="text" id="correo" placeholder="correo">
			</div>
			<br>
			<button type="submit">Actualizar Edificio</button>
			<br><br>
		</form>
	</div>
	</div>
</div>
</div>
</div>
<div>