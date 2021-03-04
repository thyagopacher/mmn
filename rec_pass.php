<?php
include_once ("admin/site/mmn_db.php");
include_once ("admin/site/config.php");


if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['femail']))
{

$email=mysqli_real_escape_string($con,$_POST['femail']);
$status=1;
if($status==1){

$status = "OK";
$msg="";
//checking constraints
if ( strlen($email) < 1 ){
$msg=$msg."Insira o seu email.<BR>";
$status= "NOTOK";}


$result = mysqli_query($con,"SELECT count(*) FROM  affiliateuser where email = '$email'");
$row = mysqli_fetch_row($result);
$numrows = $row[0];

if(($numrows) == 0) {
$msg=$msg."Este email não está cadastrado no sistema.<BR>";
$status= "NOTOK";}

}

$newpassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789@#$%^&*') , 0 , 14 );

if ( strlen($newpassword) < 8 ){
$msg=$msg."A nova senha não pôde ser gerada, tente novamente.<BR>";
$status= "NOTOK";}


if($status=="OK")
{


$re = mysqli_query($con,"update affiliateuser set password = '$newpassword' where email = '$email'");
if($re)
{
$emailtext="Aqui está sua nova senha de acesso ao sistema.";
$message=$emailtext;
$to=$email;
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
$headers .= 'From: <no-reply@'.$site_url.'>' . "\r\n";
$subject="Recuperação de senha";
$message.="Nova senha : <b> $newpassword </b><br><br>";
mail($to,$subject,$message,$headers);

echo "<br><center><font face='Verdana' size='2' color=red>Sua nova senha foi enviada para o seu email cadastrado aqui no sistema. </font><br>";
}
else
{
 print "<center><font face='Verdana' size='2' color=red><br>Não foi possível recuperar sua senha, tente novamente mais tarde.</font><br>";
}
//updating status if validation passes

}
else{
echo "<br/><br/><br/><center><font face='Verdana' size='2' color=red>$msg</font><br>"; //priting error if found in validation


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
  <h2 class="form-heading">login</h2>
  <div class="app-cam">
	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"], ENT_QUOTES, "utf-8"); ?>" method="post">
	
		<input type="email" class="text" value="Seu email cadastrado" name="femail" required onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Seu email';}">
		<br>
		<div class="submit"><input type="submit" onclick="myFunction()" value="Recuperar Senha"></div>
		
		<ul class="new">
			
			<li class="new_right"><p class="sign">#<a href="index.php"> Fazer Login</a></p></li>
			<div class="clearfix"></div>
		</ul>
	</form>
  </div>
   <?php
include_once ("admin/site/footer.php");
?>
</body>
</html>
