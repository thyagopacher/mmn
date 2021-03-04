<?php
// ESTATÍSTICAS DO SITE - não alterar

// buscar total faturado
$res = mysqli_query($con,"SELECT sum(valor) FROM payorders WHERE status!=0");
$row = mysqli_fetch_row($res);
$sum = $row[0];
// buscar total faturado hoje
$res1 = mysqli_query($con,"SELECT sum(valor) FROM payorders WHERE status=1 AND dia='$hoje'");
$row1 = mysqli_fetch_row($res1);
$sum1 = $row1[0];
// buscar total em saques pagos
$res2 = mysqli_query($con,"SELECT sum(payment_amount) FROM payments WHERE payment_status=1");
$row2 = mysqli_fetch_row($res2);
$sum2 = $row2[0];
// total em saques para pagar
$res3 = mysqli_query($con,"SELECT sum(payment_amount) FROM payments WHERE payment_status=0");
$row3 = mysqli_fetch_row($res3);
$sum3 = $row3[0];
// saldo total dos usuários
$res4 = mysqli_query($con,"SELECT sum(tamount) FROM affiliateuser");
$row4 = mysqli_fetch_row($res4);
$sum4 = $row4[0];

// somar total de pontos dos usuários qualificados lider
$res5 = mysqli_query($con,"SELECT sum(pontos) FROM affiliateuser WHERE active=1 AND lider=1");
$row5 = mysqli_fetch_row($res5);
$sum5 = $row5[0];
$total_ptl=$sum5*2;
// somar total de pontos dos usuários comuns
$res6 = mysqli_query($con,"SELECT sum(pontos) FROM affiliateuser WHERE active=1 AND lider!=1");
$row6 = mysqli_fetch_row($res6);
$sum6 = $row6[0];
// somar tudo
$total_points=$total_ptl+$sum6;
?>
<?php
// buscar total de usuarios ativos e inativos
$result = mysqli_query($con,"SELECT count(*) FROM  affiliateuser where level = 2 and active = 1");
$row = mysqli_fetch_row($result);
$totalusers = $row[0];

$result2 = mysqli_query($con,"SELECT count(*) FROM  affiliateuser where level = 2 and active = 0");
$row2 = mysqli_fetch_row($result2);
$totalusers2 = $row2[0];


?>