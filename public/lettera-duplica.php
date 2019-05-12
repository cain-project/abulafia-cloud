<?php
	
	session_start();
	
	if ($_SESSION['auth'] < 1 ) {
		header("Location: index.php?s=1");
		exit(); 
	}

	include '../core.php'; //connessione al db-server
	
	$lett = new Lettera();
	$id = $_GET['id'];
	
	$duplica = $lett->duplicaLettera($id);
	
	if($duplica) {
		header("Location: login0.php?corpus=elenco-lettere");
	}
	else {
		echo 'Errore nella duplicazione della lettera';
	}
?>