<?php
  
  //Una forma facil de validar que la pagina se abrio desde la pagina anterior y si esta logueado en el sistema
  if( ($_GET['logueado']=='si') AND isset($_SERVER['HTTP_REFERER']))
  {

  }
else
	{
		die('No autorizado para acceder por este medio !  
		<a href="index.php">volver</a>');
	}
  //metodo para iniciar las variables de  session
  session_start();
?>


<!DOCTYPE html>
<html>
<head>
	
	<title>Proyecto</title>
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


	
    <!--  CSS -->
	<style>
		table, th, td {
  			border: 1px solid black;
		}
	</style>
		<style type="text/css">.borde1{
		background-color: red;
		width: 100px;
		height: 160px;
		
	}
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




	<!-- Contenido HTML de la Ventana Modal -->
<!--	<div id="ex1" class="modal">
		<p>Hola este contenido del ejemplo 1 de una ventana modal</p>
		<a href="#" rel="modal:close">Cerrar</a>
	</div> 
-->

	<!-- Contenido HTML de la Ventana Modal Ingresar Datos -->
	<div id="ventana-consulta" class="modal">
		<div class="modal-header">
		<h3 class="modal-title" id="myModalLabel">Consultar tipo de noticia por comuna</h3>

           <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
      </div>
		<form enctype="multipart/form-data">
			
			<label for="opciones_form1">Seleccione el tipo de noticia:</label><br>
			<select id="opciones_form1" name="opciones_form1">
			<option value="violencia">Violencia</option>
			<option value="accidentes">Accidente</option>
			<option value="hurtos">Hurtos</option>
			<option value="bloqueos">Bloqueos</option>
			<option value="Incendios">Incendios</option>
			<option value="DesNaturales">Desastres naturales</option>
			</select>
			<br>

            <form enctype="multipart/form-data">
			
			<label for="opciones_form2">Seleccione la comuna:</label><br>
			<select id="opciones_form2" name="opciones_form2">
			<option value="1">Comuna 1</option>
			<option value="2">Comuna 2</option>
			<option value="3">Comuna 3</option>
			<option value="4">Comuna 4</option>
			<option value="5">Comuna 5</option>
			<option value="6">Comuna 6</option>
            <option value="7">Comuna 7</option>
			<option value="8">Comuna 8</option>
			<option value="9">Comuna 9</option>
			<option value="10">Comuna 10</option>
			<option value="11">Comuna 11</option>
			<option value="12">Comuna 12</option>
            <option value="13">Comuna 13</option>
			<option value="14">Comuna 14</option>
			<option value="15">Comuna 15</option>
			<option value="16">Comuna 16</option>
			<option value="17">Comuna 17</option>
			<option value="18">Comuna 18</option>
            <option value="19">Comuna 19</option>
			<option value="20">Comuna 20</option>
			<option value="21">Comuna 21</option>
            <option value="22">Comuna 22</option>
			</select>
			<br>
			
			<input type="button" id="boton-envio-consulta" value="Consultar">
		  </form>
		  <div id="div_mensaje_ventana_consulta´"></div>
	</div>

<!--ventana modal mision-->







<!--intento recuperar posicion-->

<div id="ventana-reporte1" class="modal">
		<div class="modal-header">
		<h3 class="modal-title" id="myModalLabel">Generar reporte de noticias</h3>

           <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
      </div>
		<form enctype="multipart/form-data">
			<label for="cox_form">Coordenada X:</label><br>
			<input type="text" id="cox_form" name="cox_form"><br>
			<label for="coy_form">Coordenada Y:</label><br>
			<input type="text" id="coy_form" name="coy_form"><br>
			
			<label for="opciones_form4">Seleccione de la lista:</label><br>
			<select id="opciones_form4" name="opciones_form4">
			<option value="violencia">Violencia</option>
			<option value="accidentes">Accidente</option>
			<option value="hurtos">Hurtos</option>
			<option value="bloqueos">Bloqueos</option>
			<option value="Incendios">Incendios</option>
			<option value="DesNaturales">Desastres naturales</option>


			</select>
			<br>

			<label for="descrip_form1">Descripcion del reporte:</label><br>
			<input type="text" id="descrip_form1" name="descrip_form"><br>

			<label for="foto_form">Foto: </label>
  			<input type="file" id="foto_form" name="foto_form" accept=".jpg,.png">
			<br>
			<input type="button" id="boton-envio-reporte1" value="Enviar Reporte en esta posición">

		  </form>
		  <div id="div_mensaje_ventana_reporte1"></div>
	</div>







<!-- inteto recuperar posicon>	 </!-->
<!--consulta por tit> </!-->
	<div id="ventana-consulta3" class="modal modal-sm">
		<div class="modal-header">
		<h3 class="modal-title" id="myModalLabel">Consultar noticia por tipo: </h3>

           <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
      </div>
		<form enctype="multipart/form-data">
			
			<label for="opciones_form3">Seleccione el tipo de noticia:</label><br>
			<select id="opciones_form3" name="opciones_form3">
			<option value="violencia">Violencia</option>
			<option value="accidentes">Accidente</option>
			<option value="hurtos">Hurtos</option>
			<option value="bloqueos">Bloqueos</option>
			<option value="Incendios">Incendios</option>
			<option value="DesNaturales">Desastres naturales</option>
			</select>
			<br>
			
			<input type="button" id="boton-envio-consulta3" value="Consultar">
		  </form>
		  <div id="div_mensaje_ventana_consulta3´"></div>
	</div>
<!--fin de consulta 3></!-->
<!-- Modal -->
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

<!--ventana modal mision-->

	<!-- Contenido HTML de la Ventana Modal Ingresar Datos -->
	<div id="ventana-reporte" class="modal">
		<div class="modal-header">
		<h3 class="modal-title" id="myModalLabel">Generar reporte de noticias</h3>

           <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
      </div>
		<form enctype="multipart/form-data">
			<label for="cx_form">Coordenada X:</label><br>
			<input type="text" id="cx_form" name="cx_form"><br>
			<label for="cy_form">Coordenada Y:</label><br>
			<input type="text" id="cy_form" name="cy_form"><br>
			
			<label for="opciones_form">Seleccione de la lista:</label><br>
			<select id="opciones_form" name="opciones_form">
			<option value="violencia">Violencia</option>
			<option value="accidentes">Accidente</option>
			<option value="hurtos">Hurtos</option>
			<option value="bloqueos">Bloqueos</option>
			<option value="Incendios">Incendios</option>
			<option value="DesNaturales">Desastres naturales</option>


			</select>
			<br>

			<label for="descrip_form">Descripcion del reporte:</label><br>
			<input type="text" id="descrip_form" name="descrip_form"><br>

			<label for="foto_form">Foto: </label>
  			<input type="file" id="foto_form" name="foto_form" accept=".jpg,.png">
			<br>
			<input type="button" id="boton-envio-reporte" value="Enviar Reporte">

		  </form>
		  <div id="div_mensaje_ventana_reporte"></div>
	</div>

	<div id="ventana-consulta2" class="modal modal-sm">
		<div class="modal-header">
		<h3 class="modal-title" id="myModalLabel">Noticias por usuario: </h3>

           <button type="button" class="close " data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span>
        </button>
      </div>
      <label for="descrip_form">Buscar usuario:</label><br>
			<input type="text" id="descrip_usu" name="descrip_usu"><br> <br>

		  <input class="btn btn-outline-danger btn-sm" id="boton-envio-consulta2" value="Consultar">

		  <div id="div_mensaje_ventana_consulta2´"></div>
	</div>

<body>

   <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container-fluid"> 
   <div class="row">
 <!--<div class="display-1 col-6 col-sm-6 col-md-6 col-lg-6 col-xl-8 text-center"></div>-->


    <div class="navbar-header ">
    <div class="display-1 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 text-center"> 	
    <a class="navbar-brand text" href="javascript:location.reload()">Geonoticias univalle</a>

    </div>

      
    </div>
   

    <ul class="nav navbar-nav">
 <li class="active"><a href="#ventana-vision" class=" nav-link btn btn-outline-danger btn-lg" data-toggle="modal" data-target="#exampleModal" aria-haspopup="true" aria-expanded="false">¿Quienes sómos?</a></li>

        <li class="nav-item dropdown nav navbar-nav">
        <a class="nav-link dropdown-toggle btn btn-outline-danger btn-lg"  id="navbarDropdownMenuLink"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Contáctenos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
          <a class="dropdown-item" href="https://www.facebook.com/esteban8atorres">Facebook</a>
          <a class="dropdown-item" href="https://www.instagram.com">Instragram</a>
          <a class="dropdown-item" href="https://www.webwhatsapp.com">Whatsapp</a>       
      </div>
      </li>
      <li class="active"><a id="boton_quienes_somos" href="index.php?op=salir" class="btn btn-outline-danger btn-lg">Cerrar sesión</a></li>
    </ul>

  </div>
  </div>
</nav>
<div class="row">	
<div class="display-4 col-12 col-sm-12 col-md-12 col-lg-1 col-xl-2 text-center"> 
<h3>	GEOVISOR </h3>
<input  id="borrar_map" value="Limpiar mapa"class="btn border-primary" onClick="location.href='javascript:location.reload()';"><br> <br>	<br>
<input  id="boton_ruteo" value="Calcula Ruta "class="btn btn-danger bt-sm" > 	
<input  id="boton_ruteo" value="Ultimas Noticias "class="btn btn-danger bt-sm" onClick="location.href='UltimasNoticias.php';"> 
<input  id="boton_reporte" value="Reporte por comunas "class="btn btn-danger bt-sm" >
<input  id="mapa_reporte2" value="Reporte por usuario"class="btn btn-danger bt-sm" ><br>
<input  id="boton_Eliminar" value="Borrar Noticias Spam "class="btn btn-danger bt-sm" onClick="location.href='form_delete.php';"> <br>
<input  id="boton_Editar" value="Editar Reportes "class="btn btn-danger bt-sm" onClick="location.href='form_update.php';"> <br>
<input  id="mapa_reporte3" value="Reporte por tipo"class="btn btn-danger bt-sm" ><br>

</div>
<div class="display-1 col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7	text-center"> 	
	<div id="mapid" style="width: 760px; height: 500px; z-index:0;"></div>
	<div id="mensaje_que_cambia"></div>	</div>

	
<div class="display-6 col-6 col-sm-6 col-md-6 col-lg-12 col-xl-3 text-left">  <br>	
<h3>	Reportar </h3>
<input  id="boton_reporte_cliente" value="Insertar reporte "class="btn btn-danger bt-sm" ><br>	<br>	
<input  id="boton_reporte_cliente1" value="Insertar Noticia en mi pos "class="btn btn-danger bt-sm" >


		
	<br>		
<h3> Herramientas </h3>
<input  id="boton_conteo" value="Conteo por comunas"class="btn border-danger" onClick="location.href='conteo_comuna.php';" ><br> <br>	
<input  id="boton_conteo" value="Conteo por barrios" class="btn border-danger" onClick="location.href='conteo_barrio.php';" ><br><br>
<input  id="boton_conteo" value="Conteo por tipos"class="btn border-danger"  onClick="location.href='conteo_tipo.php';"><br><br>	
<input  id="mapa_calor" value="Mapa de calor "class="btn border-warning" ><br>	<br>
<input  id="mapa_cluster" value="Cluster"class="btn border-warning" ><br><br>


</div>







</div>


</body>



	<!--  semana15 enlace para salir -->


	


	<!-- Boton Ruteo entre dos puntos -->


	<!-- FIN Boton Ruteo entre dos puntos -->




  
  <!-- Link para abir la ventana modal -->
 <!-- <p><a href="ventana-consulta" rel="modal:open">Abrir ventana modal (ejemplo 1)</a></p>-->

  <!-- Link para abir la ventana modal -->
<script>
	


	var roles= "<?php echo $_SESSION["rol"];?>"
if (roles==1){
		var flag_registrar1=false;

		$( "#boton_reporte_cliente1" ).click(function() 
	{
	  	//vuelo hacia univalle
	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "A continuación se ingresará su ubicación:" );
	  	//Cambio de estado la vabriable bandera
		flag_registrar1=true;
		render();

		//mymap.flyTo([3.372472, -76.533229], 16);
	});

	//Evento click para boton boton-envio-reporte
	$("#boton-envio-reporte1").click(function() 
	{
		console.log('Enviar formulario y cerrar ventana modal');
		//capturar los datos del formulario

		var cox_ = $('#cox_form').val();
		var coy_ = $('#coy_form').val();
		var opcion_1 = $('#opciones_form4').val();
		var descripcion_1 = $('#descrip_form1').val();
		var usuario_1= "<?php echo $_SESSION["iduser"];?>";
		var usuario_2= "<?php echo $_SESSION["usuario"];?>";



		//Hago la peticion registro-desde-ventana-modal mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'registro-desde-ventana-modal', 
				parametros: {  x:cox_ ,  y: coy_,  tipo: opcion_1 , descripcion: descripcion_1, usuario : usuario_1,nombres:usuario_2}
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					if(data=='NUEVO_REPORTE_CREADO')
					{
					   $('#div_mensaje_ventana_reporte1').html('<h2>Su reporte ha sido registrado</h2>');
					}else
					{
						$('#div_mensaje_ventana_reporte1').html('<h2>Lo sentimos, no se puede realizar el reporte</h2>');	
					}	
				}
			});	
		//Para cerrar la ventana modal	
		$.modal.close();
	});




	function render(pos)
	{
		navigator.geolocation.watchPosition(render);


		// Capturo las coordenadas clickeadas sobre el mapa
		coordenada_y1 = pos.coords.latitude.toString();
		coordenada_x1 = pos.coords.longitude.toString();
		// Envio las coordenadas a los campos dentro del form
		$('#cox_form').val(coordenada_x1);
		$('#coy_form').val(coordenada_y1);

		//Limpio los campos del formulario
		$('#opciones_form4').val("");
		$('#descripcion_form1').val("");
		$('#div_mensaje_ventana_reporte1').html("");

		// lanzo ventana modal para registrar datos de reporte
		$('#ventana-reporte1').modal(
			{
				closeExisting: false,
				escapeClose: true,
  				clickClose: true,
			});
	}



