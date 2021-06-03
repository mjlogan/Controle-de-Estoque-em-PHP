<?php
require_once '../auth.php';
require_once '../../App/Models/vendas.class.php';

if(!isset($_SESSION['itens']))
{
	$_SESSION['itens'] = array();
}


if(isset($_POST['prodSubmit']) && $_POST['prodSubmit'] == "carrinho"){

	$qtd    = $_POST['qtd'];
	$idProduto = $_POST['idItem'];
	$itemDescription = $_POST['description'];

	if(!isset($_SESSION['itens'][$idProduto])){
		$_SESSION['itens'][$idProduto] = array($qtd, $itemDescription);
	}else{
		$_SESSION['itens'][$idProduto] = array($qtd, $itemDescription);
	}
}	

$pkCount = (is_array($_SESSION['itens']) ? count($_SESSION['itens']) : 0);
  if ($pkCount == 0) {
	echo ' Carrinho Vazio</br> ';

}else{

	$vendas = new Vendas;
	$cont = 1;
	foreach ($_SESSION['itens'] as $produtos => $information) {
		
			echo '<tr>
			<td>'.$cont.'</td>
			<td>'.$produtos.'</td>
			<td>'.$information[1].'</td>
			<td>'.$information[0].'</td>
			<td><input type="hidden" id="idItem" name="idItem['.$produtos.']" value="'.$produtos.'" />
			<input type="hidden" id="qtd" name="qtd['.$produtos.']" value="'.$information[0].'" />
			<a href="../../App/Database/remover.php?remover=carrinho&id='.$produtos.'"><i class="fa fa-trash text-danger"></i></a></td>
			</tr>';	
			$cont = $cont + 1;
		
	}
}
?>
