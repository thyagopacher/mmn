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

		<?php
		$tomake= mysqli_real_escape_string($con,$_GET["saqueid"]);

$result=mysqli_query($con,"UPDATE payments SET payment_status=1 WHERE id='$tomake'");
if ($result)
{
print "<div class='alert alert-success' role='alert'>
        <strong>Sucesso!</strong> Status do saque atualizado para PAGO.</br>
		<a href='payments.php' class='btn btn-info'>VOLTAR</a>
       </div>";
}
else
{
print "<div class='alert alert-danger' role='alert'>
        <strong>Erro!</strong> Operação falhou.</br>
		<a href='payments.php' class='btn btn-info'>VOLTAR</a>
       </div>";
}
?>
				
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
