<?php
// busca se tem algum pacote vencendo hoje
$buscapacks = mysqli_query($con,"SELECT count(*) FROM  payorders where user='$my_username' AND status=1 AND valid='$hoje'");
$rowp = mysqli_fetch_row($buscapacks);
$qtdpacks = $rowp[0];

// pega os dados desses pacotes = sum
if ($qtdpacks == 1){
	
$query="SELECT * FROM  payorders where user='$my_username' AND status=1 AND valid='$hoje'";
$result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result))
{
	
	$pv_id="$row[id]";
	$pv_valor="$row[valor]";
	$pv_tipo="$row[tipo]";
	$pv_user="$row[user]";
	$pv_nome="$row[nome]";
	$pv_status="$row[status]";
	$pv_points="$row[pontos]";
	$pv_validad="$row[valid]";
	
	print "
	<div class='alert alert-danger' role='alert'><strong>Atenção!</strong> Hoje seu Pacote $pv_tipo venceu, e os pontos referentes à ele foram subtraidos da sua conta.<br>
			Para ficar Ativo novamente e ter pontos para participar da divisão de lucros, e conquistar o status de líder, compre um novo pacote!</div>
			";

}
// atualiza perfil do usuário, - pontos, status= 2
$new_pontos=$my_pontos-$pv_points;
$atualiza2=mysqli_query($con,"UPDATE payorders SET status=2 WHERE id='$pv_id'");
$atualiza=mysqli_query($con,"UPDATE affiliateuser SET active=2,lider=0,pontos='$new_pontos' WHERE username='".$_SESSION['username']."'");

}

elseif ($qtdpacks > 1){
	
$query="SELECT * FROM  payorders where user='$my_username' AND status=1 AND valid='$hoje' ORDER BY id DESC";
$result = mysqli_query($con,$query);
$i=0;
while($row = mysqli_fetch_array($result)){
	$pv_id="$row[id]";
	$pv_valor="$row[valor]";
	$pv_tipo="$row[tipo]";
	$pv_user="$row[user]";
	$pv_nome="$row[nome]";
	$pv_status="$row[status]";
	$pv_points="$row[pontos]";
	$pv_validad="$row[valid]";
	
	print "
	<div class='alert alert-danger' role='alert'><strong>Atenção!</strong> Hoje seu Pacote $pv_tipo venceu, e os pontos referentes à ele foram subtraidos da sua conta.<br>
			Para ficar Ativo novamente e ter pontos para participar da divisão de lucros, compre um novo pacote!</div>
			";
			
}

$resp = mysqli_query($con,"SELECT sum(valor) FROM payorders where user='$my_username' AND status=1 AND valid='$hoje'");
$row = mysqli_fetch_row($resp);
$totalpv = $row[0];

// atualiza perfil do usuário, - pontos, status= 2
$new_pontos=$my_pontos - $totalpv;
$atualiza2=mysqli_query($con,"UPDATE payorders SET status=2 WHERE id='$pv_id'");
$atualiza=mysqli_query($con,"UPDATE affiliateuser SET active=2,lider=0,pontos='$new_pontos' WHERE username='".$_SESSION['username']."'");

}


?>