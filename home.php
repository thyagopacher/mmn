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

// desativa qualquer pacote com vencimento pra hoje
$desativapacks = mysqli_query($con, "UPDATE payorders SET status=2 WHERE valid='$hoje'");

if ($desativapacks) {
    // atualizar pontuação
    $res4 = mysqli_query($con, "SELECT sum(pontos) FROM payorders WHERE user='" . $_SESSION['username'] . "' AND status=1");
    $row4 = mysqli_fetch_row($res4);
    $sum4 = $row4[0];
    $updatepoints = mysqli_query($con, "UPDATE affiliateuser SET pontos='$sum4' WHERE username='" . $_SESSION['username'] . "'");

    if ($updatepoints) {
        // desativa todos usuários que não tem pontos
        $desativausers = mysqli_query($con, "UPDATE affiliateuser SET active=0 WHERE level=2 AND pontos=0 ");
    }
}

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
                    <h3>Painel do usuário</h3>

                    <div class="col_3">
                        <div class="col-md-12 widget widget1">
                            <div class="r3_counter_box">
                                <i class="pull-left fa fa-user icon-rounded"></i>
                                <div class="stats">
                                    <h5>Bem vindo: <strong><?php print $my_username ?></strong></h5>
                                    <span>Status: <?php
            if ($my_status == 1) {
                $sts = "Ativo";
            } else {
                $sts = "Inativo/Pendente";
            } print $sts
            ?></span>
                                    <?php
                                    $diretos = mysqli_query($con, "SELECT count(*) FROM  affiliateuser where referedby = '" . $_SESSION['username'] . "' AND active=1 ");
                                    $row1 = mysqli_fetch_row($diretos);
                                    $diretosativos = $row1[0];

                                    if ($my_status == 1) {
                                        if ($diretosativos >= 1) {
                                            $qualify1 = "SIM";
                                        } else {
                                            $qualify1 = "NÃO";
                                        }
                                    } else {
                                        $qualify1 = "NÃO";
                                    }


                                    if ($diretosativos >= $lider_minimo) {
                                        $qualify3 = "SIM";
                                        $update4lider = mysqli_query($con, "UPDATE affiliateuser SET lider=1 WHERE username='" . $_SESSION['username'] . "'");
                                    } else {
                                        $qualify3 = "NÂO";
                                    }
                                    ?>
                                    <span>Qualificações: Divisão de lucro=<?php print $qualify1 ?> Bônus Liderança=<?php print $qualify3 ?> </span>
                                    <br>Seu link de indicação: <a href="<?php print $site_url ?>register.php?ref=<?php print $my_username ?>" target="blank"><?php print $site_url ?>register.php?ref=<?php print $my_username ?></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 widget widget1">
                            <div class="r3_counter_box">
                                <i class="pull-left fa fa-users user1 icon-rounded"></i>
                                <div class="stats">
<?php
$result = mysqli_query($con, "SELECT count(*) FROM  affiliateuser where referedby = '" . $_SESSION['username'] . "'");
$row = mysqli_fetch_row($result);
$numdow = $row[0];
?>
                                    <h5><strong><?php print $numdow ?></strong></h5>
                                    <span>Indicados Diretos</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 widget">
                            <div class="r3_counter_box">
                                <i class="pull-left fa fa-dollar dollar1 icon-rounded"></i>
                                <div class="stats">
                                    <h5><strong>R$ <?php print number_format($my_saldo, 2, ',', '.'); ?></strong></h5>
                                    <span>Saldo Disponível </span><a href="bank.php" class="btn btn-info">SACAR</a>
                                </div>
                            </div>
                        </div>



                        <div class="clearfix"> </div>
                    </div>
<?php
include_once ("verify_packs.php");
?>
                    <?php
                    if ($my_status != 1) {
                        print"
	<div class='alert alert-danger' role='alert'><strong>Atenção!</strong> 
	Você não está ativo, para receber os bônus, você precisa comprar um pacote.</div>
	";
                    }
                    ?>
                    <div class="widget_2">

                        <div class="col-sm-4 widget_1_box">
                            <div class="wid-social skype">
                                <div class="social-icon">
                                    <i class="fa fa-money text-light icon-xlg pull-right"></i>
                                </div>
                                <div class="social-info">
                                    R$<h3 class="number_counter bold count text-light start_timer counted"><?php print number_format($totalfaturado, 2, ',', '.'); ?></h3>
                                    <h4 class="counttype text-light">Total acumulado</h4>
                                    <span class="percent">Soma total dos ganhos no sistema</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 widget_1_box">
                            <div class="wid-social youtube">
                                <div class="social-icon">
                                    <i class="fa fa-users text-light icon-xlg pull-right"></i>
                                </div>
                                <div class="social-info">
                                    <h3 class="number_counter bold count text-light start_timer counted"><?php print $totalusers ?></h3>
                                    <h4 class="counttype text-light">Downlines</h4>
                                    <span class="percent">Total de usuários na sua rede</span>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-4 widget_1_box">
                            <div class="wid-social facebook">
                                <div class="social-icon">
                                    <i class="fa fa-star-o text-light icon-xlg pull-right"></i>
                                </div>
                                <div class="social-info">
                                    <h3 class="number_counter bold count text-light start_timer counted"><?php print $my_pontos ?></h3>
                                    <h4 class="counttype text-light">PONTOS</h4>
                                    <span class="percent">Pontos para Divisão de Lucro</span>
                                </div>
                            </div>
                        </div>


                        <div class="clearfix"> </div>
                    </div>

                    <div class="xs">

                        <div class="panel panel-warning" data-widget="{&quot;draggable&quot;: &quot;false&quot;}" data-widget-static="">
                            <div class="panel-heading">
                                <a href="packs.php" type="button" class="btn btn-warning warning_22 pull-right">COMPRAR PACOTE</a>
                                <h2>Meus Pacotes</h2>
                                <div class="panel-ctrls" data-actions-container="" data-action-collapse="{&quot;target&quot;: &quot;.panel-body&quot;}"><span class="button-icon has-bg"><i class="ti ti-angle-down"></i></span></div>
                            </div>
                            <div class="panel-body no-padding" style="display: block;">
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Pacote</th>
                                                <th>Valor</th>
                                                <th>Pontos</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
<?php
$query = "SELECT * FROM  payorders where user='$my_username' AND status!=0 ORDER BY id DESC";
$result = mysqli_query($con, $query);
$i = 0;
while ($row = mysqli_fetch_array($result)) {

    $p_id = "$row[id]";
    $p_valor = "$row[valor]";
    $p_tipo = "$row[tipo]";
    $p_user = "$row[user]";
    $p_nome = "$row[nome]";
    $p_status = "$row[status]";
    $p_points = "$row[pontos]";
    $p_validad = "$row[valid]";

    if ($p_status == 1) {
        $exibir = "ATIVO até $p_validad";
    } elseif ($p_status == 2) {
        $exibir = "VENCEU dia $p_validad";
    }
    ?>

                                                <tr>
                                                    <td><?php print $p_id ?></td>
                                                    <td><?php print $p_tipo ?></td>
                                                    <td>R$ <?php print number_format($p_valor, 2, ',', '.'); ?></td>
                                                    <td><?php print $p_points ?></td>
                                                    <td><?php print $exibir ?></td>
                                                </tr>
                                                <?php
                                                }

                                                ?>
                                            </tbody>
                                        </table>
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