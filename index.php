<?php 
// VERIFICA SE EXISTEM ERROS DE EXECUÇÃO NO CÓDIGO
ini_set('display_errors',1);

// CHAMA O ARQUIVO DE VERIFICAÇÃO DE EXISTÊNCIA DAS CLASSES
require_once("config.php");

// CRIA UM OBJETO SQL
$sql = new Sql();

// SOLICITA UM SELECT AO BANCO
$usuarios = $sql->select("SELECT 
							NOME_CLIENTE
							,[CPF/CNPJ]
							,[EMAIL_PRINCIPAL]
      						,[EMAIL_SECUNDARIO]
  							,[EMAIL_RESERVA] 
						FROM 
							tbl_SIEXC_OPES_EMAIL_CLIENTES_CADASTRO");

echo json_encode($usuarios, JSON_UNESCAPED_SLASHES);

?>