<?php 
	class DAO
	{
		//Establecemos la variable de la conexión
		private $conn;

		//Creamos el constructor del DAO
		function __construct($service, $user, $pass, $host, $dbname){
				if($this->conectar($service, $user, $pass, $host, $dbname)){
					echo "Conectado correctamente";
					echo "<br>";
				}
				else{
					echo "Base de datos no existe";
					echo "<br>";
					if($this->conectarBase($service, $user, $pass, $host)){
						echo "Conectado a base de datos basica";
						echo "<br>";
						$this->crearBaseDatos($dbname);
						echo "Base de datos creada";
						echo "<br>";
						$this->conectar($service, $user, $pass, $host, $dbname);
						$this->crearTablas();
						echo "Tablas creadas"; 
						echo "<br>";
					}
					else{
						echo "No se ha conseguido conectar a la base de datos básica";
						echo "<br>";
					}
					
					
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
		public function conectarBase($service, $user, $pass, $host){
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
		public function conectar($service, $user, $pass, $host, $dbname){
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
						SELECT id, nombre, nacido, sexo, foto from usuario;
					";
				break;
				case "UsuarioDeporte":
					$sql = "
						SELECT id_usuario, id_deporte from usuario_deporte;
					";
				break;
				case "Deporte":
					$sql = "
						SELECT id, nombre from deporte;
					";
				break;
				case "Passwd":
					$sql = "
						SELECT usuario, clave from passwd; 
					";
				break;
			}
			$arrayFilas=$this->conn->query($sql);
			echo "<br>";
			echo "Pasamos los datos de la tabla ".$tabla." ";
			echo "<br>";
			var_dump($arrayFilas);
			echo "<br>";
			return $arrayFilas;
		}

		public function escribirDatos($tabla, $datos){
			$sql='';
			switch($tabla){
				case "Usuario":
					$sql = "
						INSERT INTO usuario (nombre, nacido, sexo, foto)
						VALUES (:nombre, :nacido, :sexo, :foto);
					";
				break;
				case "UsuarioDeporte":
					$sql = "
						INSERT INTO usuario_deporte (id_usuario, id_deporte)
						VALUES (:id_usuario, id_deporte);
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
						INSERT INTO passwd (usuario, clave)
						VALUES (:usuario, :clave);
					";
					echo "Escribimos en Passwd";
					echo "<br>";
				break;
			}
			echo "Imprimimos el comando sql";
			var_dump ($sql);
			echo "<br>";
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
						INSERT INTO passwd (usuario, clave)
						VALUES (:usuario, :clave);
						WHERE nombre = :usuario;
					";
				break;
			}
		}

		// Incluimos los metodos para crear la base de datos
		public function crearTablas(){
			$this->crearTablaUsuario();
			$this->crearTablaDeporte();
			$this->crearTablaUsuarioDeporte();
			$this->crearTablaPassw();
		}
		private function crearBaseDatos($dbname){
			$sql = "
				CREATE DATABASE {$dbname};
			";
			$array= array('' => '');
			$this->ejecutar($sql, $array);
			echo "Base de datos ".$dbname." creada";
			echo "<br>";
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
			$array= array('' => '');
			$this->ejecutar($sql, $array);
			echo "Tabla usuario creada";
			echo "<br>";
		}

		private function crearTablaUsuarioDeporte(){
			$sql = "

				
				CREATE TABLE usuario_deporte(
					id_usuario INT(10) NOT NULL,
					id_deporte INT(10) NOT NULL,
					FOREIGN KEY (id_usuario) REFERENCES usuario(id), 
					FOREIGN KEY (id_deporte) REFERENCES deporte(id)
				);
				/*
				CREATE TABLE usuario_deporte(
					id_usuario INT(10) NOT NULL,
					id_deporte INT(10) NOT NULL,
					CONSTRAINT cons_fk_id_usuario FOREIGN KEY (id_usuario) REFERENCES usuario(id),
					CONSTRAINT cons_fk_id_deporte FOREIGN KEY (id_deporte) REFERENCES deporte(id)
				);
				*/
			";
			$array= array('' => '');
			$this->ejecutar($sql, $array);
			echo "Tabla usuariodeporte creada";
			echo "<br>";
		}

		private function crearTablaDeporte(){
			$sql = "
				CREATE TABLE deporte(
					id INT(10) NOT NULL AUTO_INCREMENT,
					nombre VARCHAR(20) NOT NULL,
					PRIMARY KEY (id)
				);
			";
			$array= array('' => '');
			$this->ejecutar($sql, $array);
			echo "Tabla deporte creada";
			echo "<br>";
		}

		private function crearTablaPassw(){
			$sql = "
				Create table passwd(
					usuario VARCHAR(15) NOT NULL,
					clave VARCHAR(15) NOT NULL,
					PRIMARY KEY (usuario) 
				);
			";
			$array= array('' => '');
			$this->ejecutar($sql, $array);
			echo "Tabla Passwd creada";
			echo "<br>";
		}

		
	}