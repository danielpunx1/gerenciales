<?php

include '../config/db.php';

$user = $_POST['usuario'];
$pass = $_POST['pass'];
$pass = hash_hmac('md5', $pass, 'casaciones');

$sql1 = "SELECT * FROM login where nick='$user' and pass='$pass' ";

//echo $sql1;

$resultado = pg_query($conn, $sql1);

$filas = pg_fetch_array($resultado);

//echo $filas['acceso'];

session_start();

if( $filas != NULL )
{
	if( $filas['fecha_baja'] == NULL )
	{
		if( $filas['acceso'] == 1 )
		{
		    $_SESSION['user'] = $filas['nombres'].' '.$filas['apellidos'];

		    header("location: admin/menu.php");

		}

		if( $filas['acceso'] == 2 )
		{
		    $_SESSION['user'] = $filas['nombres'].' '.$filas['apellidos'];

		    header("location: estrategico/menu.php");

		}

		if( $filas['acceso'] == 3 )
		{
		    $_SESSION['user'] = $filas['nombres'].' '.$filas['apellidos'];

		    header("location: tactico/menu.php");

		}
	}
	else
	{
		$_SESSION['errores'] = "Sus credenciales han sido desactivadas comuniquese con el administrador";	
		header("location: ../index.php");
	}
		
}
else
{
	$_SESSION['errores'] = "Error verifique su usuario o clave";	
	header("location: ../index.php");
}

pg_free_result($resultado);
pg_close($conn);

?>

