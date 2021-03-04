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
		<h3>Ativação de Usuário por Liberação de Fatura</h3>
		
<?php

$tomake= mysqli_real_escape_string($con,$_GET["order"]);
// buscando dados da fatura
$busca1="SELECT * FROM  payorders where id='$tomake'";
$resp1 = mysqli_query($con,$busca1);
while($row = mysqli_fetch_array($resp1))
{
	$f_id="$row[id]";
	$f_valor="$row[valor]";
	$f_tipo="$row[tipo]";
	$f_user="$row[user]";
	$f_nome="$row[nome]";
	$f_status="$row[status]";
	$f_pontos="$row[pontos]";
	$f_dia="$row[dia]";
	$f_valid="$row[valid]";
	}
	
	if($f_status==0){
// buscando uplines
$sqli="SELECT * FROM  uplines where user_id='$f_user'";
$resu = mysqli_query($con,$sqli);
while($resp = mysqli_fetch_array($resu)){
	$membro_code="$resp[user_id]";
	$up1_code="$resp[up1]";
	$up2_code="$resp[up2]";
	$up3_code="$resp[up3]";
	$up4_code="$resp[up4]";
	$up5_code="$resp[up5]";
}
// definindo comissão
$bonus_up1=($f_valor * $bonus_nv1)/100;
$bonus_up2=($f_valor * $bonus_nv2)/100;
$bonus_up3=($f_valor * $bonus_nv3)/100;
$bonus_up4=($f_valor * $bonus_nv4)/100;
$bonus_up5=($f_valor * $bonus_nv5)/100;
// definindo a validade
$validade_do_pack = date('d/m/Y', strtotime("+$f_valid days"));
// inserindo comissão no saldo dos uplines
$cmup1=mysqli_query($con,"UPDATE affiliateuser SET tamount=tamount+'$bonus_up1' WHERE username='$up1_code'");
$cmup2=mysqli_query($con,"UPDATE affiliateuser SET tamount=tamount+'$bonus_up2' WHERE username='$up2_code'");
$cmup3=mysqli_query($con,"UPDATE affiliateuser SET tamount=tamount+'$bonus_up3' WHERE username='$up3_code'");
$cmup4=mysqli_query($con,"UPDATE affiliateuser SET tamount=tamount+'$bonus_up4' WHERE username='$up4_code'");
$cmup5=mysqli_query($con,"UPDATE affiliateuser SET tamount=tamount+'$bonus_up5' WHERE username='$up5_code'");
// ativando usuário e somando pontos
$resultu=mysqli_query($con,"UPDATE affiliateuser SET active=1,pontos=pontos+$f_pontos WHERE username='$f_user'");
// atualizando status e validade do pack
$result=mysqli_query($con,"update payorders set status=1,dia='$hoje',valid='$validade_do_pack' where id=$tomake");
//$result=mysqli_query($con,"UPDATE payorders SET status=1 WHERE id='$tomake'");
if ($result)
{
print "<div class='alert alert-success' role='alert'>
        <strong>Sucesso!</strong> Pagamento de fatura liberado, usuário ativado e bônus somado ao saldo dos uplines!.
		</br>
		<a href='faturas.php' class='btn btn-info'>VOLTAR</a>
       </div>";
}
else
{
print "<div class='alert alert-danger' role='alert'>
        <strong>Erro!</strong> Operação falhou.
		</br>
		<a href='faturas.php' class='btn btn-info'>VOLTAR</a>
       </div>";
}
	}elseif($f_status==1){
		print "<div class='alert alert-danger' role='alert'>
        <strong>Erro!</strong> Fatura já foi paga.
		</br>
		<a href='faturas.php' class='btn btn-info'>VOLTAR</a>
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
