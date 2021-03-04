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
		<h3>Titulo</h3>
		
<?php
// pega id do pacote
$pack_buy=mysqli_real_escape_string($con,$_POST['packid']);

$status = "OK";
$msg="";

if ( $pack_buy=="" ){
$msg=$msg."Escolha um pacote <a href='packs.php' class='btn btn-info'>Pacotes</a>.<BR>";
$status= "NOTOK";}

// busca total e limite de packs
$npacks = mysqli_query($con,"SELECT count(*) FROM  payorders where user = '".$_SESSION['username']."' AND status=1");
$row = mysqli_fetch_row($npacks);
$totalpacks = $row[0];
if($totalpacks == $packs_limite){
$msg=$msg."Você atingiu o limite de $packs_limite pacotes/usuário, e não pode comprar mais pacotes.<BR>";
$status= "NOTOK";	
}

if($status=="OK")
{
	// busca dados do pacote
	$query="SELECT * FROM packages WHERE id='$pack_buy'";
	$result = mysqli_query($con,$query);
	$i=0;
	while($row = mysqli_fetch_array($result)){
		$pack_id="$row[id]";
		$pack_name="$row[name]";
		$pack_price="$row[price]";
		$pack_active="$row[active]";
		$pack_valid="$row[validity]";
		$pack_points="$row[sbonus]";
	}
	
	$res1=mysqli_query($con,"INSERT INTO payorders (valor,tipo,user,nome,pontos,dia,valid) VALUES ('$pack_price', '$pack_name','$my_username','$my_nome','$pack_points','$hoje','$pack_valid')");

if($res1)
{
	print "<div class='alert alert-success' role='alert'><strong>Sucesso!</strong> Você acabou de reservar um pacote. <br>
	Para efetuar o pagamento desta fatura, <a href='packspay.php' target='_blank' class='btn btn-primary'>CLIQUE AQUI</a> ou <a href='packs.php' class='btn btn-info'>VOLTAR</a></div>";

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
