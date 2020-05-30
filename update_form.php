<?php
/*
CRUD con PostgreSQL y PHP
================================
Este archivo muestra un formulario llenado automáticamente
(a partir del ID pasado por la URL) para editar
================================
 */
 
if (!isset($_GET["id_reporte"])) {
    exit();
}

$id_reporte = $_GET["id_reporte"];
include_once "config.php";

$sql = $databasePDO->prepare("select id_reporte, tipo, descripcion from reporte WHERE id_reporte = ?;");
$sql->execute([$id_reporte]);

$edifico = $sql->fetchObject();

if (!$edifico) {
    #No existe
    echo "¡No existe algun Edificio con ese ID!";
    exit();
}
#Si la mascota existe, se ejecuta esta parte del código
?>


<div>
	<div>
		<h1>Actualizar Edificio</h1>
		<form action="update.php" method="POST">
			<input type="hidden" name="id_reporte" value="<?php echo $edifico->id_reporte; ?>">
			
			<div>
			<label for="tipo">Seleccione de la lista:</label><br>
			<select id="tipo" required name="tipo" type="text" id="tipo" placeholder="Tipo de Reporte">
			<option value="violencia">Violencia</option>
			<option value="accidentes">Accidente</option>
			<option value="hurtos">Hurtos</option>
			<option value="bloqueos">Bloqueos</option>
			<option value="Incendios">Incendios</option>
			<option value="DesNaturales">Desastres naturales</option>

			</select>
			<br>
			</div>
			<div>
				<label for="Descripcion">Codigo Edificio</label>
				<input value="<?php echo $edifico->descripcion; ?>" required name="descripcion" type="text" id="descripcion" placeholder="descripcion">
			</div>
			<br>
			<button type="submit">Actualizar Edificio</button>
			<br><br>
			<a href="form_update.php">Volver al Listado de Reportes (Actualizar)</a>
		</form>
	</div>
</div>
