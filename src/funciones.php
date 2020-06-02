<?php 

  //configuracion de la conexion a la base de datos

   include('configuracion.php');
   
   session_start();
   
   if(!isset($_POST['peticion']))
   {
	$_POST['peticion'] = "peticion";
   }

   if(!isset($_POST['parametros']))
   {
	$_POST['parametros'] = "parametros";
   }

   $peticion = $_POST['peticion'];
   $parametros = $_POST['parametros'];
   
   switch($peticion)
   {
	//Caso de reportes por comuna
		case 'Reportes-x-comuna':
			{
				$comuna = $parametros['comuna'];
				$tipo = $parametros['tipo'];

				$sql="SELECT row_to_json(fc)
				FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
				FROM (SELECT 'Feature' As type, ST_AsGeoJSON(lg.geom)::json As geometry, row_to_json
				((SELECT l FROM (SELECT  lg.comuna, lg.tipo, lg.descripcion, lg.id_reporte  ) As l)) As properties
				FROM (SELECT st_setsrid(st_makepoint(r.x,r.y),4326) as geom , c.comuna, r.tipo, r.descripcion, r.id_reporte FROM
		   comuna as c, reporte as r
		   WHERE st_within(st_setsrid(st_makepoint(r.x,r.y),4326), c.geom ) and c.comuna = '$comuna' and r.tipo ='$tipo'
		   ) As lg   
		   ) As f )  As fc;";
				  
				  $query3 = pg_query($dbcon,$sql);
				  $row = pg_fetch_row($query3);
				  echo $row[0];
			  break;
			}

	//Caso PARA REGISTRAR UN REPORTE DESDE UNA VENTANA MODAL
		case 'registro-desde-ventana-modal':
		{
			$px = $parametros['x'];
			$py = $parametros['y'];
			$ptipo = $parametros['tipo'];
			$pdescripcion = $parametros['descripcion'];
			$usuario= $parametros['usuario'];
			$nombre=$parametros['nombres'];

			$sql = "INSERT INTO reporte(x,y,tipo,descripcion,fecha_registro,id_usuario,usuario)VALUES($px,$py,'$ptipo','$pdescripcion',now(),'$usuario','$nombre');";
			$query = pg_query($dbcon,$sql);

			if($query)
			{
				//si se ejecuto la consulta con exito retorno un identificador
				echo "NUEVO_REPORTE_CREADO";
			}else
			{
				//si NO se ejecuto la consulta retorno un identificador
				echo "NO SE PUDO CREAR EL REPORTE";
			}

		    break;
		}
	//Caso para validar el login y el password
		case 'validar-login':
		{
				$login = $parametros['login'];
				$password = $parametros['password'];
				
				$sql="select usuario,contrasena,id_rol,id_usuario from usuarios where usuario='$login'  and contrasena = md5('$password') and id_rol='2';";
				$query = pg_query($dbcon,$sql);
				// si se obtiene mas de un registro en el select
				$row=pg_fetch_row($query);
				if($row>1)
				{
					echo "ENTRAR";
					$_SESSION["usuario"] = $row[0];
					$_SESSION["rol"] = $row[2];
					$_SESSION["iduser"] = $row[3];
				}else
				{
					echo "NOVALIDO";
				}
				break;
		}

	//Caso validar login administrador////
			case 'validar-login2':
		{
				$login = $parametros['login'];
				$password = $parametros['password'];
				
				$sql="select usuario,contrasena,id_rol,id_usuario from usuarios where usuario='$login'  and contrasena = md5('$password') and id_rol='1';";
				$query = pg_query($dbcon,$sql);
				// si se obtiene mas de un registro en el select
				$row=pg_fetch_row($query);
				if($row>1)
				{
					echo "ENTRAR";
					$_SESSION["usuario"] = $row[0];
					$_SESSION["rol"] = $row[2];
					$_SESSION["iduser"] = $row[3];
				}else
				{
					echo "NOVALIDO";
				}
				break;
		}
	//CASO Consulta para visualizar	
		case 'consulta2':
			{
				$user= $parametros['user'];

				$sql="SELECT row_to_json(fc)
				FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
				FROM (SELECT 'Feature' As type, ST_AsGeoJSON(lg.geom)::json As geometry, row_to_json
				((SELECT l FROM (SELECT  lg.comuna, lg.tipo, lg.descripcion, lg.id_reporte, lg.usuario  ) As l)) As properties
				FROM (SELECT st_setsrid(st_makepoint(r.x,r.y),4326) as geom , c.comuna, r.tipo, r.descripcion, r.id_reporte,r.usuario, r.id_usuario FROM
		   comuna as c, reporte as r
		   WHERE st_within(st_setsrid(st_makepoint(r.x,r.y),4326), c.geom ) and r.usuario ='$user'
		   ) As lg   
		   ) As f )  As fc;";
				  
				  $query3 = pg_query($dbcon,$sql);
				  $row = pg_fetch_row($query3);
				  echo $row[0];
			  break;
			}

	//CASO Semana15 - Mapa de Calor
		case 'recupera-geojson-mapacalor':
			{
				$sql3="SELECT row_to_json(fc)
				FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
				FROM (SELECT 'Feature' As type, ST_AsGeoJSON(lg.geom)::json As geometry, row_to_json
				((SELECT l FROM (SELECT  lg.barrio, lg.tipo, lg.descripcion, lg.id_reporte  ) As l)) As properties
				FROM (SELECT st_setsrid(st_makepoint(r.x,r.y),4326) as geom , b.barrio, r.tipo, r.descripcion, r.id_reporte FROM
		   barrios as b, reporte as r
		   WHERE st_within(st_setsrid(st_makepoint(r.x,r.y),4326), b.geom )
		   ) As lg   
		   ) As f )  As fc;";
	   
				$query3 = pg_query($dbcon,$sql3);
				$row = pg_fetch_row($query3);
				echo $row[0];
				break;
			}

	//CASO Semana15 Clase - Cluster Map
		case 'recupera-geojson-cluster':
		{
				$sql3="SELECT row_to_json(fc)
				FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
				FROM (SELECT 'Feature' As type, ST_AsGeoJSON(lg.geom)::json As geometry, row_to_json
				((SELECT l FROM (SELECT  lg.barrio, lg.tipo, lg.descripcion, lg.id_reporte  ) As l)) As properties
				FROM (SELECT st_setsrid(st_makepoint(r.x,r.y),4326) as geom , b.barrio, r.tipo, r.descripcion, r.id_reporte FROM
		   barrios as b, reporte as r
		   WHERE st_within(st_setsrid(st_makepoint(r.x,r.y),4326), b.geom )
		   ) As lg   
		   ) As f )  As fc;";
	   
				$query3 = pg_query($dbcon,$sql3);
				$row = pg_fetch_row($query3);
				echo $row[0];
				break;
		}	
	//Caso de reportes por tipo
		case 'Reportes-x-tipo':
			{
				$tipo = $parametros['tipo'];

				$sql="SELECT row_to_json(fc)
				FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
				FROM (SELECT 'Feature' As type, ST_AsGeoJSON(lg.geom)::json As geometry, row_to_json
				((SELECT l FROM (SELECT  lg.comuna, lg.tipo, lg.descripcion, lg.id_reporte  ) As l)) As properties
				FROM (SELECT st_setsrid(st_makepoint(r.x,r.y),4326) as geom , c.comuna, r.tipo, r.descripcion, r.id_reporte FROM
		  	    comuna as c, reporte as r
		   		WHERE st_within(st_setsrid(st_makepoint(r.x,r.y),4326), c.geom ) and r.tipo ='$tipo'
		   		) As lg   
		   		) As f )  As fc;";
				  
				  $query3 = pg_query($dbcon,$sql);
				  $row = pg_fetch_row($query3);
				  echo $row[0];
			  break;
			}
	//Caso de conteo por tipo
		case 'conteo-x-tipo':
			{
				$tipo = $parametros['tipo'];
	
				$sql="select r.count, r.tipo from reporte r where r.tipo ='$tipo' group by r.tipo ";
					  
					$query4 = pg_query($dbcon,$sql);
					$row = pg_fetch_row($query4); 
					echo $row['r.count'];
					
					  
				break;
			}
	//Caso de Reportes por dia
		case 'recupera-geojson-cluster-tiempo':
		{
				$sql3="SELECT row_to_json(fc)
				FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
				FROM (SELECT 'Feature' As type, ST_AsGeoJSON(lg.geom)::json As geometry, row_to_json
				((SELECT l FROM (SELECT  lg.barrio, lg.tipo, lg.descripcion, lg.id_reporte  ) As l)) As properties
				FROM (SELECT st_setsrid(st_makepoint(r.x,r.y),4326) as geom , b.barrio, r.tipo, r.descripcion, r.id_reporte FROM
		   barrios as b, reporte as r
		   WHERE st_within(st_setsrid(st_makepoint(r.x,r.y),4326), b.geom ) and r.fecha_registro = current_date
		   ) As lg   
		   ) As f )  As fc;";

				$query3 = pg_query($dbcon,$sql3);
				$row = pg_fetch_row($query3);
				echo $row[0];
				break;
		}	

	}
    

?>
