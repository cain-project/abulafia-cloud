<?php
	session_start();

	if ($_SESSION['auth'] < 1 ) {
		header("Location: index.php?s=1");
		exit(); 
	}

	include '../core.php';
	include 'maledetti-apici-centro-include.php'; //ATTIVA O DISATTIVA IL MAGIC QUOTE PER GLI APICI

	$a = new Anagrafica();
	$c = new Calendario();
	
	$ogg = $_GET['q'];
	$num = $_GET['num'];

	$query = $connessione->query("SELECT * FROM cert_assistito WHERE nome LIKE '%$ogg%' OR cognome LIKE '%$ogg%' OR codicefiscale LIKE '%$ogg%' ORDER BY id DESC LIMIT $num");
?>
	
<table class="table table-bordered">
	<tr style="vertical-align: middle">
		<td><b>Nome</b></td>
		<td><b>Cognome</b></td>
		<td><b>Cod. Fiscale</b></td>
		<td><b>Luogo di Nascita</b></td>
		<td><b>Data di Nascita</b></td>
		<td align="center"><b>Opzioni</b></td>
	</tr>
		
	<?php
	$contatorelinee = 0;
	while ($risultati2 = $query->fetch())	{
		$risultati2 = array_map('stripslashes', $risultati2);
		if ( $contatorelinee % 2 == 1 ) { 
				$colorelinee = $_SESSION['primocoloretabellarisultati'] ; 
			} //primo colore
			else { 
				$colorelinee = $_SESSION['secondocoloretabellarisultati'] ; 
			} //secondo colore
			$contatorelinee = $contatorelinee + 1 ;
		?>
		<tr bgcolor=<?php echo $colorelinee; ?>>
			<td style="vertical-align: middle"><?php echo ucwords($risultati2['nome']);?></td>
			<td style="vertical-align: middle"><?php echo ucwords($risultati2['cognome']);?></td>
			<td style="vertical-align: middle"><?php echo strtoupper($risultati2['codicefiscale']);?></td>
			<td style="vertical-align: middle"><?php echo ucwords($risultati2['luogonascita']);?></td>
			<td style="vertical-align: middle"><?php echo $c->dataSlash($risultati2['datanascita']);?></td>
			<td style="vertical-align: middle" align="center">
				<div class="btn-group btn-group-sm">
					<a class="btn btn-info btn" data-toggle="tooltip" data-placement="left" title="Info Assistito" href="login0.php?corpus=cert-info-anag&id=<?php echo $risultati2['id']; ?> " data-toggle="modal" data-target="#myModal">
							<i class="fa fa-info-circle fa-fw"></i>
					</a>
					<a class="btn btn-warning" data-toggle="tooltip" data-placement="left" title="Modifica Assistito" href="login0.php?corpus=cert-edit-anag&id=<?php echo $risultati2['id']; ?>">
							<i class="fa fa-edit fa-fw"></i>
					</a>
					<a class="btn btn-success" data-toggle="tooltip" data-placement="left" title="Aggiungi Visita" href="login0.php?corpus=cert-modale-add-access&id=<?php echo $risultati2['id']; ?>" data-toggle="modal" data-target="#myModal">
							<i class="fa fa-medkit fa-fw"></i>
					</a>
					<?php if($a->isAdmin($_SESSION['loginid'])) {
						?>
						<a class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Elimina Assistito" onclick="return confirm('Sicuro di voler cancellare la persona?')" href="cert-delete-anag.php?id=<?php echo $risultati2['id']; ?>">
							<i class="fa fa-trash-o fa-fw"></i>
						</a>
						<?php
					}
					?>
				</div>
			</td>
		</tr>
		<?php 
	} 
	?>
</table>