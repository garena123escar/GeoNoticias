<?php
/*
CRUD con PostgreSQL y PHP
================================
Este archivo guarda los datos del formulario
en donde se editan
================================
*/
?>

<?php
#Salir si alguno de los datos no está presente
if (
    !isset($_POST["tipo"]) ||
    !isset($_POST["descripcion"]) ||
    !isset($_POST["id_reporte"])
) {
    exit();
}
#Si todo va bien, se ejecuta esta parte del código...
include_once "config.php";

$id_reporte = $_POST["id_reporte"];
$tipo = $_POST["tipo"];
$descripcion = $_POST["descripcion"];


$sql = $databasePDO->prepare("UPDATE reporte SET tipo = ?, descripcion = ? WHERE id_reporte = ?;");
$resultado = $sql->execute([$tipo, $descripcion, $id_reporte]); # Pasar en el mismo orden de los ?


#Si todo salio bien, retornar al form del listado de edificios
if ($resultado === true) {
    header("Location: reportes.php");
} else {
    echo "Algo salio mal. Por favor verifica que la tabla exista, así como el ID del usuario";
}
