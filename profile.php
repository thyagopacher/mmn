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
//$new_username=mysqli_real_escape_string($con,$_POST['user']);
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


$errormsg= "
<div class='alert alert-success'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Sucesso! </br></strong>Dados Atualizados.</div>"; //printing error if found in validation



}



else
{ 
$errormsg= "
<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>Corrija os erros : </br></strong>".$msg."</div>"; //printing error if found in validation
					
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
		<div class="grid_3 grid_5">
	     
	     <div class="but_list">
	       <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
			<ul id="myTab" class="nav nav-tabs" role="tablist">
			  <li role="presentation" class="active"><a href="#home" class="btn btn-lg btn-primary" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Dados pessoais e de acesso</a></li>
			  <li role="presentation"><a href="#profile" class="btn btn-lg btn-success" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile">Dados Bancários - IMPORTANTE!</a></li>
			  
			</ul>
		<div id="myTabContent" class="tab-content">
		  <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
		    <form class="form-horizontal" method="post" action="profile_update.php">
		<input type="hidden" name="todo" value="post">
							<fieldset>
								<p>Os únicos dados alteráveis são senha e dados bancários</p>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Nome:</label>
									<div class="col-sm-7">
										<input disabled="" type="text" class="form-control1" id="focusedinput" placeholder="" name="nome" value="<?php echo $my_nome;?>">
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">CPF:</label>
									<div class="col-sm-7">
										<input disabled="" type="text" class="form-control1" id="focusedinput" placeholder="" name="cpf" value="<?php echo $my_cpf;?>">
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Email:</label>
									<div class="col-sm-7">
										<input disabled="" type="text" class="form-control1" id="focusedinput" placeholder="" name="email" value="<?php echo $my_email;?>">
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">WhatsApp:</label>
									<div class="col-sm-7">
										<input disabled="" type="text" class="form-control1" id="focusedinput" placeholder="" name="whats" value="<?php echo $my_whats;?>">
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Username:</label>
									<div class="col-sm-7">
										<input disabled="" type="text" class="form-control1" id="focusedinput" placeholder="" name="user" value="<?php echo $my_username;?>">
									</div>
									
								</div>
								
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Senha Atual:</label>
									<div class="col-sm-7">
										<input type="password" class="form-control1" id="focusedinput" placeholder="" name="pass1" >
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Nova Senha:</label>
									<div class="col-sm-7">
										<input type="password" class="form-control1" id="focusedinput" placeholder="" name="pass2" >
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Confirme a Nova Senha:</label>
									<div class="col-sm-7">
										<input type="password" class="form-control1" id="focusedinput" placeholder="" name="pass3" >
									</div>
									
								</div>
								
								
								<button type="submit" class="btn btn-primary">Atualizar dados</button>
	 
							</fieldset>
		</form>
		 </div>
		  <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
		    
			<form class="form-horizontal" method="post" action="profile_update_bank.php">
		<input type="hidden" name="todo" value="post">
							<fieldset>
								<p>Dados para recebimento. Você só pode receber em contas de sua titularidade!</p>
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Banco:</label>
									<div class="col-sm-7">
										<input type="text" class="form-control1" id="focusedinput" placeholder="" name="banco" value="<?php echo $my_banco;?>">
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Agencia:</label>
									<div class="col-sm-7">
										<input type="text" class="form-control1" id="focusedinput" placeholder="" name="agencia" value="<?php echo $my_agencia;?>">
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Nº da Conta:</label>
									<div class="col-sm-7">
										<input type="text" class="form-control1" id="focusedinput" placeholder="" name="nconta" value="<?php echo $my_conta;?>">
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Tipo:</label>
									<div class="col-sm-7">
										<input type="text" class="form-control1" id="focusedinput" placeholder="Poupança ou Corrente" name="tipo" value="<?php echo $my_conta_tipo;?>">
									</div>
									
								</div>
								
								<div class="form-group">
									<label for="focusedinput" class="col-sm-3 control-label">Titular:</label>
									<div class="col-sm-7">
										<input disabled="" type="text" class="form-control1" id="focusedinput" placeholder="" name="user" value="<?php echo $my_nome;?>">
									</div>
									
								</div>
								
								
								<button type="submit" class="btn btn-primary">Inserir / Atualizar dados</button>
	 
							</fieldset>
		</form>
			</div>
		  
		  
		</div>
   </div>
   </div>
  </div>
  
  

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
