<?php

	$id = $_GET['id'];
	$a = new Anagrafica();
	$c = new Calendario();
	$info = $a->infoVeicolo($id);

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
		<h3 class="panel-title"><strong><i class="fa fa-user-plus"></i> Modifica di un Veicolo</strong></h3>
	</div>

	<div class="panel-body">

		<form class="form-horizontal" action="autoparco-edit-veicoli2.php" role="form" name="modulo" method="post" >

			<input type="hidden" name="id" value="<?php echo $id; ?>">

			<div class="form-group">
				<div class="row">

					<label class="col-sm-2 control-label">Targa:</label>
                    <div class="col-sm-2">
                        <input type="text" value="<?php echo $info['targa']; ?>" class="form-control input-sm" name="targa" required>
                    </div>

                    <label class="col-sm-2 control-label">Tipologia:</label>
                    <div class="col-sm-3">
                        <select class="form-control input-sm" name="tipologia">
                            <option value="Autovettura" <?php if($info['tipologia'] == 'Autovettura') echo 'selected'; ?> > Autovettura</option>
                            <OPTION value="Ambulanza" <?php if($info['tipologia'] == 'Ambulanza') echo 'selected'; ?> > Ambulanza</option>
                            <OPTION value="Motoveicolo" <?php if($info['tipologia'] == 'Motoveicolo') echo 'selected'; ?> > Motoveicolo</option>
                            <OPTION value="Camion" <?php if($info['tipologia'] == 'Camion') echo 'selected'; ?> > Camion</option>
                        </select>
                    </div>

				</div>
			</div>

			<div class="form-group">
				<div class="row">

					<label class="col-sm-2 control-label">Selettiva radio:</label>
                    <div class="col-sm-2">
                        <input type="text" value="<?php echo $info['selettiva']; ?>" class="form-control input-sm" minlength="5" maxlength="6" name="selettiva">
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