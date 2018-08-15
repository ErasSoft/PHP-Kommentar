<?php
#############################################################################################
# Copyright des PHP-Kommentar Scripts by ErasSoft.de (2012)                                 #
#############################################################################################

# Hier kann man die Bewertungen auslesen mit den PHP-Befehlen:
# $comment_erassoft_dateiname="comment_test.dat";       Auswählen der Kommentar Datei
# include("comment/bewertung.php");                     Auslesen der Bewertungen
# echo"$comment_erassoft_Ausgabe_voting_durchschnitt";  Durchschnitt aller Bewertungen ausgeben
# echo"$comment_erassoft_Ausgabe_voting_stimmen";       Anzahl der abgegebenen Stimmen



# Einstellungen auslesen
# include("settings.php");

$comment_erassoft_ordner =           "comment";
$comment_erassoft_daten =            "daten";


if (file_exists("$comment_erassoft_ordner/$comment_erassoft_daten/$comment_erassoft_dateiname")){
  # .dat auslesen
  $comment_datei = fopen("$comment_erassoft_ordner/$comment_erassoft_daten/$comment_erassoft_dateiname","r");
  $comment_erassoft_antworten = file("$comment_erassoft_ordner/$comment_erassoft_daten/$comment_erassoft_dateiname");
  $comment_antworten_zeilen = count($comment_erassoft_antworten);
  fclose($comment_datei);
}

$comment_erassoft_Ausgabe_voting_stimmen=0;
$comment_erassoft_Ausgabe_voting_gesamt=0;
for($z=0;$z<$comment_antworten_zeilen;$z++){
  $comment_zeichen=substr($comment_erassoft_antworten[$z], 0, 1);
  if($comment_zeichen!=''){
    if($comment_zeichen!='|'){
      # Striche ermitteln und Werte dazwischen auslesen
      $comment_antwort_strich=0;
      $c=0;
      $comment_erassoft_länge = strlen($comment_erassoft_antworten[$z]);
      for($b=0;$b<=$comment_erassoft_länge;$b++){
        $comment_erassoft_test = substr($comment_erassoft_antworten[$z], $b, 1);
        if($comment_erassoft_test=='|'){
          $comment_erassoft_strich_pos[$c]=$b;
          $c=$c+1;
        }
      }
      $comment_erassoft_Ausgabe_voting_array[$z] =
      substr($comment_erassoft_antworten[$z],($comment_erassoft_strich_pos[0]+1),($comment_erassoft_strich_pos[1]-$comment_erassoft_strich_pos[0]-1));
      if($comment_erassoft_Ausgabe_voting_array[$z]!=''){
        $comment_erassoft_Ausgabe_voting_stimmen=$comment_erassoft_Ausgabe_voting_stimmen+1;
        $comment_erassoft_Ausgabe_voting_gesamt=$comment_erassoft_Ausgabe_voting_gesamt+$comment_erassoft_Ausgabe_voting_array[$z];
      }
    }
  }
}

if($comment_erassoft_Ausgabe_voting_stimmen==0){
  $comment_erassoft_Ausgabe_voting_durchschnitt="-";
}
else{
  $comment_erassoft_Ausgabe_voting_durchschnitt=$comment_erassoft_Ausgabe_voting_gesamt/$comment_erassoft_Ausgabe_voting_stimmen;
  $comment_erassoft_Ausgabe_voting_durchschnitt = round($comment_erassoft_Ausgabe_voting_durchschnitt,2);
}
?>