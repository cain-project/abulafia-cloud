<?php

	session_start();
	
	if ($_SESSION['auth'] < 1 ) {
		header("Location: index.php?s=1");
		exit(); 
	}

	include '../db-connessione-include.php'; //connessione al db-server
	$idlettera = $_GET['id'];
	$from = $_GET['from'];
	
	try {
	   	$connessione->beginTransaction();
		$query = $connessione->prepare("UPDATE comp_lettera SET firmata = 1, vista = 2 WHERE id = :idlettera"); 
		$query->bindParam(':idlettera', $idlettera);
		$query->execute();
		$connessione->commit();
		$update = true;
	}	 
	catch (PDOException $errorePDO) { 
	   	echo "Errore: " . $errorePDO->getMessage();
	   	$connessione->rollBack();
	 	$update = false;
	}	
	
	if($update) {
		header("Location: login0.php?corpus=".$from);
	}
	else {
		echo 'Errore nella registrazione dei dati';
	}
?>