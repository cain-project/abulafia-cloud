<?php

	session_start();

	if ($_SESSION['auth']< 1 ) {
		echo 'Devi prima effettuare il login dalla<br>';
		?> <a href="../"><?php echo 'pagina principale'; $_SESSION['auth']= 0 ;  ?></a>
		<?php 
		exit(); 
	}

	include '../db-connessione-include.php';
	include 'class/Prodotto.obj.inc';
	$p = new Prodotto();
	$codiceprodotto = $_GET['id'];
	$magazzino = $_POST['magazzino'];
	$settore = $_POST['settore'];
	$scortaminima = $_POST['scortaminima'];
	$riordino = $_POST['riordino'];
	$giacenzainiziale = $_POST['giacenzainiziale'];
	$confezionamento = $_POST['confezionamento'];
	
	$res = $p->assegnaProdotto($codiceprodotto, $magazzino, $settore, $scortaminima, $riordino, $giacenzainiziale, $confezionamento); 
	
	if($res) {
		header("Location: login0.php?corpus=magazzino-prodotti&insert=ok");
	}
	else {
		echo 'Errore nella registrazione dei dati';
	}
?>