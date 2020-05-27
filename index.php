<?php
	  session_start();
		
	  if($_GET['op']=='salir')
	  {
		if(isset($_SESSION["rol"])){ session_unset(); session_destroy(); }
	  }else
	  {
		  if(isset($_SESSION["rol"])){ header('Location: index.php?logueado=si');  }
	  }
?>
<!DOCTYPE html>
<html>
  <head>
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
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="lib/jquery/jquery-3.4.1.js"></script>
        <script type="text/javascript">
	
	
	$( document ).ready(function() 
	{

        
		$("#boton1").click(function()
		{
			$.post("src/funciones.php",
			{
				peticion: 'validar-login',
				parametros: {  login: $("#caja_usuario").val() ,  password: $("#caja_password").val()  },
			},
			function(data, status){
				console.log("Datos recibidos: " + data + "\nStatus: " + status);
				if(status=='success')
				{
					if(data=='ENTRAR')
					{
						//Ingresa al archivo semana15.php
                        document.location.href ='semana15.php?logueado=si';	
					}else
					{
						$("#caja_respuesta").html( '<br><b>USUARIO O PASSWORD ERROR !!</b>' );
					}
				}
			});
		});
		
		
    });


	
	</script>
</head>
<body>
<!--  esto es un comentario-->			
<div class="container-fluid">
<div class="row">
<div class="display-1 col-2 col-sm-3 col-md-2 col-lg-2 col-xl-3  text-center"></div>
<div class="display-1 col-8 col-sm-6 col-md-8 col-lg-8 col-xl-6  text-center"><p>GeoNoticias <br> Universidad del Valle <br><br> <h1 class="display-3 text-center">Iniciar Sesion</h1></p></div>
<div class="display-6 col-2 col-sm-3 col-md-2 col-lg-4 col-xl-3  text-center"></div>

</div>
<br>	<br>		
	<div class="row">
		<div class="display-6 col-3 col-sm-3 col-md-2 col-lg-2 col-xl-3  text-center"></div>
		<div class="display-6 col-6 col-sm-6 col-md-8 col-lg-8 col-xl-6 borde1 text-center"><br><br><br><br><br>	
Usuario:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <input type="text" id="caja_usuario" class="text-center" value=""></input><br><br>	
Password:&nbsp;&nbsp; <input type="password" id="caja_password"  value=""></input><br><br>
<a href="/sig3/Semana15/Semana15/create_usu.php">registrar usuario</a>
<button id="boton1">Ingresar al Sistema</button>
</div>
		<div class="display-6 col-3 col-sm-3 col-md-2 col-lg-2 col-xl-3  text-center"></div>

	</div>
</div>

</body>



<div id="caja_respuesta"> </div>

<br>	<br><br><br><br><br><br><br>
<div class="container-fluid">

	<div class="row">
		<div class="display-6 col-4 col-sm-4 col-md-2 col-lg-2 col-xl-4 border text-center"><p>MODELAMIENTO DE DATOS SIG EN WEB 	<br><br> PROYECTO FINAL</p></div>
		<div class="display-6 col-4 col-sm-4 col-md-8 col-lg-8 col-xl-4 borde2 text-center"><p>UNIVERSIDAD DEL VALLE <br>ESCUELA DE INGENIERÍA CIVIL Y GEOMÁTICA <br> INGENIERÍA TOPOGRÁFICA</p></div>
		<div class="display-6 col-4 col-sm-4 col-md-2 col-lg-2 col-xl-4 border text-center"><p>GeoNoticias <br> Santiago de Cali <br> 2020</p></div>

	</div>
</div>

