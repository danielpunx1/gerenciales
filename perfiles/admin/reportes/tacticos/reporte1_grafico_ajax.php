
<?php

include "../../../../config/db.php";

$camara = $_GET['camara'];
$materia = $_GET['materia'];
$juicio = $_GET['juicio'];
$fechai = $_GET['fechai'];
$fechaf = $_GET['fechaf'];


$sql = "SELECT ex.codigo,ex.camara,CASE WHEN ex.codigo like '%-CAC-%' THEN 'Civil' WHEN ex.codigo like '%-CAL-%' THEN 'Laboral'
        WHEN ex.codigo like '%-CAF-%' THEN 'Familia' WHEN ex.codigo like '%-CAM-%' THEN 'Mercantil' END AS materia,ex.juicio 
        FROM expediente 
        WHERE ex.codigo LIKE '%-$materia-%' AND ex.juicio LIKE '%$juicio%' 
        AND ex.camara LIKE '%$camara%' AND ex.fecha BETWEEN '$fechai 00:00:00' AND '$fechaf 23:59:59' 
        ORDER BY materia ASC, fecha ASC";


?>

<table>
	<tr>
		<td>Codigo</td>
		<td>Camara</td>
		<td>Materia</td>
		<td>Juicio</td>
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
			  </tr>
			 ';
    }//fin while

?>

</table>

