## Funktionsumfang

Modul aktualisiert einen DNS Record (A) bei GoDaddy um so ein DynDNS bei gehosteten Domains zu ermöglichen 

## Voraussetzungen

IP-Symcon ab Version 5.x (darauf wurde entwickelt - sollte aber auch mit Version 4.x funktionieren).

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


## Wo finde ich Informationen ob das Modul funktioniert
Wenn Debug eingeschaltet ist gibt die Komponente diverse Informationen im Debug Fenster aus.
