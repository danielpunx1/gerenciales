
<?php

include "../../../../config/db.php";

$camara = $_GET['camara'];
$materia = $_GET['materia'];
$colaborador = $_GET['colaborador'];



$sql = "SELECT MAX(id) AS id, nombres,apellidos,codigo,camara, materia,juicio,jrc as estado_juridico, hoy, fechar, fechae 
       from (
       SELECT p.id,u.nombres,u.apellidos, e.codigo,e.camara, e.juicio, est.estado as jrc, NOW() as hoy, r.fechar, r.fechae, 
       CASE WHEN e.codigo like '%-CAC-%' THEN 'Civil' WHEN e.codigo like '%-CAL-%' THEN 'Laboral'
       WHEN e.codigo like '%-CAF-%' THEN 'Familia' WHEN e.codigo like '%-CAM-%' THEN 'Mercantil' END AS materia 
       from expediente e, proyecto p, ruta r, usuario u, estado_expediente es, estados est 
       where e.codigo=p.codigo AND u.login=r.manda AND r.fechae IS NULL AND r.codigo=e.codigo 
       and r.codigo like '%-____' AND u.codigo_col='$colaborador' AND est.id_estado=es.estado_admin 
       AND es.codigo=e.codigo AND est.tipo='JRC' AND e.camara='$camara' AND e.codigo like '$materia'
       ) 
       AS tabla GROUP BY nombres,apellidos,codigo, camara,juicio,estado_juridico, hoy, fechar, fechae
       ";

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

