<?php

$url = 'https://www.andreabalista.com.br/vendas/views/';

$head = '<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta http-equiv="content-language" content="pt-br" /> 
  <title>Vendas ABC | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="'.$url.'bootstrap/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="'.$url.'dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="'.$url.'dist/css/skins/_all-skins.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="'.$url.'plugins/iCheck/flat/blue.css">
  <!-- Morris chart -->
  <link rel="stylesheet" href="'.$url.'plugins/morris/morris.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="'.$url.'plugins/jvectormap/jquery-jvectormap-1.2.2.css">
  <!-- Date Picker -->
  <link rel="stylesheet" href="'.$url.'plugins/datepicker/datepicker3.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="'.$url.'plugins/daterangepicker/daterangepicker.css">

  <link rel="stylesheet" href="'.$url.'plugins/datatables/dataTables.bootstrap.css">
  
  
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="'.$url.'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.13/jquery-ui.min.js"></script>

<!-- Imprimir Venda -->

  <script type="text/javascript">
    
    function cont(){
       var conteudo = document.getElementById(\'print\').innerHTML;
       tela_impressao = window.open(\'about:blank\');
       tela_impressao.document.write(conteudo);
       tela_impressao.window.print();
       tela_impressao.window.close(); 
    }

</script>

<!-- Imprimir Venda --> 

  <script type="text/javascript">
    $(document).ready(function(){
    $("input[name=\'status[]\']").click(function(){
      var $this = $( this );//guardando o ponteiro em uma variavel, por performance


      var status = $this.attr(\'checked\') ? 1 : 0;
      var id = $this.next(\'input\').val();


      $.ajax({
        url: \'action.php\',
        type: \'GET\',
        data: \'status=\'+status+\'&id=\'+id,
        success: function( data ){
          alert( data );
        }
      });
    });
  }); 
  </script>

  <!-- Lista Cliente CPF -->

<script type="text/javascript">
 
 $(document).ready(function(){  
      window.searchHisteresis = 400;
      window.shouldSearch = true;
      $(\'#infoCliente\').keyup(function(){  
        if(!window.shouldSearch)  return;
        else {
          setTimeout(function(){ window.shouldSearch = true; doSearch(); }, searchHisteresis);
          window.shouldSearch = false;
        }
      });

      function doSearch(){
        var query = $(\'#infoCliente\').val();
        if(query != "")  
        {  
             $.ajax({  
                  url:"'.$url.'../App/Database/search.php",  
                  method:"POST",  
                  data:{query:query},  
                  success:function(data)  
                  {  
                       $(\'#Listdata\').fadeIn();  
                       $(\'#Listdata\').html(data);  
                  }  
             });  
        }
     }


      $(\'#Listdata\').on("click","li", function(){  
           $(\'#infoCliente\').val($(this).text());  
           $(\'#Listdata\').fadeOut();
           $(\'#btnSearchCliente\').click();
           <!-- console.log(event.target);-->
      });
  });  
 </script>

 <!-- FIM Lista Cliente CPF --> 

 <!-- Consulta Qtd venda -->

<script type="text/javascript">

 $(document).ready(function(){

  $("#prodSubmit").click(function()  {
    var prodSubmit = $("#prodSubmit").val();
    var idItem = $("#idItem").val();
    var addedProductData = $("#idItem option:selected").text();
    var availableStock = parseInt(addedProductData.substring(addedProductData.lastIndexOf("(") + 1, addedProductData.lastIndexOf(")")));
    var itemDescription = addedProductData.substring(0, addedProductData.lastIndexOf(" ("));
    var qtd = $("#qtd").val();
    
    if(!idItem){
      alert("Selecione um produto para adicionar ao carrinho.");
      return;
    }
    
    if(!qtd || qtd < 1){
      alert("Selecione uma quantidade válida de itens para adicionar ao carrinho.");
      return;
    }
    
    if(qtd > availableStock){
        alert("Existem apenas "+availableStock+" itens desse produto em estoque.\nNão é possível adicionar "+qtd+" itens ao carrinho.\nCorrija a quantidade e tente novamente.");
        return;
    }
    
    $.ajax({
      type: "POST",
      url: "'.$url.'../App/Database/carrinho.php",
      data: {prodSubmit: prodSubmit, idItem: idItem, qtd:qtd, description: itemDescription},
      success: function(data){
              $(\'#listable\').fadeIn();  
              $(\'#listable\').html(data);
      }
    });
  }); 

  $(\'#listable\').on("click","li", function(){  
    $(\'#idItem\').val($(data).text());
    $(\'#qtd\').val($(data).text());  
    $(\'#listable\').fadeOut();
    
      return false;

    <!-- console.log(event.target);-->
  });           
 });  
 </script>

 <script type="text/javascript">
(function ($) {

    RemoveTableRow = function (handler) {
        var tr = $(handler).closest(\'tr\');

        tr.fadeOut(400, function () {
            tr.remove();
        });

        return false;
    };

    AddTableRow = function () {

        var newRow = $("<tr>");
        var cols = \'<td></td>\';
        var tabela = document.getElementById(\'products-table\');
        var a = (tabela.getElementsByTagName(\'tr\'));
        var b = a.length;
        var i = b - 2;
        var cont = 7 + i;

        cols += \'<td><input type="text" class="form-control" id="idItem" name="idItem[]" autocomplete="off" /></td>\';
        cols += \'<td><input type="text" class="form-control" id="qtd" name="qtd[]" autocomplete="off" /><span id="stv" name="stv[]"></span></td>\';
        cols += \'<td class="actions">\';
        cols += \'<button class="btn btn-danger btn-xs" onclick="RemoveTableRow(this)" type="button"><i class="fa fa-trash"></i></button>\';
        cols += \'</td>\';

        newRow.append(cols);
        $("#products-table").append(newRow);
        return false;
    };


})(jQuery);
</script>

<!-- Consulta Qtd Vendas -->

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn\'t work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->


</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">';

$header = '<header class="main-header">
    <!-- Logo -->
    <a href="#" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>A</b>LT</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Vendas</b>ABC</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="'.$url.''.$foto.'" class="user-image" alt="User Image">
              <span class="hidden-xs">'.$usuario.'</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="'.$url.''.$foto.'" class="img-circle" alt="User Image">

                <p>
                  '.$usuario.'
                  <small>Membro registrado</small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="'.$url.'destroy.php" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
          <li>
            <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
          </li>
        </ul>
      </div>
    </nav>
  </header>';

  $aside = '<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="'.$url.''.$foto.'" class="img-circle" style="height:50px; width:50px;" alt="User Image">
         
        </div>
        <div class="pull-left info">
          <p>'.$usuario.'</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>

        </div>
      </div>
      <!-- search form -->
      <!--<form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>-->
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu">
        <li class="header">MAIN NAVIGATION</li>
        <li class="active treeview">
          <a href="'.$url.'">
            <i class="fa fa-dashboard"></i> <span>Dashboard</span>
            
          </a>
          
        </li>
        
<!-- Produtos -->

        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Produtos</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="'.$url.'prod/"><i class="fa fa-circle-o"></i>Produtos</a></li>
            <!--<li><a href="'.$url.'prod/addprod.php"><i class="fa fa-circle-o"></i>Add Produtos</a></li>-->
            <li><a href="'.$url.'itens/"><i class="fa fa-circle-o"></i>Movimento Estoque</a></li>
             <li><a href="'.$url.'itens/totalitens.php"><i class="fa fa-circle-o"></i>Estoque Consolidado</a></li>
            <!--<li><a href="'.$url.'itens/additens.php"><i class="fa fa-circle-o"></i>Add Itens</a></li>-->
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Fabricante</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="'.$url.'fabricante/"><i class="fa fa-circle-o"></i>Fabricantes</a></li>
            <!--<li><a href="'.$url.'fabricante/addfabricante.php"><i class="fa fa-circle-o"></i>Add Fabricante</a></li>-->
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Representante</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="'.$url.'representante/"><i class="fa fa-circle-o"></i>Representantes</a></li>
            <!--<li><a href="'.$url.'representante/addrepresentante.php"><i class="fa fa-circle-o"></i>Add Representante</a></li>-->
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Usuário</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="'.$url.'usuarios/"><i class="fa fa-circle-o"></i>Usuários</a></li>
            <!--<li><a href="'.$url.'usuarios/addusuarios.php"><i class="fa fa-circle-o"></i>Add Usuário</a></li>-->
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Cliente</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="'.$url.'cliente/"><i class="fa fa-circle-o"></i>Clientes</a></li>
            <!--<li><a href="'.$url.'cliente/addcliente.php"><i class="fa fa-circle-o"></i>Add Cliente</a></li>-->
            
          </ul>
        </li>

        <li class="treeview">
          <a href="#">
            <i class="fa fa-table"></i>
            <span>Vendas</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="'.$url.'vendas/"><i class="fa fa-circle-o"></i>Registrar venda</a></li>
            
          </ul>
        </li>

      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>';

  $footer = '<footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.3.8
    </div>
    <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Create the tabs -->
    <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
      <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
      <li><a href="#control-sidebar-settings-tab" data-toggle="tab"><i class="fa fa-gears"></i></a></li>
    </ul>
    <!-- Tab panes -->
    <div class="tab-content">
      <!-- Home tab content -->
      <div class="tab-pane" id="control-sidebar-home-tab">
        <h3 class="control-sidebar-heading">Recent Activity</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-birthday-cake bg-red"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Langdon\'s Birthday</h4>

                <p>Will be 23 on April 24th</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-user bg-yellow"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Frodo Updated His Profile</h4>

                <p>New phone +1(800)555-1234</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-envelope-o bg-light-blue"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Nora Joined Mailing List</h4>

                <p>nora@example.com</p>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <i class="menu-icon fa fa-file-code-o bg-green"></i>

              <div class="menu-info">
                <h4 class="control-sidebar-subheading">Cron Job 254 Executed</h4>

                <p>Execution time 5 seconds</p>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

        <h3 class="control-sidebar-heading">Tasks Progress</h3>
        <ul class="control-sidebar-menu">
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Custom Template Design
                <span class="label label-danger pull-right">70%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-danger" style="width: 70%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Update Resume
                <span class="label label-success pull-right">95%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-success" style="width: 95%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Laravel Integration
                <span class="label label-warning pull-right">50%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-warning" style="width: 50%"></div>
              </div>
            </a>
          </li>
          <li>
            <a href="javascript:void(0)">
              <h4 class="control-sidebar-subheading">
                Back End Framework
                <span class="label label-primary pull-right">68%</span>
              </h4>

              <div class="progress progress-xxs">
                <div class="progress-bar progress-bar-primary" style="width: 68%"></div>
              </div>
            </a>
          </li>
        </ul>
        <!-- /.control-sidebar-menu -->

      </div>
      <!-- /.tab-pane -->
      <!-- Stats tab content -->
      <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div>
      <!-- /.tab-pane -->
      <!-- Settings tab content -->
      <div class="tab-pane" id="control-sidebar-settings-tab">
        <form method="post">
          <h3 class="control-sidebar-heading">General Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Report panel usage
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Some information about this general settings option
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Allow mail redirect
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Other sets of options are available
            </p>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Expose author name in posts
              <input type="checkbox" class="pull-right" checked>
            </label>

            <p>
              Allow the user to show his name in blog posts
            </p>
          </div>
          <!-- /.form-group -->

          <h3 class="control-sidebar-heading">Chat Settings</h3>

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Show me as online
              <input type="checkbox" class="pull-right" checked>
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Turn off notifications
              <input type="checkbox" class="pull-right">
            </label>
          </div>
          <!-- /.form-group -->

          <div class="form-group">
            <label class="control-sidebar-subheading">
              Delete chat history
              <a href="javascript:void(0)" class="text-red pull-right"><i class="fa fa-trash-o"></i></a>
            </label>
          </div>
          <!-- /.form-group -->
        </form>
      </div>
      <!-- /.tab-pane -->
    </div>
  </aside>
  <!-- /.control-sidebar -->
  <!-- Add the sidebar\'s background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>';

  $javascript = '

  </div>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>

<!-- jQuery UI 1.11.4 -->
<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge(\'uibutton\', $.ui.button);
</script>
<!-- Bootstrap 3.3.6 -->
<script src="'.$url.'bootstrap/js/bootstrap.min.js"></script>
<!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="'.$url.'plugins/morris/morris.min.js"></script>
<!-- Sparkline -->
<script src="'.$url.'plugins/sparkline/jquery.sparkline.min.js"></script>
<!-- jvectormap -->
<script src="'.$url.'plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="'.$url.'plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<!-- jQuery Knob Chart -->
<script src="'.$url.'plugins/knob/jquery.knob.js"></script>
<!-- daterangepicker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
<script src="'.$url.'plugins/daterangepicker/daterangepicker.js"></script>
<!-- datepicker -->
<script src="'.$url.'plugins/datepicker/bootstrap-datepicker.js"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="'.$url.'plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<!-- Slimscroll -->
<script src="'.$url.'plugins/slimScroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="'.$url.'plugins/fastclick/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="'.$url.'dist/js/app.min.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="'.$url.'dist/js/pages/dashboard.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="'.$url.'dist/js/demo.js"></script>
<script src="'.$url.'plugins/datatables/jquery.dataTables.min.js"></script>
<script>
  
  $(function () {
    $(\'#example1\').DataTable()
    $(\'#example2\').DataTable({
      \'paging\'      : true,
      \'lengthChange\': false,
      \'searching\'   : false,
      \'ordering\'    : true,
      \'info\'        : true,
      \'autoWidth\'   : false
    })
  })
</script>

</body>
</html>
';