</script>

<script>

	
	
	var basemaps = 
	{
		Grayscale: L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', 
		{
			maxZoom: 18,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}),
		
		Streets: L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', 
		{
			maxZoom: 19,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		})
	};
  

	var wmsLayer = L.tileLayer.wms('http://idesc.cali.gov.co:8081/geoserver/wms?service=WMS&version=1.1.0', 
	{
		layers: 'idesc:mc_comunas',
		attribution: 'Creditos de la capa',
		format: 'image/png',
		transparent: true
	});
	
	
	var mymap = L.map('mapid',
	{
		zoom: 10
	}).setView([3.42335,-76.52086], 13);
	
	
	basemaps.Grayscale.addTo(mymap);
	wmsLayer.addTo(mymap);
	
	
	
	
	var groupedOverlays = {
	
	  "Capas idecs": {
		"Manzanas": wmsLayer
	  },
	};


	//hacer este cambio
	//L.control.groupedLayers(basemaps, groupedOverlays).addTo(mymap);
	
	var layerControl=L.control.groupedLayers(basemaps, groupedOverlays);
	layerControl.addTo(mymap);


	//Creo una variable booleana (bandera) para saber cuando se requiere el ruteo 
	var flag_ruteo=false;

	//Evento click para boton_ruteo
	$( "#boton_ruteo" ).click(function() 
	{
	  	//vuelo hacia univalle
		mymap.flyTo([3.372472, -76.533229], 16);
		alert( "Click sobre el Mapa, indicando el punto Inicial" );
	  	//Cambio de estado la vabriable bandera
		flag_ruteo=true;
	  	//Cambio el cursor 	del mouse sobre el mapa
	  	document.getElementById('mapid').style.cursor = 'crosshair';
	});
//Creo una variable booleana (bandera) para saber cuando se requiere el ruteo 
	var flag_reporte=false;

	//Evento tipo de noticia por comuna
	$( "#boton_reporte" ).click(function() 
	{
	  	//vuelo hacia univalle
	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "Ingrese el tipo de reporte y la comuna: " );
	  	//Cambio de estado la vabriable bandera
		flag_reporte=true;
	  	//Cambio el cursor 	del mouse sobre el mapa
	  	lanzarVentanaconsulta();

	});

	var flag_registrar=false;


		$( "#boton_reporte_cliente" ).click(function() 
	{
	  	//vuelo hacia univalle
	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "A continuación marque el sitio de reporte:" );
	  	//Cambio de estado la vabriable bandera
		document.getElementById('mapid').style.cursor = 'crosshair';
		flag_registrar=true;
		lanzarVentanaRegistro(e);

		//mymap.flyTo([3.372472, -76.533229], 16);
	});
		
	

	var flag_calor=false;


		$( "#mapa_calor" ).click(function() 
	{
	  	//vuelo hacia univalle
	  	var flag_calor=false;

	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "A continuación se muestra el mapa de calor:" );
	  	//Cambio de estado la vabriable bandera
	  	mapaCalor();

		//mymap.flyTo([3.372472, -76.533229], 16);

	});
		

	var flag_cluster=false;


		$( "#mapa_cluster" ).click(function() 
	{
	  	//vuelo hacia univalle
	  	var flag_clustter=false;

	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "A continuación se muestra el cluster de noticias:" );
	  	//Cambio de estado la vabriable bandera
	  	cargarCluster();

		//mymap.flyTo([3.372472, -76.533229], 16);

	});
	
		var flag_reporte2=false;


		$( "#mapa_reporte2" ).click(function() 
	{
	  	//vuelo hacia univalle
	  	

	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "A continuación Eliga el usuario a consultar" );
	  	//Cambio de estado la vabriable bandera
	  	var flag_reporte2=true;
		  lanzarVentanaconsulta2();


		//mymap.flyTo([3.372472, -76.533229], 16);

	});
	var flag_reporte2=false;


		$( "#mapa_reporte2" ).click(function() 
	{
	  	//vuelo hacia univalle
	  	

	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "A continuación Eliga el usuario a consultar" );
	  	//Cambio de estado la vabriable bandera
	  	var flag_reporte2=true;
		  lanzarVentanaconsulta2();


		//mymap.flyTo([3.372472, -76.533229], 16);

	});


	var flag_tipo=false;

	//Evento tipo de noticia por comuna
	$( "#mapa_reporte3" ).click(function() 
	{
	  	//vuelo hacia univalle
	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "Ingrese el tipo de reporte: " );
	  	//Cambio de estado la vabriable bandera
		flag_tipo=true;
	  	//Cambio el cursor 	del mouse sobre el mapa
	  	lanzarVentanaconsulta3();

	});




	var popup = L.popup();


	//Boton Ejemplo para mostrar evento click sobre el mapa
