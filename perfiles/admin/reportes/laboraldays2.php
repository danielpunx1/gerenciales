<?
//Programa que calcula los dias laborales
function lab($fecharecibida,$fechaenviada,$ahora){
$aniolab=0;
$meslab=0;
$diaslab=0;
$horares=0;
$minres=0;

list($fecha1,$hora1)=explode(" ",$fecharecibida);
list($fecha2,$hora2)=explode(" ",$fechaenviada);
list($hora3,$ms1)=explode(".",$hora1);
list($hora4,$ms2)=explode(".",$hora2);

$fecharec=$fecha1;
$fechaen=$fecha2;
$horarec=$hora3;//hora de recepcion
$horaen=$hora4;//hora de envio

list($diar,$mesr,$anior) = explode("/",$fecharec);
list($diae,$mese,$anioe) = explode("/",$fechaen);

if ($anioe<1971){
	$fechaen = $ahora;
	list($diae,$mese,$anioe) = explode("/",$fechaen);
	list($anioe,$horaen) = explode(" ",$anioe);
}

if ($anior<1971){
	$fecharec = $ahora;
	list($diar,$mesr,$anior) = explode("/",$fecharec);
	list($anior,$horarec) = explode(" ",$anior);
}

$hora3=$horarec;
$hora4=$horaen;

list($h1,$m1)=explode(":",$hora3);
list($h2,$m2)=explode(":",$hora4);

$timestamp1=mktime(0,0,0,$mesr,$diar,$anior);
$timestamp2=mktime(0,0,0,$mese,$diae,$anioe);

$dif_secs = $timestamp2 - $timestamp1;
$diastotales=$dif_secs/86400 +1;
$fechainicio=$fecharec;
$diaslab=0;

for ($i=$diastotales;$i>0;$i--){
	list($diai,$mesi,$anioi) = explode("/",$fechainicio);
	if(!checkdate($mesi,$diai,$anioi)){
		if ($mesi>12){
			$diai=1;
			$mesi=1;
			$anioi++;
		}else{
			$diai=1;
			$mesi++;
		}
		$i++;
		$fechainicio=$diai."/".$mesi."/".$anioi;
	}else{
		$diasem= date("w",mktime(0,0,0,$mesi,$diai,$anioi));
		if ($diasem=="6" || $diasem=="0"){
		}else{
			$diaslab++;
		}
		$diai++;
		$fechainicio = $diai."/".$mesi."/".$anioi;
	}
}

if ($diaslab<2){
	$diaslab=0;
}else{
	$diaslab = $diaslab - 2;
}

if ($diar == $diae){
	$horares=($horaen-$horarec);
}else{
	$horares=("16:00:00"-$horarec)+($horaen-"08:00:00");
}

if (($diar == $diae)&&($h1==$h2)){
	$minres=$m2-$m1;
}else{
	$minres=(60-$m1)+$m2;
}

if ($m2<$m1){
	$horares--;
}

if ($minres<60){
	//
}else{
	$minres=$minres-60;
}

if ($horares<8||$diar==$diae){
	//
}else{
	$diaslab++;
	$horares=$horares-8;
}

if ($diaslab>30){
	$meslab=floor($diaslab/30);
	$diaslab=$diaslab%30;
}
$hora3=$horarec;
if ($meslab>12){
	$aniolab=floor($meslab/12);
	$meslab=$meslab%12;
}

if ($aniolab>1){
	$alabel=" años, ";
}else{
	$alabel=" año, ";
}

if ($meslab>1){
	$melabel=" meses, ";
}else{
	$melabel=" mes, ";
}

if ($diaslab>1){
	$dlabel=" dias, ";
}else{
	$dlabel=" dia, ";
}

if ($horares>1){
	$hlabel=" horas y ";
}else{
	$hlabel=" hora y ";
}

if ($minres>1){
	$milabel=" minutos";
}else{
	$milabel=" menos de un minuto";
}

if ($aniolab<>'0'){
	$tiempolaboral=$aniolab.$alabel.$meslab.$melabel.$diaslab.$dlabel.$horares.$hlabel.$minres.$milabel;
}else{
	if ($meslab<>'0'){
		$tiempolaboral=$meslab.$melabel.$diaslab.$dlabel.$horares.$hlabel.$minres.$milabel;
	}else{
		if ($diaslab<>'0'){
			$tiempolaboral=$diaslab.$dlabel.$horares.$hlabel.$minres.$milabel;
		}else{
			if($horares<>'0'){
				$tiempolaboral=$horares.$hlabel.$minres.$milabel;
			}else{

					if ($minres>1){
						$tiempolaboral=$minres.$milabel;
					}else{
						$tiempolaboral=$milabel;
					}
				
			}
		}
	}
}

return $tiempolaboral;

}





