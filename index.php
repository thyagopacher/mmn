<?php
include_once ("admin/site/mmn_db.php");
include_once ("admin/site/config.php");

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['username']))
{
$status = "OK"; //initial status
$msg="";
	$username=mysqli_real_escape_string($con,$_POST['username']); //fetching details through post method
     $password = mysqli_real_escape_string($con,$_POST['password']);

if ( strlen($username) < 6 ){
$msg=$msg."Username deve conter no mínimo 6 caracteres<BR>";
$status= "NOTOK";}

if ( strlen($password) < 6 ){ //checking if password is greater then 8 or not
$msg=$msg."Senha deve conter no mínimo 6 dígitos<BR>";
$status= "NOTOK";}

if($status=="OK"){

// Retrieve username and password from database according to user's input, preventing sql injection
$query ="SELECT * FROM affiliateuser WHERE (username = '" . mysqli_real_escape_string($con,$_POST['username']) . "') AND (password = '" . mysqli_real_escape_string($con,$_POST['password']) . "')";
if ($stmt = mysqli_prepare($con, $query)) {

    /* execute query */
    mysqli_stmt_execute($stmt);

    /* store result */
    mysqli_stmt_store_result($stmt);

    $num=mysqli_stmt_num_rows($stmt);

    /* close statement */
    mysqli_stmt_close($stmt);
}
//mysqli_close($con);
// Check username and password match

if (($num) == 1) {



session_start();
        // Set username session variable
        $_SESSION['username'] = $username;
		
        // Jump to secured page
		print "
				<script language='javascript'>
					window.location = 'home.php?page=home%location=index.php';
				</script>"; 


}



else{
$errormsg= "
<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>ERRO : </br></strong>Username ou Senha incorretos, tente novamente.</div>"; //printing error if found in validation
				
}} 
else {
        
$errormsg= "
<div class='alert alert-danger'>
                    <button type='button' class='close' data-dismiss='alert'>&times;</button>
                    <i class='fa fa-ban-circle'></i><strong>ERRO : </br></strong>".$msg."</div>"; //printing error if found in validation
				
	 
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
	<?php 
						if($_SERVER['REQUEST_METHOD'] == 'POST' && ($errormsg!=""))
						{
						print $errormsg;
						}
						?>
		<input type="text" class="text" value="Seu username" name="username" required onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Seu Username';}">
		<input type="password" value="Password" name="password" required onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Sua senha';}">
		<div class="submit"><input type="submit" onclick="myFunction()" value="ENTRAR"></div>
		
		<ul class="new">
			<li class="new_left"><p><a href="rec_pass.php">Perdeu a senha?</a></p></li>
			<li class="new_right"><p class="sign">#<a href="register.php">Criar Conta</a></p></li>
			<div class="clearfix"></div>
		</ul>
	</form>
  </div>
   <?php
   include_once ("admin/site/footer.php");
   ?>
</body>
</html>
