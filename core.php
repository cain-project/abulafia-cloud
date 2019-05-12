<?php

/**
 * core.php
 *
 * Parametri di connessione al database.
 *
 * Se stai installando Abulafia in locale, modifica le righe
 *  seguenti, riempiendole con i dettagli di connessione al
 *  tuo database MySQL/MariaDB.
 */

// Parametri di connessione al database (modifica qui)
$dbname = "abulafia";       // Nome del database
$dbusername = "abulafia";   // Username per il database
$dbpassword = "abulafia";   // Password per l'utente del database
$dbhost = "localhost";      // Host del database (nome DNS)
$dbport = 3306;             // Host del database (numero di porta)


// Se un database AWS RDS è configurato, sovrascrivi la configurazione corrente.
if ( isset($_SERVER['RDS_HOSTNAME']) ) {
    $dbname = $_SERVER["RDS_DB_NAME"];
    $dbusername = $_SERVER["RDS_USERNAME"];
    $dbpassword = $_SERVER["RDS_PASSWORD"];
    $dbhost = $_SERVER["RDS_HOSTNAME"];
    $dbport = $_SERVER["RDS_PORT"];
}

// Permetti il caricamento delle dipendenze da Composer
require_once "vendor/autoload.php";

// Registra autoloader per le classi interne
spl_autoload_register(function($class_name) {
    require_once "public/class/${class_name}.obj.inc";
});

$my_log = new Log();

try
{
    $connessione = new PDO("mysql:host=$dbhost;port=$dbport;dbname=$dbname", $dbusername, $dbpassword);
    $connessione->setAttribute (PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}

//gestione dell'eventuale errore della connessione
catch (PDOException $errorePDO) {
    echo "Errore: Impossibile effettuare connessione al Database - " . $errorePDO->getMessage();
    $my_log -> publscrivilog($userid, 'connectionToDB', 'denied', '' , $logfile, 'database');
    die();
}

