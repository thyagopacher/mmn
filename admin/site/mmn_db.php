<?php
// ARQUIVO DE CONEXÃO COM O BANCO DE DADOS
// Substitua os dados entre aspas na linha baixo, pelos dados do banco de dados que você criou

$con = new mysqli("localhost", "root", "", "mnn");
if ($con->connect_errno) {
    echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

?>