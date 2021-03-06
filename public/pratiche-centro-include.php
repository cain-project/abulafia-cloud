<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title" bgcolor="red"><b><i class="fa fa-tags"></i> Gestione pratiche</b></h3>
  </div>
  <div class="panel-body">
  
     <?php
    if( isset($_GET['add']) && $_GET['add'] == "ok") {
	?>
	<div class="row">
	<div class="col-sm-12">
	<div class="alert alert-success"><b><i class="fa fa-check fa-fw"></i></b> Nuova pratica aggiunta!</div></div></div>
	<?php
   }
    if( isset($_GET['add']) && $_GET['add'] == "no") {
	?>
	<div class="row">
	<div class="col-sm-12">
	<div class="alert alert-danger"><b><i class="fa fa-warning fa-fw"></i></b> Si � verificato un errore, controlla di aver inserito tutti i campi oppure riprova pi� tardi.</div></div></div>
	<?php
   }
    if( isset($_GET['add']) && $_GET['add'] == "duplicato") {
	?>
	<div class="row">
	<div class="col-sm-12">
	<div class="alert alert-danger"><b><i class="fa fa-warning fa-fw"></i> Impossibile aggiungere:</b> esiste gi&agrave; una pratica con lo stesso nome!</div></div></div>
	<?php
   }
   if( isset($_GET['mod']) && $_GET['mod'] == "ok") {
	?>
	<div class="row">
	<div class="col-sm-12">
	<div class="alert alert-success"><b><i class="fa fa-check fa-fw"></i></b> Pratica modificata con successo!</div></div></div>
	<?php
   }
   if( isset($_GET['mod']) && $_GET['mod'] == "no") {
	?>
	<div class="row">
	<div class="col-sm-12">
	<div class="alert alert-success"><b><i class="fa fa-warning fa-fw"></i></b> Si � verificato un errore nella modifica della pratica.</div></div></div>
	<?php
   }
   if( isset($_GET['canc']) && $_GET['canc'] == "ok") {
	?>
	<div class="row">
	<div class="col-sm-12">
	<div class="alert alert-success"><b><i class="fa fa-check fa-fw"></i></b> Pratica eliminata con successo!</div></div></div>
	<?php
   }
   if( isset($_GET['canc']) && $_GET['canc'] == "no") {
	?>
	<div class="row">
	<div class="col-sm-12">
	<div class="alert alert-success"><i class="fa fa-warning fa-fw"></i></b>  Si � verificato un errore nella cancellazione della pratica</div></div></div>
	<?php
   }
   ?>
   
   <div class="row">
		<div class="col-sm-12">   
		    <form action="login0.php?corpus=pratiche2" method="post" role="form">
			  <div class="form-group">
				
				<div class="row">
					<div class="col-sm-8">
						<label>Descrizione pratica:</label><input class="form-control" size="40" type="text" name="descrizione" required />			
					</div>
				
					<div class="col-sm-4">
						<br><button type="submit" class="btn btn-primary btn-block"><span class="glyphicon glyphicon-plus"></span> Aggiungi pratica</button>
					</div>
				</div>
				
			  </div>
		</form>
		</div>
	</div>

	<br>

   	<div class="row">

		<div class="col-sm-12">   
			<?php
			$pratiche = $connessione->query("SELECT COUNT(*) FROM pratiche"); //ricerca tutti i valori del titolario
			if ($pratiche) { 
				$num = $pratiche->fetch();
			} //se ce ne sono, li conta
			else { 
				$num[0] = 0; 
			} //altrimenti azzera il contatore
			if($num[0] <=0 ) {
				echo '<div class="alert alert-warning"><span class="glyphicon glyphicon-warning-sign"></span> Nessuna pratica registrata.</div>';
			}
			else {

				?>
				<label><span class="glyphicon glyphicon-list"></span> Elenco pratiche:</label><br><br>
				<?php
				$risultati = $connessione->query("SELECT DISTINCT * FROM pratiche");
				?>
				<table class="table table-striped table-hover">
				<tr>
				<td><b>Id</b></td><td><b>Descrizione</b></td><td><b>Opzioni</b></td>
				</tr>
				<?php
				while ($risultati2 = $risultati->fetch())	{
					$risultati2 = array_map ("stripslashes",$risultati2);
					echo '<tr>';
					echo '<td>' . $risultati2['id'] . '</td><td>' . $risultati2['descrizione'] . '</td>
						<td>
							<div class="btn-group btn-group-sm">
								<a class="btn btn-success" data-toggle="tooltip" data-placement="left" title="Visualizza protocolli per questa pratica" href="login0.php?corpus=corrispondenza-pratica&currentpage=1&iniziorisultati=0&id=' . $risultati2['id'] . '"><i class="fa fa-bars"></i> Protocolli</a>
								<a class="btn btn-warning" data-toggle="tooltip" data-placement="left" title="Modifica pratica" href="login0.php?corpus=pratica-modifica&id=' . $risultati2['id'] . '"><span class="glyphicon glyphicon-pencil"></span> Modifica</a> 
								<a class="btn btn-danger" data-toggle="tooltip" data-placement="left" title="Elimina pratica" onClick="return confirm(\'Vuoi veramente cancellare questa pratica?\');" href="login0.php?corpus=pratica-elimina&id='. $risultati2['id'] . '"><span class="glyphicon glyphicon-trash"></span> Elimina</a>
							</div>
						</td>
						</tr>';
				}
			}
			?>
			</table>
		</div>
	</div>
	

</div>
</div>
<?php $_SESSION['my_database']=serialize($my_database);?>

