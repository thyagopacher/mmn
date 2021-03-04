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
		<h3>Pacotes / Planos</h3>

		<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<a data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right" >CRIAR NOVO PACOTE</a>
					<h2>Pacotes do Sistema</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>Id</th>
					<th>Nome</th>
					<th>Valor</th>
					<th>QTD Pontos = Cotas</th>
					<th>Validade</th>
					<th>Status</th>
					<th>Ação</th>
					</tr>
					</thead>
					<tbody>
<?php $query="SELECT * FROM  packages ORDER BY id DESC"; 
 
 
 $result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	
	$pack_id="$row[id]";
	$pack_name="$row[name]";
	$pack_price="$row[price]";
	$pack_pontos="$row[sbonus]";
	$pack_status="$row[active]";
	$pack_valid="$row[validity]";
	
	if($pack_status==1)
	{
	$p_status="Ativo";
	$boton="<a href='packs_off.php?pack=$pack_id' class='btn btn-danger'>Desativar</a>";
	}
	else if($pack_status==0)
	{
	$p_status="Inativo";
	$boton="<a href='packs_on.php?pack=$pack_id' class='btn btn-primary'>Ativar</a>";
	}
	else
	{
	$v_status="Unknown";
	}
	
  print "
  <tr>
					
					
					<td>$pack_id</td>
					<td>$pack_name</td>
					<td>R$ $pack_price</td>
					<td>$pack_pontos</td>
					<td>$pack_valid</td>
					<td>$p_status</td>
					<td>$boton</td>
					</tr>";
  
  }
?>
					</tbody>
					</table>
					</div>
				</div>
				</div>
				
				<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
					<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Criando Novo Pacote</h2>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" action="packs_add.php">
							<fieldset>
								<p>Coloque apenas números nos campos: valor, pontos e validade!</p>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Nome:</label>
									<div class="col-sm-8">
										<input required="" type="text" class="form-control1" id="focusedinput" placeholder="Ex.: Pacote Ouro" name="nome">
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Valor:</label>
									<div class="col-sm-6">
										R$<input type="text" class="form-control1" id="focusedinput" placeholder="Ex.: 100 se quer R$100,00" name="valor">
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">nº Cotas/Pontos:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Ex.: 10 para 10 pontos=10 cotas" name="pontos">
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-2 control-label">Validade:</label>
									<div class="col-sm-8">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Ex.: 30 para 30 dias" name="validade">
									</div>
									
								</div>
								
								
								<button type="submit" class="btn btn-primary">Criar Pacote</button>
	 
							</fieldset>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
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
