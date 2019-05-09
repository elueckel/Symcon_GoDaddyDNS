## English information below

## Funktionsumfang

Modul aktualisiert einen DNS Record (A) bei GoDaddy um so ein DynDNS bei gehosteten Domains zu ermöglichen 

## Voraussetzungen

IP-Symcon ab Version 4.x

## Software-Installation

Über das Modul-Control folgende URL hinzufügen.
https://github.com/elueckel/Symcon_GoDaddyDNS

## Einrichten der Instanzen in IP-Symcon
Unter "Instanz hinzufügen" ist das 'GoDaddy DNS'-Modul unter dem Hersteller '(Sonstige)' aufgeführt.

## Konfigurationsseite:

Domain: Root Domain die aktualisiert werden soll z.B. symcon.com
Update Record: Der A-Record der aktualisiert werden soll z.B. daheim von symcon.com (nur den A-Record selbst angeben - nicht FQDN)
Key: Ein Key der via api.godaddy.com erstellt wird
Secret: Ein Secret der via api.godaddy.com erstellt wird
Update Interval: Frequenz die oft die Komponente die eigene IP von der Firewall abfragt (60 für Minütlich dürfte vermutlich reichen)
IPInfo Token: Eigene IP wird via IPInfo abgefragt - es wird eine Token (kostenlos für 1000 Abfragen) bei IPInfo benötigt


### Version 1.0 20/01/2019
- Kompenente fragt die IP des Anschlusses in der oben gewählten Frequenz ab und prüft ob ein Update im DNS nötig ist
- Komponente stellt auf Wunsch die aktuelle IP in einer Variable bereit
- Komponente aktualisiert einen DNS Record (A) bei GoDaddy gehosteten Domains

### Version 1.01 03/02/2019
- Fix beim abrufen der eigenen Adresse

## Wo finde ich Informationen ob das Modul funktioniert
Wenn Debug eingeschaltet ist gibt die Komponente diverse Informationen im Debug Fenster aus.


## Features

Module updates a DNS (A) record in the GoDaddy DNS service.

## Voraussetzungen

IP-Symcon 4.x upward

## Software-Installation

Via Module-Control or Module Store
https://github.com/elueckel/Symcon_GoDaddyDNS

## Setup of the instance in IP-Symcon
At "Add Instance" select 'GoDaddy DNS'-Module at vendor 'Other'

## Configuration:

Domain: Root Domain which should be updated z.B. symcon.com
Update Record: The A-Record which should be updated e.g. home von symcon.com (just select the A-Record (home) - not the FQDN)
Key: A key created via api.godaddy.com 
Secret: A key created via api.godaddy.com 
Update Interval: Cadance how often the record should be updated (60 should be enough (every minute)
IPInfo Token: Token created via IPInfo (free of charge for 1000 queries)


### Version 1.0 20/01/2019
- Component checks the current IP of the router and updates the DNS record
- Component provides the IP Adress in a variable

### Version 1.01 03/02/2019
- Fix while check the own IP adress

## Where can I find additional information in case an update is not performed
If debug is enabled, messages will be added to the debug view
