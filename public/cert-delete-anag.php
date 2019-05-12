<?php
	
	session_start();

	include '../core.php';
	include 'maledetti-apici-centro-include.php';

	if ($_SESSION['auth'] < 1 ) {
		header("Location: index.php?s=1");
		exit(); 
	}

	$a = new Anagrafica();
	
	$id = $_GET['id'];

	$result = $a->deleteAssistito($id);

	if($result) {
		?>
		<script>
			window.location="login0.php?corpus=cert-search-anag&delete=ok";
		</script>
		<?php
	}

?>