//INTENTO DE LOCALIZARME 



	  navigator.geolocation.watchPosition(b);

  function b(f) {
      var lat = f.coords.latitude;
      var lon = f.coords.longitude;
      L.marker([lat, lon ]).addTo(mymap).bindPopup("<b>Aquí estás tu, <br> GeoReportero ").openPopup();;

      
  };

  ////TERMINA INTENTO 
    //Semana 13
	//Boton Ejemplo para registrar 

	function onMapClick(e) {
		//Clase 10 - Comentar evento click y retorno de coordenadas
		//popup
		//	.setLatLng(e.latlng)
		//	.setContent("Usted realizo un Click en las coordenadas:  " + e.latlng.toString())
		//	.openOn(mymap);

		//Si doy click sobre el mapa, estando en true la variable bandera
		if(flag_ruteo)
		{
			rutaMasCortaEntreDosPuntos(e);
		}
		else
		if(flag_registrar)
		{
			//caso para lanzar ventana modal una vez de click sobre el mapa
			lanzarVentanaRegistro(e);
		}	
	
	else
		if(flag_reporte)
		{
			//caso para lanzar ventana modal una vez de click sobre el mapa
		lanzarVentanaconsulta();
		}
	else
		if(flag_registrar1)
		{
			//caso para lanzar ventana modal una vez de click sobre el mapa
		render();
		}
	



	}

	function funcionNueva(){
		alert("soy una funcion nueva");
		flag_otro=false;
	        document.getElementById('mapid').style.cursor = '';
	}

	mymap.on('click', onMapClick);

	
	//Para que el cursor retorne estado por defecto en el mapa
	mymap.on('mousedown', function (e) { document.getElementById('mapid').style.cursor = ''; });
	
	
	
	var helloPopup = L.popup().setContent('Mensaje desde boton');

	







	//Boton Ejemplo para mostrar evento click sobre el mapa


    //Semana 13
	//Boton Ejemplo para registrar 



	//Semana 15  --  Boton Para Mapa de Calor

	



	var capaGeojsonEdificios = L.geoJson();
	function cargarEdificios()
	{
		//Hago la peticion recupera-edificios-geojson mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'recupera-edificios-geojson'
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					//console.log(data);
					mymap.removeLayer(capaGeojsonEdificios); 
					geojsonFeatureEdificios= eval('('+data+')');
					capaGeojsonEdificios = L.geoJson(geojsonFeatureEdificios, {onEachFeature: onEachFeatureEdificio }).addTo(mymap);	
				}
			});	
	}

	//Solucion tarea -- Sitios de Interes
	var capaGeojsonSitiosInteres = L.geoJson();
	function cargarSitiosInteres()
	{
		//Hago la peticion recupera-sitios-interes-geojson mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'recupera-sitios-interes-geojson'
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					//console.log(data);
					mymap.removeLayer(capaGeojsonSitiosInteres); 
					geojsonFeatureSitiosInteres= eval('('+data+')');
					
					//Agrego la capa de puntos
					capaGeojsonSitiosInteres = L.geoJson(geojsonFeatureSitiosInteres, 
					{
						pointToLayer: function (feature, latlng) 
						{
							//Icons from https://mapicons.mapsmarker.com/
							var smallIcon = L.icon(
							{
							iconSize: [27, 27],
							iconAnchor: [13, 27],
							popupAnchor:  [1, -24],
							iconUrl: 'images/icono_'+feature.properties.type+'.png' 
						});
						
							return L.marker(latlng, {icon: smallIcon}); 
						},onEachFeature: onEachFeatureSitiosInteres 
						
					} ).addTo(mymap);

				}
			});	
	}
	

	var estiloPoligonoEdificiosDefecto = 
	{
		radius: 8,
		fillColor: "#ff7800",
		color: "#000",
		weight: 1,
		opacity: 1,
		fillOpacity: 0.8
	};
	
	
	var estiloPoligonoEdificioMouseEncima = 
	{
		radius: 8,
		fillColor: "#000000",
		color: "#000",
		weight: 1,
		opacity: 1,
		fillOpacity: 0.8
	};

	function onEachFeatureEdificio(feature, layer) 
	{
		//Asigno estilo a cada edificio		
		layer.setStyle(estiloPoligonoEdificiosDefecto);		
		console.log(feature.properties.name);
		if (feature.properties && feature.properties.name) {
			layer.bindPopup('<b>NOMBRE: </b> '+feature.properties.name+'<br><b>TIPO: </b>' +feature.properties.tipo +'<br><b>UBICACION: </b>' +feature.properties.localiza);
			
			layer.on('mouseover', function() 
			{ 
				//Se agrego para cambiar el color del elemento cuando se ubique el mouse 
				this.setStyle(estiloPoligonoEdificioMouseEncima);				
				$('#mensaje_que_cambia').html('<h1>'+feature.properties.name+'</h1>');
			});
		        layer.on('mouseout', function() 
			{
				$('#mensaje_que_cambia').html('<h1>&nbsp;</h1>');
				this.setStyle(estiloPoligonoEdificiosDefecto);
			});	
		}
	}
	

	//Para cada reporte
	function onEachFeatureSitiosInteres(feature, layer) 
	{
		//Asigno estilo a cada reporte		
		console.log(feature.properties.name);
		if (feature.properties && feature.properties.name) 
		{
			var mensaje = '<b>NOMBRE: </b> '+feature.properties.name;
			mensaje +='<br><b>ID: </b>' + feature.properties.tipo;
			mensaje +='<br><b>TIPO: </b>' +feature.properties.localizaci;
			layer.bindPopup(mensaje);
		}
	}
	

	//RUTA MAS CORTA ENTRE DOS PUNTOS ( CLASE 10 )

	var conteoClicks=1;
	var coordenadasPuntoInicial = {};
	var coordenadasPuntoFinal = {};
	var puntoInicialMarcador = L.marker();
	var puntoFinalMarcador = L.marker();

	//Defino estas variables de forma global
	var nuevasCoordenadasPuntoInicial = {};
	var nuevasCoordenadasPuntoFinal = {};

	//creo los iconos

	var puntoInicialIcono = L.icon(
	{
		iconSize: [27, 27],
		iconAnchor: [13, 27],
		popupAnchor:  [1, -24],
		iconUrl: 'images/punto_inicio.png' 
	});

	var puntoFinalIcono = L.icon(
	{
		iconSize: [27, 27],
		iconAnchor: [13, 27],
		popupAnchor:  [1, -24],
		iconUrl: 'images/punto_final.png' 
	});


	//function para capturar punto inicial y punto final sobre el mapa 

	function rutaMasCortaEntreDosPuntos(e)
	{
		if(conteoClicks==2){
			coordenada_y = e.latlng.lat.toString();
			coordenada_x = e.latlng.lng.toString();
			coordenadasPuntoFinal={x:coordenada_x,y:coordenada_y};

			mymap.removeLayer(puntoFinalMarcador); 
			//puntoFinalMarcador = L.marker( [ coordenadasPuntoFinal['y'] , coordenadasPuntoFinal['x']  ]).addTo(mymap);

			//Solucion tarea
			//Agrego funcionalidad para que el punto final sea draggable 
			puntoFinalMarcador = L.marker( [ coordenadasPuntoFinal['y'] , coordenadasPuntoFinal['x']  ],
			{
			  draggable: true,
			  icon:puntoFinalIcono,
			}).addTo(mymap)
			.on('dragend', function() 
			{
				var nuevasCoordenadas = String(puntoFinalMarcador.getLatLng()).split(',');
				var lat = nuevasCoordenadas[0].split('(');
				var lng = nuevasCoordenadas[1].split(')');
				nuevasCoordenadasPuntoFinal={x:lng[0], y:lat[1]};

				//Actualizo las coordenadas del punto final
				coordenadasPuntoFinal=nuevasCoordenadasPuntoFinal;

				ejecutaCalculoRuteo(coordenadasPuntoInicial,nuevasCoordenadasPuntoFinal);
			});

			conteoClicks=1;
			flag_ruteo=false;
			document.getElementById('mapid').style.cursor = '';
			ejecutaCalculoRuteo(coordenadasPuntoInicial,coordenadasPuntoFinal);
		}else{
			document.getElementById('mapid').style.cursor = 'crosshair';
			coordenada_y = e.latlng.lat.toString();
			coordenada_x = e.latlng.lng.toString();
			coordenadasPuntoInicial={x:coordenada_x,y:coordenada_y};
			
			mymap.removeLayer(puntoInicialMarcador); 
			puntoInicialMarcador = L.marker( [ coordenadasPuntoInicial['y'] , coordenadasPuntoInicial['x']  ],
			{
			  draggable: true,
			  icon:puntoInicialIcono,
			}).addTo(mymap)
			.on('dragend', function() 
			{
				var nuevasCoordenadas = String(puntoInicialMarcador.getLatLng()).split(',');
				var lat = nuevasCoordenadas[0].split('(');
				var lng = nuevasCoordenadas[1].split(')');
				nuevasCoordenadasPuntoInicial={x:lng[0], y:lat[1]};

				//Actualizo las coordenadas del punto inicial
				coordenadasPuntoInicial=nuevasCoordenadasPuntoInicial;

				ejecutaCalculoRuteo(nuevasCoordenadasPuntoInicial,coordenadasPuntoFinal);
			});
			
			conteoClicks=conteoClicks+1;
			alert('Ingrese el punto de destino !');
		}
	}

	var contadorRutasGeneradas = 0;
	//Function que ejecuta el calculo de la ruta mas corta
	function ejecutaCalculoRuteo(pInicial,pFinal)
	{
		console.log(pInicial);
		console.log(pFinal);
		
			$.post("src/funciones.php",
			{
				//Ejecuto el caso genera-ruta-mascorta
				peticion: 'genera-ruta-mascorta',
				parametros: {  x1: pInicial.x,  y1: pInicial.y,  x2: pFinal.x,  y2: pFinal.y  }
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					console.log(data);
					if(data=='NUEVA_RUTA_CREADA')
					{
						//Si se genero la ruta, ejecuto la funcion pintarRutaCreadaEntrePIniyPfin()
						pintarRutaCreadaEntrePIniyPfin();
						contadorRutasGeneradas = contadorRutasGeneradas+1;
					}
				}
			});
	}


	var capaGeojsonreporte = L.geoJson();
	var geojsonFeatureconsulta;

	var capaGeojsonvias = L.geoJson();
	var geojsonFeaturevia;
	
	
	var geojsonFeatureconsulta2;


	var capaGeojsonRuta = L.geoJson();
	var geojsonFeatureRuta;
	
	//Creo estilo para la linea que representara la ruta
	var miEstiloLinea1Ruta = {
		"color": "#ff0000",
		"weight": 1,
		"opacity": 0.8
	};
	//Pinto la ruta en el mapa
	function pintarRutaCreadaEntrePIniyPfin()
	{
		$.post("src/funciones.php",
		{
			peticion: 'recupera-ruta-geojson',
		},
		function(data, status)
		{
			console.log("Datos recibidos: " + data + "\nStatus: " + status);
			if(status=='success')
			{
				mymap.removeLayer(capaGeojsonRuta); 
				layerControl._update();
				geojsonFeatureRuta= eval('('+data+')');

				capaGeojsonRuta = L.geoJson(geojsonFeatureRuta,  {style: miEstiloLinea1Ruta  }).addTo(mymap);
				layerControl.addOverlay(capaGeojsonRuta,"Ruta mas Corta ("+ contadorRutasGeneradas + " )" ,"Rutas");
				mymap.addLayer(capaGeojsonRuta); 
				layerControl._update();
				capaGeojsonRuta.addTo( mymap );

				//Informacion Sobre la ruta pintada
				$.post("src/funciones.php",
				{
					peticion: 'info-ruta-creada',
				},
				function(data, status)
				{
					if(status=='success')
					{
						//Informacion Sobre la ruta pintada
						$('#informacion_sobre_ruta').html('<br><b>Ruta creada</b>'+data);
					}
				});


				
			}
		});
	}
