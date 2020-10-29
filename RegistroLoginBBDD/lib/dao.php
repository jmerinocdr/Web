<?php 
	class DAO
	{
		//Establecemos la variable de la conexión
		private $conn;

		//Creamos el constructor del DAO
		function __construct($service, $user, $pass, $host, $dbname){
				$this->conectar($service, $user, $pass, $host);
		}

		//Getters y Setters para obtener la conexión
		public function setDB($conn){
			$this->conn=$conn;
		}
		public function getDB(){
			return $this->$conn;
		}

		//Incluimos un metodo para comprobar si la base de datos está creada
		public function dbExist($conn){
			if($this.getDB() != null){

			}
		}

		//Usamos la Conexión y Ejecución de la base de datos
		public function conectar($service, $user, $pass, $host, $dbname){
			$dbInfo = $service . ":host=" . $host . ";dbname=" . $dbname;
			try{
				$conn = new PDO($dbInfo, $user, $pass)
				$this->setDB($conn);
				return true;
			}
			catch(PDOException $e){
				return false;
			}
		}
		public function ejecutar($conn, $sql, $array){
			$stmt=$conn->prepare($sql);
			$stmt->execute($array);
		}


		//Escribir Leer y Modificar
		public function leerDatos($tabla){
			switch($tabla){
				case "Usuario":
					$sql = "
						SELECT id, nombre, nacido, sexo, foto from usuario;
					";
				break;
				case "UsuarioDeporte":
					$sql = "
						SELECT id, nombre, nacido, sexo, foto from usuario;
					";
				break;
				case "Deporte":
					$sql = "
						SELECT id, nombre, nacido, sexo, foto from deporte;
					";
				break;
				case "Passwd":
					$sql = "
						SELECT id, nombre, nacido, sexo, foto from passwd; 
					";
				break;

			}
		}

		public function escribirDatos($tabla, $datos){
			switch($tabla){
				case "Usuario":
					$sql = "
						INSERT INTO usuario (nombre, nacido, sexo, foto)
						VALUES (:nombre, :nacido, :sexo, :foto);
					";
				break;
				case "UsuarioDeporte":
					$sql = "
						SELECT id, nombre, nacido, sexo, foto from usuario;
					";
				break;
				case "Deporte":
					$sql = "
						INSERT INTO deporte (nombre)
						VALUES (:nombre);
					";
				break;
				case "Passwd":
					$sql = "
						INSERT INTO passwd (nombre, clave)
						VALUES (:nombre, :clave);
					";
				break;

			}
		}
		public function modificarDatos($tabla, $nombre, $datos){
			switch($tabla){
				case "Usuario":
					$sql = "
						INSERT INTO usuario (nombre, nacido, sexo, foto)
						VALUES (:nombre, :nacido, :sexo, :foto);
					";
				break;
				case "UsuarioDeporte":
					$sql = "
						SELECT id, nombre, nacido, sexo, foto from usuario;
					";
				break;
				case "Deporte":
					$sql = "
						INSERT INTO deporte (nombre)
						VALUES (:nombre);
					";
				break;
				case "Passwd":
					$sql = "
						INSERT INTO passwd (nombre, clave)
						VALUES (:nombre, :clave);
					";
				break;
			}
		}

		// Incluimos los metodos para crear la base de datos
		public function crearTablas($conn){
			$this->crearTablaUsuario($conn);
			$this->crearTablaDeporte($conn);
			$this->crearTablaUsuarioDeporte($conn);
			$this->crearTablaPassw($conn);
		}
		private function crearBaseDatos($conn){
			$sql = "
				CREATE DATABASE Usuario;
			";

		}
		private function crearTablaUsuario($conn){
			$sql = "
				CREATE TABLE usuario(
					id INT(10) NOT NULL AUTO_INCREMENT,
					nombre VARCHAR(15) NOT NULL,
					nacido DATE,
					sexo VARCHAR(2) NOT NULL CHECK(sexo IN ('H', 'M')),
					foto VARCHAR(30), PRIMARY KEY (id)
				);
			";
			ejecutar($conn, $sql, $array);
		}

		private function crearTablaUsuarioDeporte($conn){
			$sql = "
				CREATE TABLE usuario_deporte(
					FOREIGN KEY (id_usuario) REFERENCES usuario(id), 
					FOREIGN KEY (id_deportes) REFERENCES deporte(id)
				);
			";
			ejecutar($conn, $sql, $array);
		}

		private function crearTablaDeporte($conn){
			$sql = "
				CREATE TABLE deporte(
					id INT(10) NOT NULL AUTO_INCREMENT,
					nombre VARCHAR(20) NOT NULL,
					PRIMARY KEY (id)
				);
			";
			ejecutar($conn, $sql, $array);
		}

		private function crearTablaPassw($conn){
			$sql = "
				Create table passwd(
					usuario VARCHAR(15) NOT NULL,
					clave VARCHAR(15) NOT NULL,
					PRIMARY KEY (usuario) 
				);
			";
			ejecutar($conn, $sql, $array);
		}
		
	}