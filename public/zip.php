<?php

	session_start();

	if ($_SESSION['auth'] < 1 ) 
	{
		header("Location: index.php?s=1");
		exit(); 
	}

	include 'class/Log.obj.inc';
	include '../core.php'; //connessione al db-server
	include 'class/Lettera.obj.inc';

	$id = $_GET['id'];
	$anno = $_GET['anno'];

	$zip_name = "allegati-prot-".$id.".zip";
	$zip = new ZipArchive;
	$zip->open($zip_name, ZIPARCHIVE::CREATE);
	 		
	$lettera = new Lettera();		
	$urlfile= $lettera->cercaAllegati($id, $anno);

	foreach ($urlfile as $valore)
	{
		$zip->addFile("lettere".$anno."/".$id."/".$valore[2], $valore[2]);
	}

	$zip->close();

	header('Content-type: application/zip');
	header('Content-disposition: attachment; filename="' . $zip_name . '"');
	header("Content-length: " . filesize($zip_name));
	ob_clean();
	flush();
	readfile($zip_name);

	unlink($zip_name);

	exit();

?>