# PHP-Kommentar
Ein Kommentar Script für die eigene Homepage.

Dieses Kommentar Script erlaubt dir das einfache einbinden und schreiben eines Kommentares oder mehreren auf deiner eigenen Homepage.
Ein optionales Bewertungssystem von 1 bis 10 Sterne erlaubt einem die Bewertung von Seiten oder Produkten.
Kommentare können entweder sofort angezeigt werden oder erst durch die Freischaltung des Administrators.
Freischalten/Ausblenden von Kommentaren erfolgt durch einen Passwort gesicherten Link der in der E-Mail mitgeliefert wird.
Weiterhin um Spam zu vermeiden sind diverse Dinge eingebaut, z.B. eine Cookie Sperre, eine IP Sperre und eine Captcha abfrage.
Diese und viele andere Dinge lassen sich alle in der settings.php einstellen!
Das Kommentar Script speichert die Daten wie die IP, Bewertung, Name, Datum, Uhrzeit und den Text in .dat Dateien in einem Unterverzeichnis.

Anwendung:
Lade das PHP-Kommentar Script auf deine Homepage hoch, nun wird ein Ordner comment und 2 Beispieldateien angezeigt.
Wie Sie das Kommentar Script richtig einbinden sehen Sie in den Beispieldateien.
In der Datei settings.php kann man das Kommentar Script einstellen.
Zum einbinden des Kommentar Scripts werden diese PHP-Befehle benutzt:
<?php 
$comment_erassoft_mit_voting = true; 
$comment_erassoft_dateiname = "comment_test.dat"; 
include("comment/comment.php"); 
?> 

Funktionsweise:
Dieses Script speichert die Kommentare in einem .dat Format im Ordner Daten.
Bei der Freischaltung der Kommentare muss man nur den ersten Querstrich in der jeweiligen Datei entfernen --> | 

Beispiel des PHP-Kommentarscripts:
Siehe in die Rubrik "Kommentare"

Achtung:
Benutzen des PHP-Kommentarscripts auf eigene Gefahr, wir übernehmen keine Haftung für eventuelle Schäden, die durch dieses Script hervorgerufen wurden.
