<?php

	$user = 'root';
	$pass = '';
	$host = "localhost";
	
	//Leer datos de base de datos
	try{
		$db = new PDO('mysql:host=localhost;dbname=Usuarios', $user, $pass);
		foreach ($db->query('SELECT id, nombre, apellido from Usuarios') as $fila) {
			//var_dump($fila);
			echo "<br>";
			echo $fila["id"];
			echo $fila["nombre"];
			echo $fila["apellido"];
		}
	}
	catch(PDOException $e){
		echo "Ha fallado la conexión";
	}


	//Escribir datos base de datos
	/*
	$name = 'nombre';
	$surname = 'apellido';
	$email = 'usuario@direccion.com';
	$bdate = '2001-04-16';
	$password = 'contrasena'; 
	
	$sql = "INSERT INTO usuarios (nombre, apellido, email, fnacimiento, contrasena) VALUES (?,?,?,?,?)";
	$stmt=$db->prepare($sql);
	$stmt->execute([$name, $surname, $email, $bdate, $password]);
	*/

	//Leer datos de base de datos cuando el nombre sea Jaime
	try{
		$db = new PDO('mysql:host=localhost;dbname=Usuarios', $user, $pass);
		foreach ($db->query('SELECT id, nombre, apellido from Usuarios WHERE nombre="Jaime"') as $fila) {
			//var_dump($fila);
			echo "<br>";
			echo $fila["id"];
			echo $fila["nombre"];
			echo $fila["apellido"];
		}
	}
	catch(PDOException $e){
		echo "Ha fallado la conexión";
	}

	/*
	try{
		$db = new PDO('$sqlite:data.sqlite');
	}
	catch(PDOException $e){
		echo 'Ha fallado la conexión'.$e->getMessage();
	}
	$options = [
		PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_EXCEPTION,
	]
	$sql = 'SELECT id, name FROM departamento ORDER BY nombre';
	$stmt = $db->query($sql);
	$stmt = $db->prepare($sql);
	$stmt->execute([1]);
	var_dump($stmt->fetchALL());
	while($record = $stmt->fetch()){
		var_dump($record);
	}
	*/
?>