<?php

	$id = $_GET['id'];
	$a = new Anagrafica();
	$c = new Calendario();
	$info = $a->infoAssistito($id);
	
	if( isset($_GET['edit']) && $_GET['edit'] == "ok") {
		?>
		<div class="row">
			<div class="col-sm-12">
				<center><div class="alert alert-success"><i class="fa fa-check"></i> Anagrafica aggiornata <b>correttamente!</b></div></center>
			</div>
		</div>
		<?php
	}
?>

<div class="panel panel-default">
	
	<div class="panel-heading">
		<h3 class="panel-title"><strong><i class="fa fa-user-plus"></i> Modifica di un Assistito</strong></h3>
	</div>
		
	<div class="panel-body">

		<form class="form-horizontal" action="cert-edit-anag2.php" role="form" name="modulo" method="post" >
						
			<input type="hidden" name="id" value="<?php echo $id; ?>">

			<div class="form-group">
				<div class="row">
					
					<label class="col-sm-2 control-label">Nome:</label>
					<div class="col-sm-2">
						<input type="text" value="<?php echo $info['nome']; ?>" class="form-control input-sm" name="nome" required>
					</div>

					<label class="col-sm-1 control-label">Cognome:</label>
					<div class="col-sm-2">
						<input type="text" value="<?php echo $info['cognome']; ?>" class="form-control input-sm" name="cognome" required>
					</div>

					<label class="col-sm-2 control-label">Codice Fiscale:</label>
					<div class="col-sm-2">
						<input type="text" value="<?php echo $info['codicefiscale']; ?>" minlength="16" maxlength="16" class="form-control input-sm" name="codicefiscale" required>
					</div>
				
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					
					<label class="col-sm-2 control-label">Nato a:</label>
					<div class="col-sm-2">
						<input type="text" value="<?php echo $info['luogonascita']; ?>" class="form-control input-sm" name="cittanascita" required>
					</div>

					<label class="col-sm-1 control-label">il:</label>
					<div class="col-sm-2">
						<input type="text" value="<?php echo $c->dataSlash($info['datanascita']); ?>" class="form-control input-sm datepickerAnag" name="datanascita" required>
					</div>

					<label class="col-sm-2 control-label">Nazionalit&agrave;</label>
					<div class="col-sm-2">
						<select class="form-control input-sm" name="cittadinanza">
							<option value="it" <?php if($info['cittadinanza'] == 'it') echo 'selected'; ?> > Italiana</option>
							<OPTION value="ee" <?php if($info['cittadinanza'] == 'ee') echo 'selected'; ?> > Estera</option>
						</select>
					</div>
				
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					
					<label class="col-sm-2 control-label">Residente a:</label>
					<div class="col-sm-3">
						<input type="text" value="<?php echo $info['residenzacitta']; ?>" class="form-control input-sm" name="residenzacitta" required>
					</div>

					<label class="col-sm-1 control-label">Via/Piazza:</label>
					<div class="col-sm-3">
						<input type="text" value="<?php echo $info['residenzavia']; ?>" class="form-control input-sm" name="residenzavia" required>
					</div>

					<label class="col-sm-1 control-label">N:</label>
					<div class="col-sm-1">
						<input type="text" value="<?php echo $info['residenzanumero']; ?>" class="form-control input-sm" name="residenzanumero" required>
					</div>
				
				</div>
			</div>

			<div class="form-group">
				<div class="row">
					
					<label class="col-sm-2 control-label">Documento:</label>
					<div class="col-sm-3">
						<select class="form-control input-sm" name="documento">
							<option value="Carta Identit&agrave;" <?php if($info['documento'] == 'Carta Identità') echo 'selected'; ?> > Carta d'identit&agrave;</option>
							<OPTION value="Patente" <?php if($info['documento'] == 'Patente') echo 'selected'; ?> > Patente di guida</option>
							<OPTION value="Passaporto" <?php if($info['documento'] == 'Passaporto') echo 'selected'; ?> > Passaporto</option>
							<OPTION value="Tesserino Aeroportuale" <?php if($info['documento'] == 'Tesserino Aeroportuale') echo 'selected'; ?> > Tesserino Aeroportuale</option>
						</select>
					</div>

					<label class="col-sm-1 control-label">N:</label>
					<div class="col-sm-3">
						<input type="text" value="<?php echo $info['documentonumero']; ?>" class="form-control input-sm" name="documentonumero" required>
					</div>
				
				</div>
			</div>
						
			<br>
			<div class="row">
				<center>
					<button type="submit" class="btn btn-warning btn-lg"><i class="fa fa-edit"></i> Modifica</button>
				</center>
			</div>
		
		</form>
				
	</div>
</div>