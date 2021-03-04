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
include_once ("downlines.php");
include_once ("financial.php");
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
		<h3>Minha equipe!</h3>
		
		<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<h2>Total de usuários na rede</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>1º nível</th>
					<th>2º nível</th>
					<th>3º nível</th>
					<th>4º nível</th>
					<th>5º nível</th>
					</tr>
					</thead>
					<tbody>
					<tr>
					<td><? print $numrows1 ?></td>
					<td><? print $numrows2 ?></td>
					<td><? print $numrows3 ?></td>
					<td><? print $numrows4 ?></td>
					<td><? print $numrows5 ?></td>
					</tr>
					</tbody>
					</table>
					</div>
				</div>
			</div>
			
			<div class="grid_3 grid_5">
	     
	     <div class="but_list">
	       <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
			<ul id="myTab" class="nav nav-tabs" role="tablist">
			  <li role="presentation" class="active"><a href="#home" class="btn btn-lg btn-primary" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true">Diretos</a></li>
			  <li role="presentation"><a href="#profile2" class="btn btn-lg btn-success" role="tab" id="profile-tab2" data-toggle="tab" aria-controls="profile2">2º nível</a></li>
			  <li role="presentation"><a href="#profile3" class="btn btn-lg btn-success" role="tab" id="profile-tab3" data-toggle="tab" aria-controls="profile3">3º nível</a></li>
			  <li role="presentation"><a href="#profile4" class="btn btn-lg btn-success" role="tab" id="profile-tab4" data-toggle="tab" aria-controls="profile4">4º nível</a></li>
			  <li role="presentation"><a href="#profile5" class="btn btn-lg btn-success" role="tab" id="profile-tab5" data-toggle="tab" aria-controls="profile5">5º nível</a></li>
			  
			  
			</ul>
		<div id="myTabContent" class="tab-content">
		  <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
		    <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<h2>Usuários</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>Usuário</th>
					<th>Email</th>
					<th>WhatsApp</th>
					<th>Status</th>
					</tr>
					</thead>
					<tbody>
					<?php
// busca usuario 
if($numrows1 > 0){
	$query1="SELECT * FROM uplines where up1 ='$my_code'";
	$result1 = mysqli_query($con,$query1);
	while($row1 = mysqli_fetch_array($result1)){
		$user_code1="$row1[user_id]";
		}
		$query10="SELECT * FROM  affiliateuser where signupcode = '$user_code1' ORDER BY id DESC";
		$result10 = mysqli_query($con,$query10);
		while($row10 = mysqli_fetch_array($result10)){
			$dw1_user="$row10[username]";
			$dw1_email="$row10[email]";
			$dw1_whats="$row10[mobile]";
			$dw1_active="$row10[active]";
			}if($dw1_active==1){
				$dw1_status="Ativo";
				}else{
					$dw1_status="Pendente";
					}
					print "<tr>
					<td>$dw1_user</td>
					<td>$dw1_email</td>
					<td>$dw1_whats</td>
					<td>$dw1_status</td>
					</tr>";
}

?>
					
					</tbody>
					</table>
					</div>
				</div>
			</div>
		 </div>
		  <div role="tabpanel" class="tab-pane fade" id="profile2" aria-labelledby="profile-tab2">
		    
			<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<h2>Usuários</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>Usuário</th>
					<th>Email</th>
					<th>WhatsApp</th>
					<th>Status</th>
					</tr>
					</thead>
					<tbody>
					<?php
// busca usuario 
if($numrows2 > 0){
	$query2="SELECT * FROM uplines where up2 ='$my_code'";
	$result2 = mysqli_query($con,$query2);
	while($row2 = mysqli_fetch_array($result2)){
		$user_code2="$row2[user_id]";
		}
		$query20="SELECT * FROM  affiliateuser where signupcode = $user_code2";
		$result20 = mysqli_query($con,$query20);
		while($row20 = mysqli_fetch_array($result20)){
			$dw2_user="$row20[username]";
			$dw2_email="$row20[email]";
			$dw2_whats="$row20[mobile]";
			$dw2_active="$row20[active]";
			}if($dw2_active==1){
				$dw2_status="Ativo";
				}else{
					$dw2_status="Pendente";
					}
					print "<tr>
					<td>$dw2_user</td>
					<td>$dw2_email</td>
					<td>$dw2_whats</td>
					<td>$dw2_status</td>
					</tr>";
}

