<?php
include_once ("site/mmn_db.php");
// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['adminidusername'])) {
        print "
				<script language='javascript'>
					window.location = 'index.php';
				</script>
			";
			
}

date_default_timezone_set('America/Sao_Paulo');
$hoje = date('d/m/Y');

?>
<?php
include_once ("site/config.php");
include_once ("site/site_stats.php");
include_once ("user_info.php");
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<?php
include_once ("site/header.php");
?>
<body>
<div id="wrapper">
     <!-- Navigation -->
<?php
include_once ("menu.php");
?>
        <div id="page-wrapper">
        <div class="graphs">
		<h3>Ativação de Usuário por Liberação de Fatura</h3>
		
<?php
if(isset($_POST['idfatura']))
{
$status = "OK";
$order_id=mysqli_real_escape_string($con,$_POST['idfatura']);
if($status=="OK"){
?>

		<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<h2>Detalhes da Fatura/ Pedido</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>Id</th>
					<th>Valor</th>
					<th>Descrição</th>
					<th>Usuário</th>
					<th>Nome</th>
					<th>Pontos</th>
					<th>Dia</th>
					<th>Status</th>
					</tr>
					</thead>
					<tbody>
<?php
$query="SELECT * FROM  payorders WHERE id='$order_id'";
$result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	
	$f_id="$row[id]";
	$f_valor="$row[valor]";
	$f_tipo="$row[tipo]";
	$f_user="$row[user]";
	$f_nome="$row[nome]";
	$f_status="$row[status]";
	$f_pontos="$row[pontos]";
	$f_dia="$row[dia]";
	$f_valid="$row[valid]";

if($f_status==1)
	{
	$view_status="Pago";
	}
	else if($f_status==0)
	{
	$view_status="Pendente <a href='faturas_ok.php?order=$f_id' class='btn btn-primary'>Ativar/Liberar</a>";
	}
	else
	{
	$view_status="Vencida";
	}
	
print "
  <tr>
  <td>$f_id</td>
  <td>$f_valor</td>
  <td>$f_tipo</td>
  <td>$f_user</td>
  <td>$f_nome</td>
  <td>$f_pontos</td>
  <td>$f_dia</td>
  <td>$view_status</td>
</tr>";
}
?>
					</tbody>
					</table>
					</div>
				</div>
		</div>
<?php
}else{
	print "<div class='alert alert-danger' role='alert'>
        <strong>Erro!</strong> Nenhum dado encontardo!
       </div>";
}
}

?>
		
		
<!-- tabs -->
<div class="grid_3 grid_5">
	     
<div class="but_list">
<div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
			<ul id="myTab" class="nav nav-tabs" role="tablist">
			  <li role="presentation" class="active"><a href="#home" class="btn btn-lg btn-primary" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Últimas Geradas/Pendentes</a></li>
			  <li role="presentation"><a href="#profile2" class="btn btn-lg btn-success" role="tab" id="profile-tab2" data-toggle="tab" aria-controls="profile2">Pagas</a></li>
			  <li role="presentation"><a href="#profile3" class="btn btn-lg btn-success" role="tab" id="profile-tab3" data-toggle="tab" aria-controls="profile3">Vencidas/Inativas</a></li>  
			</ul>
	<div id="myTabContent" class="tab-content">
		
		<div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
		    <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<a data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right" >Buscar Fatura</a>
					<h2>Últimas faturas geradas no Sistema</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>Id</th>
					<th>Valor</th>
					<th>Descrição</th>
					<th>Usuário</th>
					<th>Nome</th>
					<th>Pontos</th>
					<th>Status/Ação</th>
					</tr>
					</thead>
					<tbody>
<?php
$query="SELECT * FROM  payorders WHERE status=0 ORDER BY id DESC";
$result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	
	$f_id="$row[id]";
	$f_valor="$row[valor]";
	$f_tipo="$row[tipo]";
	$f_user="$row[user]";
	$f_nome="$row[nome]";
	$f_status="$row[status]";
	$f_pontos="$row[pontos]";
	$f_dia="$row[dia]";
	$f_valid="$row[valid]";

	$view_status="Pendente <a href='faturas_ok.php?order=$f_id' class='btn btn-primary'>Ativar/Liberar</a>";
	
	
