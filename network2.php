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
	$query1="SELECT * FROM affiliateuser where referedby ='$my_username' ORDER BY id DESC";
	$result1 = mysqli_query($con,$query1);
	while($row1 = mysqli_fetch_array($result1)){
		$dw1_user="$row1[username]";
			$dw1_email="$row1[email]";
			$dw1_whats="$row1[mobile]";
			$dw1_active="$row1[active]";
			
			if($dw1_active==1){
				$dw1_status="Ativo";
				}else{
					$dw1_status="Pendente";
					}
			
			print "
			<tr>
					<td>$dw1_user</td>
					<td>$dw1_email</td>
					<td>$dw1_whats</td>
					<td>$dw1_status</td>
					</tr>
					";
		
		}
		
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
					</tr>
					</thead>
					<tbody>
					<?php
// busca usuario 
if($numrows2 > 0){
	$query2="SELECT * FROM uplines where up2 ='$my_username'";
	$result2 = mysqli_query($con,$query2);
	while($row2 = mysqli_fetch_array($result2)){
		$user_code2="$row2[user_id]";
		}
		
					print "<tr>
					<td>$user_code2</td>
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
					</tr>
					</thead>
					<tbody>
					<?php
// busca usuario 
if($numrows3 > 0){
	$query3="SELECT * FROM uplines where up3 ='$my_username'";
	$result3 = mysqli_query($con,$query3);
	while($row3 = mysqli_fetch_array($result3)){
		$user_code3="$row3[user_id]";
		}
		
					print "<tr>
					<td>$user_code3</td>
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
					</tr>
					</thead>
					<tbody>
					<?php
// busca usuario 
if($numrows4 > 0){
	$query4="SELECT * FROM uplines where up4 ='$my_username'";
	$result4 = mysqli_query($con,$query4);
	while($row4 = mysqli_fetch_array($result4)){
		$user_code4="$row4[user_id]";
		}
		
					print "<tr>
					<td>$user_code4</td>
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
					</tr>
					</thead>
					<tbody>
					<?php
// busca usuario 
if($numrows5 > 0){
	$query5="SELECT * FROM uplines where up5 ='$my_username'";
	$result5 = mysqli_query($con,$query5);
	while($row5 = mysqli_fetch_array($result5)){
		$user_code5="$row5[user_id]";
		}
		
					print "<tr>
					<td>$user_code5</td>
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
