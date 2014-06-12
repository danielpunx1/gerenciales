
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html lang="es">
<head>
    <?php
    
        //CODIGOS PARA CONVERTIR A EXCEL
        
        header("Content-Type: application/vnd.ms-excel");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("content-disposition: attachment;filename=reporte_tipos_de_juicio_por_camara.xlsx"); //COLOCAR EL NOMBRE DEL ARCHIVO
    ?>
    
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    
    
    <meta http-equiv="pragma" content="no-cache" />
    
    <!-- ************************************************************************ -->
    <title>Consulta de tipos de juicios por c&aacute;mara</title>
    <!-- ************************************************************************ -->
    
    <link href="../../../../estilo/estilo.css" rel="stylesheet" type="text/css" />
 </head>
 
 <body onload="javascript: window.print();" style="background: #FFFFFF;">
 
 <?php
 
    include "../../../../config/db.php";
    
    $camara = $_REQUEST['camara'];
    $materia = $_REQUEST['materia'];
    $juicio = $_REQUEST['juicio'];
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
        <tr><th class='tituloReporte'>Consulta de Tipos de Juicios por C&aacute;mara</th></tr>
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
        <td>Tipo de Juicio : </td>
        <td><?php if($juicio=='%'){echo 'Todos los juicios';}else{echo $juicio;} ?></td>
        <!-- *********************************************************************************************** -->
        
    </tr>

 </table>
 
 
 
 <table class='resultadosRep'>
    
    <thead>
        <tr>
            <th style='width:10%'>N°</th>
            <th style='width:10%'>Codigo</th>
            <th style='width:20%'>C&aacute;mara</th>
            <th style='width:15%'>Materia</th>
            <th style='width:30%'>Juicio</th>
            <th style='width:15%'>Fecha de Creaci&oacute;n</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php
            
            $sql = "SELECT ex.codigo,ex.camara,CASE WHEN ex.codigo like '%-CAC-%' THEN 'Civil' WHEN ex.codigo like '%-CAL-%' THEN 'Laboral' WHEN ex.codigo like '%-CAF-%' THEN 'Familia' WHEN ex.codigo like '%-CAM-%' THEN 'Mercantil' END AS materia,ex.juicio, DATE_TRUNC('second', ex.fecha) AS fecha FROM expediente ex WHERE ex.codigo LIKE '$materia' AND ex.juicio LIKE '%$juicio%' AND ex.camara LIKE '%$camara%' AND ex.fecha BETWEEN '$desde 00:00:00' AND '$hasta 23:59:59' ORDER BY materia ASC, fecha ASC";
                    
            $resultado = pg_query($sql) or die ('consulta fallida:'.pg_last_error());
        
            $filas = pg_num_rows($resultado);
                    
            if ($filas >= 1) 
            {
                $total=0;
                            
                while ($_expedientes = pg_fetch_array($resultado))
                {
                    $total = $total +1 ;
                    $codigo1 = $_expedientes["codigo"];
                    $camara1 = $_expedientes["camara"];
                    $materia1 = $_expedientes["materia"];
                    $juicio1 = $_expedientes["juicio"];
                    $fecha1  = $_expedientes["fecha"];
                           
                    ?>
                        
                        <tr>
                            <td><?php echo $total; ?></a></td>
                            <td><?php echo $codigo1; ?></a></td>
                            <td><?php echo $camara1; ?></td>
                            <td><?php echo $materia1; ?></td>
                            <td><?php echo $juicio1; ?></td>
                            <td><?php echo $fecha1; ?></td>
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
    <tr><td colspan="6"> Total <?php echo $total; ?> resultados</td></tr>
    </tfoot>
    
 </table>

 </body>
 </html>
