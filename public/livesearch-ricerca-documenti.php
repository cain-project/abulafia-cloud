<?php
	session_start();

	if ($_SESSION['auth'] < 1 ) {
		header("Location: index.php?s=1");
		exit(); 
	}

	include '../core.php';
	include 'maledetti-apici-centro-include.php'; //ATTIVA O DISATTIVA IL MAGIC QUOTE PER GLI APICI
	
	$m = new Magazzino();
	$s = new Servizio();
	$c = new Calendario();
	
	$doc = $_GET['q'];
	$mag = $_GET['mag'];
	$causale = $_GET['causale'];
	$num = $_GET['num'];

	$res = $m->getDocumentFilter($doc, $mag, $causale, $num);
	if($res)
	{
		?>
		<table class="table table-bordered" width="100%">
			<tr style="vertical-align: middle">
				<td>Num. Doc.</td>
				<td>Data</td>
				<td>Magazzino</td>
				<td>Causale</td>
				<td>Opzioni</td>
			</tr>
			<?php
			foreach($res as $val) {
				if ( $val['tipologia'] == 'carico' ) { 
					$colorelinee = '#D0F0C0'; 
				}
				else { 
					$colorelinee = '#FFD1DC'; 
				}
				?>
				<tr bgcolor= <?php echo $colorelinee;?> >
					<td style="vertical-align: middle"><?php echo $val['id']; ?></td>
					<td style="vertical-align: middle"><?php echo $c->dataSlash($val['datadocumento']); ?></td>
					<td style="vertical-align: middle"><?php echo $val['magazzino'] . ' - ' . $s->getServizioById($val['magazzino']); ?></td>
					<td style="vertical-align: middle" align="center"><?php echo strtoupper($val['causale']); ?></td>
					<td align="center" nowrap style="vertical-align: middle">
						<div class="btn-group btn-group-sm" role="group">
							<a class="btn btn-info" href="?corpus=magazzino-info-documento&id=<?php echo $val['id']; ?>"><i class="fa fa-info fa-fw"></i></a>
							<a class="btn btn-warning" href="?corpus=magazzino-documenti-carico-scarico-prodotti&id=<?php echo $val['id']; ?>&tipologia=<?php echo $val['tipologia']; ?>"><i class="fa fa-pencil fa-fw"></i></a>	
							<a class="btn btn-danger" onClick="return confirm('Vuoi veramente cancellare questo documento?');" href="?corpus=magazzino-documenti-carico-scarico-elimina&id=<?php echo $val['id']; ?>&tipologia=<?php echo $val['tipologia']; ?>&magazzino=<?php echo $val['magazzino']; ?>"><i class="fa fa-trash fa-fw"></i></a>
							<!--<a class="btn btn-danger" href=""><i class="fa fa-file-pdf-o fa-fw"></i></a>-->
						</div>
					</td>		
				</tr>
				<?php
			}
			?>
		</table>
		<?php
	}
	else
	{
		?>
		<center><div class="alert alert-danger"><b><i class="fa fa-warning"></i> Nessun</b> risultato trovato con i criteri di ricerca applicati.</div></center>
		<?php
	}
?>