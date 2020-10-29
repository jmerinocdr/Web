<?php 
	class DAO
	{
		//Establecemos la variable de la conexión
		private $conn;

		//Creamos el constructor del DAO
		function __construct($service, $user, $pass, $host, $dbname){
				if($this->conectar($service, $user, $pass, $host, $dbname)){
					echo "Conectado correctamente";
				}
				else{
					echo "Base de datos no existe";
					$this->crearBaseDatos();
					echo "Base de datos creada";
					$this->crearTablas();
					echo "Tablas creadas"; 
				}
		}

		//Getters y Setters para obtener la conexión
		public function setDB($conn){
			$this->conn=$conn;
		}
		public function getDB(){
			return $this->conn;
		}

		//Incluimos un metodo para comprobar si la base de datos está creada
		public function dbExist(){
			if(is_null($this->getDB())){
				return false;
			}
			else{
				return true;
			}
		}

		//Usamos la Conexión y Ejecución de la base de datos
		public function conectar($service, $user, $pass, $host, $dbname){
			$dbInfo = $service . ":host=" . $host . ";dbname=" . $dbname;
			try{
				$conn = new PDO($dbInfo, $user, $pass);
				$this->setDB($conn);
				return true;
			}
			catch(PDOException $e){
				$this->crearBaseDatos();
				$this->crearTablas();
				return false;
			}
		}
		public function ejecutar($sql, $array){
			$stmt=$this->conn->prepare($sql);
			$stmt->execute($array);
		}


		//Metodo para leer los datos de la tabla pasando la tabla
		public function leerDatos($tabla){
			$sql = '';
			switch($tabla){
				case "Usuario":
					$sql = "
						SELECT * from usuario;
					";
				break;
				case "UsuarioDeporte":
					$sql = "
						SELECT * from usuario;
					";
				break;
				case "Deporte":
					$sql = "
						SELECT * from deporte;
					";
				break;
				case "Passwd":
					$sql = "
						SELECT * from passwd; 
					";
				break;
			}
			$arrayFilas=$this->conn->query($sql);
			echo "<br>";
			var_dump($arrayFilas);
			return $arrayFilas;
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
			$this->ejecutar($sql, $datos);
		}
		public function modificarDatos($tabla, $nombre, $datos){

			switch($tabla){
				case "Usuario":
					$sql = "
						INSERT INTO usuario (nombre, nacido, sexo, foto)
						VALUES (:nombre, :nacido, :sexo, :foto) 
						WHERE nombre = :pnombre;
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
						WHERE nombre = :pnombre;
					";
				break;
				case "Passwd":
					$sql = "
						INSERT INTO passwd (nombre, clave)
						VALUES (:nombre, :clave);
						WHERE nombre = :pnombre;
					";
				break;
			}
		}

		// Incluimos los metodos para crear la base de datos
		public function crearTablas(){
			$this->crearTablaUsuario($conn);
			$this->crearTablaDeporte($conn);
			$this->crearTablaUsuarioDeporte($conn);
			$this->crearTablaPassw($conn);
		}
		private function crearBaseDatos(){
			$sql = "
				CREATE DATABASE Usuario;
			";
			$array='';
			$this->ejecutar($sql, $array);
		}
		private function crearTablaUsuario(){
			$sql = "
				CREATE TABLE usuario(
					id INT(10) NOT NULL AUTO_INCREMENT,
					nombre VARCHAR(15) NOT NULL,
					nacido DATE,
					sexo VARCHAR(2) NOT NULL CHECK(sexo IN ('H', 'M')),
					foto VARCHAR(30), PRIMARY KEY (id)
				);
			";
			$this->ejecutar($sql, $array);
		}

		private function crearTablaUsuarioDeporte(){
			$sql = "
				CREATE TABLE usuario_deporte(
					FOREIGN KEY (id_usuario) REFERENCES usuario(id), 
					FOREIGN KEY (id_deportes) REFERENCES deporte(id)
				);
			";
			$this->ejecutar($sql, $array);
		}

		private function crearTablaDeporte(){
			$sql = "
				CREATE TABLE deporte(
					id INT(10) NOT NULL AUTO_INCREMENT,
					nombre VARCHAR(20) NOT NULL,
					PRIMARY KEY (id)
				);
			";
			$this->ejecutar($sql, $array);
		}

		private function crearTablaPassw(){
			$sql = "
				Create table passwd(
					usuario VARCHAR(15) NOT NULL,
					clave VARCHAR(15) NOT NULL,
					PRIMARY KEY (usuario) 
				);
			";
			$this->ejecutar($sql, $array);
		}
		
	}