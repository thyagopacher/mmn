<?php
if(!isset($_SESSION)){
    session_start();
}
include_once ("admin/site/mmn_db.php");

include_once ("admin/site/config.php");
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE HTML>
<html>
<head>
<title><?php print $site_name ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Modern Responsive web template, Bootstrap Web Templates, Flat Web Templates, Andriod Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
 <!-- Bootstrap Core CSS -->
<link href="css/bootstrap.min.css" rel='stylesheet' type='text/css' />
<!-- Custom CSS -->
<link href="css/style.css" rel='stylesheet' type='text/css' />
<link href="css/font-awesome.css" rel="stylesheet"> 
<!-- jQuery -->
<script src="js/jquery.min.js"></script>
<!----webfonts--->
<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900' rel='stylesheet' type='text/css'>
<!---//webfonts--->  
<!-- Bootstrap Core JavaScript -->
<script src="js/bootstrap.min.js"></script>
</head>
<body id="login">
  <div class="login-logo">
    <h2><a href="index.php"><img src="admin/site/logo.png" alt="" /></a></h2>
  </div>
<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']) && isset($_POST['todo']))
{
	
$todo=mysqli_real_escape_string($con,$_POST['todo']);
$name=mysqli_real_escape_string($con,$_POST['name']);
$username=mysqli_real_escape_string($con,$_POST['username']);
$userid=mysqli_real_escape_string($con,$_POST['username']);
$password=mysqli_real_escape_string($con,$_POST['password']);
$password2=mysqli_real_escape_string($con,$_POST['password2']);
$email=mysqli_real_escape_string($con,$_POST['email']);
$mobile=mysqli_real_escape_string($con,$_POST['mobile']);
$ref=mysqli_real_escape_string($con,$_POST['referral']);
$cpf=mysqli_real_escape_string($con,$_POST['cpf']);

$status = "OK";
$msg="";

if(!isset($username) or strlen($username) <6){
$msg=$msg."Nome de usuário - username - deve conter mais de 6 caracteres.<BR>";
$status= "NOTOK";}					

if(!ctype_alnum($username)){
$msg=$msg."Username deve conter apenas caracteres alfanuméricos.<BR>";
$status= "NOTOK";}					


$rr=mysqli_query($con,"SELECT COUNT(*) FROM affiliateuser WHERE username = '$username'");
$r = mysqli_fetch_row($rr);
$nr = $r[0];
if($nr==1){
$msg=$msg."Este username já está registrado, tente outro.<BR>";
$status= "NOTOK";
}	

$rrr=mysqli_query($con,"SELECT COUNT(*) FROM affiliateuser WHERE mobile = '$mobile'");
$r3 = mysqli_fetch_row($rrr);
$nr3 = $r3[0];
if($nr3>0){
$msg=$msg."Número do celular/WhatsApp já registrado no sistema, tente outro.<BR>";
$status= "NOTOK";
}	

$remail=mysqli_query($con,"SELECT COUNT(*) FROM affiliateuser WHERE email = '$email'");
$re = mysqli_fetch_row($remail);
$nremail = $re[0];
if($nremail>0){
$msg=$msg."Este email já está registrado no sistema, tente outro.<BR>";
$status= "NOTOK";
}

$rcpf=mysqli_query($con,"SELECT COUNT(*) FROM affiliateuser WHERE cpf = '$cpf'");
$re = mysqli_fetch_row($rcpf);
$nrcpf = $re[0];
if($nrcpf>0){
$msg=$msg."Este CPF já está registrado no sistema. Cada usuário pode ter apenas 1 conta por CPF<BR>";
$status= "NOTOK";
}				

$result = mysqli_query($con,"SELECT count(*) FROM  affiliateuser where username = '$ref' AND active=1");
$row = mysqli_fetch_row($result);
$numrows = $row[0];
if ($numrows==0)
{
$msg=$msg."Seu indicador NÃO está ativo, ou não existe no sistema.<BR>";
$status= "NOTOK";
}

if ( strlen($cpf) <> 11 ){
$msg=$msg."Informe seu CPF corretamente, será necessário para sacar, coloque apenas números, não use espaços, nem sinais, ex.: 01234567890.<BR>";
$status= "NOTOK";}

if ( strlen($password) < 6 ){
$msg=$msg."A senha deve ter no mínimo 6 dígitos.<BR>";
$status= "NOTOK";}	

if ( strlen($mobile) > 12 ){
$msg=$msg."Coloque seu WhatsApp da maneira correta, DDD + número, ex. 11988884444<BR>";
}

if ( strlen($email) < 1 ){
$msg=$msg."Coloque seu melhor email.<BR>";
$status= "NOTOK";}


if ( $password <> $password2 ){
$msg=$msg."As senhas não conferem, preste atenção.<BR>";
$status= "NOTOK";}		


//Test if it is a shared client
if (!empty($_SERVER['HTTP_CLIENT_IP'])){
  $ip=$_SERVER['HTTP_CLIENT_IP'];
//Is it a proxy address
}elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
  $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}else{
  $ip=$_SERVER['REMOTE_ADDR'];
}
//The value of $ip at this point would look something like: "192.0.34.166"
$ip = ip2long($ip);
//The $ip would now look something like: 1073732954


