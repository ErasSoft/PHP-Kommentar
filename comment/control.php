<?php
#############################################################################################
# Copyright des Kommentar Scripts by ErasSoft.de (2012)                                     #
#############################################################################################

# Kommentare freischalten und unsichtbar machen via link...
# Bsp. control.php?pw=admin&file=test.dat&line=0&visible=true



# Einstellungen auslesen
include("settings.php");

$pw=""; $file=""; $line=0; $visible="true";
if(isset($_GET['pw'])){
  $pw=$_GET['pw'];
}
if(isset($_GET['file'])){
  $file=$_GET['file'];
}
if(isset($_GET['line'])){
  $line=$_GET['line'];
}
if(isset($_GET['visible'])){
  $visible=$_GET['visible'];
}


if($comment_erassoft_passwort == $pw && $comment_erassoft_passwort_enable==true){
  if(file_exists("$comment_erassoft_daten/$file")){
    # .dat auslesen
    $comment_datei = fopen("$comment_erassoft_daten/$file","r");
    $comment_erassoft_antworten = file("$comment_erassoft_daten/$file");
    $comment_antworten_zeilen = count($comment_erassoft_antworten);
    fclose($comment_datei);

    # Für line 0 bis x (all)
    $neu_schreiben = false;
    if(is_numeric($line) && $line >= 0 && $line < $comment_antworten_zeilen){
      if($visible == "true"){
        $test_zeichen=substr($comment_erassoft_antworten[$line],0,1);
        if($test_zeichen=="|"){
          $comment_erassoft_antworten[$line]=substr($comment_erassoft_antworten[$line],1,(strlen($comment_erassoft_antworten[$line])-1) );
          $neu_schreiben = true;
          echo"Kommentar erfolgreich freigeschaltet!";
        }
        else{
          echo"Beitrag schon freigeschaltet!";
        }
      }
      else{
        $test_zeichen=substr($comment_erassoft_antworten[$line],0,1);
        if($test_zeichen!="|"){
          $comment_erassoft_antworten[$line]="|".$comment_erassoft_antworten[$line];
          $neu_schreiben = true;
          echo"Kommentar erfolgreich versteckt!";
        }
        else{
          echo"Beitrag schon versteckt!";
        }
      }
    }
    # Alle Kommentare freischalten/verstecken
    else if($line == "all"){
    $neu_schreiben = true;
      if($visible == "true"){
        for($i=0; $i<$comment_antworten_zeilen; $i++){
          $test_zeichen=substr($comment_erassoft_antworten[$i],0,1);
          if($test_zeichen=="|"){
            $comment_erassoft_antworten[$i]=substr($comment_erassoft_antworten[$i],1,(strlen($comment_erassoft_antworten[$i])-1) );
          }
        }
        echo"Alle Kommentare erfolgreich freigeschaltet!";
      }
      else{
        for($i=0; $i<$comment_antworten_zeilen; $i++){
          $test_zeichen=substr($comment_erassoft_antworten[$i],0,1);
          if($test_zeichen!="|"){
            $comment_erassoft_antworten[$i]="|".$comment_erassoft_antworten[$i];
          }
        }
        echo"Alle Kommentare erfolgreich versteckt!";
      }
    }
    else{
      echo"Kommentar nicht gefunden!";
    }
    # Datei neu schreiben
    if($neu_schreiben == true){
      $comment_datei = fopen("$comment_erassoft_daten/$file","w");
      for($i=0; $i<$comment_antworten_zeilen; $i++){
        fwrite($comment_datei,"$comment_erassoft_antworten[$i]");
      }
      fclose($comment_datei);
    }
  }
  else{
    echo"Datei existiert nicht!";
  }
}
else{
  echo"Falsches Passwort!";
}

?>