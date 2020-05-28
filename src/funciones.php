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
		//Caso para recuperar los edificios de la base de datos
		case 'recupera-edificios-geojson':
		{
			$sql="SELECT row_to_json(fc)
			 FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
			 FROM (SELECT 'Feature' As type
				, ST_AsGeoJSON(lg.geom)::json As geometry
				, row_to_json((SELECT l FROM (SELECT name,localizaci,tipo) As l
				  )) As properties
			   FROM fuerza_publica As lg  where ST_IsValid(geom) ) As f )  As fc;";
   
			$query = pg_query($dbcon,$sql);
			$row = pg_fetch_row($query);
			echo $row[0];
			break;
		}
		//Caso para recuperar los sitios de interes ( TAREA )
		case 'recupera-sitios-interes-geojson':
		{
			$sql="SELECT row_to_json(fc)
			 FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
			 FROM (SELECT 'Feature' As type
				, ST_AsGeoJSON(lg.the_geom)::json As geometry
				, row_to_json((SELECT l FROM (SELECT osm_id , name, type ) As l
				  )) As properties
			   FROM sitiosinteres_univalle As lg  where ST_IsValid(the_geom) ) As f )  As fc;";
   
			$query = pg_query($dbcon,$sql);
			$row = pg_fetch_row($query);
			echo $row[0];
			break;
		}


		//CASO PARA GENERAR UNA VISTA CON LA RUTA MAS CORTA
		// Tarea remplazar caso, por funcion en plgsql (implementada en clases anteriores)
		case 'genera-ruta-mascorta':
		{
				$x1 = $parametros['x1'];
				$y1 = $parametros['y1'];
				$x2 = $parametros['x2'];
				$y2 = $parametros['y2'];

				//$sql="CREATE OR REPLACE VIEW rutatemporal AS SELECT seq, id1 AS node, id2 AS edge, cost, b.the_geom FROM pgr_dijkstra('
				//, false, false) a LEFT JOIN redpeatonal_univalle b ON (a.id2 = b.gid);";
				/*$sql="CREATE OR REPLACE VIEW rutatemporal AS SELECT seq, node AS node, edge AS edge, cost, b.the_geom FROM pgr_dijkstra('
                SELECT gid AS id,
                         source::integer,
                         target::integer,
                         costo::double precision AS cost
                        FROM redpeatonal_univalle',
                (select o.id::integer from (
 select id, st_distance(the_geom, ST_SetSRID(st_makepoint($x1,$y1),4326)  )  from  redpeatonal_univalle_vertices_pgr  
 order by 2 asc limit 1  )as o),(select d.id::integer  from (
 select id, st_distance(the_geom, ST_SetSRID(st_makepoint($x2,$y2),4326)  )  from  redpeatonal_univalle_vertices_pgr  
 order by 2 asc limit 1  )as d), false ) a LEFT JOIN redpeatonal_univalle b ON (a.edge = b.gid);";*/

 			$sql = "SELECT creaRutaMasLatLon($x1,$y1,$x2,$y2);";

			//Ejecutar QUERY SQL
			$query = pg_query($dbcon,$sql);
					
			if($query)
			{
				//si se ejecuto la consulta con exito retorno un identificador
				echo "NUEVA_RUTA_CREADA";
			}else
			{
				//si NO se ejecuto la consulta retorno un identificador
				echo "NOSEPUDOCREARLARUTA";
			}
			break;
		}

		//CASO PARA RETORNAR LA RUTA GENERADA
		case 'recupera-ruta-geojson':
		{
			$sql=" SELECT row_to_json(fc)
	 FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
	 FROM (SELECT 'Feature' As type
		, ST_AsGeoJSON(lg.the_geom)::json As geometry
		, row_to_json((SELECT l FROM (SELECT node, edge) As l
		  )) As properties
	   FROM rutatemporal As lg   ) As f )  As fc;";
			
				$query3 = pg_query($dbcon,$sql);
				$row = pg_fetch_row($query3);
				echo $row[0];
			break;
		}

		//CASO PARA CONSULTAR LA INFORMACION DE LA RUTA CREADA
		case 'info-ruta-creada':
		{
			$sql = "SELECT * FROM info_rutatemporal limit 1;";
			$query4 = pg_query($dbcon,$sql);
			
			$tabla_html = "<table style='width:800px'><tr>
			  <th>Desde</th>
			  <th>Hasta</th>
			  <th>Distancia Total Ruta</th>
			</tr>";
			
			while ($row = pg_fetch_row($query4)) 
			{
				$tabla_html .=  '<tr>';
				$tabla_html .=  '<td>' . $row[1] . '</td>';
				$tabla_html .=  '<td>' . $row[4] . '</td>';
				$tabla_html .=  '<td>' . round( $row[6] ,2 ) . '</td>';
				$tabla_html .=  '</tr>';
			}

			$tabla_html.='</table>';

			echo $tabla_html;

			break;
		}

		//CASO PARA REGISTRAR UN REPORTE DESDE UNA VENTANA MODAL
		case 'registro-desde-ventana-modal':
		{
			$px = $parametros['x'];
			$py = $parametros['y'];
			$ptipo = $parametros['tipo'];
			$pdescripcion = $parametros['descripcion'];
			$usuario= $parametros['usuario'];
			$foto=$parametros['foto'];



			$sql = "INSERT INTO reporte(x,y,tipo,descripcion,fecha_registro,id_usuario, foto)VALUES($px,$py,'$ptipo','$pdescripcion',now(),'$usuario', '$foto');";
			$query = pg_query($dbcon,$sql);

			if($query)
			{
				//si se ejecuto la consulta con exito retorno un identificador
				echo "NUEVO_REPORTE_CREADO";
			}else
			{
				//si NO se ejecuto la consulta retorno un identificador
				echo "NOSEPUDOCREARELREPORTE";
			}

		    break;
		}
		//Caso para validar el login y el password
		case 'validar-login':
		{
				$login = $parametros['login'];
				$password = $parametros['password'];
				
				$sql="select usuario,contrasena,id_rol,id_usuario from usuarios where usuario='$login'  and contrasena = md5('$password');";
				$query = pg_query($dbcon,$sql);
				// si se obtiene mas de un registro en el select
				$row=pg_fetch_row($query);
				if($row>1)
				{
					echo "ENTRAR";
					$_SESSION["rol"] = $row[2];
					$_SESSION["iduser"] = $row[3];
				}else
				{
					echo "NOVALIDO";
				}
				break;
		}

		//CASO Semana15 - Mapa de Calor
		case 'recupera-geojson-mapacalor':
			{
				$sql3="SELECT row_to_json(fc)
				FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
				FROM (SELECT 'Feature' As type, ST_AsGeoJSON(lg.the_geom)::json As geometry, row_to_json
				((SELECT l FROM (SELECT  lg.barrio , lg.comuna, lg.estra_moda   ) As l)) As properties
				FROM (SELECT st_setsrid(st_makepoint(r.x,r.y),4326) as the_geom , b.barrio, b.comuna, b.estra_moda, r.valor FROM
		   barrios_cali as b, reporte_ejemplo as r
		   WHERE st_within(st_setsrid(st_makepoint(r.x,r.y),4326), b.the_geom )
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
				FROM (SELECT 'Feature' As type, ST_AsGeoJSON(lg.the_geom)::json As geometry, row_to_json
				((SELECT l FROM (SELECT  lg.barrio , lg.comuna, lg.estra_moda , lg.valor,  lg.opcion_registrada  ) As l)) As properties
				FROM (SELECT st_setsrid(st_makepoint(r.x,r.y),4326) as the_geom , b.barrio, b.comuna, b.estra_moda, r.valor, r.opcion_registrada FROM
		   barrios_cali as b, reporte_ejemplo as r
		   WHERE st_within(st_setsrid(st_makepoint(r.x,r.y),4326), b.the_geom )
		   ) As lg   
		   ) As f )  As fc;";
	   
				$query3 = pg_query($dbcon,$sql3);
				$row = pg_fetch_row($query3);
				echo $row[0];
				break;
		}	
		
   }
    

?>