?>
					</tbody>
					</table>
					</div>
				</div>
			</div>
			
			</div>
			
			<div role="tabpanel" class="tab-pane fade" id="profile3" aria-labelledby="profile-tab3">
		    
			<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<h2>Usuários</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>Usuário</th>
					<th>Email</th>
					<th>WhatsApp</th>
					<th>Status</th>
					</tr>
					</thead>
					<tbody>
					<?php
// busca usuario 
if($numrows3 > 0){
	$query3="SELECT * FROM uplines where up3 ='$my_code'";
	$result3 = mysqli_query($con,$query3);
	while($row3 = mysqli_fetch_array($result3)){
		$user_code3="$row3[user_id]";
		}
		$query30="SELECT * FROM  affiliateuser where signupcode = $user_code3";
		$result30 = mysqli_query($con,$query30);
		while($row30 = mysqli_fetch_array($result30)){
			$dw3_user="$row30[username]";
			$dw3_email="$row30[email]";
			$dw3_whats="$row30[mobile]";
			$dw3_active="$row30[active]";
			}if($dw3_active==1){
				$dw3_status="Ativo";
				}else{
					$dw3_status="Pendente";
					}
					print "<tr>
					<td>$dw3_user</td>
					<td>$dw3_email</td>
					<td>$dw3_whats</td>
					<td>$dw3_status</td>
					</tr>";
}

?>
					</tbody>
					</table>
					</div>
				</div>
			</div>
			
			</div>
			
			<div role="tabpanel" class="tab-pane fade" id="profile4" aria-labelledby="profile-tab4">
		    
			<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<h2>Usuários</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>Usuário</th>
					<th>Email</th>
					<th>WhatsApp</th>
					<th>Status</th>
					</tr>
					</thead>
					<tbody>
					<?php
// busca usuario 
if($numrows4 > 0){
	$query4="SELECT * FROM uplines where up4 ='$my_code'";
	$result4 = mysqli_query($con,$query4);
	while($row4 = mysqli_fetch_array($result4)){
		$user_code4="$row4[user_id]";
		}
		$query40="SELECT * FROM  affiliateuser where signupcode = $user_code4";
		$result40 = mysqli_query($con,$query40);
		while($row40 = mysqli_fetch_array($result40)){
			$dw4_user="$row40[username]";
			$dw4_email="$row40[email]";
			$dw4_whats="$row40[mobile]";
			$dw4_active="$row40[active]";
			}if($dw4_active==1){
				$dw4_status="Ativo";
				}else{
					$dw4_status="Pendente";
					}
					print "<tr>
					<td>$dw4_user</td>
					<td>$dw4_email</td>
					<td>$dw4_whats</td>
					<td>$dw4_status</td>
					</tr>";
}

?>
					</tbody>
					</table>
					</div>
				</div>
			</div>
			
			</div>
			
			<div role="tabpanel" class="tab-pane fade" id="profile5" aria-labelledby="profile-tab5">
		    
			<div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
				<div class="panel-heading">
					<h2>Usuários</h2>
					<div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
				</div>
				<div class="panel-body no-padding" style="display: block;">
					<div class="table-responsive">
					<table class="table table-bordered">
					<thead>
					<tr>
					<th>Usuário</th>
					<th>Email</th>
					<th>WhatsApp</th>
					<th>Status</th>
					</tr>
					</thead>
					<tbody>
					<?php
// busca usuario 
if($numrows5 > 0){
	$query5="SELECT * FROM uplines where up5 ='$my_code'";
	$result5 = mysqli_query($con,$query5);
	while($row5 = mysqli_fetch_array($result5)){
		$user_code5="$row5[user_id]";
		}
		$query50="SELECT * FROM  affiliateuser where signupcode = $user_code5";
		$result50 = mysqli_query($con,$query50);
		while($row50 = mysqli_fetch_array($result50)){
			$dw5_user="$row50[username]";
			$dw5_email="$row50[email]";
			$dw5_whats="$row50[mobile]";
			$dw5_active="$row50[active]";
			}if($dw5_active==1){
				$dw5_status="Ativo";
				}else{
					$dw5_status="Pendente";
					}
					print "<tr>
					<td>$dw5_user</td>
					<td>$dw5_email</td>
					<td>$dw5_whats</td>
					<td>$dw5_status</td>
					</tr>";
}

?>
					</tbody>
					</table>
					</div>
				</div>
			</div>
			
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
