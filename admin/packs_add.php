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
		<h3>Pacotes / Planos</h3>

		<?php

$pack_name=mysqli_real_escape_string($con,$_POST['nome']);
$pack_price =mysqli_real_escape_string( $con,$_POST['valor']);
$pack_points = mysqli_real_escape_string($con,$_POST['pontos']);
$pack_days = mysqli_real_escape_string($con,$_POST['validade']);

$status = "OK";
$msg="";

if ( $pack_name=="" ){
$msg=$msg."Faltou o nome do pacote.<BR>";
$status= "NOTOK";}
if ( $pack_price=="" ){
$msg=$msg."Faltou o preço do pacote.<BR>";
$status= "NOTOK";}
if ( $pack_points=="" ){
$msg=$msg."Faltou os pontos/cotas do pacote.<BR>";
$status= "NOTOK";}
if ( $pack_days=="" ){
$msg=$msg."Faltou os dias de validade.<BR>";
$status= "NOTOK";}

if($status=="OK")
{
$res1=mysqli_query($con,"INSERT INTO packages (name,price,sbonus,validity) VALUES ('$pack_name', '$pack_price', '$pack_points', '$pack_days')");

if($res1)
{
print "<div class='alert alert-success' role='alert'>
        <strong>Sucesso!</strong> Pacote criado e adicionado ao sistema!
		</br>
		<a href='packs.php' class='btn btn-info'>VOLTAR</a>
       </div>";
}
else
{
print "<div class='alert alert-danger' role='alert'>
        <strong>Erro!</strong> Operação falhou!
		</br>
		<a href='packs.php' class='btn btn-info'>VOLTAR</a>
       </div>";
}


}
elseif($status=="NOTOK")
{
print "<div class='alert alert-danger' role='alert'>
        <strong>Erro!</strong> Operação falhou! $msg
		</br>
		<a href='packs.php' class='btn btn-info'>VOLTAR</a>
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
