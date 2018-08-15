<?php
#############################################################################################
# Copyright des Kommentar Scripts by ErasSoft.de (2012)                                     #
#############################################################################################

# Hier kann man das Kommentarscript einstellen





################### Sonstige Einstellungen ###################

# Ordner wählen (Standard: "comment")
$comment_erassoft_ordner =           "comment";
$comment_erassoft_daten =            "daten";

# Passwort für die control.php Datei wählen (Auf true stellen zur benutzung!)
$comment_erassoft_passwort_enable =   false;
$comment_erassoft_passwort =         "admin";
$comment_erassoft_pfad =             "comment/"; // individuell anpassen je nach einbindung

# Kommentar nach absenden sofort anzeigen? (true/false)
# Bei false = Freischaltung erfolgt durch das entfernen des ersten Querstriches. -->  | in den .dat Dateien
$comment_erassoft_comment_anzeigen =  true;

# max. Anzahl der neusten Kommentare anzeigen (0 = Alle anzeigen)
$comment_erassoft_comment_anzahl =    5;

# Bei Kommentarbegrenzung "Alle Kommentare anzeigen" anzeigen? (true/false)
$comment_erassoft_comment_allcomment= true;

# E-Mail benachrichtigung? (true/false)
$comment_erassoft_email_nachricht =   false;
$comment_erassoft_email_adresse =    "max@mustermann.de";
$comment_erassoft_email_name =       "Kommentarscript";

# Captcha Stufe wählen 0 bis 5 (0 = Kein Captcha)
# (1 = leichter Captcha, wenig Spamschutz ...bis... 5 = schwerer Captcha, hoher Spamschutz)
$comment_erassoft_captcha_stufe =     4;
$comment_erassoft_font          =    "fonts/font.ttf";

# Smiley Grafiken benutzen? (true/false) Wichtig: Smileys hinzufügen/ändern in der Datei smileys.php !
$comment_erassoft_smiley =            true;

# IP Sperre gegen Doppelpost? (true/false)
$comment_erassoft_ipsperre =          true;

# Cookiesperre? (true/false) (Einstellungen in cookie.php ändern!)
$comment_erassoft_cookie =            false;

# Cookiename wählen (Einstellungen in cookie.php ändern!)
$comment_erassoft_cookie_name =      "comment";

# Fehler Captcha Code falsch eingegeben
$comment_erassoft_text_captcha =     "<font color=\"#FF0000\">Sie haben den Captcha Code falsch eingegeben.</font><br>";
# Fehler doppelpost mit gleicher IP
$comment_erassoft_text_iptext =      "<font color=\"#FF0000\">Sie haben schon einen Kommentar abgeschickt.</font><br>";
# Cookiefehler Textnachricht
$comment_erassoft_text_cookiefehler= "<font color=\"#FF0000\">Sie haben gerade einen Kommentar abgeschickt, bitte warten Sie 30 sek.</font><br>";
# Dateifehler Textnachricht
$comment_erassoft_text_dateifehler = "<font color=\"#FF0000\">Sie haben vergessen einen Speicherort zu wählen.</font><br>";
# Fehler kein Name, kurzer Name
$comment_erassoft_text_kname =       "<font color=\"#FF0000\">Dein Name ist zu kurz, wähle einen längeren.</font><br>";
# Fehler kein Text, kurzer Text
$comment_erassoft_text_ktext =       "<font color=\"#FF0000\">Dein Text ist zu kurz, schreibe einen längeren.</font><br>";
# Gesendet Textnachricht
$comment_erassoft_text_gesendet =    "<font color=\"#FF0000\">Ihre Angaben wurden erfolgreich gesendet.</font><br>";

# Form Name und Text einstellen? (Name der Textfelder für das Formular)
$comment_erassoft_form_name =        "name";
$comment_erassoft_form_voting =      "voting";
$comment_erassoft_form_captcha =     "captcha";
$comment_erassoft_form_text =        "text";
$comment_erassoft_form_abschicken =  "abschicken";
$comment_erassoft_form_löschen =     "löschen";

# Wenn keine Angabe zum Voting besteht, dann (true/false)
if(!isset($comment_erassoft_mit_voting)){
  $comment_erassoft_mit_voting = false;
}
?>