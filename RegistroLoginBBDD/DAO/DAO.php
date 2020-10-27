<?php 
	class DAO
	{
		private $db = "";

		//Getters&Setters
		public function setDB($db){
			$this->db=$db;
		}
		public function getDB(){
			return $this->db;
		}



		//Usamos la Conexión y Ejecución de la base de datos
		public function conectar($user, $pass){
			$db = new PDO('mysql:host=localhost;dbname=Usuarios', $user, $pass);
		}
		public function ejecutar()

		public function crearTablaUsuario($conn){
			$sql = "
				CREATE TABLE usuario(
					id INT(10) NOT NULL AUTO_INCREMENT,
					nombre VARCHAR(15) NOT NULL,
					nacido DATE,
					sexo VARCHAR(2) NOT NULL CHECK(sexo IN ('H', 'M')),
					foto VARCHAR(30), PRIMARY KEY (id)
				);
			";
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