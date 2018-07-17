<?php  
// VERIFICA SE EXISTEM ERROS DE EXECUÇÃO NO CÓDIGO
ini_set('display_errors',1);


// CRIAÇÃO DA CLASSE
class Empresa {

	private $nome;
	private $cnpj;
	private $emailPrincipal;
	private $emailSecundario;
	private $emailReserva;
	private $codPv;
	private $codSr;


	// GETTERS E SETTERS DAS VARIÁVEIS DA CLASSE
	
	// $nome
	public function getNome(){
		return $this->nome;
	}
	public function setNome($value){
		$this->nome = $value;
	}

	// $cnpj
	public function getCnpj(){
		return $this->cnpj;
	}
	public function setCnpj($value){
		$this->cnpj = $value;
	}

	// $emailPrincipal
	public function getEmailPrincipal(){
		return $this->emailPrincipal;
	}
	public function setEmailPrincipal($value){
		$this->emailPrincipal = $value;
	}

	// $emailSecundario
	public function getEmailSecundario(){
		return $this->emailSecundario;
	}
	public function setEmailSecundario($value){
		$this->emailSecundario = $value;
	}

	// $emailReserva
	public function getEmailReserva(){
		return $this->emailReserva;
	}
	public function setEmailReserva($value){
		$this->emailReserva = $value;
	}

	// FUNÇÃO QUE TRAZ A PRIMEIRA OCORRENCIA DO SELECT (NÃO FUNCIONA PARA TRAZER AS EMPRESAS)
	// public function loadByPv($codPv){

	// 	$sql = new Sql();

	// 	$result = $sql->select("SELECT 
	// 								[NOME_CLIENTE]
	// 								,[CPF/CNPJ]
	// 								,[EMAIL_PRINCIPAL]
	// 								,[EMAIL_SECUNDARIO]
	// 								,[EMAIL_RESERVA] 
	// 							FROM 
	// 								tbl_SIEXC_OPES_EMAIL_CLIENTES_CADASTRO
	// 							WHERE
	// 								[CO_PV] = :PV", array(":PV"=>$codPv));
	// 	if(count($result) > 0){

	// 		$row = $result[0];

	// 		$this->setNome($row['NOME_CLIENTE']);
	// 		$this->setCnpj($row['CPF/CNPJ']);
	// 		$this->setEmailPrincipal($row['EMAIL_PRINCIPAL']);
	// 		$this->setEmailSecundario($row['EMAIL_SECUNDARIO']);
	// 		$this->setEmailReserva($row['EMAIL_RESERVA']);

	// 	}
	// }

	public function __toString(){

		return json_encode(array(
			"NOME_CLIENTE"=>$this->getNome(),
			"CPF/CNPJ"=>$this->getCnpj(),
			"EMAIL_PRINCIPAL"=>$this->getEmailPrincipal(),
			"EMAIL_SECUNDARIO"=>$this->getEmailSecundario(),
			"EMAIL_RESERVA"=>$this->getEmailReserva(),
		), JSON_UNESCAPED_SLASHES);
	}