//Programa que calcula los dias laborales
function labd($fecharecibida,$fechaenviada,$ahora){
$aniolab=0;
$meslab=0;
$diaslab=0;
$horares=0;
$minres=0;

list($fecha1,$hora1)=explode(" ",$fecharecibida);
list($fecha2,$hora2)=explode(" ",$fechaenviada);
list($hora3,$ms1)=explode(".",$hora1);
list($hora4,$ms2)=explode(".",$hora2);

$fecharec=$fecha1;
$fechaen=$fecha2;
$horarec=$hora3;//hora de recepcion
$horaen=$hora4;//hora de envio

list($diar,$mesr,$anior) = explode("/",$fecharec);
list($diae,$mese,$anioe) = explode("/",$fechaen);

if ($anioe<1971){
    $fechaen = $ahora;
    list($diae,$mese,$anioe) = explode("/",$fechaen);
    list($anioe,$horaen) = explode(" ",$anioe);
}

if ($anior<1971){
    $fecharec = $ahora;
    list($diar,$mesr,$anior) = explode("/",$fecharec);
    list($anior,$horarec) = explode(" ",$anior);
}

$hora3=$horarec;
$hora4=$horaen;

list($h1,$m1)=explode(":",$hora3);
list($h2,$m2)=explode(":",$hora4);

$timestamp1=mktime(0,0,0,$mesr,$diar,$anior);
$timestamp2=mktime(0,0,0,$mese,$diae,$anioe);

$dif_secs = $timestamp2 - $timestamp1;
$diastotales=$dif_secs/86400 +1;
$fechainicio=$fecharec;
$diaslab=0;

for ($i=$diastotales;$i>0;$i--){
    list($diai,$mesi,$anioi) = explode("/",$fechainicio);
    if(!checkdate($mesi,$diai,$anioi)){
        if ($mesi>12){
            $diai=1;
            $mesi=1;
            $anioi++;
        }else{
            $diai=1;
            $mesi++;
        }
        $i++;
        $fechainicio=$diai."/".$mesi."/".$anioi;
    }else{
        $diasem= date("w",mktime(0,0,0,$mesi,$diai,$anioi));
        if ($diasem=="6" || $diasem=="0"){
        }else{
            $diaslab++;
        }
        $diai++;
        $fechainicio = $diai."/".$mesi."/".$anioi;
    }
}

if ($diaslab<2){
    $diaslab=0;
}else{
    $diaslab = $diaslab - 2;
}

if ($diar == $diae){
    $horares=($horaen-$horarec);
}else{
    $horares=("16:00:00"-$horarec)+($horaen-"08:00:00");
}

if (($diar == $diae)&&($h1==$h2)){
    $minres=$m2-$m1;
}else{
    $minres=(60-$m1)+$m2;
}

if ($m2<$m1){
    $horares--;
}

if ($minres<60){
    //
}else{
    $minres=$minres-60;
}

if ($horares<8||$diar==$diae){
    //
}else{
    $diaslab++;
    $horares=$horares-8;
}

if ($diaslab>30){
    $meslab=floor($diaslab/30);
    $diaslab=$diaslab%30;
}
$hora3=$horarec;
if ($meslab>12){
    $aniolab=floor($meslab/12);
    $meslab=$meslab%12;
}


return $diaslab;

}


?>
