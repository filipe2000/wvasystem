<?php
function limitarTexto($texto, $limite){
	$contador=strlen($texto);
	if ($contador>= $limite) {
		$texto=substr($texto,0,strrpos(substr($texto,0, $limite),' ')).'...';
		return $texto;
	}
}

?>