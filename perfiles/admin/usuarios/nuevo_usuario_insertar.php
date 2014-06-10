
<?php

include '../../../config/db.php';

$nick = $_POST['nick'];
$pass = $_POST['pass'];
$pass = hash_hmac('md5', $pass, 'casaciones');
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$acceso = (int)$_POST['acceso'];



$sql1 = "INSERT INTO login (nick,pass,nombres,apellidos,fecha_alta,fecha_baja,acceso) values ('$nick','$pass','$nombres','$apellidos',current_date,NULL,'$acceso') ";

//echo $sql1;

$resultado = pg_query($conn, $sql1);

if($resultado)
{
	// echo 'Insercion exitosa';
	// echo $nick.' - '.$nombres.' - '.$apellidos.' - '.$acceso;
	header("location: nuevo_usuario.php");
}
else
{
	// echo 'Error en la insercion'.pg_last_error();
	header("location: nuevo_usuario.php");
}



?>