
<?php

include '../../../config/db.php';

$user_mod  = $_POST['user_mod'];

$nick = $_POST['nick'];
$pass = $_POST['pass'];
$nombres = $_POST['nombres'];
$apellidos = $_POST['apellidos'];
$acceso = (int)$_POST['acceso'];

if( $pass == " " )
{
	$sql = "UPDATE login SET nick='$nick',nombres='$nombres',apellidos='$apellidos',acceso='$acceso' WHERE nick='$user_mod' ";
}
else
{
	$pass = hash_hmac('md5', $pass, 'casaciones');
	$sql = "UPDATE login SET nick='$nick',pass='$pass',nombres='$nombres',apellidos='$apellidos',acceso='$acceso' WHERE nick='$user_mod' ";
}

$res = pg_query($conn,$sql);

if( $res )
{
	header("location: modificar_usuario.php");
}
else
{
	header("location: modificar_usuario.php");
}

?>


