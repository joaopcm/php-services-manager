<?php

/*
* Classe responsável por todas as ações
* relacionadas ao banco de dados
*/

namespace Root\DB;

define('DBHOST', getenv('DBHOST'));
define('MYSQL_USER', getenv('MYSQL_USER'));
define('MYSQL_PASSWORD', getenv('MYSQL_PASSWORD'));
define('MYSQL_DATABASE', getenv('MYSQL_DATABASE'));

class Sql {

	private $conn;

	/* Método mágico construct */
	public function __construct()
	{

		$this->conn = new \PDO(
			"mysql:dbname=" . MYSQL_DATABASE . ";host=" . DBHOST, "root", MYSQL_PASSWORD
		);

	}

	/* Seta os parâmetros */
	private function setParams($statement, $parameters = array())
	{

		foreach ($parameters as $key => $value) {

			$this->bindParam($statement, $key, $value);

		}

	}

	/* Binda os parâmetros */
	private function bindParam($statement, $key, $value)
	{

		$statement->bindParam($key, $value);

	}

	/* Faz uma query */
	public function query($rawQuery, $params = array())
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

	}

	/* executa uma consulta */
	public function select($rawQuery, $params = array()):array
	{

		$stmt = $this->conn->prepare($rawQuery);

		$this->setParams($stmt, $params);

		$stmt->execute();

		return $stmt->fetchAll(\PDO::FETCH_ASSOC);
		
	}

}

?>