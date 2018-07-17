<?php 
// VERIFICA SE EXISTEM ERROS DE EXECUÇÃO NO CÓDIGO
ini_set('display_errors',1);

// CHAMA O ARQUIVO DE VERIFICAÇÃO DE EXISTÊNCIA DAS CLASSES
require_once("config.php");

/*
	CRIA UM OBJETO SQL
// $sql = new Sql();
// SOLICITA UM SELECT AO BANCO
// $usuarios = $sql->select("SELECT 
// 							NOME_CLIENTE
// 							,[CPF/CNPJ]
// 							,[EMAIL_PRINCIPAL]
// 							,[EMAIL_SECUNDARIO]
// 							,[EMAIL_RESERVA] 
// 						FROM 
// 							tbl_SIEXC_OPES_EMAIL_CLIENTES_CADASTRO");
// echo json_encode($usuarios, JSON_UNESCAPED_SLASHES);

*/

// CRIA UM OBJETO EMPRESA E BUSCA POR PV / SR / OU COM A FUNÇÃO DE VERIFICAR AMBOS
// $pv = new Empresa();
// $pv->loadByPv(3337);
// echo "<hr>";
// $sr = new Empresa();
// $sr->loadByPvOuSr(2515);

// CARREGA UMA LISTA COM TODAS AS EMPRESAS
// $lista = Empresa::getEmpresas();
// echo json_encode($lista);

//CARREGA UMA LISTA DE EMPRESA COM BASE EM UMA "TAG" DE BUSCA
// $search = Empresa::search("GILVAN");
// echo json_encode($search);


// ATUALIZA UM NOVO E-MAIL NO CADASTRO DA EMPRESA
$inserir = new Empresa();
// $inserir->loadByCnpj('04.565.932/0001-32');
// echo "<br>";
$inserir->updateEmail('04.565.932/0001-32','edu.chuman@hotmail.com','eduardo.chuman@gmail.com','eduardo.chuman@caixa.gov.br');
echo "<br>";
echo $inserir;

?>