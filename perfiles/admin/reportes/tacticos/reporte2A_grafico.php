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


  <script type="text/javascript" src="../../../../js/paginador/jquery-1.8.2.min.js"></script>
  <script type="text/javascript" src="../../../../js/paginador/highlight.pack.js"></script>
  <script type="text/javascript" src="../../../../js/paginador/tabifier.js"></script>
  <script src="../../../../js/paginador/js.js"></script>
  <script src="../../../../js/paginador/jPages.js"></script>

  <script>
  $(function(){
    $("div.holder").jPages({
      containerID : "movies",
       midRange     : 15,
      previous : "Anterior",
      next : "Siguiente",
      first : "Primera",
      last : "Ultima",
      perPage : 20,
      delay : 10,
      keyBrowse   : true,
      callback    : function( pages, items ){
        $("#legend2").html("Mostrando resultados del " + items.range.start + " al " + items.range.end + " de " + items.count);
      }
    });
  });
  </script>

</head>

<body style="font-size: 12px;font-family: Helvetica,Arial,sans-serif;color: #000;">

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
    
    <form name="form" id="expediente" action="resultadosexp.php" method="post">
            
        <table class='tablaR'>
            <tr>
                <td class='tituloR'> Reporte de estados de resoluci&oacute;n por casaci&oacute;n</td>
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
                                            <?php 
                                                if($materia=="%-%-%"){echo "Todas las Materias";}
                                                if($materia=="%-CAC-%"){echo "Civil";}
                                                if($materia=="%-CAF-%"){echo "Familia";}
                                                if($materia=="%-CAL-%"){echo "Laboral";}
                                                if($materia=="%-CAM-%"){echo "Mercantil";}
                                            ?>
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
                                    <tr>
                                        <td>
                                            Colaborador:
                                        </td>
                                        <td>
                                            <?php if($colaborador=='%'){echo 'Todos los colaboradores';}else{echo $colaborador;} ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </td>
                    </tr>
                </tbody>
            </table>
            
            <table class="tablaR">
                    <tr>
                        <td class="cabeza_tabla" style="width: 10%;">
                            Código
                        </td>
                        <td class="cabeza_tabla" style="width: 20%;">
                            Colaborador
                        </td>
                        <td class="cabeza_tabla" style="width: 20%;">
                            Cámara
                        </td>
                        <td class="cabeza_tabla" style="width: 20%;">
                            Materia
                        </td>
                        <td class="cabeza_tabla" style="width: 15%;">
                            Estado resoluci&oacute;n
                        </td>
                        <td class="cabeza_tabla" style="width: 15%;">
                            Tiempo retenido
                        </td>
                    </tr>
            </table>
            
            <div id="tresultados">
                
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
                    
                    
                    echo '<table id="resultados" class="tablaR">';
                    echo '<tbody id="movies">';
                    
                    if ($filas >= 1) 
                    {
                            $total=0;
                            
                            while ($_expedientes = pg_fetch_array($resultado))
                            {
                                $total= total + 1;
                                $total2 = ($total % 2);
                                if ($total2 == 1) {
                                    $clase = "resultados";
                                } else {
                                    $clase = "resultados_i";
                                }
                            
                                $codigo1 = $_expedientes["codigo"];
                                $colaborador1 = $_expedientes["nombre"];
                                $materia1 = $_expedientes["materia"];
                                $camara1 = $_expedientes["camara"];
                                $estado1 = $_expedientes["estado"];
                                
                                $fechae  = $_expedientes["fechae"];
                                $fechar  = $_expedientes["fechar"];
                                $dif=lab($fechar, $fechae, '2014-01-01 00:00:00');
                           
                            ?>
                            
                                <tr class="<?php echo $clase; ?>">
                                    <td style="width: 10%;"><?php echo $codigo1; ?></a></td>
                                    <td style="width: 20%;"><?php echo $colaborador1; ?></td>
                                    <td style="width: 20%;"><?php echo $materia1; ?></td>
                                    <td style="width: 20%;"><?php echo $camara1; ?></td>                                    
                                    <td style="width: 15%;"><?php echo $estado1; ?></td>
                                    <td style="width: 15%;"><?php echo $dif; ?></td>
                                </tr>
                            

                            <?php
                            } //fin while
                            echo '</tbody>';
                            echo '</table>';
                            echo '<div class="holder botones_b"></div>';
                            echo '<div id="legend2" class="botones_b" style="margin-top:10px;"></div>';
                        
               
                        
                        echo "
                        <script type=\"text/javascript\">
                        function imprimir() {
                            window.location.assign(\"reporte2A_imprimir.php?materia=$materia&camara=$camara&colaborador=$colaborador&desde=$desde&hasta=$hasta\");
                        }
                        
                        function exportar() {
                            window.location.assign(\"reporte2A_excel.php?materia=$materia&camara=$camara&colaborador=$colaborador&desde=$desde&hasta=$hasta\");
                        }
                        
                        </script>
                        ";
                        
                        ?>
                        <table class="botones_b">
                            <tbody>
                                <tr>
                                    <td>
                                        <span id="t_exp"></span>
                                    </td>
                                    <td>
                                        <input id="boton_b" type="button" value="Exportar a EXCEL" onclick="exportar()" />
                                    </td>
                                    <td>
                                        <input id="boton_b" type="button" value="Imprimir resultados" onclick="imprimir()" />
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        
                        <?php
                        
                        
                    } else {
                        //echo titleInfo("Expedientes ingresados a la Sala", 0);
                        echo "No se encontraron resultados para su consulta.";
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
