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
		<h3>Envio Bônus Divisão de Lucro (diário, semanal ou mensal) = Cotas</h3>

		<?php
		
$bonus_dl=mysqli_real_escape_string($con,$_POST['bonus']);

$status = "OK";
$msg="";

if ( $bonus_dl=="" ){
$msg=$msg."Faltou o valor do bônus.<BR>";
$status= "NOTOK";}

// buscar se tem bonus com data igual hoje 
$bonusdl2 = mysqli_query($con,"SELECT count(*) FROM  bonusdl where data='$hoje'");
$row22 = mysqli_fetch_row($bonusdl2);
$bonus_check_day = $row22[0];
if ( $bonus_check_day > 0 ){
$msg=$msg."O bônus já foi enviado hoje.<BR>";
$status= "NOTOK";}

// $bonus_dl_lider=($bonus_dl * 2);

if($status=="OK")
{
	// $cmup1=mysqli_query($con,"UPDATE affiliateuser SET tamount=pontos*'" . $bonus_dl . "'+tamount WHERE active=1 AND lider=0");
	// $cmup2=mysqli_query($con,"UPDATE affiliateuser SET tamount=pontos*'" . $bonus_dl_lider . "'+tamount WHERE active=1 AND lider=1");
$res1=mysqli_query($con,"INSERT INTO bonusdl (valor,data) VALUES ('$bonus_dl','$hoje')");

if($res1)
{
print "<div class='alert alert-success' role='alert'>
        <strong>Sucesso!</strong> Bônus Divisão de Lucro enviado! Por segurança, o bonus é limitado a 1 envio por dia,
		pra que não seja enviado em dobro. Caso queira rodar as cotas por hora, será necessário desativaria esta função.
		</br>
		<a href='bonus.php' class='btn btn-info'>VOLTAR</a>
       </div>";
}
else
{
print "<div class='alert alert-danger' role='alert'>
        <strong>Erro!</strong> Operação falhou!
		</br>
		<a href='bonus.php' class='btn btn-info'>VOLTAR</a>
       </div>";
}


}
elseif($status=="NOTOK")
{
print "<div class='alert alert-danger' role='alert'>
        <strong>Erro!</strong> Operação falhou! $msg
		</br>
		<a href='bonus.php' class='btn btn-info'>VOLTAR</a>
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
