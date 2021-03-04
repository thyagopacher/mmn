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
		<h3>Efetuando Pagamento</h3>
		
		<?php

$packbuy= mysqli_real_escape_string($con,$_GET["idorder"]);

$query="SELECT * FROM payorders WHERE id='$packbuy'";
$result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result)){
	$o_id="$row[id]";
	$o_valor="$row[valor]";
	$o_tipo="$row[tipo]";
	$o_user="$row[user]";
	$o_nome="$row[nome]";
	$o_status="$row[status]";
	$o_validad="$row[valid]";
	}
	
echo "<div class='alert alert-info' role='alert'>
<strong>Como pagar:</strong> Envie o valor de <strong>R$ $o_valor,00</strong> para a conta informada abaixo.
<br>
	Depois envie o comprovante para o email <strong>$email_bank</strong> informando os seguintes dados:
	<br>
	ID do pedido/compra/fatura: <strong>$o_id</strong>
	<br>
	Pacote: <strong>$o_tipo</strong>
	<br>
	Usuário: <strong>$o_user</strong>
	<br>
	Nome Completo: <strong>$o_nome</strong>
	
	</div>";
	

?>

<h3>Contas para Efetuar o Pagamento</h3>
		<div class="col-sm-4 widget_1_box">
                <div class="wid-social skype">
                    <div class="social-icon">
                        <i class="fa fa-money text-light icon-xlg pull-right"></i>
                    </div>
                    <div class="social-info">
                        <h3>Banco: <?php print $site_bank1 ?></h3></br>
						<h3>Agencia: <?php print $site_agencia1 ?></h3></br>
						<h3>Nº da Conta: <?php print $site_nconta1 ?></h3></br>
						<h3>Conta <?php print $site_tipo_conta1 ?></h3>
                    </div>
                </div>
		</div>
		<div class="col-sm-4 widget_1_box">
                <div class="wid-social skype">
                    <div class="social-icon">
                        <i class="fa fa-money text-light icon-xlg pull-right"></i>
                    </div>
                    <div class="social-info">
                        <h3>Banco: <?php print $site_bank2 ?></h3></br>
						<h3>Agencia: <?php print $site_agencia2 ?></h3></br>
						<h3>Nº da Conta: <?php print $site_nconta2 ?></h3></br>
						<h3>Conta <?php print $site_tipo_conta2 ?></h3>
                    </div>
                </div>
		</div>
		<div class="col-sm-4 widget_1_box">
                <div class="wid-social skype">
                    <div class="social-icon">
                        <i class="fa fa-money text-light icon-xlg pull-right"></i>
                    </div>
                    <div class="social-info">
                        <h3>Conta Super: <?php print $site_contasuper ?></h3></br>
						<h3>Neteller: <?php print $site_neteller ?></h3></br>
						<h3>Paypal: <?php print $site_paypal ?></h3></br>
                    </div>
                </div>
		</div>
		</div>
		
       </div>
      <!-- /#page-wrapper -->
   </div>
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
</body>
</html>
