<?php
	include '../db-connessione-include.php';
	include 'class/Prodotto.obj.inc';
	$p = new Prodotto();
	$codice = $_POST['codice'];
	$descrizione = $_POST['descrizione'];
	$prezzo = str_replace(',','.',$_POST['prezzo']);
	$note = $_POST['note'];
	$unita = $_POST['unitadimisura'];
	$barcode = $_POST['codicebarre'];
	
	$res = $p->modificaProdotto($codice, $descrizione, $prezzo, $note, $unita, $barcode); 
	
	if($res) {
		header("Location: login0.php?corpus=magazzino-prodotti&mod=ok");
	}
	else {
		echo 'Errore nella registrazione dei dati';
	}
?>