
<?php

include "../../../../config/db.php";

$camara = $_GET['camara'];
$materia = $_GET['materia'];
$colaborador = $_GET['colaborador'];
$estado_juridico = $_GET['estado_juridico'];
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


$sql = "select distinct estado_proyecto.codigo,estado_proyecto.estado,estado_resolucion,nombres, apellidos,
juicio, camara, nuevo_codigo, expediente.fecha 
from estado_proyecto join proyecto on estado_proyecto.id_proyecto=proyecto.id
join expediente on expediente.codigo=proyecto.codigo
join usuario on usuario.codigo_col=proyecto.codigo_col
where estado_proyecto.fecha between '2008/06/06 00:00:00' and '2009/06/06 23:59:59'";


?>


<table>


	<tr>
		<td>Codigo</td>
		<td>Camara</td>
		<td>Materia</td>
		<td>Nomativa</td>
		<td>fechai</td>
				
	</tr>
<?php
    
    $res = pg_query($conn,$sql);

    while( $filas = pg_fetch_array($res) )
    {
    	echo '<tr>
				<td>'.$filas['codigo'].'</td>
				<td>'.$filas['camara'].'</td>
				<td>'.$filas['materia'].'</td>
				<td>'.$filas['normativa'].'</td>
				<td>'.$filas['fechai'].'</td>
				
			  </tr>
			 ';
    }//fin while

?>

</table>

