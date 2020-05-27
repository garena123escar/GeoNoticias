--- INSERTAR DATOS SINTETICOS DE REPORTE

INSERT INTO public.reporte_ejemplo(
            x, y, opcion_registrada, nombre, valor, fecha_registro)
    VALUES (-76.50850,3.41279, 'op1', 'Andres Herrera', 25, now());

INSERT INTO public.reporte_ejemplo(
            x, y, opcion_registrada, nombre, valor, fecha_registro)
    VALUES (-76.50195,3.44491, 'op1', 'Andres Herrera', 33, now());


INSERT INTO public.reporte_ejemplo(
            x, y, opcion_registrada, nombre, valor, fecha_registro)
    VALUES (-76.49480,3.47763, 'op2', 'Andres Herrera', 18, now());

INSERT INTO public.reporte_ejemplo(
            x, y, opcion_registrada, nombre, valor, fecha_registro)
    VALUES (-76.49360,3.47168, 'op3', 'Andres Herrera', 56, now());

    
INSERT INTO public.reporte_ejemplo(
            x, y, opcion_registrada, nombre, valor, fecha_registro)
    VALUES (-76.53234,3.44551, 'op4', 'Andres Herrera', 33, now());


INSERT INTO public.reporte_ejemplo(
            x, y, opcion_registrada, nombre, valor, fecha_registro)
    VALUES (-76.52280,3.37294, 'op3', 'Andres Herrera', 56, now());

INSERT INTO public.reporte_ejemplo(
            x, y, opcion_registrada, nombre, valor, fecha_registro)
    VALUES (-76.49480,3.46811, 'op1', 'Andres Herrera', 24, now());

INSERT INTO public.reporte_ejemplo(
            x, y, opcion_registrada, nombre, valor, fecha_registro)
    VALUES (-76.50075,3.47703, 'op3', 'Andres Herrera', 12, now());

INSERT INTO public.reporte_ejemplo(
            x, y, opcion_registrada, nombre, valor, fecha_registro)
    VALUES (-76.53710,3.36283, 'op2', 'Andres Herrera', 100, now());
    
INSERT INTO public.reporte_ejemplo(
            x, y, opcion_registrada, nombre, valor, fecha_registro)
    VALUES (-76.47513,3.42529, 'op1', 'Andres Herrera', 10, now());


INSERT INTO public.reporte_ejemplo(
            x, y, opcion_registrada, nombre, valor, fecha_registro)
    VALUES (-76.51148,3.48060, 'op1', 'Andres Herrera', 23, now());

--- CONSULTA RECUPERAR REPORTES E INFORMACION ESPACIAL ASOCIADA

SELECT st_setsrid(st_makepoint(r.x,r.y),4326) as the_geom , b.barrio, b.comuna, b.estra_moda, r.valor FROM
			    barrios_cali as b, reporte_ejemplo as r
			    WHERE st_within(st_setsrid(st_makepoint(r.x,r.y),4326), b.the_geom );

-- CONSULTA RETORNA GEOJSON
			    

SELECT row_to_json(fc)
     FROM ( SELECT 'FeatureCollection' As type, array_to_json(array_agg(f)) As features
     FROM (SELECT 'Feature' As type, ST_AsGeoJSON(lg.the_geom)::json As geometry, row_to_json
     ((SELECT l FROM (SELECT  lg.barrio , lg.comuna, lg.estra_moda   ) As l)) As properties
     FROM (SELECT st_setsrid(st_makepoint(r.x,r.y),4326) as the_geom , b.barrio, b.comuna, b.estra_moda, r.valor FROM
barrios_cali as b, reporte_ejemplo as r
WHERE st_within(st_setsrid(st_makepoint(r.x,r.y),4326), b.the_geom )
) As lg   
) As f )  As fc;
