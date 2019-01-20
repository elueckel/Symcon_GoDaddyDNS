## Funktionsumfang

Modul aktuellisiert einen DNS Record (A) um so ein DynDNS bei GoDaddy gehosteten Domains zu ermöglichen 

## Voraussetzungen

IP-Symcon ab Version 5.x (darauf wurde entwickelt - sollte aber auch mit Version 4.x funktionieren).

## Software-Installation

Über das Modul-Control folgende URL hinzufügen.
https://github.com/elueckel/Symcon_GoDaddyDNS

## Einrichten der Instanzen in IP-Symcon
Unter "Instanz hinzufügen" ist das 'GoDaddy DynDNS'-Modul unter dem Hersteller '(Sonstige)' aufgeführt.

## Konfigurationsseite:

Domain: Root Domain die aktualisiert werden soll z.B. symcon.com
Update Record: Der A-Record der aktualisiert werden soll z.B. daheim.symcon.com
Key: Ein Key der via api.godaddy.com erstellt wird
Secret: Ein Secret der via api.godaddy.com erstellt wird
Update Interval: Frequenz die oft die Komponente die eigene IP von der Firewall abfragt


Daten Hier können die Sensoren ausgewählt werden.

### Version 1.0 16/01/2019
- Kompenente fragt die IP des anschlusses in der oben gewählten Frequenz ab und prüft ob ein Update im DNS nötig ist
- Komponente stellt auf Wunsch die aktuelle IP in eine Variable bereit
- Komponente aktualisiert einen DNS Record (A) bei GoDaddy gehosteten domains



## Wo finde ich Informationen ob das Modul funktioniert
Das Modul postet Informationen ins Log (Stand V2.0). 
