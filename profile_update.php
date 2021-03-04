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


// Collect the data from post method of form submission // 
//$new_nome=mysqli_real_escape_string($con,$_POST['nome']);
//$new_cpf=mysqli_real_escape_string($con,$_POST['cpf']);
//$new_email=mysqli_real_escape_string($con,$_POST['email']);
//$new_whats=mysqli_real_escape_string($con,$_POST['whats']);
// $new_username=mysqli_real_escape_string($con,$_POST['user']);
//$new_saldo=mysqli_real_escape_string($con,$_POST['saldo']);
//$new_pontos=mysqli_real_escape_string($con,$_POST['pontos']);
$pass_word=mysqli_real_escape_string($con,$_POST['pass1']);
$new_pass=mysqli_real_escape_string($con,$_POST['pass2']);
$new_pass2=mysqli_real_escape_string($con,$_POST['pass3']);
//collection ends

$check=1;
if($check==1){

$status = "OK";
$msg="";
//validation starts
// if userid is less than 6 char then status is not ok


if ( $pass_word!=$my_password ){
$msg=$msg."Senha errada, você precisa informar a sua senha atual para alterar.<BR>";
$status= "NOTOK";}

if ( $new_pass!=$new_pass2 ){
$msg=$msg."As senhas são diferentes, confirme a nova senha.<BR>";
$status= "NOTOK";}

if ( strlen($new_pass) < 6 ){
$msg=$msg."A senha deve ter no mínimo 6 dígitos.<BR>";
$status= "NOTOK";}

}
if ($status=="OK") 
{

$query=mysqli_query($con,"update affiliateuser set password='$new_pass' where username='".$_SESSION['username']."'");


$errormsg= "<div class='alert alert-success'>
<button type='button' class='close' data-dismiss='alert'>&times;</button>
<i class='fa fa-ban-circle'></i><strong>Sucesso! </br></strong>Dados Atualizados.</br>
<a href='profile.php' class='btn btn-info'>VOLTAR</a></div>"; //printing error if found in validation



}



else
{ 
$errormsg= "
<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Corrija os erros : </br></strong>$msg
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
		<h3>Informações do usuário</h3>

		
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
