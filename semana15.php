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

      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle btn btn-outline-danger btn-lg"  id="navbarDropdownMenuLink"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         ¿Quienes somos?
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
          <a class="dropdown-item" href="#">Misión</a>
          <a class="dropdown-item" href="#">Visión</a>
      </div>
      </li>
        <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle btn btn-outline-danger btn-lg" href="quienes_somos.php" id="navbarDropdownMenuLink"  data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Contáctenos
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink1">
          <a class="dropdown-item" href="https://www.facebook.com/esteban8atorres">Facebook</a>
          <a class="dropdown-item" href="https://www.instagram.com">Instragram</a>
          <a class="dropdown-item" href="https://www.webwhatsapp.com">Whatsapp</a>       
      </div>
      </li>
      <li class="active"><a href="index.php?op=salir" class="btn btn-outline-danger btn-lg">Cerrar sesión</a></li>
    </ul>

  </div>
  </div>
</nav>
<div class="row">	
<div class="display-1 col-12 col-sm-12 col-md-12 col-lg-1 col-xl-1 text-center"> 
</div>
<div class="display-1 col-12 col-sm-12 col-md-12 col-lg-7 col-xl-7"> 	
	<div id="mapid" style="width: 860px; height: 580px; z-index:0;"></div>
	<div id="mensaje_que_cambia"></div>	</div>
<div class="display-6 col-6 col-sm-6 col-md-6 col-lg-12 col-xl-4 text-center">  <br>	
<input  id="boton_ruteo" value="Calcula Ruta "class="btn btn-danger bt-lg" > 
		<div id="informacion_sobre_ruta"></div><br>
		  <p><a href="#ventana-reporte" rel="modal:open" class="btn btn-danger bt-lg" >&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;Registrar reporte &nbsp;&nbsp;</a></p>

</div>



</div>


</body>



	<!--  semana15 enlace para salir -->

	<!--<?php 
	//  echo 'Este es rol del usuario logueado : '.$_SESSION["rol"];
	//  echo '<br>';
	 // echo 'Este es id del usuario logueado  : '.$_SESSION["iduser"];
	 // echo '<br>'; 
	?>-->
	


	<!-- Boton Ruteo entre dos puntos -->


	<!-- FIN Boton Ruteo entre dos puntos -->




  
  <!-- Link para abir la ventana modal -->
 <p><a href="#ex1" rel="modal:open">Abrir ventana modal (ejemplo 1)</a></p>

  <!-- Link para abir la ventana modal -->


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



	
	
	var popup = L.popup();

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
		if(flag_otro){
			funcionNueva();
		}
	else
		if(flag_registrar)
		{
			//caso para lanzar ventana modal una vez de click sobre el mapa
			lanzarVentanaRegistro(e);
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

	L.easyButton('<img src="images/smile.png">', function(btn, map)
	{
		var coordenadas = [3.483820,-76.509149];
		map.setView(coordenadas);
		
		helloPopup.setLatLng(coordenadas).openOn(map);
	}).addTo( mymap );

	L.easyButton('<img src="images/icono1.png" width="20px">', function(btn, map)
	{
		//Recupero los edificios desde la base de datos		
		cargarEdificios();
		//hago zoom hacia univalle
		mymap.flyTo([3.372472, -76.533229], 16);
	}).addTo( mymap );


	L.easyButton('<img src="images/icono2.png" width="20px">', function(btn, map)
	{
		//Recupero los sitios de interes desde la base de datos		
		cargarreporte();
		//hago zoom hacia univalle
		//mymap.flyTo([3.372472, -76.533229], 16);
	}).addTo( mymap );



	//Boton Ejemplo para mostrar evento click sobre el mapa
	var flag_otro=false;
	L.easyButton('<img src="images/icono4.png" width="20px">', function(btn, map)
	{
		//recuperarvias();
		//document.getElementById('mapid').style.cursor = 'crosshair';
                //flag_otro=true;
		//mymap.flyTo([3.372472, -76.533229], 16);
	}).addTo( mymap );

    //Semana 13
	//Boton Ejemplo para registrar 
	var flag_registrar=false;
	L.easyButton('<img src="images/punto_inicio.png" width="20px">', function(btn, map)
	{
		document.getElementById('mapid').style.cursor = 'crosshair';
		flag_registrar=true;
		//mymap.flyTo([3.372472, -76.533229], 16);
	}).addTo( mymap );


	//Semana 15  --  Boton Para Mapa de Calor
	L.easyButton('<img src="images/punto_final.png" width="20px">', function(btn, map)
	{
		mapaCalor();
	}).addTo( mymap );

	//Semana 15  --  Boton Para Mapa de Cluster
	L.easyButton('<img src="images/icono_op1.png" width="20px">', function(btn, map)
	{
		cargarCluster();
	}).addTo( mymap );



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




	var capaGeojsonvias = L.geoJson();
	var geojsonFeaturevia;
	



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


		//Hago la peticion registro-desde-ventana-modal mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'registro-desde-ventana-modal', 
				parametros: {  x:cx_ ,  y: cy_,  tipo: opcion_ , descripcion: descripcion_, usuario : usuario_}
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
							arrayPoints+='['+feature.geometry.coordinates[1]+','+feature.geometry.coordinates[0]+',"'+feature.properties.valor+'"],';	
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
		    mensaje+="Comuna: "+feature.properties.comuna+"<br>";
		    mensaje+="Estrato: "+feature.properties.estra_moda+"<br>";
		    mensaje+="Valor: "+feature.properties.valor+"<br>";
		    mensaje+="Opcion Registrada: "+feature.properties.opcion_registrada+"<br>";			
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
							  iconUrl: 'images/icono_'+feature.properties.opcion_registrada+'.png' 
						        });
						
							return L.marker(latlng, {icon: smallIcon}); 
						},onEachFeature: onEachFeatureStyledIconCluster 
						
					} );

					markers.addLayer(capaGeojson4);		
					mymap.addLayer(markers);					
				}
			});
	}
	

	
	
	
	

</script>
<script type="text/javascript">
  function actualizar(){location.reload(true);}
//Función para actualizar cada 25 segundos(4000 milisegundos)
  setInterval("actualizar()",60000);
</script>
<!--<div class="container-fluid">
<br>	
	<div class="row">
		<div class="display-6 col-4 col-sm-4 col-md-2 col-lg-2 col-xl-4 border text-center"><p>MODELAMIENTO DE DATOS SIG EN WEB 	<br><br> PROYECTO FINAL</p></div>
		<div class="display-6 col-4 col-sm-4 col-md-8 col-lg-8 col-xl-4 borde2 text-center"><p>UNIVERSIDAD DEL VALLE <br>ESCUELA DE INGENIERÍA CIVIL Y GEOMÁTICA <br> INGENIERÍA TOPOGRÁFICA</p></div>
		<div class="display-6 col-4 col-sm-4 col-md-2 col-lg-2 col-xl-4 border text-center"><p>GeoNoticias <br> Santiago de Cali <br> 2020</p></div>

	</div>
-->

</body>
</html>
