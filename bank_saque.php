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
		<h3>Solicitando Retirada de Fundos</h3>
		
<?php

$check=1;
if($check==1){

$status = "OK";
$msg="";

if ($my_status!=1){
$msg=$msg."Você está com status INATIVO/PENDENTE, e não pode solicitar saque.<BR>";
$status= "NOTOK";}


if ($my_saldo < $saque_minimo){
$msg=$msg."Você não tem saldo suficiente para solicitar saque.<BR>";
$status= "NOTOK";}

$sts_btn_saque=mysqli_query($con,"SELECT status FROM sacar");
	$r = mysqli_fetch_row($sts_btn_saque);
	$stsbtnsaque = $r[0];
if ($stsbtnsaque != 1){
$msg=$msg."Pedidos de saques não estão liberados.<BR>";
$status= "NOTOK";}

}

if ($status=="OK"){
	$taxa=($my_saldo*$taxa_saque)/100;
	$valor_do_saque=$my_saldo - $taxa;
	
	$res1=mysqli_query($con,"INSERT INTO payments (userid,payment_amount,data) VALUES ('".$_SESSION['username']."', '$valor_do_saque','$hoje')");
	
	if($res1){
		$result5=mysqli_query($con,"UPDATE affiliateuser SET tamount=0 WHERE username='".$_SESSION['username']."'");
		?>
		<div class="alert alert-success" role="alert"><strong>Sucesso!</strong> Você solicitou um pagamento. <br>
	Em no máximo 7 dias úteis, enviaremos o valor de R$ <?php print number_format($valor_do_saque, 2, ',', '.'); ?> (já descontado a taxa de saque) sua conta cadastrada aqui, se ainda não cadastrou nenhum dado para recebimento, cadastre.
	</br>
		<a href="bank.php" class="btn btn-info">VOLTAR</a></div>
		<?php
		
	}
	
	
}else{
	
	print "<div class='alert alert-danger' role='alert'><strong>Erro!</strong> $msg. <br>
	
	<a href='bank.php' class='btn btn-info'>VOLTAR</a></div>";
}
?>

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
