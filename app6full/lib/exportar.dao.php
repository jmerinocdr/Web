<?php
require_once('dao.lib.php');
require_once('usuario.class.php');
require_once('deporte.class.php');
//connect
$pdo;

$dao = new Dao('../data/datos.sqlite');
$pdo = $dao->getPdo();

//get all the tables
$tablapasswd=[];
$tabladeportes=[];
$tablausuarios=[];
$tablausuariosdeportes=[];

	//prep output
	$tab = "\t";
	$br = "\n";
	$xml = '<?xml version="1.0" encoding="UTF-8"?>'.$br;
	$xml.= '<database name="Datos">'.$br;
	
	//TABLA PASSWD
	$xml.= $tab.'<table name="passwd">'.$br;
		
	$sql = 'SELECT usuario, clave FROM passwd';
	$stmt = $pdo->query($sql);

	while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
		$tablapasswd[] = [
			'usuario' => $row['usuario'],
			'clave' => $row['clave'],
		];
	}

	//table attributes
	$attributes = array('usuario','clave');
	$xml.= $tab.$tab.'<columns>'.$br;
	$x = 0;
	foreach($tablapasswd as $datostablapasswd)
	{
		$meta = $datostablapasswd;
		$xml.= $tab.$tab.$tab.'<column ';
		foreach($attributes as $attribute)
		{
			$xml.= $attribute.'="'.$meta[$attribute].'" ';
		}
		$xml.= '/>'.$br;
		$x++;
	}
	$xml.= $tab.$tab.'</columns>'.$br;
	
	$xml.= $tab.'</table>'.$br;


	//TABLA DEPORTES
	$xml.= $tab.'<table name="deportes">'.$br;
		
	$sql = 'SELECT id, nombre FROM usuarios';
	$stmt = $pdo->query($sql);

	while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
		$tabladeportes[] = [
			'id' => $row['id'],
			'nombre' => $row['nombre'],
		];
	}

	//table attributes
	$attributes = array('id','nombre');
	$xml.= $tab.$tab.'<columns>'.$br;
	$x = 0;
	foreach($tabladeportes as $datostabladeportes)
	{
		$meta = $datostabladeportes;
		$xml.= $tab.$tab.$tab.'<column ';
		foreach($attributes as $attribute)
		{
			$xml.= $attribute.'="'.$meta[$attribute].'" ';
		}
		$xml.= '/>'.$br;
		$x++;
	}
	$xml.= $tab.$tab.'</columns>'.$br;
	
	$xml.= $tab.'</table>'.$br;



	//TABLA USUARIOS
		$xml.= $tab.'<table name="usuarios">'.$br;
		
		$sql = 'SELECT id, nombre, nacido, sexo, foto FROM usuarios';
		$stmt = $pdo->query($sql);

		while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
			$tablausuarios[] = [
				'id' => $row['id'],
				'nombre' => $row['nombre'],
				'nacido' => $row['nacido'],
				'sexo' => $row['sexo'],
				'foto' => $row['foto'],
			];
		}

		//table attributes
		$attributes = array('id','nombre','nacido','sexo','foto');
		$xml.= $tab.$tab.'<columns>'.$br;
		$x = 0;
		foreach($tablausuarios as $datostablausuarios)
		{
			$meta = $datostablausuarios;
			$xml.= $tab.$tab.$tab.'<column ';
			foreach($attributes as $attribute)
			{
				$xml.= $attribute.'="'.$meta[$attribute].'" ';
			}
			$xml.= '/>'.$br;
			$x++;
		}
		$xml.= $tab.$tab.'</columns>'.$br;
		
		$xml.= $tab.'</table>'.$br;

		//TABLA USUARIOS-DEPORTES
	$xml.= $tab.'<table name="usuarios_deportes">'.$br;
		
	$sql = 'SELECT id_usuario, id_deporte FROM usuarios_deportes';
	$stmt = $pdo->query($sql);

	while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)){
		$tablapasswd[] = [
			'id_usuario' => $row['id_usuario'],
			'id_deporte' => $row['id_deporte'],
		];
	}

	//table attributes
	$attributes = array('id_usuario','id_deporte');
	$xml.= $tab.$tab.'<columns>'.$br;
	$x = 0;
	foreach($tablausuariosdeportes as $datostablausuariosdeportes)
	{
		$meta = $datostablausuariosdeportes;
		$xml.= $tab.$tab.$tab.'<column ';
		foreach($attributes as $attribute)
		{
			$xml.= $attribute.'="'.$meta[$attribute].'" ';
		}
		$xml.= '/>'.$br;
		$x++;
	}
	$xml.= $tab.$tab.'</columns>'.$br;
	
	$xml.= $tab.'</table>'.$br;
	
	$xml.= '</database>';
	
	//save file
	$handle = fopen('../data/Datos-backup-'.time().'.xml','w+');
	fwrite($handle,$xml);
	fclose($handle);

	header('location: ../php/login.php');