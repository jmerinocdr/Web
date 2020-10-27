//Crear tablas de la base de datos
		public function crearTablaUsuarioDeporte($conn){
			$sql = "
				CREATE TABLE usuario_deporte(
					FOREIGN KEY (id_usuario) REFERENCES usuario(id), 
					FOREIGN KEY (id_deportes) REFERENCES deporte(id)
				);
			";
		}

		public function crearTablaDeporte($conn){
			$sql = "
				CREATE TABLE deporte(
					id INT(10) NOT NULL AUTO_INCREMENT,
					nombre VARCHAR(20) NOT NULL,
					PRIMARY KEY (id)
				);
			";
		}

		public function crearTablaPassw($conn){
			$sql = "
				Create table passwd(
					usuario VARCHAR(15) NOT NULL,
					clave VARCHAR(15) NOT NULL,
					PRIMARY KEY (usuario) 
				);
			";
		}