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
		<h3>Recebendo Bônus Divisão de Lucro</h3>
		
<?php

$check=1;
if($check==1){

$status = "OK";
$msg="";

if ($my_status!=1){
$msg=$msg."Você está com status INATIVO/PENDENTE, e não participa da Divisão de Lucros.<BR>";
$status= "NOTOK";}

if ($my_pontos==0){
$msg=$msg."Você não tem pontos, e não participa da Divisão de Lucros. Compre um Pacote<BR>";
$status= "NOTOK";}

// MINIMO INDICADOS DIRETOS ATIVOS PARA PARTICIPAR DA DIVISÃO DE LUCROS
$diretos = mysqli_query($con,"SELECT count(*) FROM  affiliateuser where referedby = '".$_SESSION['username']."' AND active=1");
$row1 = mysqli_fetch_row($diretos);
$diretosativos = $row1[0];
if ($diretosativos < $diretos_minimo_bdl){
$msg=$msg."Você não tem $diretos_minimo_bdl indicados ativos para ter direito a divisão de lucros.<BR>";
$status= "NOTOK";}

$bonusdl = mysqli_query($con,"SELECT count(*) FROM  user_bonus_dl where user_id = '$my_id' AND dia='$hoje'");
$row2 = mysqli_fetch_row($bonusdl);
$check_bonusdl = $row2[0];
if ($check_bonusdl > 0){
$msg=$msg."Você já recebeu o bônus de hoje.<BR>";
$status= "NOTOK";}

$bonusdl2 = mysqli_query($con,"SELECT count(*) FROM  bonusdl where data='$hoje'");
$row22 = mysqli_fetch_row($bonusdl2);
$check_bonusdl2 = $row22[0];
if ($check_bonusdl2 < 1){
$msg=$msg."O bônus de divisão de lucros do dia, ainda não foi calculado pela administração do site, aguarde até que o bônus seja enviado.<BR>";
$status= "NOTOK";}

}
if ($status=="OK"){
	
	// busca valor do bônus
	$rr=mysqli_query($con,"SELECT valor FROM bonusdl WHERE data='$hoje'");
	$r = mysqli_fetch_row($rr);
	$bonusdldehoje = $r[0];

	if($my_lider==1){
		$my_bdl=$bonusdldehoje * 2;
	}else{
		$my_bdl=$bonusdldehoje;
	}
	// soma bonus ao saldo
	$somabonus=mysqli_query($con,"UPDATE affiliateuser SET tamount=pontos*'" . $my_bdl . "'+tamount WHERE username='".$_SESSION['username']."' AND active=1");

	if($somabonus){
		$my_bdl_hoje=$my_bdl * $my_pontos;
		$inserebdl=mysqli_query($con,"INSERT INTO user_bonus_dl (user_id,valor,dia) VALUES ('$my_id','$my_bdl_hoje','$hoje')");
		
		if($inserebdl){
			print "<div class='alert alert-success' role='alert'><strong>Sucesso!</strong> Você resgatou o Bônus Divisão de Lucro de hoje!<br></br>
		<a href='home.php' class='btn btn-info'>VOLTAR</a></div>";
		}
	}
	
}else{
	
	print "<div class='alert alert-danger' role='alert'><strong>Erro!</strong> $msg. <br>
	
	<a href='home.php' class='btn btn-info'>VOLTAR</a></div>";
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
