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
		<h3>Dados do Usuário Solicitante do Saque</h3>

		<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<h2>Dados Bancários do Usuário</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>Nome</th>
					<th>CPF</th>
					<th>Username</th>
					<th>Email</th>
					<th>WhatsApp</th>
					<th>Banco</th>
					<th>Agência</th>
					<th>Nº da Conta</th>
					<th>Tipo</th>
					</tr>
					</thead>
					<tbody>
<?php

$tomake= mysqli_real_escape_string($con,$_GET["user"]);
$query="SELECT * FROM  affiliateuser where username='$tomake'";
$result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
// buscar dados bancários do solicitante	
	$u_id="$row[Id]";
	$u_user="$row[username]";
	$u_nome="$row[fname]";
	$u_email="$row[email]";
	$u_whats="$row[mobile]";
	$u_cpf="$row[cpf]";
	$u_banco="$row[banco]";
	$u_agencia="$row[agencia]";
	$u_num="$row[conta]";
	$u_tipo="$row[tipo]";
	
	
	
  print "
  <tr>
					
					<td>$u_nome</td>
					<td>$u_cpf</td>
					<td>$u_user</td>
					<td>$u_email</td>
					<td>$u_whats</td>
					<td>$u_banco</td>
					<td>$u_agencia</td>
					<td>$u_num</td>
					<td>$u_tipo</td>
					</tr>";
  
  }
?>
					</tbody>
					</table>
					</div>
				</div>
				</div>
				<a href="payments.php" class="btn btn-info">Voltar para os pedidos de saque</a>
				
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
