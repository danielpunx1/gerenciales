
<?php

include "../../../../config/db.php";

$camara = $_GET['camara'];
$materia = $_GET['materia'];
$fechai = $_GET['fechai'];
$fechaf = $_GET['fechaf'];


// echo $camara;
// echo ' -- ';
// echo $materia;
// echo ' -- ';
// echo $juicio;
// echo ' -- ';
// echo $fechai;
// echo ' -- ';
// echo $fechaf;


$sql = "select distinct expediente.codigo,juicio,estado_resolucion, ii.estado as estado_administrativo, nombres, apellidos, fechacre 
from expediente join estado_expediente ee on expediente.codigo=ee.codigo 
join estados ii on ii.id_estado =ee.estado_admin 
join estados on estados.id_estado = ee.estado_juridico 
join proyecto oo on expediente.codigo=oo.codigo 
join usuario on usuario.codigo_col=oo.codigo_col
where  nuevo_codigo IS TRUE 
order by fechacre asc";


?>


<table>


	<tr>
		<td>Codigo</td>
		<td>Camara</td>
		<td>Materia</td>
		<td>Juicio</td>
		<td>Estado juridico</td>
		<td>Estado administrativo</td>
		<td>Colaborador</td>
		
	</tr>
<?php
    
    $res = pg_query($conn,$sql);

    while( $filas = pg_fetch_array($res) )
    {
    	echo '<tr>
				<td>'.$filas['codigo'].'</td>
				<td>'.$filas['camara'].'</td>
				<td>'.$filas['materia'].'</td>
				<td>'.$filas['juicio'].'</td>
				<td>'.$filas['estado_resolucion'].'</td>
				<td>'.$filas['estado_administrativo'].'</td>
				<td>'.$filas['nombres'].'</td>
				<td>'.$filas['apellidos'].'</td>
			  </tr>
			 ';
    }//fin while

?>

</table>

