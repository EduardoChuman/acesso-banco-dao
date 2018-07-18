
<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
		<?php 
		// VERIFICA SE EXISTEM ERROS DE EXECUÇÃO NO CÓDIGO
		ini_set('display_errors',1);

		// CHAMA O ARQUIVO DE VERIFICAÇÃO DE EXISTÊNCIA DAS CLASSES
		require_once("config.php");
		
		//CRIA UM OBJETO SQL
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

		// CARREGA UMA LISTA COM TODAS AS EMPRESAS
		// $lista = Empresa::getEmpresas();
		// echo json_encode($lista);

		//CARREGA UMA LISTA DE EMPRESA COM BASE EM UMA "TAG" DE BUSCA
		// $search = Empresa::search("GILVAN");
		// echo json_encode($search);

		//ATUALIZA UM NOVO E-MAIL NO CADASTRO DA EMPRESA
		// $inserir = new Empresa();
		// // $inserir->loadByCnpj('04.565.932/0001-32');
		// // echo "<br>";
		// $inserir->updateEmail('04.565.932/0001-32','edu.chuman@hotmail.com','eduardo.chuman@gmail.com','eduardo.chuman@caixa.gov.br');
		// echo "<br>";
		// echo $inserir;

		// CRIAÇÃO DO OBJETO EMPREGADO
		// $usuario = new Empregado();
		// echo $usuario;


		// ROTA PARA ACESSAR A LISTA DE EMPRESAS
		
		// CRIAÇÃO DO OBJETO EMPREGADO
		$usuario = new Empregado();
		
		// CRIA UM OBJETO EMPRESA
		$pv = new Empresa();

		// FUNÇÃO PARA TRAZER A RELAÇÃO DAS EMPRESAS COM BASE NO PERFIL DE ACESSO, LOTAÇÃO FÍSICA OU LOTAÇÃO ADMINISTRATIVA - OBS: A MATRICULA É UTILIZADA SOMENTE PARA TESTE DE PERFIL
		$pv->getEmpresas($usuario->getMatricula(),$usuario->getNivelAcesso(), $usuario->getLotacaoFisica(), $usuario->getLotacaoAdm());
		// $pv->getEmpresas();

		?>
</body>
</html>
