



function limpiar(evt){
document.insertardatos.horas.value = "" ;
}

//********************************************************************************************
//********************************************************************************************

//PERMITE INGRESAR SOLO NUMEROS

var nav4 = window.Event ? true : false;

function solo_numeros(evt)
{
	// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 ':'=58
	var key = nav4 ? evt.which : evt.keyCode;
	return (key <= 13 || (key >= 48 && key <= 57) || key == 8 );
}

//********************************************************************************************
//********************************************************************************************

//PERMITE INGRESAR SOLO LETRAS

function solo_letras(evt)
{
	// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 ':'=58
	var key = nav4 ? evt.which : evt.keyCode;
	return ( (key >= 97 && key <= 122) || (key >= 65 && key <= 90) || key == 8 || key == 32 );
}


//********************************************************************************************
//********************************************************************************************

//NO PERMITE BORRAR NI INGRESAR NADA

function no_escribir(evt)
{
	// NOTE: Backspace = 8, Enter = 13, '0' = 48, '9' = 57 ':'=58
	var key = nav4 ? evt.which : evt.keyCode;
	return false;
}

//********************************************************************************************
//********************************************************************************************


function validar_login(form){

	if( form.usuario.value == "" )
	{	alert("Por favor, Ingrese su id de usuario"); form.usuario.focus(); return false; }

	if( form.pass.value == "" )
	{	alert("Por favor, Ingrese su clave de usuario"); form.pass.focus(); return false; }
}



