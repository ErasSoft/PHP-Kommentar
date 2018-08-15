<?php
# Beispieldatei zum Kommentarscript einbinden auf der Homepage
?>


<?php
# F�r den Header Bereich (ganz oben im Quelltext)
session_start();                                  // WICHTIG: Muss 1x ganz oben im Quelltext vorhanden sein f�r Captcha!
include("comment/cookie.php");                    // Cookie Sperre, um doppelposting zu verhindern (einschaltbar in Settings)
?>


<?php
# F�r die individuelle Homepage
$comment_erassoft_mit_voting = true;              // Kommentare mit Bewertung? (true/false)
$comment_erassoft_dateiname = "comment_test.dat"; // Speicherort f�r die Kommentare
                                                  // (f�r weitere Kommentare, nur Dateinamen �ndern)
include("comment/comment.php");                   // Kommentarscript wird eingebunden
?>