
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
    <meta http-equiv="pragma" content="no-cache" />
    
    <!-- ************************************************************************ -->
    <title>Consulta de tipos de juicios por c&aacute;mara</title>
    <!-- ************************************************************************ -->
    
    <link href="../../../../estilo/estilo.css" rel="stylesheet" type="text/css" />
 </head>
 
 <body onload="javascript: window.print();" style="background: #FFFFFF;">
 
 <?php
 
    include "../../../../config/db.php";
    include "../laboraldays2.php";
    
    $camara = $_REQUEST['camara'];
    $materia = $_REQUEST['materia'];
    $colaborador = $_REQUEST['colaborador'];
    $desde = $_REQUEST['desde'];
    $hasta = $_REQUEST['hasta'];
    
    //para mostrar la fecha y hora
    date_default_timezone_set("America/El_Salvador");
    $dias= array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
    $meses=array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
?>
 
 <table class="cabecera_ cabecera_reporte">
    <tr>
    <td rowspan="4">
        <img border="0" src="../../../../imagenes/escudo.png">
    </td>
    <td>CORTE SUPREMA DE JUSTICIA</td><td rowspan="4">
        <img border="0" src="../../../../imagenes/images-76x74.png">
    </td>
    </tr>
    <tr><td style="font-size: 14px;">SALA DE LO CIVIL</td></tr>
    <tr><td style="font-size: 14px;">SISTEMA GERENCIAL DE CASACI&Oacute;NES</td></tr>
    <tr>
            <td style="font-size: 11px; font-style: italic;">
            <?php 
                echo $dias[date('w')].", ".strftime(" %d ")." de ".$meses[date('n')-1]." de " .strftime(" %Y")." ".date('g:i a'); 
            ?>
            </td>
    </tr>
 </table>
 
 <table class='resultadosRep'>
    <thead>
        
        <!-- *********************************************************************************************** -->
        <tr><th class='tituloReporte'>Reporte de estados de resoluci&oacute;n por casaci&oacute;n</th></tr>
        <!-- *********************************************************************************************** -->
        
    </thead>
 </table>
 
 <table class='datosReporte'>
    <tr>
    
        <!-- *********************************************************************************************** -->
        <td>Periodo : </td>
        <td><?php echo $desde.' al '.$hasta; ?></td>
        <!-- *********************************************************************************************** -->
        
    </tr>
    <tr>
    
        <!-- *********************************************************************************************** -->
        <td>Materia : </td>
        <td>
            <?php 
                if($materia=="%-%-%"){echo "Todas las materias";}
                if($materia=="%-CAC-%"){echo "Civil";}
                if($materia=="%-CAF-%"){echo "Familia";}
                if($materia=="%-CAL-%"){echo "Laboral";}
                if($materia=="%-CAM-%"){echo "Mercantil";}
            ?>
        </td>
        <!-- *********************************************************************************************** -->
    
    </tr>
    <tr>
        
        <!-- *********************************************************************************************** -->
        <td>C&aacute;mara : </td>
        <td><?php if($camara=="%"){echo "Todas las C&aacute;maras";}else{echo $camara;} ?></td>
        <!-- *********************************************************************************************** -->
        
    </tr>
    <tr>
        
        <!-- *********************************************************************************************** -->
        <td>Colaborador : </td>
        <td><?php if($colaborador=='%'){echo 'Todos los colaboradores';}else{echo $colaborador;} ?></td>
        <!-- *********************************************************************************************** -->
        
    </tr>

 </table>
 
 
 
 <table class='resultadosRep'>
    
    <thead>
        <tr>
            <th style='width:10%'>N°</th>
            <th style='width:10%'>Codigo</th>
            <th style='width:20%'>Colaborador</th>
            <th style='width:10%'>Materia</th>
            <th style='width:20%'>C&aacute;mara</th>
            <th style='width:15%'>Estado resoluci&oacute;n</th>
            <th style='width:15%'>Fecha de Creaci&oacute;n</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php
            
            $sql = "SELECT e.codigo,u.nombres || ' ' || u.apellidos as nombre,e.camara,
    CASE WHEN e.codigo like '%-CAC-%' THEN 'Civil' WHEN e.codigo like '%-CAL-%' THEN 'Laboral'
    WHEN e.codigo like '%-CAF-%' THEN 'Familia' WHEN e.codigo like '%-CAM-%' THEN 'Mercantil' END AS materia
    ,est.estado,r.fechar, r.fechae
    from expediente e, 
    ruta r, usuario u, estado_expediente es, estados est 
    where u.login=r.manda 
    AND r.codigo=e.codigo and r.codigo like '%-____' AND u.codigo_col like '$colaborador' and u.codigo_col != 'AA'
    AND est.id_estado=es.estado_juridico AND es.codigo=e.codigo AND  fechae =(SELECT max(fechae) FROM ruta WHERE codigo=e.codigo)
    AND e.camara LIKE '$camara' AND e.codigo like '$materia'
    AND fechar BETWEEN '$desde 00:00:00' AND '$hasta 23:59:59' order by split_part(e.codigo,'-', 3) DESC, nombre,materia,camara";
                    
            $resultado = pg_query($sql) or die ('consulta fallida:'.pg_last_error());
        
            $filas = pg_num_rows($resultado);
                    
            if ($filas >= 1) 
            {
                $total=0;
                            
                while ($_expedientes = pg_fetch_array($resultado))
                {
                    $total = $total +1 ;
                    $codigo1 = $_expedientes["codigo"];
                                $colaborador1 = $_expedientes["nombre"];
                                $materia1 = $_expedientes["materia"];
                                $camara1 = $_expedientes["camara"];
                                $estado1 = $_expedientes["estado"];
                                
                                $fechae  = $_expedientes["fechae"];
                                $fechar  = $_expedientes["fechar"];
                                $dif=lab($fechar, $fechae, '2014-01-01 00:00:00');
                           
                    ?>
                        
                        <tr>
                            <td><?php echo $total; ?></a></td>
                            <td><?php echo $codigo1; ?></a></td>
                            <td><?php echo $colaborador1; ?></a></td>
                            <td><?php echo $materia1; ?></td>
                            <td><?php echo $camara1; ?></td>                            
                            <td><?php echo $estado1; ?></td>
                            <td><?php echo $dif; ?></td>
                        </tr>
                            

        <?php
                } //fin while
            }//fin if
            else
            {
                ?>
                    <table class='resultadosRep sinResultados'>
                        <tr>
                            <td>No se encontraron resultados para su consulta.</td>
                        </tr>
                    </table>
                <?php
            }
        ?>
    
    </tbody>
    
    <tfoot>
    <tr><td colspan="7"> Total <?php echo $total; ?> resultados</td></tr>
    </tfoot>
    
 </table>

 </body>
 </html>