// Recuperacion de los reportes de noticias
    var capaGeojsonreporte = L.geoJson();
	function cargarreporte()
	{
		//Hago la peticion recupera-reportes mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'Recupera-reportes'
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					
					mymap.removeLayer(capaGeojsonreporte); 
                    geojsonFeaturereporte= eval('('+data+')');
                    

                    capaGeojsonreporte = L.geoJson(geojsonFeaturereporte,
                    {
						pointToLayer: function (feature, latlng) 
						{
							
							var smallIcon = L.icon(
							{
							iconSize: [27, 27],
							iconAnchor: [13, 27],
							popupAnchor:  [1, -24],
							iconUrl: 'images/icono_'+feature.properties.tipo+'.png' 
						});
						
							return L.marker(latlng, {icon: smallIcon}); 
						},onEachFeature: onEachFeaturereporte
						
					} ).addTo(mymap);

				}
			});	
	} 
    


    
	//icono para cada reporte
	function onEachFeaturereporte(feature, layer) 
	{
			
		console.log(feature.properties.barrio);
		if (feature.properties && feature.properties.barrio) 
		{
			var mensaje ='<b><b>ID: </b>' +feature.properties.id_reporte;
			mensaje +='<br><b>Barrio: </b> '+feature.properties.barrio;
			mensaje +='<br><b>Reporte: </b>' + feature.properties.descripcion;
			mensaje +='<br><b>TIPO: </b>' +feature.properties.tipo;
			

			layer.bindPopup(mensaje);
		}
    }	

//para recuperar las vias
function recuperarvias()
	{
		$.post("src/funciones.php",
		{
			peticion: 'recupera-via',
		},
		function(data, status)
		{
			console.log("Datos recibidos: " + data + "\nStatus: " + status);
			if(status=='success')
			{
				mymap.removeLayer(capaGeojsonvias); 
				layerControl._update();
				geojsonFeaturevia= eval('('+data+')');

				capaGeojsonvias = L.geoJson(geojsonFeaturevia,  {style: miEstiloLinea1Ruta  }).addTo(mymap);
				mymap.addLayer(capaGeojsonvias); 
				layerControl._update();
				capaGeojsonvias.addTo( mymap );
            }
        });    
    }   

	//Evento click para boton boton-envio-reporte
	$("#boton-envio-reporte").click(function() 
	{
		console.log('Enviar formulario y cerrar ventana modal');
		//capturar los datos del formulario

		var cx_ = $('#cx_form').val();
		var cy_ = $('#cy_form').val();
		var opcion_ = $('#opciones_form').val();
		var descripcion_ = $('#descrip_form').val();
		var usuario_= "<?php echo $_SESSION["iduser"];?>";
		var usuario_1= "<?php echo $_SESSION["usuario"];?>";



		//Hago la peticion registro-desde-ventana-modal mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'registro-desde-ventana-modal', 
				parametros: {  x:cx_ ,  y: cy_,  tipo: opcion_ , descripcion: descripcion_, usuario : usuario_,nombres:usuario_1}
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					if(data=='NUEVO_REPORTE_CREADO')
					{
					   $('#div_mensaje_ventana_reporte').html('<h2>Su reporte ha sido registrado</h2>');
					}else
					{
						$('#div_mensaje_ventana_reporte').html('<h2>Lo sentimos, no se puede realizar el reporte</h2>');	
					}	
				}
			});	
		//Para cerrar la ventana modal	
		$.modal.close();
	});



	function lanzarVentanaRegistro(e)
	{
		// Capturo las coordenadas clickeadas sobre el mapa
		coordenada_y = e.latlng.lat.toString();
		coordenada_x = e.latlng.lng.toString();
		// Envio las coordenadas a los campos dentro del form
		$('#cx_form').val(coordenada_x);
		$('#cy_form').val(coordenada_y);

		//Limpio los campos del formulario
		$('#opciones_form').val("");
		$('#descripcion_form').val("");
		$('#div_mensaje_ventana_reporte').html("");

		// lanzo ventana modal para registrar datos de reporte
		$('#ventana-reporte').modal(
			{
				closeExisting: false,
				escapeClose: true,
  				clickClose: true,
			});
	}


//CONSULTA 1

//icono para cada reporte

function onEachFeatureconsulta(feature, layer) 
	{
			
		console.log(feature.properties.comuna);
		if (feature.properties && feature.properties.comuna) 
		{
			var mensaje ='<b><b>ID: </b>' +feature.properties.id_reporte;
			mensaje +='<br><b>Barrio: </b> '+feature.properties.comuna;
			mensaje +='<br><b>Reporte: </b>' + feature.properties.descripcion;
			mensaje +='<br><b>TIPO: </b>' +feature.properties.tipo;
			

			layer.bindPopup(mensaje);
		}
    }	


$("#boton-envio-consulta").click(function() 
	{
		console.log('Enviar formulario y cerrar ventana modal');
		//capturar los datos del formulario

		var comuna_= $('#opciones_form2').val();
		var opcion_ = $('#opciones_form1').val();
	

		//Hago la peticion registro-desde-ventana-modal mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'Reportes-x-comuna', 
				parametros: { comuna:comuna_, tipo: opcion_ }
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					//console.log(data);
					//mymap.removeLayer(capaGeojsonconsulta); 
                    geojsonFeatureconsulta= eval('('+data+')');
                    

                    capaGeojsonconsulta = L.geoJson(geojsonFeatureconsulta,
                    {
						pointToLayer: function (feature, latlng) 
						{
							//Icons from https://mapicons.mapsmarker.com/
							var smallIcon = L.icon(
							{
							iconSize: [27, 27],
							iconAnchor: [13, 27],
							popupAnchor:  [1, -24],
							iconUrl: 'images/icono_'+feature.properties.tipo+'.png' 
						});
						
							return L.marker(latlng, {icon: smallIcon}); 
						},onEachFeature: onEachFeatureconsulta
						
					} ).addTo(mymap);

				}
			});	
		//Para cerrar la ventana modal	
		$.modal.close();
	});


	function lanzarVentanaconsulta(e)
	{
	
		//Limpio los campos del formulario
		$('#opciones_form1').val("");
		$('#opciones_form2').val("");
		$('#div_mensaje_ventana_consulta').html("");

		// lanzo ventana modal para consulta
		$('#ventana-consulta').modal(
			{
				closeExisting: false,
				escapeClose: true,
  				clickClose: true,
			});
	}

	 //CONSULTA 2
	
function onEachFeatureconsulta2(feature, layer) 
	{
			
		console.log(feature.properties.comuna);
		if (feature.properties && feature.properties.comuna) 
		{
			var mensaje ='<b><b>ID reporte: </b>' +feature.properties.id_reporte;
			mensaje +='<br><b>Comuna: </b> '+feature.properties.comuna;
			mensaje +='<br><b>Reporte: </b>' + feature.properties.descripcion;
			mensaje +='<br><b>TIPO: </b>' +feature.properties.tipo;
			mensaje +='<br><b>usuario: </b>' +feature.properties.usuario;

			

			layer.bindPopup(mensaje);
		}
    }		
    
    
    $("#boton-envio-consulta2").click(function() 
        {    
            var user_= $('#descrip_usu').val();

            //Hago la peticion registro-desde-ventana-modal mediante el metodo post a funciones.php		
            $.post("src/funciones.php",
                {
                    peticion: 'consulta2', 
                    parametros: { user: user_ }
                },

                function(data, status)
				{
                    console.log("Datos recibidos: " + user_ + "\nStatus: " + status);
                    if(status=='success')
                    {
                        //console.log(data);
                        //mymap.removeLayer(capaGeojsonconsulta2); 
                        geojsonFeatureconsulta2= eval('('+data+')');
                        
    
                        capaGeojsonconsulta2 = L.geoJson(geojsonFeatureconsulta2,
                        {
                            pointToLayer: function (feature, latlng) 
                            {
                                //Icons from https://mapicons.mapsmarker.com/
                                var smallIcon = L.icon(
                                {
                                iconSize: [27, 27],
                                iconAnchor: [13, 27],
                                popupAnchor:  [1, -24],
                                iconUrl: 'images/icono_'+feature.properties.tipo+'.png' 
                            	});
                            
                                return L.marker(latlng, {icon: smallIcon}); 
                            },onEachFeature: onEachFeatureconsulta2
                            
                        } ).addTo(mymap);
    
                    }
                });	
            //Para cerrar la ventana modal	
            $.modal.close();
        });
    
    
        function lanzarVentanaconsulta2(e)
        {
        
            //Limpio los campos del formulario
            $('#opciones_form3').val("");
            $('#div_mensaje_ventana_consulta2').html("");
    
            // lanzo ventana modal para consulta
            $('#ventana-consulta2').modal(
                {
                    closeExisting: false,
                    escapeClose: true,
                      clickClose: true,
                });
        }

