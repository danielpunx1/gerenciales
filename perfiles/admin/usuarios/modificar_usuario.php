<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="../../../estilo/estilo.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../../../js/validacion.js"></script>
<title>SIG para el seguimiento de las casaciones CSJ</title>
</head>

<script>
function modificar_usuario(formulario)
{
	var usuario = formulario.user_mod;
	usuario = usuario.options[usuario.selectedIndex].value; //para calcular valor de select

	var xmlhttp;    
	// if ( usuario == "" )
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
	    document.getElementById("datos_modificar").innerHTML=xmlhttp.responseText;
	  }
	}

	xmlhttp.open("GET","modificar_usuario_ajax.php?usuario="+usuario,true);
	xmlhttp.send();
}
</script>

<body>

<?php

include '../../../config/db.php';

?>

<div id="contenedor">
     <div id="header">
          <div id="header-menu">
               <ul>
                   <li><a href="../../cerrar_sesion.php">Cerrar Sesion</a></li>
                   <li> - </li>
                   <li><a href="../backup/backup.php">Backup</a></li>
                   <li> - </li>
                   <li><a href="../actualizacion/actualizar_bd.php">Actualizar BD</a></li>
                   <li> - </li>
                   <li><a href="../reportes/reportes.php">Reportes</a></li>
                   <li> - </li>
                   <li>
                       <a href="#">Administrar usuarios</a>
                       <ul>
                       	   <li> <a href="nuevo_usuario.php"> Registrar usuario </a> </li>
                       	   <li> <a href="modificar_usuario.php"> Modificar usuario </a> </li>
                       	   <li> <a href="alta_usuario.php"> Activar usuario </a> </li>
                       	   <li> <a href="baja_usuario.php"> Desactivar usuario </a> </li>
                       </ul>
                   </li>
                   <li> - </li>
                   <li><a href="../menu.php">Inicio</a></li>
               </ul>
          </div>
     </div>
     
     <!-- ************************************************************************************************************ -->

     <div id="contenido">
	    <form name="nuevo-usuario" action="modificar_usuario_modificar.php" method="post">
	     	<fieldset>
		     	<table class="formulario" cellpadding="0" cellspacing="0" border="0">
		     		
		     		<tr>
		     			<td class="titulo" colspan="4">
		     				Modificar usuario gerencial
		     			</td>
		     		</tr>

		     		<tr>
		     			<td class="1" colspan="4"> &nbsp;</td>
		     		</tr>

		     		<tr>
		     			<td class="caja1" style="width:115px;">Usuario a modificar</td>
		     			<td class="caja3">
		     				<select name="user_mod" onchange="modificar_usuario(this.form)">
		     					<option value="">Seleccione un usuario</option>
		     					<?php

		     					    $sql ="SELECT nick FROM login WHERE fecha_baja IS NULL";

		     					    $resultado = pg_query($conn, $sql);

                                    while ( $filas = pg_fetch_array($resultado) )
                                    {
                                    	$user = $filas['nick'];

                                    	echo '<option value="'.$user.'">'.$user.'</option>';
                                    }

                                    pg_free_result($resultado);
                                    
                                    pg_close($conn);

		     					?>
		     					
		     				</select>
		     			</td>
		     		</tr>

		     		<tr>
		     			<td class="1" colspan="4"> &nbsp;</td>
		     		</tr>
		     	</table>

		     	<div id="datos_modificar">

		     		<table class="formulario" cellpadding="0" cellspacing="0" border="0">
					
					
			     		<tr>
			     		    <td class="caja1"> Login de usuario : </td>
			     		    <td class="caja2"> <input type="text" name="nick" value="" maxlength="18" disabled="disabled" /> </td>
			     		    <td class="caja1"> Contrase&ntilde;a : </td>
			     		    <td class="caja2"> <input type="password" disabled="disabled" placeholder='Digitar contrase&ntilde;a solo si desea modificar' name="pass" value="" onclick="alert('Dejar el campo en blanco si NO desea modificar su password actual PERO si desea modificarlo por favor ingrese su NUEVO password');" maxlength="18"> </td>
			     		</tr>

			     		<tr>
			     			<td class="caja1"> Nombres : </td>
			     			<td class="caja2"> <input type="text" name="nombres" value="" disabled="disabled" maxlength="50"> </td>
			     			<td class="caja1"> Apellidos : </td>
			     			<td class="caja2"> <input type="text" name="apellidos" value="" disabled="disabled" maxlength="50"> </td>
			     		</tr>

			     		<tr>
			     			<td class="caja1">Acceso : </td>
			     			<td class="caja3" colspan="3">
			     				<input type="radio" name="acceso" value="1" disabled="disabled"> Administrador
			     				<input type="radio" name="acceso" value="2" disabled="disabled"> Usuario Estrategico
			     				<input type="radio" name="acceso" value="3" disabled="disabled"> Usuario Tactico
			     			</td>
			     		</tr>

			     		<tr>
			     			<td class="caja4" colspan="4"> <input type="submit" name="Guardar" disabled="disabled" value="Modificar usuario"> </td>
			     		</tr>
			     	</table>
		     	</div>

		     	
	     	</fieldset>
	    </form>

     </div>

     <!-- ************************************************************************************************************ -->

     <div id="footer1">
           <img alt="" src="../../../imagenes/copi.jpg" />
     </div>
     
     <div id="footer2">
           <img alt="" src="../../../imagenes/csjcivil_14.jpg" />
     </div>
     
</div>

</body>

</html>
