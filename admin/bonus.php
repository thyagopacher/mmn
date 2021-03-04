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
		<h3>Bônus Divisão de Lucro (diário, semanal ou mensal) = Cotas</h3>

		<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<a data-toggle="modal" data-target="#myModal" class="btn btn-info pull-right" >ENVIAR BÔNUS</a>
					<h2>Histórico do Bônus Divisão de Lucro</h2>
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
$query2="SELECT * FROM  bonusdl ORDER BY id DESC";
$result2 = mysqli_query($con,$query2);
$i=0;
while($row2 = mysqli_fetch_array($result2))
{
	
	$bdl_id="$row2[id]";
	$bdl_dia="$row2[data]";
	$bdl_valor="$row2[valor]";
	?>
	<tr>
  <td>R$ <?php print number_format($bdl_valor, 2, ',', '.'); ?></td>
  <td><?php print $bdl_dia; ?></td>
  </tr>
	
	<?php
  
  
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
					<h2 class="modal-title">Enviando Bônus de Participação nos Lucros</h2>
				</div>
				<div class="modal-body">
					<form class="form-horizontal" method="post" action="bonus_ok.php">
							<fieldset>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-4 control-label">Valor: R$</label>
									<div class="col-sm-6">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Ex.: 7.98" name="bonus">
									</div>
									
								</div>
								
								<p># recomenda-se, enviar um valor inteiro(ex.: 7 = R$7,00), mas se deseja usar centavos, separe com ponto, NÃO USE VÍRGULA!</p>
								
								<button type="submit" class="btn btn-primary">ENVIAR BÔNUS</button>
	 
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
