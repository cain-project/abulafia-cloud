<?php
	$idriga = $_GET['id'];
	$iddocumento = $_GET['documento'];
	$m = new Magazzino();
	$infodocumento = $m->getDocumentById($iddocumento);
	$del = $m->eliminaRigaDocumento($idriga, $infodocumento[2]);
	
	if ($del) {
		$my_log -> publscrivilog( $_SESSION['loginname'], 'ELIMINATA RIGA DOCUMENTO '. $iddocumento , 'OK' , $_SESSION['ip'] , $_SESSION['historylog']);
		?>
		<SCRIPT LANGUAGE="Javascript">
		browser= navigator.appName;
		if (browser == "Netscape")
			window.location="login0.php?corpus=magazzino-documenti-carico-scarico-prodotti&id=<?php echo $iddocumento; ?>&tipologia=<?php echo $infodocumento[7]; ?>"; 
		else 
			window.location="login0.php?corpus=magazzino-documenti-carico-scarico-prodotti&id=<?php echo $iddocumento; ?>&tipologia=<?php echo $infodocumento[7]; ?>";
		</SCRIPT>
		<?php
	}
	else {
		$my_log -> publscrivilog( $_SESSION['loginname'], 'TENTATIVO DI ELIMINARE RIGA DOCUMENTO '. $iddocumento , 'FAILED' , $_SESSION['ip'] , $_SESSION['historylog']);
		?>
		<SCRIPT LANGUAGE="Javascript">
		browser= navigator.appName;
		if (browser == "Netscape")
			window.location="login0.php?corpus=magazzino-documenti-carico-scarico-prodotti&id=<?php echo $iddocumento; ?>&tipologia=<?php echo $infodocumento[7]; ?>"; 
		else 
			window.location="login0.php?corpus=magazzino-documenti-carico-scarico-prodotti&id=<?php echo $iddocumento; ?>&tipologia=<?php echo $infodocumento[7]; ?>";
		</SCRIPT>
		<?php
	}	
?>