//consulta 3 
 function onEachFeatureconsulta3(feature, layer) 
	{
			
		console.log(feature.properties.comuna);
		if (feature.properties && feature.properties.comuna) 
		{
			var mensaje ='<b><b>ID: </b>' +feature.properties.id_reporte;
			mensaje +='<br><b>Barrio: </b> '+feature.properties.comuna;
			mensaje +='<br><b>Reporte: </b>' + feature.properties.descripcion;
			mensaje +='<br><b>TIPO: </b>' +feature.properties.tipo;
			

			layer.bindPopup(mensaje);
		}
    }	


$("#boton-envio-consulta3").click(function() 
	{
		console.log('Enviar formulario y cerrar ventana modal');
		//capturar los datos del formulario

		var tipo_= $('#opciones_form3').val();
	

		//Hago la peticion registro-desde-ventana-modal mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'Reportes-x-tipo', 
				parametros: { tipo: tipo_ }
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					//console.log(data);
					//mymap.removeLayer(capaGeojsonconsulta); 
                    geojsonFeatureconsulta3= eval('('+data+')');
                    

                    capaGeojsonconsulta3 = L.geoJson(geojsonFeatureconsulta3,
                    {
						pointToLayer: function (feature, latlng) 
						{
							//Icons from https://mapicons.mapsmarker.com/
							var smallIcon = L.icon(
							{
							iconSize: [27, 27],
							iconAnchor: [13, 27],
							popupAnchor:  [1, -24],
							iconUrl: 'images/icono_'+feature.properties.tipo+'.png' 
						});
						
							return L.marker(latlng, {icon: smallIcon}); 
						},onEachFeature: onEachFeatureconsulta3
						
					} ).addTo(mymap);

				}
			});	
		//Para cerrar la ventana modal	
		$.modal.close();
	});


	function lanzarVentanaconsulta3(e)
	{
	
		//Limpio los campos del formulario
		$('#opciones_form3').val("");
		
		$('#div_mensaje_ventana_consulta3').html("");

		// lanzo ventana modal para consulta
		$('#ventana-consulta3').modal(
			{
				closeExisting: false,
				escapeClose: true,
  				clickClose: true,
			});
	}


    //funcion mapa de calor Semana15
	var arrayPoints='[';
	function mapaCalor()
	{
		$.post("src/funciones.php",
			{
				peticion: 'recupera-geojson-mapacalor'
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					
					var capaGeojson2 = L.geoJson(eval('('+data+')'), {onEachFeature: 
						function onEachFeature(feature, layer) 
						{
							//var alea=Math.floor((Math.random() * 100) + 1);
							arrayPoints+='['+feature.geometry.coordinates[1]+','+feature.geometry.coordinates[0]+',"15"],';	
						} 
					});
					var y=arrayPoints.substring(0, arrayPoints.length - 1);
					arrayPoints=y+'];';
					var heat = L.heatLayer(eval(arrayPoints)).addTo(mymap);	
				}
			});
	}

 	
	 //funcion para estilo del popup mapa de calor Semana15
	function onEachFeatureStyledIconCluster(feature, layer) 
	{
		if (feature.properties) 
		{	
		    var mensaje="Barrio: <b>"+feature.properties.barrio+"</b><br>";
		    mensaje+="Tipo: "+feature.properties.tipo+"<br>";
		    mensaje+="descripcion: "+feature.properties.descripcion+"<br>";
		    mensaje+="ID: "+feature.properties.id_reporte+"<br>";		
		    layer.bindPopup(''+mensaje+'');
		}
	}
	 //funcion mapa de calor Semana15
	var capaGeojson4 = L.geoJson();
	function cargarCluster()
	{
		$.post("src/funciones.php",
			{
				peticion: 'recupera-geojson-cluster'
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					//console.log(data);
					mymap.removeLayer(capaGeojson4); 
					geojsonFeature= eval('('+data+')');
					
					var markers = L.markerClusterGroup();
					
					capaGeojson4 = L.geoJson(geojsonFeature, 
					{
						pointToLayer: function (feature, latlng) 
						{
							//convierto en un string							
							var smallIcon = L.icon(
							{
							  iconSize: [27, 27],
							  iconAnchor: [13, 27],
							  popupAnchor:  [1, -24],
							  iconUrl: 'images/icono_'+feature.properties.tipo+'.png' 
						        });
						
							return L.marker(latlng, {icon: smallIcon}); 
						},onEachFeature: onEachFeatureStyledIconCluster 
						
					} );

					markers.addLayer(capaGeojson4);		
					mymap.addLayer(markers);					
				}
			});

} else{

var flag_registrar1=false;

		$( "#boton_reporte_cliente1" ).click(function() 
	{
	  	//vuelo hacia univalle
	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "A continuación se ingresará su ubicación:" );
	  	//Cambio de estado la vabriable bandera
		flag_registrar1=true;
		render();

		//mymap.flyTo([3.372472, -76.533229], 16);
	});

	//Evento click para boton boton-envio-reporte
	$("#boton-envio-reporte1").click(function() 
	{
		console.log('Enviar formulario y cerrar ventana modal');
		//capturar los datos del formulario

		var cox_ = $('#cox_form').val();
		var coy_ = $('#coy_form').val();
		var opcion_1 = $('#opciones_form4').val();
		var descripcion_1 = $('#descrip_form1').val();
		var usuario_1= "<?php echo $_SESSION["iduser"];?>";
		var usuario_2= "<?php echo $_SESSION["usuario"];?>";



		//Hago la peticion registro-desde-ventana-modal mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'registro-desde-ventana-modal', 
				parametros: {  x:cox_ ,  y: coy_,  tipo: opcion_1 , descripcion: descripcion_1, usuario : usuario_1,nombres:usuario_2}
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					if(data=='NUEVO_REPORTE_CREADO')
					{
					   $('#div_mensaje_ventana_reporte1').html('<h2>Su reporte ha sido registrado</h2>');
					}else
					{
						$('#div_mensaje_ventana_reporte1').html('<h2>Lo sentimos, no se puede realizar el reporte</h2>');	
					}	
				}
			});	
		//Para cerrar la ventana modal	
		$.modal.close();
	});




	function render(pos)
	{
		navigator.geolocation.watchPosition(render);


		// Capturo las coordenadas clickeadas sobre el mapa
		coordenada_y1 = pos.coords.latitude.toString();
		coordenada_x1 = pos.coords.longitude.toString();
		// Envio las coordenadas a los campos dentro del form
		$('#cox_form').val(coordenada_x1);
		$('#coy_form').val(coordenada_y1);

		//Limpio los campos del formulario
		$('#opciones_form4').val("");
		$('#descripcion_form1').val("");
		$('#div_mensaje_ventana_reporte1').html("");

		// lanzo ventana modal para registrar datos de reporte
		$('#ventana-reporte1').modal(
			{
				closeExisting: false,
				escapeClose: true,
  				clickClose: true,
			});
	}



</script>

<script>

	
	
	var basemaps = 
	{
		Grayscale: L.tileLayer('http://{s}.tiles.wmflabs.org/bw-mapnik/{z}/{x}/{y}.png', 
		{
			maxZoom: 18,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		}),
		
		Streets: L.tileLayer('http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', 
		{
			maxZoom: 19,
			attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
		})
	};
  

	var wmsLayer = L.tileLayer.wms('http://idesc.cali.gov.co:8081/geoserver/wms?service=WMS&version=1.1.0', 
	{
		layers: 'idesc:mc_comunas',
		attribution: 'Creditos de la capa',
		format: 'image/png',
		transparent: true
	});
	
	
	var mymap = L.map('mapid',
	{
		zoom: 10
	}).setView([3.42335,-76.52086], 13);
	
	
	basemaps.Grayscale.addTo(mymap);
	wmsLayer.addTo(mymap);
	
	
	
	
	var groupedOverlays = {
	
	  "Capas idecs": {
		"Manzanas": wmsLayer
	  },
	};


	//hacer este cambio
	//L.control.groupedLayers(basemaps, groupedOverlays).addTo(mymap);
	
	var layerControl=L.control.groupedLayers(basemaps, groupedOverlays);
	layerControl.addTo(mymap);


	//Creo una variable booleana (bandera) para saber cuando se requiere el ruteo 
	var flag_ruteo=false;

	//Evento click para boton_ruteo
	$( "#boton_ruteo" ).click(function() 
	{
	  	//vuelo hacia univalle
		mymap.flyTo([3.372472, -76.533229], 16);
		alert( "Click sobre el Mapa, indicando el punto Inicial" );
	  	//Cambio de estado la vabriable bandera
		flag_ruteo=true;
	  	//Cambio el cursor 	del mouse sobre el mapa
	  	document.getElementById('mapid').style.cursor = 'crosshair';
	});
