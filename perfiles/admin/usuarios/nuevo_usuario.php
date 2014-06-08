<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="../../../estilo/estilo.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="../../../js/validacion.js"></script>
<title>SIG para el seguimiento de las casaciones CSJ</title>
</head>

<body>

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
	    <form name="nuevo-usuario" action="nuevo_usuario_insertar.php" method="post">
	     	<fieldset>
		     	<table class="formulario" cellpadding="0" cellspacing="0" border="0">
		     		
		     		<tr>
		     			<td class="titulo" colspan="4">
		     				Registrar nuevo usuario gerencial
		     			</td>
		     		</tr>
			
		     		<tr>
		     		    <td class="caja1"> Login de usuario : </td>
		     		    <td class="caja2"> <input type="text" name="nick" value="" maxlength="18" /> </td>
		     		    <td class="caja1"> Contrase&ntilde;a : </td>
		     		    <td class="caja2"> <input type="password" name="pass" value="" maxlength="18"> </td>
		     		</tr>

		     		<tr>
		     			<td class="caja1"> Nombres : </td>
		     			<td class="caja2"> <input type="text" name="nombres" value="" maxlength="50" onkeypress="return solo_letras(event)" > </td>
		     			<td class="caja1"> Apellidos : </td>
		     			<td class="caja2"> <input type="text" name="apellidos" value="" maxlength="50" onkeypress="return solo_letras(event)" > </td>
		     		</tr>

		     		<tr>
		     			<td class="caja1">Acceso : </td>
		     			<td class="caja3" colspan="3">
		     				<input type="radio" name="acceso" value="1"> Administrador
		     				<input type="radio" name="acceso" value="2"> Usuario Estrategico
		     				<input type="radio" name="acceso" value="3"> Usuario Tactico
		     			</td>
		     		</tr>

		     		<tr>
		     			<td class="caja4" colspan="4"> <input type="submit" name="Guardar" value="Guardar usuario"> </td>
		     		</tr>
		     	

		     	</table>
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
