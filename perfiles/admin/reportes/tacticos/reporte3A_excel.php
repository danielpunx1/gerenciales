
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
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
    include "../laboraldays2.php";
    
    $materia = $_REQUEST['materia'];
    $colaborador = $_REQUEST['colaborador'];
    
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
        <tr><th class='tituloReporte'>Consulta de expedientes en periodo de expiraci&oacute;n Nueva Normativa</th></tr>
        <!-- *********************************************************************************************** -->
        
    </thead>
 </table>
 
 <table class='datosReporte'>
    
    <tr>
        
        <!-- *********************************************************************************************** -->
        <td>Codigo : </td>
        <td>Nueva Normativa</td>
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
            <th style='width:20%'>Materia</th>
            <th style='width:10%'>Vencimiento</th>
            <th style='width:30%'>Tiempo retenido</th>
        </tr>
    </thead>
    
    <tbody>
        
        <?php
            
            $sql = "SELECT e.codigo, u.nombres || ' ' || u.apellidos as nombre,
                            CASE WHEN e.codigo like '%-CAC-%' THEN 'Civil' WHEN e.codigo like '%-CAL-%' THEN 'Laboral'
                            WHEN e.codigo like '%-CAF-%' THEN 'Familia' WHEN e.codigo like '%-CAM-%' THEN 'Mercantil' END AS materia,
                            e.fecha, now() as hoy 
                            from expediente e 
                            inner join ruta ru on ru.codigo=e.codigo
                            inner join usuario u on u.login=ru.manda 
                            where ru.manda !='archivo' and e.codigo like '$materia' and u.codigo_col like '$colaborador'
                            and e.nuevo_codigo IS true and ru.fechae is null order by nombre";
                    
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
                                
                                $fechar  = $_expedientes["fecha"];
                                $fechae  = $_expedientes["hoy"];
                                $dif=lab($fechar, $fechae, '2014-01-01 00:00:00');
                                $dias=labd($fechar, $fechae, '2014-01-01 00:00:00');
                                
                                
                                if( $dias < 10 )
                                {
                                    $estilos= 'verde';
                                }
                                
                                if( $dias > 9 and $dias < 20 )
                                {
                                    $estilos= 'amarillo';
                                }
                                
                                if( $dias > 19 and $dias < 31 )
                                {
                                    $estilos= 'rojo';
                                }
                           
                    ?>
                        
                        <tr>
                            <td><?php echo $total; ?></a></td>
                            <td ><?php echo $codigo1; ?></a></td>
                            <td ><?php echo $colaborador1; ?></td>
                            <td ><?php echo $materia1; ?></td>                                    
                            <td ><?php echo $estilos; ?> </td>
                            <td ><?php echo $dif; ?></td>
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

