<?php
	
	session_start();

	if ($_SESSION['auth'] < 1 ) {
		header("Location: index.php?s=1");
		exit(); 
	}
	
	include 'class/Log.obj.inc';
	include '../core.php';

	$id = $_GET['id'];
	$num = $_GET['num'];
	$value = $_GET['value'];
	$riga = 'riga'.$num;
	
	$update = $connessione->query(" UPDATE comp_destinatari SET $riga = '$value' WHERE id = $id "); 

?>