//Creo una variable booleana (bandera) para saber cuando se requiere el ruteo 
	var flag_reporte=false;

	//Evento tipo de noticia por comuna
	$( "#boton_reporte" ).click(function() 
	{
	  	//vuelo hacia univalle
	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "Ingrese el tipo de reporte y la comuna: " );
	  	//Cambio de estado la vabriable bandera
		flag_reporte=true;
	  	//Cambio el cursor 	del mouse sobre el mapa
	  	lanzarVentanaconsulta();

	});

	var flag_registrar=false;


		$( "#boton_reporte_cliente" ).click(function() 
	{
	  	//vuelo hacia univalle
	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "A continuación marque el sitio de reporte:" );
	  	//Cambio de estado la vabriable bandera
		document.getElementById('mapid').style.cursor = 'crosshair';
		flag_registrar=true;
		lanzarVentanaRegistro(e);

		//mymap.flyTo([3.372472, -76.533229], 16);
	});
		
	

	var flag_calor=false;


		$( "#mapa_calor" ).click(function() 
	{
	  	//vuelo hacia univalle
	  	var flag_calor=false;

	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "A continuación se muestra el mapa de calor:" );
	  	//Cambio de estado la vabriable bandera
	  	mapaCalor();

		//mymap.flyTo([3.372472, -76.533229], 16);

	});
		

	var flag_cluster=false;


		$( "#mapa_cluster" ).click(function() 
	{
	  	//vuelo hacia univalle
	  	var flag_clustter=false;

	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "A continuación se muestra el cluster de noticias:" );
	  	//Cambio de estado la vabriable bandera
	  	cargarCluster();

		//mymap.flyTo([3.372472, -76.533229], 16);

	});
	
		var flag_reporte2=false;


		$( "#mapa_reporte2" ).click(function() 
	{
	  	//vuelo hacia univalle
	  	

	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "A continuación Eliga el usuario a consultar" );
	  	//Cambio de estado la vabriable bandera
	  	var flag_reporte2=true;
		  lanzarVentanaconsulta2();


		//mymap.flyTo([3.372472, -76.533229], 16);

	});
	var flag_reporte2=false;


		$( "#mapa_reporte2" ).click(function() 
	{
	  	//vuelo hacia univalle
	  	

	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "A continuación Eliga el usuario a consultar" );
	  	//Cambio de estado la vabriable bandera
	  	var flag_reporte2=true;
		  lanzarVentanaconsulta2();


		//mymap.flyTo([3.372472, -76.533229], 16);

	});


	var flag_tipo=false;

	//Evento tipo de noticia por comuna
	$( "#mapa_reporte3" ).click(function() 
	{
	  	//vuelo hacia univalle
	//	mymap.flyTo([3.372472, -76.533229], 16);
		alert( "Ingrese el tipo de reporte: " );
	  	//Cambio de estado la vabriable bandera
		flag_tipo=true;
	  	//Cambio el cursor 	del mouse sobre el mapa
	  	lanzarVentanaconsulta3();

	});




	var popup = L.popup();


	//Boton Ejemplo para mostrar evento click sobre el mapa
//INTENTO DE LOCALIZARME 



	  navigator.geolocation.watchPosition(b);

  function b(f) {
      var lat = f.coords.latitude;
      var lon = f.coords.longitude;
      L.marker([lat, lon ]).addTo(mymap).bindPopup("<b>Aquí estás tu, <br> GeoReportero ").openPopup();;

      
  };

  ////TERMINA INTENTO 
    //Semana 13
	//Boton Ejemplo para registrar 

	function onMapClick(e) {
		//Clase 10 - Comentar evento click y retorno de coordenadas
		//popup
		//	.setLatLng(e.latlng)
		//	.setContent("Usted realizo un Click en las coordenadas:  " + e.latlng.toString())
		//	.openOn(mymap);

		//Si doy click sobre el mapa, estando en true la variable bandera
		if(flag_ruteo)
		{
			rutaMasCortaEntreDosPuntos(e);
		}
		else
		if(flag_registrar)
		{
			//caso para lanzar ventana modal una vez de click sobre el mapa
			lanzarVentanaRegistro(e);
		}	
	
	else
		if(flag_reporte)
		{
			//caso para lanzar ventana modal una vez de click sobre el mapa
		lanzarVentanaconsulta();
		}
	else
		if(flag_registrar1)
		{
			//caso para lanzar ventana modal una vez de click sobre el mapa
		render();
		}
	



	}

	function funcionNueva(){
		alert("soy una funcion nueva");
		flag_otro=false;
	        document.getElementById('mapid').style.cursor = '';
	}

	mymap.on('click', onMapClick);

	
	//Para que el cursor retorne estado por defecto en el mapa
	mymap.on('mousedown', function (e) { document.getElementById('mapid').style.cursor = ''; });
	
	
	
	var helloPopup = L.popup().setContent('Mensaje desde boton');

	







	//Boton Ejemplo para mostrar evento click sobre el mapa


    //Semana 13
	//Boton Ejemplo para registrar 



	//Semana 15  --  Boton Para Mapa de Calor

	



	var capaGeojsonEdificios = L.geoJson();
	function cargarEdificios()
	{
		//Hago la peticion recupera-edificios-geojson mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'recupera-edificios-geojson'
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					//console.log(data);
					mymap.removeLayer(capaGeojsonEdificios); 
					geojsonFeatureEdificios= eval('('+data+')');
					capaGeojsonEdificios = L.geoJson(geojsonFeatureEdificios, {onEachFeature: onEachFeatureEdificio }).addTo(mymap);	
				}
			});	
	}

	//Solucion tarea -- Sitios de Interes
	var capaGeojsonSitiosInteres = L.geoJson();
	function cargarSitiosInteres()
	{
		//Hago la peticion recupera-sitios-interes-geojson mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'recupera-sitios-interes-geojson'
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					//console.log(data);
					mymap.removeLayer(capaGeojsonSitiosInteres); 
					geojsonFeatureSitiosInteres= eval('('+data+')');
					
					//Agrego la capa de puntos
					capaGeojsonSitiosInteres = L.geoJson(geojsonFeatureSitiosInteres, 
					{
						pointToLayer: function (feature, latlng) 
						{
							//Icons from https://mapicons.mapsmarker.com/
							var smallIcon = L.icon(
							{
							iconSize: [27, 27],
							iconAnchor: [13, 27],
							popupAnchor:  [1, -24],
							iconUrl: 'images/icono_'+feature.properties.type+'.png' 
						});
						
							return L.marker(latlng, {icon: smallIcon}); 
						},onEachFeature: onEachFeatureSitiosInteres 
						
					} ).addTo(mymap);

				}
			});	
	}
	

	var estiloPoligonoEdificiosDefecto = 
	{
		radius: 8,
		fillColor: "#ff7800",
		color: "#000",
		weight: 1,
		opacity: 1,
		fillOpacity: 0.8
	};
	
	
	var estiloPoligonoEdificioMouseEncima = 
	{
		radius: 8,
		fillColor: "#000000",
		color: "#000",
		weight: 1,
		opacity: 1,
		fillOpacity: 0.8
	};

	function onEachFeatureEdificio(feature, layer) 
	{
		//Asigno estilo a cada edificio		
		layer.setStyle(estiloPoligonoEdificiosDefecto);		
		console.log(feature.properties.name);
		if (feature.properties && feature.properties.name) {
			layer.bindPopup('<b>NOMBRE: </b> '+feature.properties.name+'<br><b>TIPO: </b>' +feature.properties.tipo +'<br><b>UBICACION: </b>' +feature.properties.localiza);
			
			layer.on('mouseover', function() 
			{ 
				//Se agrego para cambiar el color del elemento cuando se ubique el mouse 
				this.setStyle(estiloPoligonoEdificioMouseEncima);				
				$('#mensaje_que_cambia').html('<h1>'+feature.properties.name+'</h1>');
			});
		        layer.on('mouseout', function() 
			{
				$('#mensaje_que_cambia').html('<h1>&nbsp;</h1>');
				this.setStyle(estiloPoligonoEdificiosDefecto);
			});	
		}
	}
	

	//Para cada reporte
	function onEachFeatureSitiosInteres(feature, layer) 
	{
		//Asigno estilo a cada reporte		
		console.log(feature.properties.name);
		if (feature.properties && feature.properties.name) 
		{
			var mensaje = '<b>NOMBRE: </b> '+feature.properties.name;
			mensaje +='<br><b>ID: </b>' + feature.properties.tipo;
			mensaje +='<br><b>TIPO: </b>' +feature.properties.localizaci;
			layer.bindPopup(mensaje);
		}
	}
	

	//RUTA MAS CORTA ENTRE DOS PUNTOS ( CLASE 10 )

	var conteoClicks=1;
	var coordenadasPuntoInicial = {};
	var coordenadasPuntoFinal = {};
	var puntoInicialMarcador = L.marker();
	var puntoFinalMarcador = L.marker();

	//Defino estas variables de forma global
	var nuevasCoordenadasPuntoInicial = {};
	var nuevasCoordenadasPuntoFinal = {};

	//creo los iconos

	var puntoInicialIcono = L.icon(
	{
		iconSize: [27, 27],
		iconAnchor: [13, 27],
		popupAnchor:  [1, -24],
		iconUrl: 'images/punto_inicio.png' 
	});

	var puntoFinalIcono = L.icon(
	{
		iconSize: [27, 27],
		iconAnchor: [13, 27],
		popupAnchor:  [1, -24],
		iconUrl: 'images/punto_final.png' 
	});


	//function para capturar punto inicial y punto final sobre el mapa 

	function rutaMasCortaEntreDosPuntos(e)
	{
		if(conteoClicks==2){
			coordenada_y = e.latlng.lat.toString();
			coordenada_x = e.latlng.lng.toString();
			coordenadasPuntoFinal={x:coordenada_x,y:coordenada_y};

			mymap.removeLayer(puntoFinalMarcador); 
			//puntoFinalMarcador = L.marker( [ coordenadasPuntoFinal['y'] , coordenadasPuntoFinal['x']  ]).addTo(mymap);

			//Solucion tarea
			//Agrego funcionalidad para que el punto final sea draggable 
			puntoFinalMarcador = L.marker( [ coordenadasPuntoFinal['y'] , coordenadasPuntoFinal['x']  ],
			{
			  draggable: true,
			  icon:puntoFinalIcono,
			}).addTo(mymap)
			.on('dragend', function() 
			{
				var nuevasCoordenadas = String(puntoFinalMarcador.getLatLng()).split(',');
				var lat = nuevasCoordenadas[0].split('(');
				var lng = nuevasCoordenadas[1].split(')');
				nuevasCoordenadasPuntoFinal={x:lng[0], y:lat[1]};

				//Actualizo las coordenadas del punto final
				coordenadasPuntoFinal=nuevasCoordenadasPuntoFinal;

				ejecutaCalculoRuteo(coordenadasPuntoInicial,nuevasCoordenadasPuntoFinal);
			});

			conteoClicks=1;
			flag_ruteo=false;
			document.getElementById('mapid').style.cursor = '';
			ejecutaCalculoRuteo(coordenadasPuntoInicial,coordenadasPuntoFinal);
		}else{
			document.getElementById('mapid').style.cursor = 'crosshair';
			coordenada_y = e.latlng.lat.toString();
			coordenada_x = e.latlng.lng.toString();
			coordenadasPuntoInicial={x:coordenada_x,y:coordenada_y};
			
			mymap.removeLayer(puntoInicialMarcador); 
			puntoInicialMarcador = L.marker( [ coordenadasPuntoInicial['y'] , coordenadasPuntoInicial['x']  ],
			{
			  draggable: true,
			  icon:puntoInicialIcono,
			}).addTo(mymap)
			.on('dragend', function() 
			{
				var nuevasCoordenadas = String(puntoInicialMarcador.getLatLng()).split(',');
				var lat = nuevasCoordenadas[0].split('(');
				var lng = nuevasCoordenadas[1].split(')');
				nuevasCoordenadasPuntoInicial={x:lng[0], y:lat[1]};

				//Actualizo las coordenadas del punto inicial
				coordenadasPuntoInicial=nuevasCoordenadasPuntoInicial;

				ejecutaCalculoRuteo(nuevasCoordenadasPuntoInicial,coordenadasPuntoFinal);
			});
			
			conteoClicks=conteoClicks+1;
			alert('Ingrese el punto de destino !');
		}
	}

	var contadorRutasGeneradas = 0;
	//Function que ejecuta el calculo de la ruta mas corta
	function ejecutaCalculoRuteo(pInicial,pFinal)
	{
		console.log(pInicial);
		console.log(pFinal);
		
			$.post("src/funciones.php",
			{
				//Ejecuto el caso genera-ruta-mascorta
				peticion: 'genera-ruta-mascorta',
				parametros: {  x1: pInicial.x,  y1: pInicial.y,  x2: pFinal.x,  y2: pFinal.y  }
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					console.log(data);
					if(data=='NUEVA_RUTA_CREADA')
					{
						//Si se genero la ruta, ejecuto la funcion pintarRutaCreadaEntrePIniyPfin()
						pintarRutaCreadaEntrePIniyPfin();
						contadorRutasGeneradas = contadorRutasGeneradas+1;
					}
				}
			});
	}


	var capaGeojsonreporte = L.geoJson();
	var geojsonFeatureconsulta;

	var capaGeojsonvias = L.geoJson();
	var geojsonFeaturevia;
	
	
	var geojsonFeatureconsulta2;


	var capaGeojsonRuta = L.geoJson();
	var geojsonFeatureRuta;
	
	//Creo estilo para la linea que representara la ruta
	var miEstiloLinea1Ruta = {
		"color": "#ff0000",
		"weight": 1,
		"opacity": 0.8
	};
	//Pinto la ruta en el mapa
	function pintarRutaCreadaEntrePIniyPfin()
	{
		$.post("src/funciones.php",
		{
			peticion: 'recupera-ruta-geojson',
		},
		function(data, status)
		{
			console.log("Datos recibidos: " + data + "\nStatus: " + status);
			if(status=='success')
			{
				mymap.removeLayer(capaGeojsonRuta); 
				layerControl._update();
				geojsonFeatureRuta= eval('('+data+')');

				capaGeojsonRuta = L.geoJson(geojsonFeatureRuta,  {style: miEstiloLinea1Ruta  }).addTo(mymap);
				layerControl.addOverlay(capaGeojsonRuta,"Ruta mas Corta ("+ contadorRutasGeneradas + " )" ,"Rutas");
				mymap.addLayer(capaGeojsonRuta); 
				layerControl._update();
				capaGeojsonRuta.addTo( mymap );

				//Informacion Sobre la ruta pintada
				$.post("src/funciones.php",
				{
					peticion: 'info-ruta-creada',
				},
				function(data, status)
				{
					if(status=='success')
					{
						//Informacion Sobre la ruta pintada
						$('#informacion_sobre_ruta').html('<br><b>Ruta creada</b>'+data);
					}
				});


				
			}
		});
	}
