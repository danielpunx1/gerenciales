<?php

$user   = 'casaciones';
$passwd = 'casaciones';
$db     = 'casaciones';
$port   = 5432;
$host   = 'localhost';

$conexion = "host=$host port=$port dbname=$db user=$user password=$passwd";
$conn = pg_connect($conexion) or die ("Error de conexion. ". pg_last_error());

//echo "Conexion exitosa "; 

?>

