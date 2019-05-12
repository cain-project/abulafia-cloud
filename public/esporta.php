<?php
	session_start(); //avvio della sessione: va fatto obbigatoriamente all'inizio e carica tutte le variabili di sessione, valide di pagina in pagina sino al logout.
	
	if ($_SESSION['auth'] < 1 ) {
		header("Location: index.php?s=1");
		exit(); 
	}

	$my_tabellahtml= unserialize($_SESSION['my_tabellahtml']);//deserializzazione 
	$tipologia=$_GET['tipologia'];
	$filename=$_GET['filename'];

	if ($tipologia=='excel') { //si attiva se il parametro passato indica una esportazione in excel
		$ext=".xls"; 
		$filename=$filename.$ext; //aggiunge al filename l'estensione standard
		header ("Content-Type: application/vnd.ms-excel");
		header ("Content-Disposition: inline; filename=$filename");
		$my_tabellahtml->publapritabella  ();
		$my_tabellahtml->publintestazionetabella ();
		$my_tabellahtml->publrighetabella ();
		$my_tabellahtml->publultimarigatabella ();
		$my_tabellahtml->publchiuditabella ();
	}
?>

