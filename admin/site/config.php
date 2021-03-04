<?php

// ARQUIVO DE CONFIGURAÇÃO DO SITE
// Para editar recomenda-se o uso de um editor de texto, ou de códigos, como o NotePad++, é fácil de usar, e você pode baixar ele gratuitamente, procure no google.

// Para configurar o site, apenas edite o que estiver entre aspas, substitua os valores

// ----------------- Dados do Site:

// # Nome do site:
$site_name="MMN5+DL V1.3";

// # URL do site:
$site_url="http://mmn.dev/backoffice/"; // <<< não esqueça da / no final da URL! Se você instalar na raiz do site, use apenas http://seudominio.com.br/

// # Email do Suporte:
$email_suporte="suporte@demo.com";

// # Email do Suporte:
$email_bank="financeiro@demo.com";

// ----------------- Dados bancários do sistema:

// Conta Bancária 1
// Banco:
$site_bank1="CEF";
// Agencia:
$site_agencia1="123";
// Nº da Conta:
$site_nconta1="123456";
// Tipo - Poupança ou Corrente
$site_tipo_conta1="poupança";

// Conta Bancária 2
// Banco:
$site_bank2="BB";
// Agencia:
$site_agencia2="456";
// Nº da Conta:
$site_nconta2="987456";
// Tipo - Poupança ou Corrente
$site_tipo_conta2="corrente";

// Outros Métodos de Pagamento
// Email ContaSuper:
$site_contasuper="email@contasuper.com";
// Email Neteller:
$site_neteller="email@neteller.com";
// Email Paypal:
$site_paypal="email@paypal.com";

// --------------------- Configuração do Marketing do Sistema

// Limite de ganhos no sistema, em relação ao valor investido, não inclui ganhos com formação de equipe, apenas ganhos com bônus divisão de lucro
// valor em %, insira apenas números
//$limite_ganhos="150";

// limite de pacotes que um usuário pode comprar
$packs_limite="2";

// Valor mínimo para solicitar saque:
$saque_minimo="50";
// Valor da taxa de saque em % - será descontado do valor do saque, exemplo: o usuário tem R$500,00, solicitaa o saque, e recebrá R$450,00 se a taxa for de 10%
$taxa_saque="5";

// Quantidade mínima de indicados diretos ativos para ter direito ao bônus divisão de lucro, coloque zero se não deseja essa função
$diretos_minimo_bdl="1";

// Bônus liderança - Apartir de X vendas, ou indicados ativos pagantes,
// o usuário passa a receber o dobro do Bônus Divisão de Lucro
// Se não deseja oferecer este bônus, coloque o número 999
$lider_minimo="10";

// ABAIXO CONFIGURA AS BONIFICAÇÕES, PARA NÃO DAR BÔNUS EM UM NÍVEL, COLOQUE O NÚMERO zero
// Comissão por downline direto = 1º nível / em %
$bonus_nv1="10";

// Comissão por downline indireto no 2º nível / em %
$bonus_nv2="5";

// Comissão por downline indireto no 3º nível / em %
$bonus_nv3="5";

// Comissão por downline indireto no 4º nível / em %
$bonus_nv4="5";

// Comissão por downline indireto no 5º nível / em %
$bonus_nv5="5";


?>