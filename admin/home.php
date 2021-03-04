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
		<h3>Bem vindo ao painel de administração do site</h3>

		<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<h2>Extrato Financeiro</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>Faturamento Total</th>
					<th>Faturamento de Hoje</th>
					<th>Total Pago</th>
					<th>Saques para pagar</th>
					<th>Saldo dos Usuários</th>
					<th>Total de pontos/cotas ativos</th>
					</tr>
					</thead>
					<tbody>

<tr>
  <td>R$ <?php print number_format($sum, 2, ',', '.'); ?></td>
  <td>R$ <?php print number_format($sum1, 2, ',', '.'); ?></td>
  <td>R$ <?php print number_format($sum2, 2, ',', '.'); ?></td>
  <td>R$ <?php print number_format($sum3, 2, ',', '.'); ?></td>
  <td>R$ <?php print number_format($sum4, 2, ',', '.'); ?></td>
  <td><?php print $total_points; ?>*</td>
</tr>
					</tbody>
					</table>
					</div>
				</div>
				</div>
				<?php
				$destinadobdl=($sum1*50)/100;
				@$previ_cota=$destinadobdl/$total_points;
				?>
				<a href="bonus.php" class="btn btn-primary">Valor aproximado Bônus Divisão de Lucro = cota para hoje R$ <?php print number_format($previ_cota, 2, ',', '.'); ?>**</a>
				<br>
				<p>* : Total aproximado do número de pontos de todos usuário, incluíndo qualificados como líder.</p>
				<p>** : Valor aproximado do Bônus Divisão de Lucro até o momento, se a destinação for de 50% do faturado no dia, seriam 50% do faturamento divididos pelo total de pontos. Lembrando que, é apenas um exemplo.</p>
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
