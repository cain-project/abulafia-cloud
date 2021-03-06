<body onload="setFocus()">
<?php
	$_SESSION['block'] = false;
	$level = $_SESSION['auth'];
	$my_log -> publscrivilog( $_SESSION['loginname'], 'GO TO RICERCA ANAGRAFICA' , 'OK' , $_SESSION['ip'], $_SESSION['logfile'], 'page request');
	$lett = new Lettera();
?>

<div class="panel panel-default">
	
		<div class="panel-heading">
			<h3 class="panel-title"><strong><span class="glyphicon glyphicon-search"></span> Ricerca ANAGRAFICA</strong></h3>
		</div>
		
		<div class="panel-body">
			<div class="form-group">
								
				<form name="search" method="post">
					
					<div class="row">
						<div class="col-sm-12">
							<h4><i class="fa fa-pencil"></i> Inserisci il valore da cercare:</h4>
								<small>&egrave; possibile effettuare una ricerca esatta per cognome e nome digitando Cognome+Nome</small>
						</div>
						
						<div class="col-sm-6">
							<br><input class="form-control input-sm" placeholder="lasciare vuoto per mostrare tutte le anagrafiche o digitare il cognome o la ragione sociale" type="text" name="cercato" onkeydown="if(event.keyCode==13) autorized(<?php echo $level ?>)" onfocus="formInUse = true;"/>
							<input type="hidden" name="tabella" value="anagrafica">
						</div>
					</div>
					
					<br>

					<div class="row">
						<div class="col-sm-12">
							<h4><i class="fa fa-filter"></i> Filtri aggiuntivi:</h4><br>
						</div>
	
						<div id="anag" class="col-sm-4">
							<label><i class="fa fa-info-circle"></i> Tipologia:</label>
							<SELECT class="form-control input-sm" NAME="anagraficatipologia">
								<OPTION value="anagrafica.tipologia" onclick="document.search.cercato.focus()" selected> Nessun filtro</OPTION>
								<OPTION value="persona" onclick="document.search.cercato.focus()"> Persone fisiche</OPTION>
								<OPTION value="carica" onclick="document.search.cercato.focus()"> Carica o Incarico</OPTION>
								<OPTION value="ente" onclick="document.search.cercato.focus()"> Ente</OPTION>
								<OPTION value="fornitore" onclick="document.search.cercato.focus()"> Fornitore</OPTION>
							</SELECT>
						</div>
						<br>
						<div class="col-sm-4">
							<label><i class="fa fa-sort-alpha-asc"></i> Elenca in ordine:</label>
							<SELECT class="form-control input-sm" NAME="group1">
								<OPTION value="alfabetico" onclick="document.search.cercato.focus()" selected> Alfabetico</OPTION>
								<OPTION value="cronologico" onclick="document.search.cercato.focus()"> Cronologico</OPTION>
								<OPTION value="cron-inverso" onclick="document.search.cercato.focus()"> Cronologico Inverso</OPTION>
							</SELECT>
						</div>

					</div>
					
					<div class="row">
						<div class="col-sm-3">
							<br><br><button  id="buttonl" data-loading-text="<i class='fa fa-spinner fa-spin'></i> Ricerca in corso..." class="btn btn-success btn-lg btn-block" type="button" onClick="autorized(<?php echo $level ?>)"><span class="glyphicon glyphicon-search"></span> Cerca Anagrafica</button>
						</div>
					</div>
					
				</form>	
			</div>			
		</div>
</div>        

<script>
	$("#buttonl").click(function() {
		var $btn = $(this);
		$btn.button('loading');
	});
</script>

<script type="text/javascript" language="javascript">
	function autorized(livello) {
		document.search.action = "login0.php?corpus=risultati&iniziorisultati=0&currentpage=1";
		document.search.submit();
	}
	
	var formInUse = false;
	function setFocus() {
		if(!formInUse) {
			document.search.cercato.focus();
		}
	}
</script>
</body>