
<?php
pg_dump base_de_datos  > archivo.sql 
//aqui puedes darle una ruta o se guardara por defecto en la ruta donde se encuentre la carpeta bin del postgres
//restauro el backup con el siguiente comando
 psql -e Nombre_de_Bd < archivo.sql >

 pg 
?>

http://ar2.php.net/manual/en/function.shell-exec.php




//*****************************************************************************************************************
//*****************************************************************************************************************


http://www.esdebian.org/foro/32002/backup-postgresql-php-apache-pgdump

<?php
function hacer_resguardo($path,$etapa){
  $host=$_COOKIE[host];
  $usuario=$_COOKIE[usuario];
  $password=$_COOKIE[password];
  $nombre_bd=$_COOKIE[nombre_bd];
  $archivo ="pirulo.bak";
  $comando =  "pg_dump -U ".$usuario." -d ".$nombre_bd." > ".$archivo;
  print "$comando";

  $salida=shell_exec($comando);
  echo $salida;
  if ($salida){
    $jr_error=error_get_last();
    cartel("Error tipo: ".$jr_error['type']. " Mensaje: ".$jr_error['message']." Archivo: ".$jr_error['file']. " Linea: ".$jr_error['line']);
  }
?>




    system("pg_dump -U mi_usuario vacunas4 > vacunas4.pgdump");





#!/usr/bin/perl

use Shell;
#use CGI::Carp qw(fatalsToBrowser);

chdir("/usr/local/pgsql/data");
#system("pg_dump vacunas2 > vacunas2.pgdump") || die("Mensaje de error pecadorr: $!");
system("pg_dump -u vacunas4 > vacunas4.pgdump");

print "Content-type: text/html\n\n";

print << "HTML";
<HTML><HEAD><TITLE></TITLE></HEAD>
<BODY>
<H2 align=center>LA BASE DE DATOS HA SIDO SALVADA CORRECTAMENTE</H2>
<BR><BR><BR><BR><A href="javascript:close()">Cerrar ventana</A><BR>
<A HREF="javascript:history.back()"> Volver atr� </A><BR>
<A HREF="http://10.170.136.111/primera.htm"> Salir </A>
<BR><A HREF="http://10.170.136.111/secret/admin2.htm"> Volver al menu de administrador</A>
</BODY>
</HTML>
HTML


