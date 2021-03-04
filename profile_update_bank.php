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
<?php
		if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['todo']))
{



$new_bank=mysqli_real_escape_string($con,$_POST['banco']);
$new_agencia=mysqli_real_escape_string($con,$_POST['agencia']);
$new_conta=mysqli_real_escape_string($con,$_POST['nconta']);
$new_tipo=mysqli_real_escape_string($con,$_POST['tipo']);

$check=1;
if($check==1){

$status = "OK";
$msg="";
//validation starts
// if userid is less than 6 char then status is not ok
if ( $new_bank=="" ){
$msg=$msg."Faltou o Banco.<BR>";
$status= "NOTOK";}
if ( $new_agencia=="" ){
$msg=$msg."Faltou a agencia.<BR>";
$status= "NOTOK";}
if ( $new_conta=="" ){
$msg=$msg."Faltou o número da conta.<BR>";
$status= "NOTOK";}
if ( $new_tipo=="" ){
$msg=$msg."Faltou o Tipo, Corrente ou Poupança.<BR>";
$status= "NOTOK";}
}
if ($status=="OK") 
{

$query=mysqli_query($con,"update affiliateuser set banco='$new_bank',agencia='$new_agencia',conta='$new_conta',tipo='$new_tipo' where username='".$_SESSION['username']."'");


$errormsg= "
<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Sucesso! </br></strong>Dados Atualizados.
					</br>
		<a href='profile.php' class='btn btn-info'>VOLTAR</a></div>"; //printing error if found in validation



}



else
{ 
$errormsg= "
<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Corrija os erros : </br></strong>'.$msg.'
					</br>
		<a href='profile.php' class='btn btn-info'>VOLTAR</a></div>"; //printing error if found in validation
					
}

}

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
		<h3>Informações bancárias do usuário</h3>

		
<?php 
						if($_SERVER['REQUEST_METHOD'] == 'POST' && ($status!=""))
						{
						print $errormsg;
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
