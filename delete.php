<?php
/*
CRUD con PostgreSQL y PHP
================================
Este archivo elimina un dato por ID sin
pedir confirmación. El ID viene de la URL
================================
*/
if (!isset($_GET["id_reporte"])) {
    exit();
}

$id_reporte = $_GET["id_reporte"];
include_once "config.php";

$sql = $databasePDO->prepare("DELETE FROM reporte WHERE id_reporte = ?;");
$resultado = $sql->execute([$id_reporte]);

if ($resultado === true) {
    header("Location: reportes.php");
} else {
    echo "Algo salio mal al tratar de eliminar el reporte";
}