print "
  <tr>
  <td>$f_id</td>
  <td>$f_valor</td>
  <td>$f_tipo</td>
  <td>$f_user</td>
  <td>$f_nome</td>
  <td>$f_pontos</td>
  <td>$view_status</td>
</tr>";
}
?>
					</tbody>
					</table>
					</div>
				</div>
		</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="profile2" aria-labelledby="profile-tab2">
		    <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<a data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right" >Buscar Fatura</a>
					<h2>Últimas faturas pagas</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>Id</th>
					<th>Valor</th>
					<th>Descrição</th>
					<th>Usuário</th>
					<th>Nome</th>
					<th>Pontos</th>
					<th>Status / Ação</th>
					</tr>
					</thead>
					<tbody>
<?php
$query="SELECT * FROM  payorders WHERE status=1 ORDER BY id DESC";
$result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	
	$f_id="$row[id]";
	$f_valor="$row[valor]";
	$f_tipo="$row[tipo]";
	$f_user="$row[user]";
	$f_nome="$row[nome]";
	$f_status="$row[status]";
	$f_pontos="$row[pontos]";
	$f_dia="$row[dia]";
	$f_valid="$row[valid]";


	$view_status="Pago, válido até $f_valid";
	
	
print "
  <tr>
  <td>$f_id</td>
  <td>$f_valor</td>
  <td>$f_tipo</td>
  <td>$f_user</td>
  <td>$f_nome</td>
  <td>$f_pontos</td>
  <td>$view_status</td>
</tr>";
}
?>
					</tbody>
					</table>
					</div>
				</div>
		</div>
		</div>
		<div role="tabpanel" class="tab-pane fade" id="profile3" aria-labelledby="profile-tab3">
		    <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<a data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right" >Buscar Fatura</a>
					<h2>Últimas faturas que venceram = Pacotes expirados</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>Id</th>
					<th>Valor</th>
					<th>Descrição</th>
					<th>Usuário</th>
					<th>Nome</th>
					<th>Pontos</th>
					<th>Status / Ação</th>
					</tr>
					</thead>
					<tbody>
<?php
$query="SELECT * FROM  payorders WHERE status=2 ORDER BY id DESC";
$result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	
	$f_id="$row[id]";
	$f_valor="$row[valor]";
	$f_tipo="$row[tipo]";
	$f_user="$row[user]";
	$f_nome="$row[nome]";
	$f_status="$row[status]";
	$f_pontos="$row[pontos]";
	$f_dia="$row[dia]";
	$f_valid="$row[valid]";


	$view_status="Venceu dia $f_valid";
	
	
print "
  <tr>
  <td>$f_id</td>
  <td>$f_valor</td>
  <td>$f_tipo</td>
  <td>$f_user</td>
  <td>$f_nome</td>
  <td>$f_pontos</td>
  <td>$view_status</td>
</tr>";
}
?>
					</tbody>
					</table>
					</div>
				</div>
		</div>
		</div>
		  
	</div>
</div>
</div>
</div>
<!-- tabs -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
					<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Buscar Fatura via ID</h2>
				</div>
				<div class="modal-body">
				
					<form class="form-horizontal" method="post" action="">
							<fieldset>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-4 control-label">ID da Fatura/Pedido:</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Coloque aqui o número ID da Fatura ou Pedido" name="idfatura">
									</div>
									
								</div>
								
								<p># insira o nº ID da fatura/Pedido e clique em BUSCAR</p>
								
								<button type="submit" class="btn btn-primary">BUSCAR</button>
	 
							</fieldset>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
</div>		
<?php
include_once ("site/footer.php");
?>
		</div>
       </div>
      <!-- /#page-wrapper -->
   </div>
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
