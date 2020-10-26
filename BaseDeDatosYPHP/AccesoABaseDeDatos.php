<?php
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
?>