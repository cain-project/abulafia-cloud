<?php

use Phinx\Migration\AbstractMigration;

class Initial extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $this->execute("
            SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
            SET time_zone = '+00:00';
            
            
            --
            -- Struttura della tabella `anagrafica`
            --
            
            CREATE TABLE IF NOT EXISTS `anagrafica` (
              `idanagrafica` int(11) NOT NULL AUTO_INCREMENT,
              `nome` text COLLATE utf8_general_ci NOT NULL,
              `cognome` text COLLATE utf8_general_ci NOT NULL,
              `residenzastato` text COLLATE utf8_general_ci NOT NULL,
              `residenzaprovincia` text COLLATE utf8_general_ci NOT NULL,
              `residenzacitta` text COLLATE utf8_general_ci NOT NULL,
              `residenzavia` text COLLATE utf8_general_ci NOT NULL,
              `residenzacivico` text COLLATE utf8_general_ci NOT NULL,
              `residenzacap` text COLLATE utf8_general_ci NOT NULL,
              `nascitadata` date NOT NULL DEFAULT '0000-00-00',
              `nascitastato` text COLLATE utf8_general_ci NOT NULL,
              `nascitaprovincia` text COLLATE utf8_general_ci NOT NULL,
              `nascitacomune` text COLLATE utf8_general_ci NOT NULL,
              `urlfoto` text COLLATE utf8_general_ci NOT NULL,
              `grupposanguigno` text COLLATE utf8_general_ci NOT NULL,
              `codicefiscale` text COLLATE utf8_general_ci NOT NULL,
              `tipologia` text COLLATE utf8_general_ci NOT NULL,
              `fuoriuso` tinyint(1) NOT NULL,
              PRIMARY KEY (`idanagrafica`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `anagrafica_prodotto`
            --
            
            CREATE TABLE IF NOT EXISTS `anagrafica_prodotto` (
              `codice` int(11) NOT NULL AUTO_INCREMENT,
              `descrizione` text NOT NULL,
              `prezzo` float NOT NULL,
              `note` text NOT NULL,
              `unita_misura` text NOT NULL,
              `codicebarre` text NOT NULL,
              PRIMARY KEY (`codice`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `attributi`
            --
            
            CREATE TABLE IF NOT EXISTS `attributi` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `attributo` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `categorie`
            --
            
            CREATE TABLE IF NOT EXISTS `categorie` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `categoria` text NOT NULL,
              `owner` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            --
            -- Struttura della tabella `cert_accesso`
            --
            
            CREATE TABLE IF NOT EXISTS `cert_accesso` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `anagrafica` int(11) NOT NULL,
              `medico` int(11) NOT NULL,
              `data` date NOT NULL,
              `ora` time NOT NULL,
              `dipendente` int(1) NOT NULL,
              `anamnesi` text NOT NULL,
              `diagnosi` text NOT NULL,
              `terapia` text NOT NULL,
              `note` text NOT NULL,
              `intervento` int(1) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `cert_assistito`
            --
            
            CREATE TABLE IF NOT EXISTS `cert_assistito` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `nome` text NOT NULL,
              `cognome` text NOT NULL,
              `codicefiscale` varchar(16) NOT NULL,
              `luogonascita` text NOT NULL,
              `datanascita` date NOT NULL,
              `cittadinanza` text NOT NULL,
              `residenzacitta` text NOT NULL,
              `residenzavia` text NOT NULL,
              `residenzanumero` text NOT NULL,
              `documento` text NOT NULL,
              `documentonumero` text NOT NULL,
              PRIMARY KEY (`id`),
              UNIQUE KEY `codicefiscale` (`codicefiscale`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `cert_certificati`
            --
            
            CREATE TABLE IF NOT EXISTS `cert_certificati` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `anagrafica` int(11) NOT NULL,
              `medico` int(11) NOT NULL,
              `numero` int(11) NOT NULL,
              `data` date NOT NULL,
              `tipo` text NOT NULL,
              `file` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `cert_richieste`
            --
            
            CREATE TABLE IF NOT EXISTS `cert_richieste` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `paziente` int(11) NOT NULL,
              `visita` int(11) NOT NULL,
              `tipo` text NOT NULL,
              `data` date NOT NULL,
              `richiedente` int(11) NOT NULL,
              `stato` int(11) NOT NULL,
              `protocollo` int(11) NOT NULL,
              `anno` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `comp_destinatari`
            --
            
            CREATE TABLE IF NOT EXISTS `comp_destinatari` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `idlettera` int(11) NOT NULL,
              `idanagrafica` int(11) NOT NULL,
              `conoscenza` tinyint(1) DEFAULT NULL,
              `attributo` text NOT NULL,
              `riga1` text NOT NULL,
              `riga2` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `comp_lettera`
            --
            
            CREATE TABLE IF NOT EXISTS `comp_lettera` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `protocollo` int(11) NOT NULL,
              `anno` int(11) NOT NULL,
              `data` date NOT NULL,
              `oggetto` text NOT NULL,
              `testo` text NOT NULL,
              `allegati` int(11) NOT NULL,
              `vista` int(1) DEFAULT NULL,
              `firmata` int(1) DEFAULT NULL,
              `idins` int(11) NOT NULL,
              `ufficio` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `defaultsettings`
            --
            
            CREATE TABLE IF NOT EXISTS `defaultsettings` (
              `annoprotocollo` int(11) NOT NULL,
              `protocollomaxfilesize` int(11) NOT NULL,
              `fotomaxfilesize` int(11) NOT NULL,
              `nomeapplicativo` text NOT NULL,
              `email` text NOT NULL,
              `version` text NOT NULL,
              `paginaprincipale` text NOT NULL,
              `titolopagina` text NOT NULL,
              `keywords` text NOT NULL,
              `description` text NOT NULL,
              `headerdescription` text NOT NULL,
              `sede` text NOT NULL,
              `denominazione` text NOT NULL,
              `vertice` text NOT NULL,
              `inizio` varchar(10) NOT NULL,
              `quota` decimal(10,0) NOT NULL,
              `anagrafica` int(1) DEFAULT NULL,
              `protocollo` int(1) DEFAULT NULL,
              `documenti` int(1) NOT NULL,
              `lettere` int(1) DEFAULT NULL,
              `magazzino` int(1) DEFAULT NULL,
              `ambulatorio` int(1) NOT NULL,
              `contabilita` int(1) DEFAULT NULL,
              `signaturepath` text NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `documenti_magazzino`
            --
            
            CREATE TABLE IF NOT EXISTS `documenti_magazzino` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `datadocumento` date NOT NULL,
              `magazzino` text NOT NULL,
              `riferimento` text NOT NULL,
              `causale` text NOT NULL,
              `datariferimento` date NOT NULL,
              `note` text NOT NULL,
              `tipologia` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `joindocumentiprodotti`
            --
            
            CREATE TABLE IF NOT EXISTS `joindocumentiprodotti` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `documento` int(11) NOT NULL,
              `prodotto` int(11) NOT NULL,
              `quantita` int(11) NOT NULL,
              `note` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `joinlettereallegati`
            --
            
            CREATE TABLE IF NOT EXISTS `joinlettereallegati` (
              `idlettera` int(11) NOT NULL,
              `annoprotocollo` int(11) NOT NULL,
              `pathfile` text NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
            
            -- --------------------------------------------------------
            
            
            --
            -- Struttura della tabella `joinlettereinserimento2019`
            --
            
            CREATE TABLE IF NOT EXISTS `joinlettereinserimento2019` (
              `idlettera` int(11) NOT NULL,
              `idinser` int(11) NOT NULL,
              `idmod` int(11) NOT NULL,
              `datamod` date NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
            
            -- --------------------------------------------------------
            
            
            --
            -- Struttura della tabella `joinletteremittenti2019`
            --
            
            CREATE TABLE IF NOT EXISTS `joinletteremittenti2019` (
              `idlettera` text COLLATE utf8_general_ci NOT NULL,
              `idanagrafica` text COLLATE utf8_general_ci NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `joinpersoneuffici`
            --
            
            CREATE TABLE IF NOT EXISTS `joinpersoneuffici` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `utente` int(11) NOT NULL,
              `ufficio` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `joinprodottimagazzini`
            --
            
            CREATE TABLE IF NOT EXISTS `joinprodottimagazzini` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `idprodotto` int(11) NOT NULL,
              `codicemagazzino` varchar(30) NOT NULL,
              `settore` int(11) NOT NULL,
              `scortaminima` int(11) NOT NULL,
              `puntoriordino` int(11) NOT NULL,
              `giacenzainiziale` int(11) NOT NULL,
              `giacenza` int(11) NOT NULL,
              `confezionamento` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `jointelefonipersone`
            --
            
            CREATE TABLE IF NOT EXISTS `jointelefonipersone` (
              `idanagrafica` int(11) NOT NULL DEFAULT '0',
              `numero` text COLLATE utf8_general_ci NOT NULL,
              `tipo` text COLLATE utf8_general_ci NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
            
            -- --------------------------------------------------------
            
            
            --
            -- Struttura della tabella `lettere2019`
            --
            
            CREATE TABLE IF NOT EXISTS `lettere2019` (
              `idlettera` int(11) NOT NULL AUTO_INCREMENT,
              `oggetto` text COLLATE utf8_general_ci NOT NULL,
              `datalettera` date NOT NULL,
              `dataregistrazione` date NOT NULL,
              `urlpdf` text COLLATE utf8_general_ci NOT NULL,
              `speditaricevuta` text COLLATE utf8_general_ci NOT NULL,
              `posizione` text COLLATE utf8_general_ci NOT NULL,
              `riferimento` text COLLATE utf8_general_ci NOT NULL,
              `pratica` int(11) DEFAULT NULL,
              `note` text COLLATE utf8_general_ci NOT NULL,
              PRIMARY KEY (`idlettera`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `mailsend`
            --
            
            CREATE TABLE IF NOT EXISTS `mailsend` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `user` int(11) NOT NULL,
              `email` text NOT NULL,
              `data` date NOT NULL,
              `idlettera` int(11) NOT NULL,
              `annolettera` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `mailsettings`
            --
            
            CREATE TABLE IF NOT EXISTS `mailsettings` (
              `username` text NOT NULL,
              `password` text NOT NULL,
              `smtp` text NOT NULL,
              `porta` int(11) NOT NULL,
              `protocollo` text,
              `replyto` text NOT NULL,
              `headermail` text NOT NULL,
              `footermail` text NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `passwordrecovery`
            --
            
            CREATE TABLE IF NOT EXISTS `passwordrecovery` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `utente` int(11) NOT NULL,
              `token` text NOT NULL,
              `timestamp` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `pratiche`
            --
            
            CREATE TABLE IF NOT EXISTS `pratiche` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `descrizione` text NOT NULL,
              `owner` int(11) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `servizi`
            --
            
            CREATE TABLE IF NOT EXISTS `servizi` (
              `codice` varchar(25) NOT NULL,
              `descrizione` text NOT NULL,
              `indirizzo` text NOT NULL,
              `citta` text NOT NULL,
              `cap` text NOT NULL,
              `telefono` varchar(10) NOT NULL,
              `email` text NOT NULL,
              `magazzino` tinyint(1) NOT NULL,
              PRIMARY KEY (`codice`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `settori`
            --
            
            CREATE TABLE IF NOT EXISTS `settori` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `descrizione` text NOT NULL,
              `owner` varchar(4) NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `storico_modifiche`
            --
            
            CREATE TABLE IF NOT EXISTS `storico_modifiche` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `protocollo` int(11) NOT NULL,
              `anno` int(11) NOT NULL,
              `modifica` text NOT NULL,
              `user` int(11) NOT NULL,
              `time` int(11) NOT NULL,
              `color` varchar(7) NOT NULL,
              `prima` text NOT NULL,
              `dopo` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `titolario`
            --
            
            CREATE TABLE IF NOT EXISTS `titolario` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `codice` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
              `descrizione` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
              `owner` int(11) NOT NULL,
              PRIMARY KEY (`codice`),
              UNIQUE KEY `id` (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `uffici`
            --
            
            CREATE TABLE IF NOT EXISTS `uffici` (
              `id` int(11) NOT NULL AUTO_INCREMENT,
              `descrizione` text NOT NULL,
              `firma` text NOT NULL,
              `firmaprova` text NOT NULL,
              PRIMARY KEY (`id`)
            ) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci AUTO_INCREMENT=0 ;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `users`
            --
            
            CREATE TABLE IF NOT EXISTS `users` (
              `idanagrafica` int(11) NOT NULL DEFAULT '0',
              `auth` int(11) NOT NULL DEFAULT '0',
              `loginname` text NOT NULL,
              `password` text NOT NULL,
              `mainemail` text NOT NULL,
              `terminiecondizioni` int(1) NOT NULL,
              `admin` tinyint(1) DEFAULT NULL,
              `anagrafica` int(1) DEFAULT NULL,
              `protocollo` int(1) DEFAULT NULL,
              `documenti` int(1) NOT NULL,
              `lettere` int(1) DEFAULT NULL,
              `magazzino` int(1) DEFAULT NULL,
              `ambulatorio` int(1) NOT NULL,
              `contabilita` int(1) DEFAULT NULL,
              `updateprofile` tinyint(4) NOT NULL DEFAULT '0',
              PRIMARY KEY (`idanagrafica`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
            
            -- --------------------------------------------------------
            
            --
            -- Struttura della tabella `usersettings`
            --
            
            CREATE TABLE IF NOT EXISTS `usersettings` (
              `idanagrafica` int(11) NOT NULL DEFAULT '0',
              `risultatiperpagina` int(11) NOT NULL DEFAULT '0',
              `splash` text NOT NULL,
              `secondocoloretabellarisultati` text NOT NULL,
              `primocoloretabellarisultati` text NOT NULL,
              `larghezzatabellarisultati` text NOT NULL,
              `notificains` tinyint(1) DEFAULT NULL,
              `notificamod` tinyint(1) DEFAULT NULL,
              PRIMARY KEY (`idanagrafica`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
            
        ");
    }
}
