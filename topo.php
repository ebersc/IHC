<?php
//Conexão com MySQL (host, usuário, senha)
$conexao = mysql_connect("localhost","root", "") or die("Erro ao conectar com MySQL!");

//Conexão com o Banco de Dados
mysql_select_db("intranet", $conexao) or die("Erro ao acessar o banco de dados!");
?>