# Abulafia Web - Smart Solutions

Abulafia Web è un gestionale che si propone di rendere maggiormente efficienti le aziende e le amministrazioni attraverso l'eliminazione dei registri cartacei, consentendo con poche operazioni di archiviare la posta in entrata e in uscita attraverso un sistema di registrazione di protocollo avanzato e professionale. 

Il programma gestisce in maniera automatica la numerazione di ciascun documento e mette a disposizione avanzate funzioni di ricerca per parole chiave o per intervalli di tempo. Conformemente alla legge sulla privacy (decreto legislativo 196/2003), ciascun utente del software è identificato da un codice e da una password. L'amministratore può creare un numero illimitato di utenti e le operazioni di registrazione di protocollo tengono traccia del nome e del cognome di chi le ha effettuate.

Il programma prevede anche l'adozione di un titolario di classificazione per permettere all'azienda di catalogare i documenti protocollati a seconda della funzione o attività cui essi fanno riferimento. Questo significa che è possibile stabilire una classificazione dei documenti, ad esempio, per oggetto o per tipologia allo scopo di facilitare la loro reperibilità in archivio.

Abulafia Web e' stato inizialmente ideato da Biagio Saitta ed Alfio Musmarra ed oggi realizzato e mantenuto dagli stessi insieme a Federico D'urso e Stefano Principato. Preziose collaborazioni sono state fornite da Alfio Costanzo, Roberto Parrinello, Laura Ferrara, Giovanni Susinni, Luigi Pistara', Laura Astolfi, Mara Basile e Marianna Schillaci. Tutto il sistema e' stato sviluppato con software opensource quali (a solo titolo di esempio) Gedit, Gimp, Php, Mysql. A sua volta il codice di Abulafia e' aperto a chiunque voglia contribuire allo sviluppo.

I creatori di Abulafia Web sono disponibili a risolvere qualsiasi problema dovesse presentarsi con l'uso dell'applicativo. Tuttavia questo viene fornito "AS IS", senza alcuna garanzia. Chi lo installa ne accetta le condizioni di licenza e lo usa sotto la propria esclusiva responsabilita'. Abulafia e' stato pensato per poter essere 'portabile' e scalabile. 

Per eseguire l'applicativo e' sufficiente far girare, in locale o da remoto, un webserver in grado di interpretare il codice php. Sono quindi supportati sistemi operativi quali Linux, Mac, FreeBSD e Windows.


## Installazione in locale

### Prerequisiti

* PHP versione 7.1 o superiore
* MySQL versione 5.5 o superiore, o MariaDB versione 10 o superiore
* Composer ([getcomposer.org/download](https://getcomposer.org/download/))
  * Su **Linux**, esegui i comandi mostrati alla pagina sopra per scaricare `composer.phar` nella tua directory, poi esegui:
    ```
    $ sudo mv composer.phar /usr/local/bin/composer
    ```
    Questo ti permetterà di chiamare `composer` da qualunque directory nel tuo sistema.
  * Su **Windows**, puoi usare [Composer-Setup.exe](https://getcomposer.org/Composer-Setup.exe) per installare Composer.

### Dipendenze

Per scaricare e installare tuti i requisiti di Abulafia, puoi usare Composer:

```
$ composer install
```

Questo creerà una cartella `vendor/`, la quale conterrà tutte le dipendenze di Abulafia.


### Configurazione

1. Crea un database per Abulafia.
2. Per creare le tabelle necessarie ad Abulafia, ed il primo utente di esempio (`utente:utente`), 
   usa lo script presente in `.ebextensions/scripts/popola-database.sql`. Puoi usare la funzionalità
   "Importa" di phpMyAdmin, oppure da terminale:
   ```
   $ mysql -u $NOME_UTENTE $NOME_DATABASE < .ebextensions/scripts/popola-database.sql
   ```
   (dove `$NOME_UTENTE` e `$NOME_DATABASE` corrispondono ai dettagli del database da te creato).
3. Modifica il file `core.php` con i dettagli del database da te creato e le credenziali di accesso al database.


## AWS Elastic Beanstalk (EB)

### Prerequisiti

Installa la utility da riga di comando (CLI) di Elastic Beanstalk.
Questo ti permetterà di lanciare i comandi che iniziano con `eb`.
Segui le istruzioni ufficiali 
[in questa pagina](https://docs.aws.amazon.com/elasticbeanstalk/latest/dg/eb-cli3-install.html),
oppure usa Python:

```
$ sudo pip install awsebcli
```

E' inoltre necessario ottenere una coppia di chiavi (AWS access key, AWS secret key) associate alla propria utenza AWS.

### Creare un ambiente

Assicurarsi che Elastic Beanstalk sia configurato, e crea una applicazione EB (un contenitore di istanze di Abulafia).
Il comando seguente farà una serie di domande a terminale per configurare l'applicazione.

```
$ eb init
```

Creare un ambiente (*environment*), ovvero una istanza di Abulafia:

```
$ eb create --database
```
