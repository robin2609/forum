<?php

class Database {
	// Declare vars
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;

	private $dbh;
	private $error;
	private $stmt;

	public function __construct() {
		// Setup PDO 
		$dsn = 'mysql:host=' . $this->host . ';dbname=' . $this->dbname;
		$options = array(PDO::ATTR_PERSISTENT => true, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

		// Create PDO
		try {
			$this->dbh = new PDO ($dsn, $this->user, $this->pass, $options);

		}	//If there is an error
		catch (PDOException $e) {
			$this->error = $e->getMessage();
		}

	}
	//Prepare query
	public function query($sql) {
		$this->stmt = $this->dbh->prepare($sql);
	}
	//Check what kind of value and declare it
	public function bind($param, $value, $type = null) {
		if (is_null ( $type )) {
			switch (true) {
				case is_int ( $value ) :
					$type = PDO::PARAM_INT;
					break;
				case is_bool ( $value ) :
					$type = PDO::PARAM_BOOL;
					break;
				case is_null ( $value ) :
					$type = PDO::PARAM_NULL;
					break;
				default :
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue( $param, $value, $type );
	}
	//Execute query
	public function execute() {
		return $this->stmt->execute();
	}

	//Retrieve all objects from query
	public function resultset() {
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}

	//Retrieve single object from query
	public function single() {
		$this->execute();
		return $this->stmt->fetch(PDO::FETCH_OBJ);

	}
	//Count rows
	public function rowCount() {
		return $this->stmt->rowCount();
	}


}