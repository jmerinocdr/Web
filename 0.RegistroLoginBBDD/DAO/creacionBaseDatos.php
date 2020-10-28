
<?php
		//Crear tablas de la base de datos
		public function crearTablas($conn){
			$this->crearTablaUsuario($conn);
			$this->crearTablaDeporte($conn);
			$this->crearTablaUsuarioDeporte($conn);
			$this->crearTablaPassw($conn);
		}
		public function crearBaseDatos($conn){
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