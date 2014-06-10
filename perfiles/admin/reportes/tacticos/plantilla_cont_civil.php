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
    include "../../../../paginator/paginator.php";
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
                                            01/06/2005 al 30/06/2014
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Materia:
                                        </td>
                                        <td>
                                            Todas las Materias
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            Cámara:
                                        </td>
                                        <td>
                                            Todas las Cámaras
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
                        <td class="cabeza_tabla" style="width: 15%;">
                            Código
                        </td>
                        <td class="cabeza_tabla" style="width: 25%;">
                            Cámara
                        </td>
                        <td class="cabeza_tabla" style="width: 35%;">
                            Juicio
                        </td>
                        <td class="cabeza_tabla" style="width: 8%;">
                            Piezas
                        </td>
                        <td class="cabeza_tabla" style="width: 17%;">
                            Fecha de Creación
                        </td>
                    </tr>
                </tbody>
            </table>
            
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
