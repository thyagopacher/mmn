<?php
// somando todos os saques aguardando
$res = mysqli_query($con,"SELECT sum(payment_amount) FROM payments WHERE userid='$my_username' AND payment_status=0");
$row = mysqli_fetch_row($res);
$sum = $row[0];
// somando todos os saques pagos
$res2 = mysqli_query($con,"SELECT sum(payment_amount) FROM payments WHERE userid='$my_username' AND payment_status=1");
$row2= mysqli_fetch_row($res2);
$sum2 = $row2[0];
// somando total investido
$res3 = mysqli_query($con,"SELECT sum(valor) FROM payorders WHERE user='$my_username' AND status!=0");
$row3= mysqli_fetch_row($res3);
$sum3 = $row3[0];
// total saques
$totalsaque = $sum + $sum2;
// total acunulado - somar tudo sacado + saldo
$totalfaturado = $totalsaque + $my_saldo;

?>