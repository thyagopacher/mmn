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
		<h3>Usuários Cadastrados no Sistema</h3>

		<div class="alert alert-success" role="alert"><strong>Atenção!</strong> Tenha muito cuidado ao deletar um usuário, ao clicar em deletar, ele será excluido definitivamente do sistema.</div>
		<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<h2>Últimos Cadastrados</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>Id</th>
					<th>Username</th>
					<th>Nome</th>
					<th>CPF</th>
					<th>Email</th>
					<th>WhatsApp</th>
					<th>Pontos</th>
					<th>Saldo</th>
					<th>Upline</th>
					<th>Status</th>
					</tr>
					</thead>
					<tbody>
<?php

$query="SELECT * FROM  affiliateuser where level=2 ORDER BY id DESC";
$result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	$u_id="$row[Id]";
	$u_user="$row[username]";
	$u_nome="$row[fname]";
	$u_email="$row[email]";
	$u_ref="$row[referedby]";
	$u_whats="$row[mobile]";
	$u_status="$row[active]";
	$u_saldo="$row[tamount]";
	$u_cpf="$row[cpf]";
	$u_pontos="$row[pontos]";
	
	if($u_status==1)
	{
	$user_status="Ativo";
	}
	else if($u_status==0)
	{
	$user_status="Inativo/Pendente";
	}
	else
	{
	$user_status="Unknown";
	}
	
	$xxx="<a href='users_delete.php?user=$u_id' class='btn btn-danger'>Deletar</a>";
  ?>
  <tr>
					
					<td><?php print $u_id; ?></td>
					<td><?php print $u_user; ?></td>
					<td><?php print $u_nome; ?></td>
					<td><?php print $u_cpf; ?></td>
					<td><?php print $u_email; ?></td>
					<td><?php print $u_whats; ?></td>
					<td><?php print $u_pontos; ?></td>
					<td>R$ <?php print number_format($u_saldo, 2, ',', '.'); ?></td>
					<td><?php print $u_ref; ?></td>
					<td><?php print $user_status; ?></td>
					<td><?php print $xxx; ?></td>
					</tr><?php
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
