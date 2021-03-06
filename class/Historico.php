<?php  
// VERIFICA SE EXISTEM ERROS DE EXECUÇÃO NO CÓDIGO
ini_set('display_errors',1);


// CRIAÇÃO DA CLASSE
class Historico {

	// DEFINIÇÃO DOS ATRIBUTOS
	private $data;
	private $idEmpresa;
	private $tipoAcao;
	private $area;
	private $nomeResponsavel;
	private $matriculaResponsavel;
	private $historico;

	// MÉTODOS
	
	// CONSTRUCT PARA SETTAR TODOS OS VALORES NO OBJETO, COM EXCEÇÃO DO HISTÓRICO
	public function __construct($idEmpresa, $areaAdm, $areaFis = "", $nomeResponsavel, $matriculaResponsavel){

		if ($areaFis != 0) {
			$this->setArea($areaFis);
		} else {
			$this->setArea($areaAdm);
		}
		$this->setIdEmpresa($idEmpresa);
		$this->setNomeResponsavel($nomeResponsavel);
		$this->setMatriculaResponsavel($matriculaResponsavel);
		$this->setData();
		$this->setTipoAcao();
	}

	// MÉTODO PARA TRAZER OS DADOS DO OBJETO COMO JSON
	public function __toString(){

		return json_encode(array(
			"ID_EMPRESA"=>$this->getIdEmpresa(),
			"DATA"=>$this->getData(),
			"ACAO"=>$this->getTipoAcao(),
			"NOME_RESPONSAVEL"=>$this->getNomeResponsavel(),
			"MATRICULA_RESPONSAVEL"=>$this->getMatriculaResponsavel(),
			"AREA_RESPONSAVEL"=>$this->getArea(),
		), JSON_UNESCAPED_SLASHES);

	}

	// GETTERS E SETTERS DOS ATRIBUTOS

	// $data
	public function getData(){
		return $this->data;
	}
	public function setData(){
		$this->data = date("Y-m-d H:i:s", time());
	}

	// $idEmpresa
	public function getIdEmpresa(){
		return $this->idEmpresa;
	}
	public function setIdEmpresa($value){
		$this->idEmpresa = $value;
	}

	// $tipoAcao
	public function getTipoAcao(){
		return $this->tipoAcao;
	}
	public function setTipoAcao(){
		$this->tipoAcao = "ALTERACAO";
	}

	// $area
	public function getArea(){
		return $this->area;
	}
	public function setArea($value){
		$this->area = $value;
	}

	// $nomeResponsavel
	public function getNomeResponsavel(){
		return $this->nomeResponsavel;
	}
	public function setNomeResponsavel($value){
		$this->nomeResponsavel = $value;
	}


	// $matriculaResponsavel
	public function getMatriculaResponsavel(){
		return $this->matriculaResponsavel;
	}
	public function setMatriculaResponsavel($value){
		$this->matriculaResponsavel = $value;
	}

	// $historico
	public function getHistorico(){
		return $this->historico;
	}
	public function setHistorico($emailPrincipal = "não foi alterado", $emailSecundario = "não foi alterado", $emailReserva = "não foi alterado"){

		$this->historico = "ALTERAÇÃO NO CADASTRO - e-mail principal: $emailPrincipal; e-mail secundário: $emailSecundario e e-mail reserva: $emailReserva.";
	}
}


?>