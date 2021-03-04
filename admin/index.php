<?php
include_once ("site/mmn_db.php");
include_once ("site/config.php");
?>
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
    <h2><a href="index.php"><img src="site/logo.png" alt="" /></a></h2>
  </div>
  <h2 class="form-heading">login</h2>
  <div class="app-cam">
	<form action="loginproc.php" method="post">
	<?php 
						if($_SERVER['REQUEST_METHOD'] == 'POST' && ($errormsg!=""))
						{
						print $errormsg;
						}
						?>
		<input type="text" class="text" value="Seu username" name="username" required onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Seu Username';}">
		<input type="password" value="Password" name="password" required onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Sua senha';}">
		<div class="submit"><input type="submit" onclick="myFunction()" value="Login"></div>
		
		
	</form>
  </div>
   <?php
include_once ("site/footer.php");
?>
</body>
</html>