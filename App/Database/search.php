<?php
require_once '../auth.php';
require_once('../Models/cliente.class.php');

$cliente = new Cliente;
 
if($_POST["query"]){

	$resp = $cliente->search($_POST["query"]);
	echo '<ul id="pesqcpf" class="list-unstyled ulcpf">';
	if($resp == 0){
		echo '<li id="no-results" class="licpf">Nenhum resultado encontrado!</li>';
	}else{

		foreach ($resp['data'] as $user){
			echo  '<li id="li['. $user['idCliente'] .']" class="licpf">'. $user['EmailCliente'] .' - '. $user['NomeCliente'] . '</li>';
		}
		echo '</ul>';
		echo('<script>$("#no-results").remove();</script>');
	}
}

?>