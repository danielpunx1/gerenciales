<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />

<title>SIG para el seguimiento de las casaciones CSJ</title>

<link href="../../../../estilo/estilo.css" rel="stylesheet" type="text/css" />
<link href="../../../../estilo/grid.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="../../../../js/validacion.js"></script>

<!-- calendar stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="../../../../js/jscalendar//calendar-blue2.css" title="win2k-cold-1" />
<!-- main calendar program -->
<script type="text/javascript" src="../../../../js/jscalendar/calendar.js"></script>
<!-- language for the calendar -->
<script type="text/javascript" src="../../../../js/jscalendar/lang/calendar-es.js"></script>
<!-- the following script defines the Calendar.setup helper function, which makes adding a calendar a matter of 1 or 2 lines of code. -->
<script type="text/javascript" src="../../../../js/jscalendar/calendar-setup.js"></script>

</head>

<body style="font-size: 12px;font-family: Helvetica,Arial,sans-serif;color: #000;">

<?php

    include "../../../../paginator/paginator.php";
    include "../../../../paginator/paginator_html3.php";
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
<div id="contenidoR">
    <table class="cabecera_R">
        <tr>
            <td rowspan="3"><img border="0" src="../../../../imagenes/escudo.png"></td>
            <td>
                SISTEMA DE INFORMACI&Oacute;N DE EXPEDIENTES JUDICIALES
            </td>
            <td rowspan="3">
                <img border="0" src="../../../../imagenes/images-76x74.png">
            </td>
        </tr>
        <tr>
            <td style="font-size: 14px;">
                SALA DE LO CIVIL
            </td>
        </tr>
        <tr>
            <td style="font-size: 11px; font-style: italic;">
            <?php 
                echo $dias[date('w')].", ".strftime(" %d ")." de ".$meses[date('n')-1]." de " .strftime(" %Y")." ".date('g:i a'); 
            ?>
            </td>
        </tr>
    </table>
    
    <form name="form" id="expediente" action="resultadosexp.php" method="post">
            
        <table class='tablaR'>
            <tr>
                <td class='tituloR'> Consulta de Expedientes ingresados a la Sala </td>
            </tr>
        </table>
        <div id='contenido3R'></div>
        
        <div id="datos">
            <table class="tablaR">
                <tbody>
                    <tr>
                        <td>
                            <table class="datosReporte">
                                <tbody>
                                    <tr>
                                        <td>
                                            Período:
                                        </td>
                                        <td>
                                            <?php echo $desde.' al '.$hasta; ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Materia:
                                        </td>
                                        <td>
                                            <?php if($materia=="%"){echo "Todas las materias";}else{echo $materia;} ?>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Cámara:
                                        </td>
                                        <td>
                                            <?php if($camara=="%"){echo "Todas las C&aacute;maras";}else{echo $camara;} ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <table class="tablaR">
                <tbody>
                    <tr>
                        <td class="cabeza_tabla" style="width: 20%;">
                            Código
                        </td>
                        <td class="cabeza_tabla" style="width: 20%;">
                            Cámara
                        </td>
                        <td class="cabeza_tabla" style="width: 20%;">
                            Materia
                        </td>
                        <td class="cabeza_tabla" style="width: 20%;">
                            Juicio
                        </td>
                        <td class="cabeza_tabla" style="width: 20%;">
                            Fecha de Creación
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <div id="tresultados">
                
                <?php
                    
                    $sql = "SELECT ex.codigo,ex.camara,CASE WHEN ex.codigo like '%-CAC-%' THEN 'Civil' WHEN ex.codigo like '%-CAL-%' THEN 'Laboral' WHEN ex.codigo like '%-CAF-%' THEN 'Familia' WHEN ex.codigo like '%-CAM-%' THEN 'Mercantil' END AS materia,ex.juicio, DATE_TRUNC('second', ex.fecha) AS fecha FROM expediente ex WHERE ex.codigo LIKE '%-$materia-%' AND ex.juicio LIKE '%$juicio%' AND ex.camara LIKE '%$camara%' AND ex.fecha BETWEEN '$desde 00:00:00' AND '$hasta 23:59:59' ORDER BY materia ASC, fecha ASC";
                    
                     $resultado = pg_query($sql) or die ('consulta fallida:'.pg_last_error());
        
                    $filas = pg_num_rows($resultado);
                    
                    if ($filas >= 1) 
                    {
                        $a =& new Paginator_html3($_GET['page'], $filas);
                        
                        //===========enviando los parametros para la siguiente pag.==================//
                        
                        $a->getParams($tipo, $materia, $camara, $juicio,$desde, $hasta);
                        
                        $a->set_Limit(20);
                        
                        $limit1 = $a->getRange1();
                        
                        $limit2 = $a->getRange2();
                        //==========================================================================//
                        
                        $total = 0;
                        for ($j = $limit1; $j < $limit1 + $limit2; $j++) {
                            $total +=1;
                            
                            $total2 = ($total % 2);
                            if ($total2 == 1) {
                                $clase = "resultados";
                            } else {
                                $clase = "resultados_i";
                            }
                            
                            $_expedientes = pg_fetch_array($resultado, $j, PGSQL_ASSOC);
                            
                            $codigo = $_expedientes["codigo"];
                            $camara = $_expedientes["camara"];
                            $juicio = $_expedientes["materia"];
                            $piezas = $_expedientes["juicio"];
                            $fecha  = $_expedientes["fecha"];
                            if ($camara == "%") {
                            ?>
                            <table id="resultados<?php echo $total; ?>" class="tabla">
                                <tr class="<?php echo $clase; ?>">
                                    <td style="width: 20%;"><?php echo $codigo; ?></a></td>
                                    <td style="width: 20%;"><?php echo $camara; ?></td>
                                    <td style="width: 20%;"><?php echo $materia; ?></td>
                                    <td style="width: 20%;"><?php echo $juicio; ?></td>
                                    <td style="width: 20%;"><?php echo $fecha; ?></td>
                                </tr>
                            </table>
                            <?php
                            } else {
                            ?>
                            <table id="resultados<?php echo $total; ?>" class="tabla">
                                <tr class="<?php echo $clase; ?>">
                                    <td style="width: 20%;"><?php echo $codigo; ?></a></td>
                                    <td style="width: 20%;"><?php echo $camara; ?></td>
                                    <td style="width: 20%;"><?php echo $materia; ?></td>
                                    <td style="width: 20%;"><?php echo $juicio; ?></td>
                                    <td style="width: 20%;"><?php echo $fecha; ?></td>
                                </tr>
                            </table>
                            <?php
                            }
                        }
                        
                        //=========================================================
                        $a->firstLast();
                        //=========================================================
                        
                        echo "
                        <script type=\"text/javascript\">
                        function imprimir() {
                            window.location.assign(\"printresultadosexp.php?materia=$materia&camara=$frmCamara&desde=$fechaini&hasta=$fechafin\");
                        }
                        </script>
                        ";
                        
                        echo botonesOpcion("down", 1, "", "", "Imprimir Resultados", "boton_b","imprimir()");
                    } else {
                        echo titleInfo("Expedientes ingresados a la Sala", 0);
                        echo noDatos("No se encontraron resultados para su consulta.");
                    }
                    
                    pg_free_result($resultado);
                
                ?>
                
            </div>
            
        </div><!-- FIN DIV DATOS -->
            
      
            
            
            <table class="pie_">
                <tbody>
                    <tr>
                        <td>
                            ® Corte Suprema de Justicia - Sala de lo Civil
                        </td>
                    </tr>
                </tbody>
            </table>
            
            
            
            </form>

</div> <!-- fin contenidoR -->

</body>

</html>
