<?php
session_start();

$annoprotocollo = $_SESSION['annoprotocollo'];

include '../db-connessione-include.php';

include 'maledetti-apici-centro-include.php'; //ATTIVA O DISATTIVA IL MAGIC QUOTE PER GLI APICI

$nomeapplicativo = $_POST['nomeapplicativo'];
$version= $_POST['version'];
$email = $_POST['email'];

$protocollomaxfilesize = $_POST['protocollomaxfilesize'];
$fotomaxfilesize = $_POST['fotomaxfilesize'];
$paginaprincipale = $_POST['paginaprincipale'];
$headerdescription = $_POST['headerdescription'];

//Settaggio Mail
$mittente = $_POST['mittente'];
$headermail = $_POST['headermail'];
$footermail = $_POST['footermail'];
//fine settaggio mail

//eventuale settaggio del primo numero del nuovo protocollo
$primoprotocollo= $_POST['primoprotocollo'];
$contalettere=mysql_query("select count(*) from lettere$annoprotocollo");
$res_count=mysql_fetch_row($contalettere);
$contalettere= $res_count[0] +1 ;
if ($contalettere == 1) 
{ $queryprimoprotocollo = mysql_query("ALTER TABLE lettere$annoprotocollo AUTO_INCREMENT = $primoprotocollo ");
if (!$queryprimoprotocollo) { echo 'Variazione del primo numero del protocollo NON RIUSCITA<br>'; echo mysql_error(); exit();}
}
//fine eventuale settaggio del primo numero del nuovo protocollo

$inserimento=mysql_query("update defaultsettings set defaultsettings.version = $version, defaultsettings.email = '$email', defaultsettings.nomeapplicativo='$nomeapplicativo', defaultsettings.paginaprincipale = '$paginaprincipale' , defaultsettings.protocollomaxfilesize = '$protocollomaxfilesize' , defaultsettings.annoprotocollo = '$annoprotocollo', defaultsettings.headerdescription = '$headerdescription'");

$inserimento2=mysql_query("update mailsettings set mailsettings.mittente = '$mittente', mailsettings.headermail = '$headermail', mailsettings.footermail = '$footermail'");

if (!$inserimento && !$inserimento2) {echo 'Impossibile compiere l\'azione richiesta<br>'; echo mysql_error(); exit();}
else { $_SESSION['version'] = $version ; $_SESSION['email'] = $email ; $_SESSION['nomeapplicativo'] = $nomeapplicativo; $_SESSION['paginaprincipale']= $paginaprincipale; $_SESSION['protocollomaxfilesize']= $protocollomaxfilesize; $_SESSION['fotomaxfilesize']= $fotomaxfilesize; $_SESSION['annoprotocollo']= $annoprotocollo; $_SESSION['headerdescription']= $headerdescription; $_SESSION['mittente'] = $mittente; $_SESSION['headermail'] = $headermail; $_SESSION['footermail'] = $footermail;}
?>

<SCRIPT LANGUAGE="Javascript">
browser= navigator.appName;
if (browser == "Netscape")
window.location="login0.php?corpus=advancedsettings"; else window.location="login0.php?corpus=advancedsettings"
</SCRIPT>
