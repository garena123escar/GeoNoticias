<?php
/*
CRUD con PostgreSQL y PHP
================================
Este archivo lista todos los
datos de la tabla, obteniendo a
los mismos como un arreglo
================================
*/
?>

<?php
	include_once "config.php";
	$sql = $databasePDO->query("SELECT tipo, descripcion, fecha_registro, foto FROM reporte order by id_reporte desc limit 6");
	$resultados = $sql->fetchAll(PDO::FETCH_OBJ);
?>


<div>
	<div>
		<h1>Listado de Noticias</h1>
		<br>
		<div>
			<table border="1">
				<thead>
					<tr>
						<th>TIPO</th>
						<th>DESCRIPCION</th>
						<th>FECHA</th>
						<th>FOTO</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($resultados as $edificio){ ?>
						<tr>
							<td><?php echo $edificio->tipo ?></td>
							<td><?php echo $edificio->descripcion ?></td>
							<td><?php echo $edificio->fecha_registro ?></td>
							<td><?php echo $edificio->foto ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<br>
<a  href='semana15.php?logueado=si'>Volver al Geovisor</a>
