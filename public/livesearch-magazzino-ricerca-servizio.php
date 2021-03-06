<?php

	session_start();

	if ($_SESSION['auth'] < 1 ) {
		header("Location: index.php?s=1");
		exit(); 
	}

	include '../core.php';
	include 'maledetti-apici-centro-include.php'; //ATTIVA O DISATTIVA IL MAGIC QUOTE PER GLI APICI

	$q=$_GET['q'];
	
	$p = new Servizio();
	$a = new Anagrafica();
	$admin = $a->isAdmin($_SESSION['loginid']);

	if(isset($_GET['page'])) {
		$page = $_GET['page'];
	}
	else {
		$page = 0;
	}
	
	if(isset($_GET['num'])) {
		$num = $_GET['num'];
	}
	else {
		$num = 25;
	}
	
	$res = $p->ricercaServizio($q);
	$count = $p->contaServizi($q);
	
?>

<?php
	if($count > 0) {
		?>
		<table class="table table-bordered" width="100%">
			<tr>
				<td colspan="6" style="vertical-align: middle">
					Risultati: <b><?php echo $count  ?></b>
				</td>
			</tr>
			<tr align="center">
				<b><td>Codice</td> <td>Descrizione</td> <td>Indirizzo</td> <td>Citt&agrave</td> <td>Email</td> <td>Azioni</td></b>
			</tr>
			<?php
			foreach($res as $val) {
				?>
				<tr>
					<td style="vertical-align: middle" align="center"><?php echo $val['codice']; ?></td>
					<td style="vertical-align: middle"><?php echo strtoupper($val['descrizione']); ?></td>
					<td style="vertical-align: middle"><?php echo $val['indirizzo']; ?></td>
					<td style="vertical-align: middle" align="center"><?php echo $val['citta']; ?></td>
					<td align="center"><?php echo $val['email']; ?></td>					
					<td nowrap style="vertical-align: middle" align="center">
						<div class="btn-group btn-group-sm">
							<a class="btn btn-warning" href="?corpus=magazzino-modifica-servizio&id=<?php echo $val['codice']; ?>">
								<i class="fa fa-pencil"></i> Modifica
							</a>
							<?php if($admin) { ?>
								<a class="btn btn-danger" onClick="return confirm('Vuoi veramente cancellare questo servizio?');" href="?corpus=magazzino-elimina-servizio&id=<?php echo $val['codice']; ?>">
									<i class="fa fa-trash"></i> Elimina
								</a>
							<?php } ?>
						</div>
					</td>
				</tr>
				<?php
			}
			?>
			
		</table>
		<?php
	}
	else {
		?>
		<center><div class="alert alert-danger"><b><i class="fa fa-warning"></i> Nessun</b> servizio trovato con i criteri di ricerca applicati.</div></center>
		<?php
	}
	
	$connessione = null;
?>
