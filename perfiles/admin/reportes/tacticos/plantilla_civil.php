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

<script>
function generar_grafico(formulario)
{
  var camaras = formulario.camara;
  var materias = formulario.materia;
  var juicios = formulario.juicio;
  var fechainicial = formulario.fechai;
  var fechafinal = formulario.fechaf;

  camaras = camaras.options[camaras.selectedIndex].value;
  materias = materias.options[materias.selectedIndex].value;
  juicios = juicios.value;
  fechainicial = fechainicial.value;
  fechafinal = fechafinal.value;

  var xmlhttp;    
  // if ( inicio == "" )
  // {
  //   document.getElementById("txtHint").innerHTML="";
  //   return;
  // }
  if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp=new XMLHttpRequest();
  }
  else
  {// code for IE6, IE5
    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange=function()
  {
    if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
      document.getElementById("contenido").innerHTML=xmlhttp.responseText;
    }
  }

  xmlhttp.open("GET","reporte1_grafico_ajax.php?camara="+camaras+"&materia="+materias+"&juicio="+juicios+"&fechai="+fechainicial+"&fechaf="+fechafinal,true); //un solo parametro
  // xmlhttp.open("GET","reporte1_grafico_ajax.php?inicio="+inicio+"&vari="+vari+"&otra="+otra,true); //varios parametros
  xmlhttp.send();
}
</script>

</head>

<body style="font-size: 12px;font-family: Helvetica,Arial,sans-serif;color: #000;">

<?php
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
            
            <input type="hidden" name="aniocal" value="<?php echo date('m/d/Y'); ?>" />
            
            <div id='tresultados'>
            
            <table class='tablam tablaFrmEst'>
                <tr>
                    <td>Materia:</td>
                    <td>
                        <SELECT size="1" NAME="materia" style="width: 250;">
                            <OPTION VALUE="1" SELECTED>Civil</OPTION>
                            <OPTION VALUE="2">Familia</OPTION>
                            <OPTION VALUE="3">Laboral</OPTION>
                            <OPTION VALUE="4">Mercantil</OPTION>
                            <OPTION VALUE="" title="Se incluyen todas las Materias en la B&uacute;squeda.">Todas</OPTION>
                        </SELECT><br />
                    </td>
                </tr>
                <tr>
                    <td>C&aacute;mara:</td>
                    <td>
                    <SELECT size="1" NAME="camara" style="width: 250;">
                        <OPTION value=" ">Seleccione una C&aacute;mara</OPTION>
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
                        <OPTION value="" title="Se incluyen todas las C&aacute;maras en la B&uacute;squeda.">Todas</OPTION>
                        </OPTGROUP>
                    </SELECT><br />
                    </td>
                </tr>
                <tr>
                    <td>Desde:</td>
                    <td>
                        <input type="text" NAME="desde" id="desde" maxlength="10" readonly style="width: 250;" class="required validate-date-au" title="Fecha de inicio para la busqueda. p.ej. 17/03/2007 (17 de Marzo de 2007)."/>
                    </td>
                </tr>
                <tr>
                    <td>Hasta:</td>
                    <td>
                        <input type="text" NAME="hasta" id="hasta" maxlength="10" readonly style="width: 250;" class="required validate-date-au" title="Fecha de fin para la busqueda. p.ej. 05/04/2007 (05 de Abril de 2007)."/>
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
                            <input id="boton_b" type="button" value="Consultar" onclick="validacion_consultaexp(this.form);;"></input>
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
