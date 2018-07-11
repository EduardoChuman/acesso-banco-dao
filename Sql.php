<?php

//require_once("../../includes/database/sqlsrv.php");

class Sql extends PDO {

	private $conn;

	public function __construct(){

		require_once("../../../includes/database/sqlsrv.php");

		$this->$conn = new PDO("sqlsrv:Database=$db_name;server=$db_host",$db_user,$db_pass);

	}

	private function setParams($statement, $parameters = $array()){

		foreach ($parameters as $key => $value) {
		
		$this->setParam($key, $value);

		}
	}

	private function setParam($statement, $key, $value){
		
		$statement->bindParam($key, $value);

	}	

	public function query($rawQuery, $params = array()){

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt;

	}

	public function select($rawQuery, $params = array()):array {

		$stmt = $this->query($rawQuery, $params);

		return $stmt->fetchAll(PDO::FETCH_ASSOC);

	}
    
}

?>