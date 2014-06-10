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

<body>

<div id="contenedor2">
     <div id="header2">
          <div id="header-menu">
               <ul>
                   <li><a href="../../cerrar_sesion.php">Cerrar Sesion</a></li>
                   <li> - </li>
                   <li><a href="../backup/backup.php">Backup</a></li>
                   <li> - </li>
                   <li><a href="../actualizacion/actualizar_bd.php">Actualizar BD</a></li>
                   <li> - </li>
                   <li><a href="reportes.php">Reportes</a></li>
                   <li> - </li>
                   <li>
                       <a href="#">Administrar usuarios</a>
                       <ul>
                       	   <li> <a href="../usuarios/nuevo_usuario.php"> Registrar usuario </a> </li>
                       	   <li> <a href="../usuarios/modificar_usuario.php"> Modificar usuario </a> </li>
                       	   <li> <a href="../usuarios/alta_usuario.php"> Activar usuario </a> </li>
                       	   <li> <a href="../usuarios/baja_usuario.php"> Desactivar usuario </a> </li>
                       </ul>
                   </li>
                   <li> - </li>
                   <li><a href="../menu.php">Inicio</a></li>
               </ul>
          </div>
     </div>
      <form name="nuevo-usuario" action="" method="post">
       <div class="fila">
         <div class="col4"><label>Camara &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</label>
            <select name="camara">
              <option value="C1">Camara1</option>
              <option value="C2">Camara2</option>
              <option value="C3">Camara3</option>
              <option value="C4">Camara4</option>
            </select>
         </div>
         <div class="col4"><label>Materia&nbsp;&nbsp;&nbsp;</label>
            <select name="materia">
              <option value="CAC">Civil</option>
              <option value="CAF">Familia</option>
              <option value="CAL">Laboral</option>
              <option value="CAM">Mercantil</option>
              <option value="___">Todas</option>
            </select>
         </div>
         <div class="fila">
         <div class="col4"><label>Colaborador&nbsp;&nbsp;&nbsp;</label>
            <select name="Colaborador">
              <option value="CAC">Colaborador 1</option>
              <option value="CAF">Colaborador 2</option>
              <option value="CAL">Colaborador 3</option>
              <option value="CAM">Colaborador 4</option>
              
            </select>
         </div>

          <div class="col4"><label>Estado juridico&nbsp;&nbsp;&nbsp;</label>
            <select name="Estado juridico">
              <option value="CAC">Estado 1</option>
              <option value="CAF">Estado 2</option>
              <option value="CAL">Estador 3</option>
              <option value="CAM">Estado 4</option>
              
            </select>
         </div>
       </div>
       </div>
       <div class="fila">
         <div class="col4"><label>Fecha inicio</label>  <input type="text" name="fechai" id="fecha_i" value="" style="text-align:center;" onkeypress="return no_escribir(event)"></div>
         <div class="col4"><label>Fecha fin</label>     <input type="text" name="fechaf" id="fecha_f" value="" style="text-align:center;" onkeypress="return no_escribir(event)"></div>
       </div>
       <div class="fila">
         <div class="push5"><input class="margenes" type="button" name="Generar" value="Generar" onclick="generar_grafico(this.form)" /></div>
       </div>
     </form>

<script type="text/javascript">
    function catcalc(cal) {
        var date = cal.date;
        var time = date.getTime()
    }
    Calendar.setup({
        inputField     :    "fecha_i",   // id of the input field
        ifFormat       :    "%Y-%m-%d",       // format of the input field
        onUpdate       :    catcalc
    });
    Calendar.setup({
        inputField     :    "fecha_f",
        ifFormat       :    "%Y-%m-%d",
        onUpdate       :    catcalc
    });
</script>

     <div id="contenido" style="min-height:120px;height:auto;">
       dfsds
     </div>
     


     <div id="footer11">
           <!-- <img alt="" src="../../../imagenes/copi.jpg" /> -->
     </div>
     
     <div id="footer22">
           <!-- <img alt="" src="../../../imagenes/csjcivil_14.jpg" /> -->
     </div>
     
</div>



</body>

</html>
