<?php

if( isset($_GET['insert']) && $_GET['insert'] == "ok") {
    ?>
    <div class="row">
        <div class="col-sm-12">
            <center><div class="alert alert-success"><i class="fa fa-check"></i> Veicolo inserito <b>correttamente!</b></div></center>
        </div>
    </div>
    <?php
}

if( isset($_GET['insert']) && $_GET['insert'] == "error") {
    ?>
    <div class="row">
        <div class="col-sm-12">
            <center><div class="alert alert-danger"><i class="fa fa-alert"></i> <b>Attenzione:</b> si &egrave; verificato un errore nell'inserimento. Verifica che il veicolo non sia gi&agrave; inserito.</div></center>
        </div>
    </div>
    <?php
}
?>

<div class="panel panel-default">

    <div class="panel-heading">
        <h3 class="panel-title"><strong><i class="fa fa-user-plus"></i> Inserimento di un Veicolo</strong></h3>
    </div>

    <div class="panel-body">

        <form class="form-horizontal" action="autoparco-add-veicoli2.php" role="form" name="modulo" method="post" >

            <div class="form-group">
                <div class="row">

                    <label class="col-sm-2 control-label">Targa:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control input-sm" name="targa" required>
                    </div>

                    <label class="col-sm-2 control-label">Tipologia:</label>
                    <div class="col-sm-3">
                        <select class="form-control input-sm" name="tipologia">
                            <option selected value="Autovettura"> Autovettura</option>
                            <OPTION value="Ambulanza"> Ambulanza</option>
                            <OPTION value="Motoveicolo"> Motoveicolo</option>
                            <OPTION value="Camion"> Camion</option>
                        </select>
                    </div>

                </div>
            </div>


            <div class="form-group">
                <div class="row">

                    <label class="col-sm-2 control-label">Selettiva radio:</label>
                    <div class="col-sm-2">
                        <input type="text" class="form-control input-sm" minlength="7" maxlength="8" name="selettiva">
                    </div>

                </div>
            </div>

            <br>
            <div class="row">
                <center>
                    <button type="submit" class="btn btn-primary btn-lg"><i class="fa fa-check"></i> Inserisci</button>
                </center>
            </div>

        </form>

    </div>
</div>