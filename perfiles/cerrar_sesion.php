
<?php

session_start(); //abrimos todas las sesiones

session_destroy(); //una vez aperturadas las destruimos

session_unset();  //limpiamos cualquier sesion existente

header("location: ../index.php"); //redireccionamos al login


?>