// Recuperacion de los reportes de noticias
    var capaGeojsonreporte = L.geoJson();
	function cargarreporte()
	{
		//Hago la peticion recupera-reportes mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'Recupera-reportes'
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					
					mymap.removeLayer(capaGeojsonreporte); 
                    geojsonFeaturereporte= eval('('+data+')');
                    

                    capaGeojsonreporte = L.geoJson(geojsonFeaturereporte,
                    {
						pointToLayer: function (feature, latlng) 
						{
							
							var smallIcon = L.icon(
							{
							iconSize: [27, 27],
							iconAnchor: [13, 27],
							popupAnchor:  [1, -24],
							iconUrl: 'images/icono_'+feature.properties.tipo+'.png' 
						});
						
							return L.marker(latlng, {icon: smallIcon}); 
						},onEachFeature: onEachFeaturereporte
						
					} ).addTo(mymap);

				}
			});	
	} 
    


    
	//icono para cada reporte
	function onEachFeaturereporte(feature, layer) 
	{
			
		console.log(feature.properties.barrio);
		if (feature.properties && feature.properties.barrio) 
		{
			var mensaje ='<b><b>ID: </b>' +feature.properties.id_reporte;
			mensaje +='<br><b>Barrio: </b> '+feature.properties.barrio;
			mensaje +='<br><b>Reporte: </b>' + feature.properties.descripcion;
			mensaje +='<br><b>TIPO: </b>' +feature.properties.tipo;
			

			layer.bindPopup(mensaje);
		}
    }	

//para recuperar las vias
function recuperarvias()
	{
		$.post("src/funciones.php",
		{
			peticion: 'recupera-via',
		},
		function(data, status)
		{
			console.log("Datos recibidos: " + data + "\nStatus: " + status);
			if(status=='success')
			{
				mymap.removeLayer(capaGeojsonvias); 
				layerControl._update();
				geojsonFeaturevia= eval('('+data+')');

				capaGeojsonvias = L.geoJson(geojsonFeaturevia,  {style: miEstiloLinea1Ruta  }).addTo(mymap);
				mymap.addLayer(capaGeojsonvias); 
				layerControl._update();
				capaGeojsonvias.addTo( mymap );
            }
        });    
    }   

	//Evento click para boton boton-envio-reporte
	$("#boton-envio-reporte").click(function() 
	{
		console.log('Enviar formulario y cerrar ventana modal');
		//capturar los datos del formulario

		var cx_ = $('#cx_form').val();
		var cy_ = $('#cy_form').val();
		var opcion_ = $('#opciones_form').val();
		var descripcion_ = $('#descrip_form').val();
		var usuario_= "<?php echo $_SESSION["iduser"];?>";
		var usuario_1= "<?php echo $_SESSION["usuario"];?>";



		//Hago la peticion registro-desde-ventana-modal mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'registro-desde-ventana-modal', 
				parametros: {  x:cx_ ,  y: cy_,  tipo: opcion_ , descripcion: descripcion_, usuario : usuario_,nombres:usuario_1}
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					if(data=='NUEVO_REPORTE_CREADO')
					{
					   $('#div_mensaje_ventana_reporte').html('<h2>Su reporte ha sido registrado</h2>');
					}else
					{
						$('#div_mensaje_ventana_reporte').html('<h2>Lo sentimos, no se puede realizar el reporte</h2>');	
					}	
				}
			});	
		//Para cerrar la ventana modal	
		$.modal.close();
	});



	function lanzarVentanaRegistro(e)
	{
		// Capturo las coordenadas clickeadas sobre el mapa
		coordenada_y = e.latlng.lat.toString();
		coordenada_x = e.latlng.lng.toString();
		// Envio las coordenadas a los campos dentro del form
		$('#cx_form').val(coordenada_x);
		$('#cy_form').val(coordenada_y);

		//Limpio los campos del formulario
		$('#opciones_form').val("");
		$('#descripcion_form').val("");
		$('#div_mensaje_ventana_reporte').html("");

		// lanzo ventana modal para registrar datos de reporte
		$('#ventana-reporte').modal(
			{
				closeExisting: false,
				escapeClose: true,
  				clickClose: true,
			});
	}


//CONSULTA 1

//icono para cada reporte

function onEachFeatureconsulta(feature, layer) 
	{
			
		console.log(feature.properties.comuna);
		if (feature.properties && feature.properties.comuna) 
		{
			var mensaje ='<b><b>ID: </b>' +feature.properties.id_reporte;
			mensaje +='<br><b>Barrio: </b> '+feature.properties.comuna;
			mensaje +='<br><b>Reporte: </b>' + feature.properties.descripcion;
			mensaje +='<br><b>TIPO: </b>' +feature.properties.tipo;
			

			layer.bindPopup(mensaje);
		}
    }	


