<?php 

require_once("config.php");

$sql = new Sql();

var_dump($sql);

$usuarios = $sql->select("SELECT NOME_CLIENTE from tbl_SIEXC_OPES_EMAIL_CLIENTES_CADASTRO");

echo json_encode($usuarios);


?>