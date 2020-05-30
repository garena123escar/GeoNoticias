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
	$sql = $databasePDO->query("select id_reporte, tipo, descripcion, usuario from reporte");
	$resultados = $sql->fetchAll(PDO::FETCH_OBJ);
?>


<div class="row">
	<div class="col-12">
		<h1>Seleccione edificio a Actualizar</h1>
		<br>
		<div>
			<table border="1">
				<thead>
					<tr>
						<th>ID</th>
						<th>Tipo</th>
						<th>Descripcion</th>
						<th>Usuario</th>
						<th>Actualizar</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach($resultados as $edificio){ ?>
						<tr>
							<td><?php echo $edificio->id_reporte ?></td>
							<td><?php echo $edificio->tipo ?></td>
							<td><?php echo $edificio->descripcion ?></td>
							<td><?php echo $edificio->usuario ?></td>
							<td><a href="<?php echo "update_form.php?id_reporte=" . $edificio->id_reporte?>">Actualizar 📝</a></td>
						</tr>
					<?php } ?>
				</tbody>
			</table>
		</div>
	</div>
</div>

<br>
<a  href='semana15.php?logueado=si'>Volver al Geovisor</a>
