<?php

$id = $_GET['id'];

?>


<div class="panel panel-default">
  <div class="panel-heading">
    <h3 class="panel-title" bgcolor="red"><b>Gestione pratiche</b></h3>
  </div>
  <div class="panel-body">
  
  <div class="row">

	<div class="col-xs-6">   
		<?php
		$pratica=mysql_query("select count(*) from pratiche");
		$num=mysql_fetch_row($pratica);
		if($num[0]<=0) {
			echo '<br><label><span class="glyphicon glyphicon-warning-sign"></span> Nessuna pratica registrata.</label>';
		}
		else {

		?>
		<label><span class="glyphicon glyphicon-list"></span> Elenco pratiche:</label><br><br>
		<?php

		$risultati=mysql_query("select distinct * from pratiche");
		?>
		<table class="table table-striped table-hover">
		<tr>
		<td><b>Id</b></td><td><b>Descrizione</b></td><td><b>Opzioni</b></td>
		</tr>
		<?php
		while ($risultati2=mysql_fetch_array($risultati))
		{
			$risultati2=array_map("stripslashes",$risultati2);
			echo '<tr>';
			echo '<td>' . $risultati2['id'] . '</td><td>' . $risultati2['descrizione'] . '</td><td><a href="login0.php?corpus=pratica-modifica&id=' . $risultati2['id'] . '"><button type="button" class="btn btn-warning btn-xs"><span class="glyphicon glyphicon-pencil"></span></button></a> <a onClick="return confirm(\'Vuoi veramente cancellare questa pratica?\');" href="login0.php?corpus=pratica-elimina&id='. $risultati2['id'] . '"><button type="button" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></button></a></td></tr>';
		}
		}
		?>
		</table>
	</div>
	
	<div class="col-xs-6">   
	 
		 <?php
			$risultati=mysql_query("select * from pratiche where id='$id'");
			$risultati2=mysql_fetch_array($risultati);
			$risultati2=array_map("stripslashes",$risultati2);
		?>
		<label><span class="glyphicon glyphicon-pencil"></span> Modifica pratica: "<?php echo $risultati2['descrizione']; ?>"</label><br><br>
		
		 <form action="login0.php?corpus=pratica-modifica2&id=<?php echo $id ?>" method="post" role="form">
		  <div class="form-group">
			
			<div class="row">
				<div class="col-xs-12">
					<label>Descrizione posizione:</label><input value="<?php echo str_replace("\"", '&quot;',$risultati2['descrizione']); ?>" class="form-control" size="40" type="text" name="descrizione" />			
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12">
					<br><button type="submit" class="btn btn-warning btn-block"><span class="glyphicon glyphicon-pencil"></span> Modifica Pratica</button>
				</div>
			</div>
			
		  </div>
		</form>
		<a href="login0.php?corpus=pratiche"><b>Indietro</b></a>
	 
	</div>
	
</div>

</div>
</div>

