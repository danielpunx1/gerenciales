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
  var inicio = formulario.inicios;
  inicio = inicio.value;
  // fechaI = usuario.options[usuario.selectedIndex].value; //para calcular valor de select

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

  xmlhttp.open("GET","reporte1_grafico_ajax.php?inicio="+inicio,true); //un solo parametro
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
         <div class="col3"><label>Primer dato</label><input type="text" name="1" value=""></div>
         <div class="col3"><label>Calendario1</label><input type="text" name="inicios" value="" id="f_date_a" onkeypress="return no_escribir(event)" placeholder="Click para ingresar fecha"/></div>
         <div class="col3"><label>Calendario2</label><input type="text" name="date" id="f_calcdate" /></div>
         <div class="col3"><label>Primer dato</label><input type="text" name="1" value=""></div>
         <div class="col3"><label>Primer dato</label><input type="text" name="1" value=""></div>
         <div class="col3"><label>Primer dato</label><input type="text" name="1" value=""></div>
         <div class="col3"><label>Primer dato</label><input type="text" name="1" value=""></div>
         <div class="col3"><label>Primer dato</label><input type="text" name="1" value=""></div>
       </div>
       <div class="fila">
         <div class="push5"><input type="button" name="Generar" value="Generar" onclick="generar_grafico(this.form)" /></div>
       </div>
     </form>

<script type="text/javascript">
    function catcalc(cal) {
        var date = cal.date;
        var time = date.getTime()
    }
    Calendar.setup({
        inputField     :    "f_date_a",   // id of the input field
        ifFormat       :    "%Y-%m-%d",       // format of the input field
        onUpdate       :    catcalc
    });
    Calendar.setup({
        inputField     :    "f_calcdate",
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
