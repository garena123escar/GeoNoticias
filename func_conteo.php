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
 
) {
    exit();
}
#Si todo va bien, se ejecuta esta parte del código...
include_once "config.php";

$tipo = $_POST["tipo"];


$sql = $databasePDO->prepare("select r.count, r.tipo from reporte  where r.tipo =? group by r.tipo ");
$resultado = $sql->execute([$tipo]); # Pasar en el mismo orden de los ?

#Si todo salio bien, retornar al form del listado de edificios
if ($resultado === true) {
    header("Location: reportes.php");
} else {
    echo "Algo salio mal. Por favor verifica que la tabla exista, así como el ID del usuario";
}