if ($status=="OK") 
{
$query=mysqli_query($con,"insert into affiliateuser(username,password,fname,email,referedby,ipaddress,mobile,cpf) values('$username','$password','$name','$email','$ref','$ip','$mobile','$cpf')");

if($query){
	$query2="SELECT * FROM  uplines WHERE user_id='$ref'";
	$result = mysqli_query($con,$query2);
	$i=0;
	while($row = mysqli_fetch_array($result))
	{
		$up1="$row[up1]";
		$up2="$row[up2]";
		$up3="$row[up3]";
		$up4="$row[up4]";
		$up5="$row[up5]";
	}
	
	$query3=mysqli_query($con,"insert into uplines(user_id,up1,up2,up3,up4,up5) values('$username','$ref','$up1','$up2','$up3','$up4')");
	
	$emailtext="Cadastro confirmado, visite o site e acesse o seu painel";
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= 'From: <'.$email_suporte.'>' . "\r\n";
	$to=$email;
	$subject="Cadastro confirmado";
	$message=$emailtext;
	mail($to,$subject,$message,$headers);
}

print "<div class='alert alert-success'><h2><strong>Sucesso!</br></strong>Cadastro realizado.<a href='login.php' class='btn btn-info'>FAZER LOGIN</a></h2></div>";
}

else
{ 
print "
<div class='alert alert-danger'><button type='button' class='close' data-dismiss='alert'>&times;</button>
<i class='fa fa-ban-circle'></i><strong>ERROS : </br></strong>".$msg."</div>";
}

}
?>
  <h2 class="form-heading">Cadastre-se</h2>
  <form class="form-signin app-cam" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post" data-validate="parsley">
      <input type="hidden" name="todo" value="post">
	  <p>Informe seus dados:</p>
      <input type="text" class="form-control1" placeholder="Nome completo" data-required="true" name="name" autofocus="" required>
      <input type="text" class="form-control1" placeholder="CPF - apenas números" data-required="true" name="cpf" autofocus="" required>
      <input type="text" class="form-control1" placeholder="Email" data-required="true" name="email" autofocus="" required>
      <input type="text" class="form-control1" placeholder="WhatsApp" data-required="true" name="mobile" autofocus="" required>
<?php
if(isset($_GET["ref"])){
	$ref=mysqli_real_escape_string($con,$_GET["ref"]);
	$_SESSION['ref'] = $ref;
	}
?>
			Convidado por:<input type="text" class="form-control1" placeholder="Informe seu indicador" value="<?php if (isset($_SESSION['ref'])){ print $_SESSION['ref']; } ?>" name="referral" required>
      
	  <p> Dados de acesso:</p>
      <input type="text" class="form-control1" placeholder="Username" data-required="true" name="username" autofocus="" required>
      <input type="password" class="form-control1" placeholder="Senha" data-required="true" name="password" required>
      <input type="password" class="form-control1" placeholder="Confirme a senha" data-required="true" name="password2" required>
      <label class="checkbox-custom check-success">
          <input type="checkbox" value="agree this condition" id="checkbox1"> <label for="checkbox1">E li e aceito os Termos e Condições</label>
      </label>
      <button class="btn btn-lg btn-success1 btn-block" type="submit">Cadastrar</button>
      <div class="registration">
          Já é registrado?
          <a class="" href="login.php">
              Login
          </a>
      </div>
  </form>
   <?php
   include_once ("admin/site/footer.php");
   ?>
</body>
</html>
