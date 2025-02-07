<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once '../../App/auth.php';
require_once '../../layout/script.php';
require_once '../../App/Models/vendas.class.php';
require_once '../../App/Models/cliente.class.php';
require_once '../../App/Models/itens.class.php';

echo $head;
echo $header;
echo $aside;

echo '<div class="content-wrapper">
		<!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Registrar Venda
      </h1>
      <ol class="breadcrumb">
        <li><a href="../"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Itens</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
    ';
    require '../../layout/alert.php';
    echo '
      <!-- Small boxes (Stat box) -->
      <div class="row">
      	<div class="box box-primary">
            
            <!-- /.box-header -->
            <div class="box-body">';

            if(!empty($_SESSION['msg'])){
            echo ' <div class="col-xs-12 col-md-12 text-success">'. $_SESSION['msg'].'</div>';
            unset($_SESSION['msg']);
          }
?>

 <!-- Cliente list PHP -->
<?php

          if(isset($_POST['search'])){ 

            $cliente = new Cliente;
            $resps = $cliente->searchdata($_POST["search"]);  
            
              if($resps > 0 && $_POST['search'] != NULL){
                foreach ($resps['data'] as $resp) { 

                //  $_SESSION['CPF'] = $resp['cpfCliente'];
                 $_SESSION['Cliente'] = $resp['NomeCliente'];
                 $_SESSION['Email'] = $resp['EmailCliente'];
                 $_SESSION['cart'] = MD5('@?#'.$resp['EmailCliente'].'@'.date("d-m-Y H:i:s"));
                }
                
              }
          }

  ?> 
<!-- Cliente list PHP -->


 <!-- Cliente list -->
  <div class="row">

          <form id="form1" action="index.php" method="post">
            <div class="box-body">
            <div class="col-lg-6">
              <div class="input-group">
                <!-- <input type="text" class="form-control" id="cpfCliente" name="search" placeholder="Pesquisar Nome ou E-mail" autocomplete="off"> -->
                <input type="text" class="form-control" id="infoCliente" name="search" placeholder="Pesquisar Nome ou E-mail" autocomplete="off">
                <span class="input-group-btn">
                  <button id="btnSearchCliente" class="btn btn-default" type="submit"><span class="glyphicon glyphicon-floppy-save"></span></button>
                </span>
              </div><!-- /input-group -->
              <div id="Listdata"></div>
            </div><!-- /.col-lg-6 -->
          </div>
          </form> 
 </div>       
<!-- Cliente list FIM -->


            <form id="form2" action="../../App/Database/insertVendas.php" method="POST">
              <div class="box-body">


                <div class="form-group">
                  <label for="exampleInputEmail1">Nome Cliente</label>
                  <input type="text" name="nomeCliente" class="form-control" id="exampleInputnome1" placeholder="Nome Cliente" value="<?php if(isset($_SESSION['Cliente'])){ echo $_SESSION['Cliente']; } ?>"/>
                </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">E-mail</label>
                  <input type="text" name="emailCliente" class="form-control" id="exampleInputEmail1" placeholder="E-mail" value="<?php if(isset($_SESSION['Email'])){ echo $_SESSION['Email']; } ?>" />
                </div>
                <!-- <div class="form-group">
                  <label for="exampleInputEmail1">CPF</label>
                  <input type="number" name="cpfcliente" class="form-control" id="exampleInputcpf1" placeholder="CPF" value="<?php if(isset($_SESSION['CPF'])){ echo $_SESSION['CPF']; } ?>" />
                </div> -->

<!-- Tabela de produtos -->

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">Produtos Disponíveis</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="row">
        
        <div class="form-group col-xs-12 col-sm-4">
          <select id="idItem" name="idItem" class="form-control">
            <option value="">--selecione--</option>
            <?php 
            $itens = new Itens;
            $itens->listaProdutosEstoque()
             ?>
          </select>
        </div>
        <div class="form-group col-xs-12 col-sm-4">
          
          <input type="number" id="qtd" name="qtde" class="form-control" placeholder="Quantidade">
        </div>

        <div class="form-group col-xs-12 col-sm-4">
          <button type="button" id="prodSubmit" name="prodSubmit" value="carrinho" class="btn btn-primary col-xs-12">Adicionar</button>
        </div>
      </div>

        <table class="table table-bordered" id="products-table">
          
          <tr>
            <th style="width: 10px">#</th>
            <th>Cod.</th>
            <th>Descrição</th>
            <th>Qtde.</th>
            <th style="width:40px" title="Remover">Del</th>
          </tr>

          <tbody id="listable">
            
<?php
	/*
	Existe uma atualização no PHP 7.2 que modifica o uso do "count" if(count($_SESSION['itens']) == 0), 
	no caso de você esta utilizando está versão ou superior,
	basta subistituir por "isset" ficando 
	====================================================
		if(isset($_SESSION['itens']) == 0)... 
	====================================================
	ou modificar o código ficando assim
	====================================================
		$pkCount = (isset($_SESSION['itens']) ? count($_SESSION['itens']) : 0);
		if ($pkCount == 0) {...
	====================================================
	*/
	$pkCount = (isset($_SESSION['itens']) ? count($_SESSION['itens']) : 0);
	if ($pkCount == 0) { // Alterado conforme descrito
		echo '<tr>
              		<td colspan="5">
              		<b>Carrinho Vazio</b>
              		</td>
              	</tr>';

        }else{

              $vendas = new Vendas;
              $cont = 1;
              

              foreach ($_SESSION['itens'] as $produtos => $information) {

                
                
                echo '<tr>
                <td>'. $cont .'</td>
                <td>'. $produtos .'</td>                
                <td>'. $information[1] .'</td>
                <td>'. $information[0] .'</td>
                <td>
                <input type="hidden" id="idItem" name="idItem['.$produtos.']" value="'.$produtos.'" /> 
                <input type="hidden" id="qtd" name="qtd['.$produtos.']" value="'.$information[0].'" />
                <a title="Remover item código '. $produtos .'." href="../../App/Database/remover.php?remover=carrinho&id='.$produtos.'"><i class="fa fa-trash text-danger"></i></a>
                </td>
                </tr>';
                $cont = $cont + 1;
              }
              
            } 
            ?>
          </tbody>                  
        </table>
     
    </div>
    <!-- /.box-body -->
  </div>
  <!-- /.box -->

  <!-- Tabela de produtos -->
  <?php
                echo'<input type="hidden" name="iduser" value="'.$idUsuario.'">';
  ?>
                <!-- /.box-body -->

                <div class="box-footer">
                  <button type="submit" name="comprar" class="btn btn-primary" value="Cadastrar">Confirmar compra</button>
                  <a class="btn btn-danger" href="clearCart.php">Cancelar / Limpar carrinho</a>
                </div>
              </form>

<?php
          

        echo'
          </div>
	 
';
echo '</div>';
echo '</section>';
      
       
	  

echo '</div>';
unset($_SESSION['notavd']);
echo  $footer;
echo $javascript;
?>

