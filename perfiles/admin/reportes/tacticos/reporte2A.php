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
    
    include "../../../../config/db.php";
    
    //para mostrar la fecha y hora
    date_default_timezone_set("America/El_Salvador");
    $dias= array("Domingo","Lunes","Martes","Mi&eacute;rcoles","Jueves","Viernes","S&aacute;bado");
    $meses=array("enero","febrero","marzo","abril","mayo","junio","julio","agosto","septiembre","octubre","noviembre","diciembre");
?>
<div id="contenidoR">
    <table class="cabecera_">
        <tr>
            <td rowspan="3"><img border="0" src="../../../../imagenes/escudo.png"></td>
            <td>
                SISTEMA GERENCIAL DE CASACIONES
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
    
    <form name="form" id="expediente" action="reporte2A_grafico.php" method="POST" onsubmit="return validar_reporte1(this)">
            
        <table class='tablaR'>
            <tr>
                <td class='tituloR'> Reporte de estados de resoluci&oacute;n por casaci&oacute;n </td>
            </tr>
        </table>
        <div id='contenido3R'></div>
            
            <div id='tresultados'>
            
            <table class='tablam tablaFrmEst'>
                <tr>
                    <td>Colaborador:</td>
                    <td>
                        <select name="colaborador">
                            <OPTGROUP label="----------------------------------------------------">
                            <option value="">Seleccione un colaborador</option>
                            </OPTGROUP>
                            <OPTGROUP label="----------------------------------------------------">
                            <option value="%">Todos los colaboradores</option>
                            </OPTGROUP>
                            <OPTGROUP label="----------------------------------------------------">
                            <?php
                                
                                $sql = "select nombres,apellidos,codigo_col from usuario";
                                $res = pg_query($conn,$sql);

                                while ($filas = pg_fetch_array($res) )
                                {
                                echo '<option value="'.$filas['codigo_col'].'">'.$filas['nombres'].' '.$filas['apellidos'].'</option>';
                                }
                            ?>
                            </OPTGROUP>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>Materia:</td>
                    <td>
                        <SELECT size="1" NAME="materia" style="width: 250;">
                            <OPTION VALUE="" SELECTED>Seleccionar materia</OPTION>
                            <OPTION VALUE="%-CAC-%">Civil</OPTION>
                            <OPTION VALUE="%-CAF-%">Familia</OPTION>
                            <OPTION VALUE="%-CAL-%">Laboral</OPTION>
                            <OPTION VALUE="%-CAM-%">Mercantil</OPTION>
                            <OPTION VALUE="%-%-%" title="Se incluyen todas las Materias en la B&uacute;squeda.">Todas</OPTION>
                        </SELECT><br />
                    </td>
                </tr>
                <tr>
                    <td>C&aacute;mara:</td>
                    <td>
                    <SELECT size="1" NAME="camara" style="width: 250;">
                        <OPTION value="">Seleccione una C&aacute;mara</OPTION>
                        <OPTGROUP label="Zona Central">
                        <OPTION value="Primera de lo Civil de 1&#176; Secci&oacute;n del Centro">Primera de lo Civil de 1&#176; Secci&oacute;n del Centro</OPTION>
                        <OPTION value="Segunda de lo Civil de 1&#176; Secci&oacute;n del Centro">Segunda de lo Civil de 1&#176; Secci&oacute;n del Centro</OPTION>
                        <OPTION value="Tercera de lo Civil de 1&#176; Secci&oacute;n del Centro">Tercera de lo Civil de 1&#176; Secci&oacute;n del Centro</OPTION>
                        <OPTION value="Familia de la Secci&oacute;n del Centro">Familia de la Secci&oacute;n del Centro</OPTION>
                        <OPTION value="Primera de lo laboral">Primera de lo laboral</OPTION>
                        <OPTION value="Segunda de lo laboral">Segunda de lo laboral</OPTION>
                        </OPTGROUP>
                        <OPTGROUP label="Santa Ana">
                        <OPTION value="Civil de la 1&#176; Secci&oacute;n de Occidente">Civil de la 1&#176; Secci&oacute;n de Occidente</OPTION>
                        <OPTION value="Familia de la Secci&oacute;n de Occidente">Familia de la Secci&oacute;n de Occidente</OPTION>
                        </OPTGROUP>
                        <OPTGROUP label="Sonsonate">
                        <OPTION value="Segunda Secci&oacute;n de Occidente">Segunda Secci&oacute;n de Occidente</OPTION>
                        </OPTGROUP>
                        <OPTGROUP label="Ahuachapan">
                        <OPTION value="Tercera Secci&oacute;n de Occidente">Tercera Secci&oacute;n de Occidente</OPTION>
                        </OPTGROUP>
                        <OPTGROUP label="San Miguel">
                        <OPTION value="Civil de la 1&#176; Secci&oacute;n de Oriente">Civil de la 1&#176; Secci&oacute;n de Oriente</OPTION>
                        <OPTION value="Segunda instancia de la 3&#176; Secci&oacute;n de Oriente">Segunda instancia de la 3&#176; Secci&oacute;n de Oriente</OPTION>
                        <OPTION value="Familia de Secci&oacute;n de Oriente">Familia de Secci&oacute;n de Oriente</OPTION>
                        </OPTGROUP>
                        <OPTGROUP label="Usulut&aacute;n">
                        <OPTION value="Segunda Secci&oacute;n de Oriente">Segunda Secci&oacute;n de Oriente</OPTION>
                        </OPTGROUP>
                        <OPTGROUP label="Cuscatl&aacute;n">
                        <OPTION value="Segunda Secci&oacute;n del Centro">Segunda Secci&oacute;n del Centro</OPTION>
                        </OPTGROUP>
                        <OPTGROUP label="San Vicente">
                        <OPTION value="Tercera Secci&oacute;n del Centro">Tercera Secci&oacute;n del Centro</OPTION>
                        </OPTGROUP>
                        <OPTGROUP label="La Libertad">
                        <OPTION value="Cuarta Secci&oacute;n del Centro">Cuarta Secci&oacute;n del Centro</OPTION>
                        </OPTGROUP>
                        <OPTGROUP label="--------------------------------------------">
                        <OPTION value="%" title="Se incluyen todas las C&aacute;maras en la B&uacute;squeda.">Todas</OPTION>
                        </OPTGROUP>
                    </SELECT><br />
                    </td>
                </tr>
                    <td>Desde:</td>
                    <td>
                        <input type="text" NAME="desde" id="desde" maxlength="10" value="" readonly style="width: 250;" title="Fecha de inicio para la busqueda"/>
                    </td>
                </tr>
                <tr>
                    <td>Hasta:</td>
                    <td>
                        <input type="text" NAME="hasta" id="hasta" maxlength="10" value="" readonly style="width: 250;" title="Fecha de fin para la busqueda"/>
                    </td>
                </tr>
            </table>
            
            
            </div>
            <table class="botones_b">

                <tbody>
                    <tr>
                        <td>
                            <span id="t_exp"></span>
                        </td>
                        <td>
                            <input id="boton_b" type="submit" value="Consultar" />
                        </td>
                    </tr>
                </tbody>

            </table>
            
            <table class="pie_">
                <tbody>
                    <tr>
                        <td>
                            ® Corte Suprema de Justicia - Sala de lo Civil
                        </td>
                    </tr>
                </tbody>
            </table>
            
            
            <script language="JavaScript">
                Calendar.setup
                ({
                inputField     :    'hasta',
                ifFormat     :     '%d/%m/%Y',
                button     :    'hasta'
                });
                </script>
                        
                <script language="JavaScript">
                Calendar.setup
                ({
                inputField     :    'desde',
                ifFormat     :     '%d/%m/%Y',
                button     :    'desde'
                });
            </script>
            </form>

</div> <!-- fin contenidoR -->

</body>

</html>
