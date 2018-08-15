<?php
# Beispieldatei zum Kommentarscript einbinden auf der Homepage
?>


<?php
# Für den Header Bereich (ganz oben im Quelltext)
session_start();                                  // WICHTIG: Muss 1x ganz oben im Quelltext vorhanden sein für Captcha!
include("comment/cookie.php");                    // Cookie Sperre, um doppelposting zu verhindern (einschaltbar in Settings)
?>


<?php
# Für die individuelle Homepage
$comment_erassoft_mit_voting = true;              // Kommentare mit Bewertung? (true/false)
$comment_erassoft_dateiname = "comment_test.dat"; // Speicherort für die Kommentare
                                                  // (für weitere Kommentare, nur Dateinamen ändern)
include("comment/comment.php");                   // Kommentarscript wird eingebunden
?>