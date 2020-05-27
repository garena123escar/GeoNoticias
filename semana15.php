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
	
	<title>Semana15 - Leaflet </title>
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


    <!--  CSS -->
	<style>
		table, th, td {
  			border: 1px solid black;
		}
	</style>
	


	
</head>
<body>

	<!-- Contenido HTML de la Ventana Modal -->
	<div id="ex1" class="modal">
		<p>Hola este contenido del ejemplo 1 de una ventana modal</p>
		<a href="#" rel="modal:close">Cerrar</a>
	</div>


	<!-- Contenido HTML de la Ventana Modal Ingresar Datos -->
	<div id="ventana-reporte" class="modal">
		<p>Reportar por coordenadas</p>
		<form>
			<label for="cx_form">Coordenada X:</label><br>
			<input type="text" id="cx_form" name="cx_form"><br>
			<label for="cy_form">Coordenada Y:</label><br>
			<input type="text" id="cy_form" name="cy_form"><br>
			
			<label for="opciones_form">Seleccione de la lista:</label><br>
			<select id="opciones_form" name="opciones_form">
			<option value="op1">Opcion 1</option>
			<option value="op2">Opcion 2</option>
			<option value="op3">Opcion 3</option>
			<option value="op4">Opcion 4</option>
			</select>
			<br>

			<label for="nombre_form">Nombre Quien Reporta:</label><br>
			<input type="text" id="nombre_form" name="nombre_form"><br>

			<label for="valor_form">Valor (entre 1 y 100):</label>
  			<input type="number" id="valor_form" name="valor_form" min="1" max="100">

			<br>
			<input type="button" id="boton-envio-reporte" value="Enviar Reporte">
		  </form>
		  <div id="div_mensaje_ventana_reporte"></div>
	</div>




	<!--  semana15 enlace para salir -->

	<a href="index.php?op=salir">Salir del Aplicativo</a><br>
	<?php 
	  echo 'Este es rol del usuario logueado : '.$_SESSION["rol"];
	  echo '<br>';
	  echo 'Este es id del usuario logueado  : '.$_SESSION["iduser"];
	  echo '<br>';
	?>


	<!-- Boton Ruteo entre dos puntos -->
	<br>
	<input type="button" id="boton_ruteo" value="Calcula la Ruta m&aacute;s corta">
	<br> 
		<div id="informacion_sobre_ruta"></div>
	<br>

	<!-- FIN Boton Ruteo entre dos puntos -->
	<div id="mapid" style="width: 800px; height: 600px; z-index:0;"></div>
	<div id="mensaje_que_cambia"></div>



  
  <!-- Link para abir la ventana modal -->
  <p><a href="#ex1" rel="modal:open">Abrir ventana modal (ejemplo 1)</a></p>

  <!-- Link para abir la ventana modal -->
  <p><a href="#ventana-reporte" rel="modal:open">Registrar reporte</a></p>


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
	
	
	var capamarcador = L.marker([3.44420 , -76.47892 ]).addTo(mymap).bindPopup("<b>Hola Clase</b><br />Esta es una ventana Emergente !!.").openPopup();
	
	var capacirculo = L.circle([3.41447,-76.54266], 500, {
		color: 'red',
		fillColor: '#f03',
		fillOpacity: 0.5
	}).addTo(mymap).bindPopup("Esto es un circulo !!.");
	
	
	var capapoligono= L.polygon([
		[3.45831,-76.51951],
		[3.44462,-76.50662],
		[3.4215,-76.5142]
	]).addTo(mymap).bindPopup("Esto es un Poligono");
	
	
	
	
	var groupedOverlays = {
	  "Grupo1": {
		"Capa Circulo": capacirculo,
		"Capa Marcador":capamarcador
	  },
	  "Grupo2": {
		"Capa Poligono": capapoligono
	  }
	  ,
	  "Capas ideas": {
		"Manzanas": wmsLayer
	  }
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
	  	//Cambio el cursor del mouse sobre el mapa
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
		cargarSitiosInteres();
		//hago zoom hacia univalle
		mymap.flyTo([3.372472, -76.533229], 16);
	}).addTo( mymap );



	//Boton Ejemplo para mostrar evento click sobre el mapa
	var flag_otro=false;
	L.easyButton('<img src="images/icono4.png" width="20px">', function(btn, map)
	{
		document.getElementById('mapid').style.cursor = 'crosshair';
                flag_otro=true;
		mymap.flyTo([3.372472, -76.533229], 16);
	}).addTo( mymap );

    //Semana 13
	//Boton Ejemplo para registrar 
	var flag_registrar=false;
	L.easyButton('<img src="images/punto_inicio.png" width="20px">', function(btn, map)
	{
		document.getElementById('mapid').style.cursor = 'crosshair';
		flag_registrar=true;
		mymap.flyTo([3.372472, -76.533229], 16);
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
			layer.bindPopup('<b>NOMBRE: </b> '+feature.properties.name+'<br><b>ID: </b>' +feature.properties.osm_id +'<br><b>AREA: </b>' +feature.properties.area_edif );
			
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
	

	//Para cada edificio
	function onEachFeatureSitiosInteres(feature, layer) 
	{
		//Asigno estilo a cada edificio		
		console.log(feature.properties.name);
		if (feature.properties && feature.properties.name) 
		{
			var mensaje = '<b>NOMBRE: </b> '+feature.properties.name;
			mensaje +='<br><b>ID: </b>' + feature.properties.osm_id;
			mensaje +='<br><b>TIPO: </b>' +feature.properties.type;

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





	



	var capaGeojsonRuta = L.geoJson();
	var geojsonFeatureRuta;
	
	//Creo estilo para la linea que representara la ruta
	var miEstiloLinea1Ruta = {
		"color": "#ff0000",
		"weight": 6,
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


	//Evento click para boton boton-envio-reporte
	$("#boton-envio-reporte").click(function() 
	{
		console.log('Enviar formulario y cerrar ventana modal');
		//capturar los datos del formulario

		var cx_ = $('#cx_form').val();
		var cy_ = $('#cy_form').val();
		var opcion_ = $('#opciones_form').val();
		var nombre_ = $('#nombre_form').val();
		var valor_ = $('#valor_form').val();

		//Hago la peticion registro-desde-ventana-modal mediante el metodo post a funciones.php		
		$.post("src/funciones.php",
			{
				peticion: 'registro-desde-ventana-modal', 
				parametros: {  x:cx_ ,  y: cy_,  opcion: opcion_ , nombre: nombre_, valor: valor_  }
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					if(data=='NUEVO_REPORTE_CREADO')
					{
					   $('#div_mensaje_ventana_reporte').html('<h2>Reporte Almacenado con exito !!</h2>');
					}else
					{
						$('#div_mensaje_ventana_reporte').html('<h2>No se pudo almacenar el reporte!</h2>');	
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
		$('#nombre_form').val("");
		$('#descripcion_form').val("");
		$('#valor_form').val("");
		$('#div_mensaje_ventana_reporte').html("");

		// lanzo ventana modal para registrar datos de reporte
		$('#ventana-reporte').modal(
			{
				closeExisting: false,
				escapeClose: false,
  				clickClose: false,
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

</body>
</html>
