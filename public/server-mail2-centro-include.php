<?php 

	$e = new Mail();
	$username=$_POST['username'];
	$password=base64_encode($_POST['password']);
	$smtp=$_POST['smtp'];
	$porta=$_POST['porta'];
	$protocollo=$_POST['protocollo'];

	$res = $e->updateSetting($username, $password, $smtp, $porta, $protocollo);
	
	if(!$res) {
		echo 'ERRORE NELLA MODIFICA:' . mysql_error();
	}
	else {
		$_SESSION['usernamemail'] = $username;
		$_SESSION['passwordmail'] = $password;
		$_SESSION['smtp'] = $smtp;
		$_SESSION['porta'] = $porta;
		$_SESSION['protocolloemail'] = $protocollo;
?>

<SCRIPT LANGUAGE="Javascript">
	browser= navigator.appName;
	if (browser == "Netscape") {
		window.location="login0.php?corpus=home&email=ok";
	}
	else {
		window.location="login0.php?corpus=home&email=ok";
	}
</SCRIPT>

<?php
	}
?>