
<?php

include '../../../config/db.php';

$usuario = $_GET['usuario'];



if( $usuario != "" )
{
	$sql = "SELECT nick,nombres,apellidos,acceso FROM login WHERE nick='$usuario' ";

	$resultado = pg_query($conn, $sql);

	$filas = pg_fetch_array($resultado);

	?>
						<table class="formulario" cellpadding="0" cellspacing="0" border="0">
			     		<tr>
			     		    <td class="caja1"> Login de usuario : </td>
			     		    <td class="caja2"> <input type="text" name="nick" <?php echo 'value="'.$filas['nick'].'"'; ?> disabled="disabled" maxlength="18" /> </td>
			     		    <td class="caja1"> Contrase&ntilde;a : </td>
			     		    <td class="caja2"> <input type="password" placeholder='Digitar contrase&ntilde;a solo si desea modificar' name="pass" value="" disabled="disabled" onclick="alert('Dejar el campo en blanco si NO desea modificar su password actual PERO si desea modificarlo por favor ingrese su NUEVO password');" maxlength="18"> </td>
			     		</tr>

			     		<tr>
			     			<td class="caja1"> Nombres : </td>
			     			<td class="caja2"> <input type="text" name="nombres" <?php echo 'value="'.$filas['nombres'].'"'; ?> disabled="disabled" onkeypress="return solo_letras(event)" maxlength="50"> </td>
			     			<td class="caja1"> Apellidos : </td>
			     			<td class="caja2"> <input type="text" name="apellidos" <?php echo 'value="'.$filas['apellidos'].'"'; ?> disabled="disabled" onkeypress="return solo_letras(event)" maxlength="50"> </td>
			     		</tr>

			     		<tr>
			     			<td class="caja1">Acceso : </td>
			     			<td class="caja3" colspan="3">
			     				<input type="radio" name="acceso" <?php if($filas['acceso']==1){ echo 'checked="checked"'; } ?> disabled="disabled" value="1" > Administrador
			     				<input type="radio" name="acceso" <?php if($filas['acceso']==2){ echo 'checked="checked"'; } ?> disabled="disabled" value="2" > Usuario Estrategico
			     				<input type="radio" name="acceso" <?php if($filas['acceso']==3){ echo 'checked="checked"'; } ?> disabled="disabled" value="3" > Usuario Tactico
			     			</td>
			     		</tr>

			     		<tr>
			     			<td class="caja4" colspan="4"> <input type="submit" name="Guardar" value="Activar usuario"> </td>
			     		</tr>
			     	</table>

	<?php
}
else //SI EL USUARIO QUE ESCOGIO ESTA VACIO O EN BLANCO
{
	?>
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
			     			<td class="caja4" colspan="4"> <input type="submit" name="Guardar" disabled="disabled" value="Activar usuario"> </td>
			     		</tr>
			     	</table>

	<?php
}



?>


