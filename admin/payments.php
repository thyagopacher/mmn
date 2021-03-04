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
		<h3>Solicitações de Saque</h3>

		<?php
		$sts_btn_saque=mysqli_query($con,"SELECT status FROM sacar");
	$r = mysqli_fetch_row($sts_btn_saque);
	$stsbtnsaque = $r[0];
if ($stsbtnsaque != 1){
	?><a href="btnpay_on.php" class="btn btn-primary">Ativar Botão de Saque</a><?php
	}else{
		?><a href="btnpay_off.php" class="btn btn-danger">Desativar Botão de Saque</a><?php
	}

?>
		
		<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<h2>Últimas solicitações de saque</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>Id</th>
					<th>Valor</th>
					<th>Usuário / Dados</th>
					<th>Data</th>
					<th>Status/Ação</th>
					</tr>
					</thead>
					<tbody>
<?php

$query="SELECT * FROM  payments ORDER BY id DESC";
$result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	
	$s_id="$row[id]";
	$s_user="$row[userid]";
	$s_valor="$row[payment_amount]";
	$s_status="$row[payment_status]";
	$s_data="$row[data]";
	
	if($s_status==1)
	{
	$view_status="Pago";
	}
	else if($s_active==0)
	{
	$view_status="Aguardando <a href='payments_ok.php?saqueid=$s_id' class='btn btn-primary'>Alterar</a>";
	}
	else
	{
	$view_status="Unknown";
	}
	
	$view_dados="<a href='payments_view.php?user=$s_user' class='btn btn-info'> Visualizar dados</a>";
	?>
  
  <tr>
					
					<td><?php print $s_id; ?></td>
					<td>R$ <?php print number_format($s_valor, 2, ',', '.'); ?></td>
					<td><?php print $s_user; ?> <?php print $view_dados; ?></td>
					<td><?php print $s_data; ?></td>
					<td><?php print $view_status; ?></td>
					</tr>
  <?php
  }
?>
					</tbody>
					</table>
					</div>
				</div>
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