$("#boton-envio-consulta").click(function() 
	{
		console.log('Enviar formulario y cerrar ventana modal');
		//capturar los datos del formulario

		var comuna_= $('#opciones_form2').val();
		var opcion_ = $('#opciones_form1').val();
	

		//Hago la peticion registro-desde-ventana-modal mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'Reportes-x-comuna', 
				parametros: { comuna:comuna_, tipo: opcion_ }
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					//console.log(data);
					//mymap.removeLayer(capaGeojsonconsulta); 
                    geojsonFeatureconsulta= eval('('+data+')');
                    

                    capaGeojsonconsulta = L.geoJson(geojsonFeatureconsulta,
                    {
						pointToLayer: function (feature, latlng) 
						{
							//Icons from https://mapicons.mapsmarker.com/
							var smallIcon = L.icon(
							{
							iconSize: [27, 27],
							iconAnchor: [13, 27],
							popupAnchor:  [1, -24],
							iconUrl: 'images/icono_'+feature.properties.tipo+'.png' 
						});
						
							return L.marker(latlng, {icon: smallIcon}); 
						},onEachFeature: onEachFeatureconsulta
						
					} ).addTo(mymap);

				}
			});	
		//Para cerrar la ventana modal	
		$.modal.close();
	});


	function lanzarVentanaconsulta(e)
	{
	
		//Limpio los campos del formulario
		$('#opciones_form1').val("");
		$('#opciones_form2').val("");
		$('#div_mensaje_ventana_consulta').html("");

		// lanzo ventana modal para consulta
		$('#ventana-consulta').modal(
			{
				closeExisting: false,
				escapeClose: true,
  				clickClose: true,
			});
	}

	 //CONSULTA 2
	
function onEachFeatureconsulta2(feature, layer) 
	{
			
		console.log(feature.properties.comuna);
		if (feature.properties && feature.properties.comuna) 
		{
			var mensaje ='<b><b>ID reporte: </b>' +feature.properties.id_reporte;
			mensaje +='<br><b>Comuna: </b> '+feature.properties.comuna;
			mensaje +='<br><b>Reporte: </b>' + feature.properties.descripcion;
			mensaje +='<br><b>TIPO: </b>' +feature.properties.tipo;
			mensaje +='<br><b>usuario: </b>' +feature.properties.usuario;

			

			layer.bindPopup(mensaje);
		}
    }		
    
    
    $("#boton-envio-consulta2").click(function() 
        {    
            var user_= $('#descrip_usu').val();

            //Hago la peticion registro-desde-ventana-modal mediante el metodo post a funciones.php		
            $.post("src/funciones.php",
                {
                    peticion: 'consulta2', 
                    parametros: { user: user_ }
                },

                function(data, status)
				{
                    console.log("Datos recibidos: " + user_ + "\nStatus: " + status);
                    if(status=='success')
                    {
                        //console.log(data);
                        //mymap.removeLayer(capaGeojsonconsulta2); 
                        geojsonFeatureconsulta2= eval('('+data+')');
                        
    
                        capaGeojsonconsulta2 = L.geoJson(geojsonFeatureconsulta2,
                        {
                            pointToLayer: function (feature, latlng) 
                            {
                                //Icons from https://mapicons.mapsmarker.com/
                                var smallIcon = L.icon(
                                {
                                iconSize: [27, 27],
                                iconAnchor: [13, 27],
                                popupAnchor:  [1, -24],
                                iconUrl: 'images/icono_'+feature.properties.tipo+'.png' 
                            	});
                            
                                return L.marker(latlng, {icon: smallIcon}); 
                            },onEachFeature: onEachFeatureconsulta2
                            
                        } ).addTo(mymap);
    
                    }
                });	
            //Para cerrar la ventana modal	
            $.modal.close();
        });
    
    
        function lanzarVentanaconsulta2(e)
        {
        
            //Limpio los campos del formulario
            $('#opciones_form3').val("");
            $('#div_mensaje_ventana_consulta2').html("");
    
            // lanzo ventana modal para consulta
            $('#ventana-consulta2').modal(
                {
                    closeExisting: false,
                    escapeClose: true,
                      clickClose: true,
                });
        }

//consulta 3 
 function onEachFeatureconsulta3(feature, layer) 
	{
			
		console.log(feature.properties.comuna);
		if (feature.properties && feature.properties.comuna) 
		{
			var mensaje ='<b><b>ID: </b>' +feature.properties.id_reporte;
			mensaje +='<br><b>Barrio: </b> '+feature.properties.comuna;
			mensaje +='<br><b>Reporte: </b>' + feature.properties.descripcion;
			mensaje +='<br><b>TIPO: </b>' +feature.properties.tipo;
			

			layer.bindPopup(mensaje);
		}
    }	


$("#boton-envio-consulta3").click(function() 
	{
		console.log('Enviar formulario y cerrar ventana modal');
		//capturar los datos del formulario

		var tipo_= $('#opciones_form3').val();
	

		//Hago la peticion registro-desde-ventana-modal mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'Reportes-x-tipo', 
				parametros: { tipo: tipo_ }
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					//console.log(data);
					//mymap.removeLayer(capaGeojsonconsulta); 
                    geojsonFeatureconsulta3= eval('('+data+')');
                    

                    capaGeojsonconsulta3 = L.geoJson(geojsonFeatureconsulta3,
                    {
						pointToLayer: function (feature, latlng) 
						{
							//Icons from https://mapicons.mapsmarker.com/
							var smallIcon = L.icon(
							{
							iconSize: [27, 27],
							iconAnchor: [13, 27],
							popupAnchor:  [1, -24],
							iconUrl: 'images/icono_'+feature.properties.tipo+'.png' 
						});
						
							return L.marker(latlng, {icon: smallIcon}); 
						},onEachFeature: onEachFeatureconsulta3
						
					} ).addTo(mymap);

				}
			});	
		//Para cerrar la ventana modal	
		$.modal.close();
	});


	function lanzarVentanaconsulta3(e)
	{
	
		//Limpio los campos del formulario
		$('#opciones_form3').val("");
		
		$('#div_mensaje_ventana_consulta3').html("");

		// lanzo ventana modal para consulta
		$('#ventana-consulta3').modal(
			{
				closeExisting: false,
				escapeClose: true,
  				clickClose: true,
			});
	}


    //funcion mapa de calor Semana15
	var arrayPoints='[';
	function mapaCalor()
	{
		$.post("src/funciones.php",
			{
				peticion: 'recupera-geojson-mapacalor'
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					
					var capaGeojson2 = L.geoJson(eval('('+data+')'), {onEachFeature: 
						function onEachFeature(feature, layer) 
						{
							//var alea=Math.floor((Math.random() * 100) + 1);
							arrayPoints+='['+feature.geometry.coordinates[1]+','+feature.geometry.coordinates[0]+',"15"],';	
						} 
					});
					var y=arrayPoints.substring(0, arrayPoints.length - 1);
					arrayPoints=y+'];';
					var heat = L.heatLayer(eval(arrayPoints)).addTo(mymap);	
				}
			});
	}

 	
	 //funcion para estilo del popup mapa de calor Semana15
	function onEachFeatureStyledIconCluster(feature, layer) 
	{
		if (feature.properties) 
		{	
		    var mensaje="Barrio: <b>"+feature.properties.barrio+"</b><br>";
		    mensaje+="Tipo: "+feature.properties.tipo+"<br>";
		    mensaje+="descripcion: "+feature.properties.descripcion+"<br>";
		    mensaje+="ID: "+feature.properties.id_reporte+"<br>";		
		    layer.bindPopup(''+mensaje+'');
		}
	}
	 //funcion mapa de calor Semana15
	var capaGeojson4 = L.geoJson();
	function cargarCluster()
	{
		$.post("src/funciones.php",
			{
				peticion: 'recupera-geojson-cluster'
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					//console.log(data);
					mymap.removeLayer(capaGeojson4); 
					geojsonFeature= eval('('+data+')');
					
					var markers = L.markerClusterGroup();
					
					capaGeojson4 = L.geoJson(geojsonFeature, 
					{
						pointToLayer: function (feature, latlng) 
						{
							//convierto en un string							
							var smallIcon = L.icon(
							{
							  iconSize: [27, 27],
							  iconAnchor: [13, 27],
							  popupAnchor:  [1, -24],
							  iconUrl: 'images/icono_'+feature.properties.tipo+'.png' 
						        });
						
							return L.marker(latlng, {icon: smallIcon}); 
						},onEachFeature: onEachFeatureStyledIconCluster 
						
					} );

					markers.addLayer(capaGeojson4);		
					mymap.addLayer(markers);					
				}
			});


}
		///intento obtener geolocalización







  ///intento 2



 


	

	
	
	
	

</script>
<script type="text/javascript">
  function actualizar(){location.reload(true);}
//Función para actualizar cada 25 segundos(4000 milisegundos)
  setInterval("actualizar()",60000000);
</script>



</body>

<div class="container-fluid">
<br>	
	<div class="row">
		<div class="display-6 col-4 col-sm-4 col-md-2 col-lg-2 col-xl-4 border text-center"><p>MODELAMIENTO DE DATOS SIG EN WEB 	<br><br> PROYECTO FINAL</p></div>
		<div class="display-6 col-4 col-sm-4 col-md-8 col-lg-8 col-xl-4 borde2 text-center text-white"><p>UNIVERSIDAD DEL VALLE <br>ESCUELA DE INGENIERÍA CIVIL Y GEOMÁTICA <br> INGENIERÍA TOPOGRÁFICA</p></div>
		<div class="display-6 col-4 col-sm-4 col-md-2 col-lg-2 col-xl-4 border text-center"><p>GeoNoticias <br> Santiago de Cali <br> 2020</p></div>
	</div>
	</div>
</html>