	//FUNÇÃO PARA TRAZER TODOS OS RESULTADOS DA TABELA
	public static function getEmpresas(){

		$sql = new Sql();

		return $sql->select("SELECT 
									[NOME_CLIENTE]
									,[CPF/CNPJ]
									,[EMAIL_PRINCIPAL]
									,[EMAIL_SECUNDARIO]
									,[EMAIL_RESERVA] 
								FROM 
									tbl_SIEXC_OPES_EMAIL_CLIENTES_CADASTRO");
	}

	// FUNÇÃO PARA RETORNAR O RESULTADO DE UM SEARCH
	public static function search($empresa){

		$sql = new Sql();

		return $sql->select("SELECT 
								[NOME_CLIENTE]
								,[CPF/CNPJ]
								,[EMAIL_PRINCIPAL]
								,[EMAIL_SECUNDARIO]
								,[EMAIL_RESERVA] 
							FROM 
								tbl_SIEXC_OPES_EMAIL_CLIENTES_CADASTRO
							WHERE
								[NOME_CLIENTE] LIKE :SEARCH", array(':SEARCH'=>"%" . $empresa . "%"));

			

	}


	// FUNÇÃO QUE TRAZ TODOS OS RESULTADOS DE UM SELECT COM WHERE NO CO_PV (TRAZ TODOS OS REGISTROS DA AGÊNCIA)
	public function loadByPv($codPv){

		$sql = new Sql();

		$result = $sql->select("SELECT 
									[NOME_CLIENTE]
									,[CPF/CNPJ]
									,[EMAIL_PRINCIPAL]
									,[EMAIL_SECUNDARIO]
									,[EMAIL_RESERVA] 
								FROM 
									tbl_SIEXC_OPES_EMAIL_CLIENTES_CADASTRO
								WHERE
									[CO_PV] = :PV", array(":PV"=>$codPv));

		echo json_encode($result, JSON_UNESCAPED_SLASHES);
		// var_dump($result);

	}

	// FUNÇÃO QUE TRAZ TODOS OS RESULTADOS DE UM SELECT COM WHERE NO CO_SR (TRAZ TODOS OS REGISTROS DA SUPERITENDÊNCIA)
	public function loadBySr($codSr){

		$sql = new Sql();

		$result = $sql->select("SELECT 
									[NOME_CLIENTE]
									,[CPF/CNPJ]
									,[EMAIL_PRINCIPAL]
									,[EMAIL_SECUNDARIO]
									,[EMAIL_RESERVA] 
									,[CO_PV] 
								FROM 
									tbl_SIEXC_OPES_EMAIL_CLIENTES_CADASTRO
								WHERE
									[CO_SR] = :SR", array(":SR"=>$codSr));

		echo json_encode($result, JSON_UNESCAPED_SLASHES);
		// var_dump($result);

	}
	// FUNÇÃO QUE TRAZ TODOS OS RESULTADOS DE UM SELECT COM WHERE NO [CPF/CNPJ]
	public function loadByCnpj($cnpj){

		$this->setCnpj($cnpj);

		$sql = new Sql();

		$result = $sql->select("SELECT 
									[NOME_CLIENTE]
									,[CPF/CNPJ]
									,[EMAIL_PRINCIPAL]
									,[EMAIL_SECUNDARIO]
									,[EMAIL_RESERVA] 
								FROM 
									tbl_SIEXC_OPES_EMAIL_CLIENTES_CADASTRO
								WHERE
									[CPF/CNPJ]= :CNPJ", array(":CNPJ"=>$cnpj));
		
		echo json_encode($result, JSON_UNESCAPED_SLASHES);
		// var_dump($result);

	}

	// FUNÇÃO QUE TRAZ A RELAÇÃO DE TODAS AS EMPRESAS DE UM PV OU SR
	public function loadByPvOuSr($cod){

		$sql = new Sql();

		// PRIMEIRO REALIZA UM SELECT POR PV
		$result = $sql->select("SELECT 
									[NOME_CLIENTE]
									,[CPF/CNPJ]
									,[EMAIL_PRINCIPAL]
									,[EMAIL_SECUNDARIO]
									,[EMAIL_RESERVA] 
								FROM 
									tbl_SIEXC_OPES_EMAIL_CLIENTES_CADASTRO
								WHERE
									[CO_PV] = :PV", array(":PV"=>$cod));
		
		/*
			AQUI VERIFICA QUE O SELECT RETORNOU ALGUM RESULTADO. CASO: 

			POSITIVO: ELE TRARÁ UM JSON DO SELECT;
			NEGATIVO: ELE PARTIRÁ PARA O PRÓXIMO SELECT (SR);
		
		*/
		if (!empty($result)) {
		 	
		 	echo json_encode($result, JSON_UNESCAPED_SLASHES);
		
		} else {
			
			// REALIZAÇÃO DO SELECT POR SR
			$result = $sql->select("SELECT 
										[NOME_CLIENTE]
										,[CPF/CNPJ]
										,[EMAIL_PRINCIPAL]
										,[EMAIL_SECUNDARIO]
										,[EMAIL_RESERVA] 
										,[CO_PV] 
									FROM 
										tbl_SIEXC_OPES_EMAIL_CLIENTES_CADASTRO
									WHERE
										[CO_SR] = :SR", array(":SR"=>$cod));
		
		/*
			AQUI VERIFICA QUE O SELECT RETORNOU ALGUM RESULTADO. CASO: 

			POSITIVO: ELE TRARÁ UM JSON DO SELECT;
			NEGATIVO: ELE DEVOLVERÁ UMA MENSAGEM DE ERRO;
		
		*/
			if (!empty($result)) {

				echo json_encode($result, JSON_UNESCAPED_SLASHES);

			} 

		} if (empty($result)) {

			echo "Não existem empresas cadastradas nesse ponto de atendimento.";

		}

	}

	// FUNÇÃO PARA INSERIR E-MAIL NA TABELA [tbl_SIEXC_OPES_EMAIL_CLIENTES_CADASTRO]
	public function updateEmail($cnpj, $emailPrincipal = "", $emailSecundario = "", $emailReserva = ""){

		$this->setCnpj($cnpj);
		$this->setEmailPrincipal($emailPrincipal);
		$this->setEmailSecundario($emailSecundario);
		$this->setEmailReserva($emailReserva);

		$sql = new Sql();

		$sql->query("UPDATE tbl_SIEXC_OPES_EMAIL_CLIENTES_CADASTRO SET [EMAIL_PRINCIPAL] = :EPRINCIPAL, [EMAIL_SECUNDARIO] = :ESECUNDARIO, [EMAIL_RESERVA] = :ERESERVA WHERE [CPF/CNPJ] = :CNPJ", array(
			':EPRINCIPAL'=>$this->getEmailPrincipal(), 
			':ESECUNDARIO'=>$this->getEmailSecundario(),
			':ERESERVA'=>$this->getEmailReserva(),
			':CNPJ'=>$this->getCnpj()
		));
		
		//if (!empty($result)) {

			// echo json_encode($result, JSON_UNESCAPED_SLASHES);

		//} else {

			//echo "Não foi possível cadastrar o e-mail. Tente novamente.";

		//}

	}

}

?>