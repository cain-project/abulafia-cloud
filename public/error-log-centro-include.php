<div class="panel panel-default">
	
		<div class="panel-heading">
		<h3 class="panel-title"><strong><i class="fa fa-warning"></i> Log degli ultimi 50 errori</strong></h3>
		</div>
		<div class="panel-body">
			<p>
			<?php 
				$my_log->publleggilog('0', '50', 'error', $_SESSION['logfile']); //legge dal log degli accessi
			?>
			</p>
			<form action="download-on-the-fly.php"" method="post">
   			<input type="hidden" name="textonthefly" value="<?php print(base64_encode(serialize($my_log->righefiltrate))); ?>">
			<input type="hidden" name="logname" value="Error LOG">
			<input type="hidden" name="filename" value="error-log.txt">

   			<center><input type="submit" 
							name="submit_parse" 
							style="margin-bottom: 20px; margin-top: 10px;width:250px; font-face: "Comic Sans MS"; 
							font-size: larger; " 
							value="Scarica questo LOG completo"> </center>
   			</form>


		</div>
				
</div>
