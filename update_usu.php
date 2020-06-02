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
    !isset($_POST["telefono"]) ||
    !isset($_POST["contrasena"]) ||
    !isset($_POST["correo"]) ||
    !isset($_POST["id_usuario"])
) {
    exit();
}
#Si todo va bien, se ejecuta esta parte del código...
include_once "config.php";

$id_usuario = $_POST["id_usuario"];
$telefono = $_POST["telefono"];
$contrasena = $_POST["contrasena"];
$correo = $_POST["correo"];


$sql = $databasePDO->prepare("UPDATE usurios SET telefono = ?, contrasena = ?, correo = ?  WHERE id_usuario = ?;");
$resultado = $sql->execute([$telefono, $contrasena, $correo, $id_usuario]); # Pasar en el mismo orden de los ?


#Si todo salio bien, retornar al form del listado de edificios
if ($resultado === true) {
    header("Location: reportes.php");
} else {
    echo "Algo salio mal. Por favor verifica que la tabla exista, así como el ID del usuario";
}
