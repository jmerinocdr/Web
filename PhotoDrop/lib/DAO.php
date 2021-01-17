<?php 
	class DAO
	{
		//Establecemos la variable de la conexión
		private $conn;

		//Creamos el constructor del DAO
		function __construct($service, $user, $pass, $host, $dbname){
				if($this->connect($service, $user, $pass, $host, $dbname)){
					//echo "Conectado correctamente";
					//echo "<br>";
				}
				else{
					echo "Database doesn't exist";
					echo "<br>";
					if($this->connBase($service, $user, $pass, $host)){
						echo "Connected to the basic database";
						echo "<br>";
						$this->createDatabase($dbname);
						echo "Database has been created";
						echo "<br>";
						$this->connect($service, $user, $pass, $host, $dbname);
						$this->createTables();
						echo "Tables has been created"; 
						echo "<br>";
					}
					else{
						echo "Can't connect to the basic database";
						echo "<br>";
					}
				}

		}

		//Getters y Setters to get the connection
		public function setDB($conn){
			$this->conn=$conn;
		}
		public function getDB(){
			return $this->conn;
		}

		//Includes a method to know if the database exist
		public function dbExist(){
			if(is_null($this->getDB())){
				return false;
			}
			else{
				return true;
			}
		}

		//Use connection and execution of the database
		public function connBase($service, $user, $pass, $host){
			$dbInfo = $service . ":host=" . $host;
			try{
				$conn = new PDO($dbInfo, $user, $pass);
				$this->setDB($conn);
				return true;
			}
			catch(PDOException $e){
				return false;
			}
		}
		public function connect($service, $user, $pass, $host, $dbname){
			$dbInfo = $service . ":host=" . $host . ";dbname=" . $dbname;
			try{
				$conn = new PDO($dbInfo, $user, $pass);
				$this->setDB($conn);
				return true;
			}
			catch(PDOException $e){
				return false;
			}
		}
		public function executeSql($sql, $array){
			$stmt=$this->conn->prepare($sql);
			$stmt->execute($array);
		}


		//Metodo para leer los data de la table pasando la table
		public function readData($table){
			$sql = '';
			switch($table){
				case "user":
					$sql = "
						SELECT id, username, passwd, name, surname, sex, bday, uphoto  FROM user;
					";
				break;
			}
			$arrayFilas=$this->conn->query($sql);
			return $arrayFilas;
		}

		public function writeData($table, $data){
			$sql='';
			switch($table){
				case "user":
					$sql = "
						INSERT INTO user (username, passwd, name, surname, sex, bday, uphoto)
						VALUES (:username, :passwd, :name, :surname, :sex, :bday, :uphoto);
					";
				break;
			}
			//echo "Imprimimos el comando sql";
			//var_dump ($sql);
			//echo "<br>";
			$this->executeSql($sql, $data);
		}
		public function modifyData($table, $data){

			switch($table){
				case "user":
					$sql = "
						UPDATE user 
						SET 
							username = :username, 
							passwd = :passwd, 
							name = :name, 
                            surname = :surname, 
                            sex = :sex, 
                            bday = :bday, 
                            uphoto = :uphoto 
						WHERE id = :pid;
					";
				break;
			}
			//echo "Imprimimos el comando sql";
			//var_dump ($sql);
			//echo "<br>";
			$this->executeSql($sql, $data);
		}

		public function deleteData($table, $pid){
			$data=[
				'pid' => $pid,
			];
			switch($table){
				case "user":
					$sql = "
						DELETE FROM user 
						WHERE id = :pid;
					";
				break;
				
			}
			//echo "Imprimimos el comando sql";
			//var_dump ($sql);
			//echo "<br>";
			$this->executeSql($sql, $data);
		}

		public function lastID($table){
			$sql = '';
			switch($table){
				case "user":
					$sql = "
						SELECT MAX(id) AS id from user;
					";
				break;
			}
			$arrayFilas=$this->conn->query($sql);
			return $arrayFilas;
		}

		// Incluimos los metodos para crear la base de data
		public function createtables(){
			echo "Ha llegao al crear tablas";
			$this->createTableUser();
		}
		private function createDatabase($dbname){
			$sql = "
				CREATE DATABASE {$dbname};
			";
			$array= array('' => '');
			$this->executeSql($sql, $array);
			echo "Base de data ".$dbname." creada";
			echo "<br>";
		}
		private function createTableUser(){
			$sql = "
				CREATE TABLE user(
					id INT(10) NOT NULL AUTO_INCREMENT,
                    username VARCHAR(15) NOT NULL,
                    passwd VARCHAR(15) NOT NULL,
                    name VARCHAR(15) NOT NULL,
                    surname VARCHAR(15) NOT NULL,
                    sex VARCHAR(2) NOT NULL CHECK(sex IN ('H', 'M')),
                    bday DATE,
                    uphoto VARCHAR(30), 
                    PRIMARY KEY (id)
				);
			";
			$array= array('' => '');
			$this->executeSql($sql, $array);
			echo "User table has been created";
			echo "<br>";
		}
	}