<?php
//session_start(); //starting session
include('site/mmn_db.php'); //connection details
$status = "OK"; //initial status
$msg="";
$username=mysqli_real_escape_string($con,$_POST['username']); //fetching details through post method
$password = mysqli_real_escape_string($con,$_POST['password']);

if ( strlen($username) < 8 ){
$msg=$msg."Username must be more than 8 char legth<BR>";
$status= "NOTOK";}

if ( strlen($password) < 8 ){ //checking if password is greater then 8 or not
$msg=$msg."Password must be more than 8 char legth<BR>";
$status= "NOTOK";}

if($status=="OK"){

// Retrieve username and password from database according to user's input, preventing sql injection
$query ="SELECT * FROM affiliateuser WHERE (username = '" . mysqli_real_escape_string($con,$_POST['username']) . "') AND (password = '" . mysqli_real_escape_string($con,$_POST['password']) . "') AND (active = '" . mysqli_real_escape_string($con,"1") . "') AND (level = '" . mysqli_real_escape_string($con,"1") . "')";
if ($stmt = mysqli_prepare($con, $query)) {

    /* execute query */
    mysqli_stmt_execute($stmt);

    /* store result */
    mysqli_stmt_store_result($stmt);

    $num=mysqli_stmt_num_rows($stmt);

    /* close statement */
    mysqli_stmt_close($stmt);
}

mysqli_close($con);
// Check username and password match

if (($num) == 1) {
session_start();
        // Set username session variable
        $_SESSION['adminidusername'] = $username;
		
        // Jump to secured page
		print "
				<script language='javascript'>
					window.location = 'home.php?page=home%location=index.php';
				</script>";
}else{
echo "<br/><br/><br/><br/><br/><center>Username And Password Not Matched Or May Be Your Account Is Inactive. <br/> Contact Admin For More Information.</center>";
}} 
else {
        
echo "<font face='Verdana' size='2' color=red>$msg</font><br><input type='button' value='Retry' onClick='history.go(-1)'>"; //printing errors
	 
}

?>
