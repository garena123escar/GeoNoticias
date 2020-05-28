#!/bin/bash
for f in *.shp
do
	archivo="${f%.*}"
	echo "CONVIRTIENDO SHP"
	shp2pgsql -g the_geom -W LATIN1 -s 4326 $archivo  $archivo>$archivo.sql
done


