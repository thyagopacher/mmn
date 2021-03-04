<?php
include_once ("admin/site/mmn_db.php");
// Inialize session
session_start();
// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['username'])) {
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
include_once ("admin/site/config.php");
include_once ("admin/site/site_stats.php");
include_once ("user_info.php");
include_once ("financial.php");
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
include_once ("admin/site/header.php");
?>
<body>
<div id="wrapper">
     <!-- Navigation -->
<?php
include_once ("admin/site/menu.php");
?>
        <div id="page-wrapper">
        <div class="graphs">
		<h3>Financeiro</h3>
		
		<div class="widget_2">
		   	  
              <div class="col-sm-4 widget_1_box">
                <div class="wid-social skype">
                    <div class="social-icon">
                        <i class="fa fa-money text-light icon-xlg pull-right"></i>
                    </div>
                    <div class="social-info">
                        R$<h3 class="number_counter bold count text-light start_timer counted"><?php print number_format($my_saldo, 2, ',', '.'); ?></h3>
                        <h4 class="counttype text-light">Saldo Disponível</h4>
                        <?php
						$sts_btn_saque=mysqli_query($con,"SELECT status FROM sacar");
	$r = mysqli_fetch_row($sts_btn_saque);
	$stsbtnsaque = $r[0];
if ($stsbtnsaque == 1){
	?><span class="percent"><a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal">SACAR TUDO</a></span>
	<?php }else{print "
	Solicitação de saque bloqueada
	";}?>

                    </div>
                </div>
			  </div>
			  
			  <div class="col-sm-4 widget_1_box">
               	<div class="wid-social youtube">
                    <div class="social-icon">
                        <i class="fa fa-money text-light icon-xlg pull-right"></i>
                    </div>
                    <div class="social-info">
                        R$<h3 class="number_counter bold count text-light start_timer counted"><?php print number_format($sum3, 2, ',', '.'); ?></h3>
                        <h4 class="counttype text-light">Total Investido</h4>
                        <span class="percent">Total em pacotes pagos</span>
                    </div>
                </div>
			  </div>
			  
			  <div class="col-sm-4 widget_1_box">
		   	  	<div class="wid-social facebook">
                    <div class="social-icon">
                        <i class="fa fa-money text-light icon-xlg pull-right"></i>
                    </div>
                    <div class="social-info">
                        R$<h3 class="number_counter bold count text-light start_timer counted"><?php print number_format($sum2, 2, ',', '.'); ?></h3>
                        <h4 class="counttype text-light">Total recebido</h4>
                        <span class="percent">Total em saques realizados</span>
                    </div>
                </div>
              </div>
              
              
              <div class="clearfix"> </div>
		</div>
		
		<div class="grid_3 grid_5">
	     
	     <div class="but_list">
	       <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
			<ul id="myTab" class="nav nav-tabs" role="tablist">
			  <li role="presentation" class="active"><a href="#home" class="btn btn-lg btn-primary" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Saques</a></li>
			  <li role="presentation"><a href="#profile" class="btn btn-lg btn-success" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Bônus</a></li>
			  <li role="presentation"><a href="#stats" class="btn btn-lg btn-info" role="tab" id="stats-tab" data-toggle="tab" aria-controls="profile">Resumo</a></li>
			  
			</ul>
		<div id="myTabContent" class="tab-content">
		  <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
		    <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<h2>Solicitações de saque</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>ID</th>
					<th>Data</th>
					<th>Valor</th>
					<th>Status</th>
					</tr>
					</thead>
					<tbody>
<?php
$query="SELECT * FROM  payments where userid='$my_username' ORDER BY id DESC";
$result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	
	$sq_id="$row[id]";
	$sq_valor="$row[payment_amount]";
	$sq_status="$row[payment_status]";
	$sq_data="$row[data]";
	
	if($sq_status==1){
		$stsdosaque="Pago";
	}else{
		$stsdosaque="Aguardando";
	}
	?>
  
  <tr>
  <td><?php print $sq_id ?></td>
  <td><?php print $sq_data ?></td>
  <td>R$ <?php print number_format($sq_valor, 2, ',', '.'); ?></td>
  <td><?php print $stsdosaque ?></td>
  </tr>
  <?php
}

?>					
					</tbody>
					</table>
					</div>
				</div>
			</div>
		 </div>
		  <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
		    
			<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<h2>Bônus Divisão de Lucro - Histórico Geral do Sistema</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					
					<th>Valor</th>
					<th>Data</th>
					</tr>
					</thead>
					<tbody>
<?php
$query2="SELECT * FROM  user_bonus_dl WHERE user_id='$my_id' ORDER BY id DESC";
$result2 = mysqli_query($con,$query2);
$i=0;
while($row2 = mysqli_fetch_array($result2))
{
	
	$bdl_id="$row2[user_id]";
	$bdl_dia="$row2[dia]";
	$bdl_valor="$row2[valor]";
	?>
  
  <tr>
  <td>R$ <?php print number_format($bdl_valor, 2, ',', '.');?></td>
  <td><?php print $bdl_dia ?></td>
  </tr>
  <?php
}

?>					
					</tbody>
					</table>
					</div>
				</div>
			</div>
			
			</div>
		  <div role="tabpanel" class="tab-pane fade" id="stats" aria-labelledby="stats-tab">
		    <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<h2>Balanço Financeiro</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>Investimento</th>
					<th>Ganhos</th>
					<th>Sacado</th>
					<th>Saldo</th>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td>R$ <?php print number_format($sum3, 2, ',', '.'); ?></td>
					<td>R$ <?php print number_format($totalfaturado, 2, ',', '.'); ?></td>
					<td>R$ <?php print number_format($totalsaque, 2, ',', '.'); ?></td>
					<td>R$ <?php print number_format($my_saldo, 2, ',', '.'); ?></td>
					</tr>
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
  
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
					<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" action="bank_saque.php">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
					<h2 class="modal-title">Solicitando saque</h2>
				</div>
				<div class="modal-body">
					<p>Saldo disponível: R$ <?php print number_format($my_saldo, 2, ',', '.'); ?></p>
					<p>Saque mínimo: R$<?php print number_format($saque_minimo, 2, ',', '.'); ?></p>
				</div>
				<p>Serão descontados <?php print $taxa_saque; ?>% como taxa de saque.</p>
				
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
					<button type="submit" class="btn btn-primary">Sacar Tudo</button>
				</div>
				</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
</div>

		</div>
		<?php
include_once ("admin/site/footer.php");
?>
       </div>
      <!-- /#page-wrapper -->
   </div>
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
