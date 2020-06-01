
<?php
include_once "configuracion.php";

$tipo = $_POST['tipo'];


$sql = "select r.count, r.tipo from reporte  where r.tipo = $tipo group by r.tipo ";
$query = pg_query($dbcon,$sql);
	
	
	//proceso el resultado de la ejecucion del sql en la base de datos
	
	while ($row = pg_fetch_row($query)) 
	{
		echo "En total hay: $row[0] reportes sobre $row[1]";
		echo "<br />";
	}
	
	

?>
