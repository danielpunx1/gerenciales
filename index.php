<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<link href="estilo/estilo.css" rel="stylesheet" type="text/css" />
<script language="javascript" type="text/javascript" src="js/validacion.js"></script>
<title>SIG para el seguimiento de las casaciones CSJ</title>
</head>

<body>

<div id="contenedor">
     <div id="header">
          
     </div>
     
     <div id="logo">
          <img alt="Sala de Lo Civil" src="imagenes/csj4.jpg" />
     </div>
     <div id="login">
        <form  name="validar-usuario" action="perfiles/validar_sesion.php" method="post" onsubmit="return validar_login(this)">
          <table style="margin-left:50px;margin-top:125px;" cellpadding="0" cellspacing="0" border="0">
               <tr>
                   <td class="celda0" colspan="2">Logueo de miembros &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
               </tr>
               <tr>
                   <td class="celda1">Usuario</td>
                   <td class="celda2"> <input type="text" name="usuario" value="" style="width:190px;margin-left:3px;" /> </td>
               </tr>                
               <tr>
                   <td class="celda1">Contrase&ntilde;a</td>
                   <td class="celda2"> <input type="password" name="pass" value="" style="width:190px;margin-left:3px;"/> </td>
               </tr>
               <tr>
                   <td colspan="2" align="right"> <input type="submit" value="Iniciar sesion" style="margin-right:10px;margin-top:10px;" /> </td>
               </tr>
               <tr>
                 <td colspan="2" class="errores">
                   <?php
                      session_start();

                      if( isset( $_SESSION['errores'] ) )
                      {
                        echo $_SESSION['errores'];
                      }
                   ?>
                 </td>
               </tr>
          </table>
        </form>
     </div>
     
     <div id="footer1">
           <!-- <img alt="" src="imagenes/copi.jpg" /> -->
     </div>
     
     <div id="footer2">
           <!-- <img alt="" src="imagenes/csjcivil_14.jpg" /> -->
     </div>
     
</div>

</body>

</html>
