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
	$sql = $databasePDO->query("select id_reporte, tipo, descripcion,fecha_registro from reporte");
	$resultados = $sql->fetchAll(PDO::FETCH_OBJ);
?>


<div>
	<div>
		<h1>Listado de Reportes</h1>
		<br>
		<div>
			<table border="1">
				<thead>
					<tr>
						<th>ID</th>
						<th>Tipo</th>
						<th>Descripcion</th>
						<th>Fecha</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($resultados as $edificio){ ?>
						<tr>
							<td><?php echo $edificio->id_reporte ?></td>
							<td><?php echo $edificio->tipo ?></td>
							<td><?php echo $edificio->descripcion ?></td>
							<td><?php echo $edificio->fecha_registro ?></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<br>
<a  href='semana15.php?logueado=si'>Volver al Geovisor</a>
