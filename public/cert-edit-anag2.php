<?php
	
	session_start();

	include 'class/Log.obj.inc';
	include '../core.php';
	include 'maledetti-apici-centro-include.php';

	if ($_SESSION['auth'] < 1 ) {
		header("Location: index.php?s=1");
		exit(); 
	}

	$a = new Anagrafica();
	$c = new Calendario();

	
	$id = $_POST['id'];
	$nome = $_POST['nome'];
	$cognome = $_POST['cognome'];
	$codicefiscale = $_POST['codicefiscale'];
	$cittanascita = $_POST['cittanascita'];
	$datanascita = $c->dataDB($_POST['datanascita']);
	$cittadinanza = $_POST['cittadinanza'];
	$residenzacitta = $_POST['residenzacitta'];
	$residenzavia = $_POST['residenzavia'];
	$residenzanumero = $_POST['residenzanumero'];
	$documento = $_POST['documento'];
	$documentonumero = $_POST['documentonumero'];

	$result = $a->editAssistito($id, $nome, $cognome, $codicefiscale, $cittanascita, $datanascita, $cittadinanza, $residenzacitta, $residenzavia, $residenzanumero, $documento, $documentonumero);

	if($result) {
		?>
		<script>
			window.location="login0.php?corpus=cert-edit-anag&edit=ok&id=<?php echo $id; ?>";
		</script>
		<?php
	}

?>