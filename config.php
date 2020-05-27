<?php
/*
	CRUD con PostgreSQL y PHP
	Este archivo se definen los parametros que permiten conectar a la base de datos
*/
 

$param_USER = "user";
$param_PASSWORD = "user";
$param_DATABASE = "proy";
$param_SERVER = "localhost";
$param_PORT = "5432";

try {
    $databasePDO = new PDO("pgsql:host=$param_SERVER;port=$param_PORT;dbname=$param_DATABASE", $param_USER, $param_PASSWORD);
    $databasePDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (Exception $e) {
    echo "Ocurrio un error con la base de datos: " . $e->getMessage();
}
