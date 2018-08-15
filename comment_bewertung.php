<?php
# Beispieldatei für Bewertungen des Kommentarscripts zum einbinden auf der Homepage

$comment_erassoft_dateiname = "comment_test.dat";     // Speicherort für die Kommentare
include("comment/bewertung.php");                     // Bewertungsscript wird eingebunden

echo"<b>Durchschnitt aller Bewertungen:</b> $comment_erassoft_Ausgabe_voting_durchschnitt<br>";
echo"<b>Anzahl der abgegebenen Stimmen:</b> $comment_erassoft_Ausgabe_voting_stimmen";
?>