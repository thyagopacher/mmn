<?php
//busca numero de usuários por nível

// 1º nivel
$result1 = mysqli_query($con,"SELECT count(*) FROM  affiliateuser where referedby = '".$_SESSION['username']."'");
$row1 = mysqli_fetch_row($result1);
$numrows1 = $row1[0];
// 2º nível
$result2 = mysqli_query($con,"SELECT count(*) FROM  uplines where up2 = '".$_SESSION['username']."'");
$row2 = mysqli_fetch_row($result2);
$numrows2 = $row2[0];
// 3º nível
$result3 = mysqli_query($con,"SELECT count(*) FROM  uplines where up3 = '".$_SESSION['username']."'");
$row3 = mysqli_fetch_row($result3);
$numrows3 = $row3[0];
// 4º nível
$result4 = mysqli_query($con,"SELECT count(*) FROM  uplines where up4 = '".$_SESSION['username']."'");
$row4 = mysqli_fetch_row($result4);
$numrows4 = $row4[0];
// 5º nível
$result5 = mysqli_query($con,"SELECT count(*) FROM  uplines where up5 = '".$_SESSION['username']."'");
$row4 = mysqli_fetch_row($result5);
$numrows5 = $row4[0];

// total na rede
$totalusers=$numrows1+$numrows2+$numrows3+$numrows4+$numrows5;

?>
