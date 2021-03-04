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
		<h3>Pacotes / Planos / Faturas</h3>
		
		<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<h2>Meus Pacotes/Pedidos/Faturas Não Pagas</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>ID</th>
					<th>Tipo</th>
					<th>Valor</th>
					<th>Pontos</th>
					<th>Status</th>
					</tr>
					</thead>
					<tbody>
<?php

$query="SELECT * FROM  payorders where user='$my_username' AND status=0 ORDER BY id DESC";
$result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	
	$p_id="$row[id]";
	$p_valor="$row[valor]";
	$p_tipo="$row[tipo]";
	$p_user="$row[user]";
	$p_nome="$row[nome]";
	$p_status="$row[status]";
	
	$p_points="$row[pontos]";
	$p_valid="$row[valid]";
	
	$exibir="Pendente/Inativo <a href='checkout.php?idorder=$p_id' class='btn btn-sm btn-warning warning_33'>PAGAR</a>";
	
	?>
  
  <tr>
  <td><?php print $p_id;?></td>
  <td><?php print $p_tipo;?></td>
  <td>R$ <?php print number_format($p_valor, 2, ',', '.'); ?></td>
  <td><?php print $p_points;?></td>
  <td><?php print $exibir;?></td>
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
