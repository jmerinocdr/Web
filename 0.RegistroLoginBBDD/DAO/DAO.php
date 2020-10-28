<?php 
	class DAO
	{
		private $user = 'root';
		private $pass = '';
		private $host = "localhost";
		private $conn = "";

		//Getters&Setters
		public function setDB($conn){
			$this->conn=$conn;
		}
		public function getDB(){
			return $this->conn;
		}



		//Usamos la Conexión y Ejecución de la base de datos
		public function conectar($user, $pass){
			$conn = new PDO('mysql:host=localhost;dbname=Usuarios', $user, $pass);
			return $conn;
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
		
	}