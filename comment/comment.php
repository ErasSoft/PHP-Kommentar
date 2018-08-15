<?php
#############################################################################################
# Copyright des Kommentar Scripts by ErasSoft.de (2012)                                     #
# Scriptänderungen dürfen nur mit Einzugsermächtigung von Eras vorgenommen werden           #
#############################################################################################


#############################################################################################
#                                    WICHTIG                                                #
# Mit den PHP-Befehlen:                                                                     #
# $comment_erassoft_mit_voting = true; // Kommentare mit Bewertung? (true/false)            #
# $comment_erassoft_dateiname = "comment_test.dat"; // Speicherort für die Kommentare       #
# include("comment/comment.php");                                                           #
# kann der Kommentar angezeigt werden und in die jeweilge .dat Datei gespeichert werden     #
#############################################################################################


#############################################################################################
#                                Dateien Überblick:                                         #
#                                                                                           #
#   settings.php     = Dort kann man Eingeschaften des Kommentares ändern usw.              #
#   ausgabe_com.php  = Dort werden die Kommentare in einer Schleife ausgegeben              #
#   ausgabe_form.php = Dort wird das Formular ausgegeben                                    #
#   bewertung.php    = liest das Voting (Durchschnitt/Anzahl Stimmen) aus                   #
#   cookie.php       = cookie.php in den Headerbereich einbinden, für einen Cookieschutz    #
#   captcha.php      = Dort wird das Captcha Bild erzeugt, für die ausgabe_form.php         #
#   control.php      = Über einen link können Beiträge freigeschaltet oder versteckt werden #
#   smileys.php      = Dort werden die Smileys in Grafiken umgewandelt                      #
#                                                                                           #
#   daten/           = In diesem Ordner werden die Daten der Kommentare in .dat gespeichert #
#   smileys/         = In diesem Ordner sind die Grafiken der Smileys drin                  #
#                                                                                           #
# Alle Dateien und auch der Ordner müssen mit allen Rechten ausgestattest sein (Leserechte, #
# Schreibrechte, Ausführrechte) kurz: 777 oder rwxrwxrwx, damit dieses Script funktioniert  #
#############################################################################################






#################################################
### Kommentar - Script Beginn - (c)ErasSoft   ###
#################################################



echo"
<!-- Kommentarscript Beginn -->
<!-- (c)ErasSoft.de -->
";

# Einstellungen auslesen
include("settings.php");

# Fehler Deklaration
$comment_fehler_captcha = false;
$comment_fehler_cookie = false;
$comment_erassoft_fehler_dateiname = false;
$comment_fehler_kname = false;
$comment_fehler_ktext = false;
$comment_fehler_ip = false;

# IP auslesen
$comment_erassoft_ip = getenv ("REMOTE_ADDR");
$comment_erassoft_Ausgabe_ip = 1;

# Wenn keine Angabe zum Speicherort besteht, dann (true/false)
$comment_erassoft_dateinamenort = "$comment_erassoft_daten/$comment_erassoft_dateiname";
if(!isset($comment_erassoft_dateinamenort)){
  $comment_erassoft_fehler_dateiname =  true;
}
$comment_anzeigen=false;
if(isset($_POST[$comment_erassoft_form_text])){
  $comment_fehler_cookie=false;
  $comment_fehler_kname=false;
  $comment_anzeigen=true;

    # Speicherort der Datei vergessen?
    if($comment_erassoft_fehler_dateiname==true){
      $comment_anzeigen=false;
    }
    if($comment_erassoft_captcha_stufe!=0){
      $comment_erassoft_captcha=$_POST[$comment_erassoft_form_captcha];}
    else{
      $comment_erassoft_captcha=1; $_SESSION["captcha_code"]=1;
    }
    $comment_erassoft_name=$_POST[$comment_erassoft_form_name];
    $comment_erassoft_text=$_POST[$comment_erassoft_form_text];
    $comment_kname_länge=strlen($comment_erassoft_name);
    $comment_ktext_länge=strlen($comment_erassoft_text);

    if($comment_erassoft_captcha!=$_SESSION["captcha_code"] || $comment_erassoft_captcha=""){
      $comment_anzeigen=false;
      $comment_fehler_captcha=true;
    }
    if($comment_kname_länge<4){
      $comment_anzeigen=false;
      $comment_fehler_kname=true;
    }
    if($comment_ktext_länge<4){
      $comment_anzeigen=false;
      $comment_fehler_ktext=true;
    }

    # IP-Sperre ?
    if($comment_erassoft_ipsperre==true){
      # .dat auslesen
      $comment_datei = fopen("$comment_erassoft_ordner/$comment_erassoft_daten/$comment_erassoft_dateiname","a+");
      $comment_erassoft_antworten = file("$comment_erassoft_ordner/$comment_erassoft_daten/$comment_erassoft_dateiname");
      $comment_antworten_zeilen = count($comment_erassoft_antworten);
      $i = $comment_antworten_zeilen-1;
      if($comment_antworten_zeilen>=1)
      {
        $comment_zeichen=substr($comment_erassoft_antworten[$i], 0, 1);
        if($comment_zeichen!=''){
          # Striche ermitteln und Werte dazwischen auslesen
          $comment_antwort_strich=0;
          $c=0;
          $comment_erassoft_länge = strlen($comment_erassoft_antworten[$i]);
          for($b=0;$b<=$comment_erassoft_länge;$b++){
            $comment_erassoft_test = substr($comment_erassoft_antworten[$i], $b, 1);
            if($comment_erassoft_test=='|'){
              $comment_erassoft_strich_pos[$c]=$b;
              $c=$c+1;
            }
          }
        if($comment_zeichen=='|'){
          $comment_erassoft_Ausgabe_ip= substr($comment_erassoft_antworten[$i],1,($comment_erassoft_strich_pos[1]-1));
        }
        else{
          $comment_erassoft_Ausgabe_ip= substr($comment_erassoft_antworten[$i],0,$comment_erassoft_strich_pos[0]);
        }
      }
    }
  }

  # wenn letzter Beitrag selbe IP hatte wie der geschriebene Beitrag
  if($comment_erassoft_ip==$comment_erassoft_Ausgabe_ip){
    $comment_anzeigen=false;
    $comment_fehler_ip=true;
  }

  # Cookiesperre?
  if($comment_fehler_ip!=true){
    if($comment_erassoft_cookie==true){
      if(isset($_COOKIE[$comment_erassoft_cookie_name])){
        $comment_anzeigen=false;
        $comment_fehler_cookie=true;
      }
    }
  }

  if($comment_anzeigen!=false){
    $comment_erassoft_name=$_POST[$comment_erassoft_form_name];
    $comment_erassoft_voting=$_POST[$comment_erassoft_form_voting];
    $comment_erassoft_text=$_POST[$comment_erassoft_form_text];
    $comment_erassoft_datum = date("d.m.Y",time());
    $comment_erassoft_uhrzeit = date("H:i:s",time());

    # Enter ersetzen durch <br> und HTML Code ersetzen
    $comment_erassoft_name = str_replace("<", " &#60; ", "$comment_erassoft_name");
    $comment_erassoft_name = str_replace(">", " &#62; ", "$comment_erassoft_name");
    $comment_erassoft_name = str_replace("|", " &#124; ", "$comment_erassoft_name");
    $comment_erassoft_name = str_replace("$", " &#36; ", "$comment_erassoft_name");
    $comment_erassoft_name = str_replace('"', ' &#34; ', "$comment_erassoft_name");
    $comment_erassoft_name = str_replace("\r\n", "<br>", "$comment_erassoft_name");

    $comment_erassoft_text = str_replace("<", " &#60; ", "$comment_erassoft_text");
    $comment_erassoft_text = str_replace(">", " &#62; ", "$comment_erassoft_text");
    $comment_erassoft_text = str_replace("|", " &#124; ", "$comment_erassoft_text");
    $comment_erassoft_text = str_replace("$", " &#36; ", "$comment_erassoft_text");
    $comment_erassoft_text = str_replace('"', ' &#34; ', "$comment_erassoft_text");
    $comment_erassoft_text = str_replace("\r\n", "<br>", "$comment_erassoft_text");

    # .dat auslesen
    $comment_datei = fopen("$comment_erassoft_ordner/$comment_erassoft_daten/$comment_erassoft_dateiname","a+");
    $comment_erassoft_antworten = file("$comment_erassoft_ordner/$comment_erassoft_daten/$comment_erassoft_dateiname");
    $comment_antworten_zeilen = count($comment_erassoft_antworten);

    # Neue .dat speichern/ersetzen
    if($comment_erassoft_comment_anzeigen==true){
      fwrite($comment_datei,"$comment_erassoft_ip|$comment_erassoft_voting|$comment_erassoft_name|$comment_erassoft_datum|$comment_erassoft_uhrzeit|$comment_erassoft_text|\n");
    }
    else{
      fwrite($comment_datei,"|$comment_erassoft_ip|$comment_erassoft_voting|$comment_erassoft_name|$comment_erassoft_datum|$comment_erassoft_uhrzeit|$comment_erassoft_text|\n");
    }
    fclose($comment_datei);

# E-Mail Text
    $comment_erassoft_email_text=
    "Neuer Eintrag von $comment_erassoft_name [$comment_erassoft_ip]:

$comment_erassoft_text


Eintrag in der Datei: $comment_erassoft_dateiname";

if($comment_erassoft_passwort_enable==true){
   $comment_erassoft_email_text=  "$comment_erassoft_email_text

Kommentar freischalten: http://".$_SERVER['SERVER_NAME']."/$comment_erassoft_pfad$comment_erassoft_ordner/control.php?pw=$comment_erassoft_passwort&file=$comment_erassoft_dateiname&line=$comment_antworten_zeilen&visible=true

Kommentar verstecken: http://".$_SERVER['SERVER_NAME']."/$comment_erassoft_pfad$comment_erassoft_ordner/control.php?pw=$comment_erassoft_passwort&file=$comment_erassoft_dateiname&line=$comment_antworten_zeilen&visible=false";
}

# Ende der E-Mail

    $comment_erassoft_email_betreff="$comment_erassoft_dateiname";
    if($comment_erassoft_email_nachricht!=false){
      mail($comment_erassoft_email_adresse, $comment_erassoft_email_betreff, $comment_erassoft_email_text,
      "From: $comment_erassoft_email_name <$comment_erassoft_email_adresse>");
    }
  }
}



if (file_exists("$comment_erassoft_ordner/$comment_erassoft_daten/$comment_erassoft_dateiname")){
  # .dat auslesen
  $comment_datei = fopen("$comment_erassoft_ordner/$comment_erassoft_daten/$comment_erassoft_dateiname","r");
  $comment_erassoft_antworten = file("$comment_erassoft_ordner/$comment_erassoft_daten/$comment_erassoft_dateiname");
  $comment_antworten_zeilen = count($comment_erassoft_antworten);
  fclose($comment_datei);
}
else{
  $comment_datei = fopen("$comment_erassoft_ordner/$comment_erassoft_daten/$comment_erassoft_dateiname","w+");
  chmod("$comment_erassoft_ordner/$comment_erassoft_daten/$comment_erassoft_dateiname", 0777);
  fclose($comment_datei);
}

# Formular ausgeben
include("ausgabe_form.php");

$comment_erassoft_Ausgabe_Fehler=0;
$comment_erassoft_Ausgabe_zeilen=$comment_antworten_zeilen;
if($comment_erassoft_Ausgabe_zeilen<=1){
  $comment_erassoft_Ausgabe_Fehler=1;
}

$sort=0;
for($i=0;$i<$comment_antworten_zeilen;$i++){
  $comment_zeichen=substr($comment_erassoft_antworten[$i], 0, 1);
  if($comment_zeichen==''){
    if(0==$i){
      $comment_erassoft_Ausgabe_Fehler=1;
    }
  }
  else{
    if($comment_zeichen=='|'){
      $comment_erassoft_Ausgabe_zeilen=$comment_erassoft_Ausgabe_zeilen-1;
      $comment_erassoft_Ausgabe_exist[$i]=0;
      if(0==$i){
        $comment_erassoft_Ausgabe_Fehler=2;
      }
    }
    else{
      # Striche ermitteln und Werte dazwischen auslesen
      $comment_antwort_strich=0;
      $c=0;
      $comment_erassoft_länge = strlen($comment_erassoft_antworten[$i]);
      for($b=0;$b<=$comment_erassoft_länge;$b++){
        $comment_erassoft_test = substr($comment_erassoft_antworten[$i], $b, 1);
        if($comment_erassoft_test=='|'){
          $comment_erassoft_strich_pos[$c]=$b;
          $c=$c+1;
        }
      }
      $comment_erassoft_Ausgabe_exist[$sort]=1;
      $comment_erassoft_Ausgabe_ip=substr($comment_erassoft_antworten[$i],0,($comment_erassoft_strich_pos[0]));
      $comment_erassoft_Ausgabe_voting[$sort]=substr($comment_erassoft_antworten[$i],($comment_erassoft_strich_pos[0]+1),($comment_erassoft_strich_pos[1]-$comment_erassoft_strich_pos[0]-1));
      $comment_erassoft_Ausgabe_name[$sort]=substr($comment_erassoft_antworten[$i],($comment_erassoft_strich_pos[1]+1),($comment_erassoft_strich_pos[2]-$comment_erassoft_strich_pos[1]-1));
      $comment_erassoft_Ausgabe_datum[$sort]=substr($comment_erassoft_antworten[$i],($comment_erassoft_strich_pos[2]+1),($comment_erassoft_strich_pos[3]-$comment_erassoft_strich_pos[2]-1));
      $comment_erassoft_Ausgabe_uhrzeit[$sort]=substr($comment_erassoft_antworten[$i],($comment_erassoft_strich_pos[3]+1),($comment_erassoft_strich_pos[4]-$comment_erassoft_strich_pos[3]-1));
      $comment_erassoft_Ausgabe_text[$sort]=substr($comment_erassoft_antworten[$i],($comment_erassoft_strich_pos[4]+1),($comment_erassoft_strich_pos[5]-$comment_erassoft_strich_pos[4]-1));

      # Trennen bei zu großen Zeichenketten
      $z2=0;
      $comment_erassoft_Ausgabe_text2="";
      $comment_erassoft_text_länge=strlen($comment_erassoft_Ausgabe_text[$sort]);
      for($z=0;$z<$comment_erassoft_text_länge;$z++){
        $comment_erassoft_text_zeichen = substr($comment_erassoft_Ausgabe_text[$sort], $z, 1);

        if($comment_erassoft_text_zeichen==" "){
          $z2=0;
        }
        if($z2==30){
          $comment_erassoft_Ausgabe_text2 = "$comment_erassoft_Ausgabe_text2"." $comment_erassoft_text_zeichen"; $z2=0;
        }
        else{
          $comment_erassoft_Ausgabe_text2 = "$comment_erassoft_Ausgabe_text2"."$comment_erassoft_text_zeichen";
        }
        $z2++;
      }
      $comment_erassoft_Ausgabe_text[$sort] = "$comment_erassoft_Ausgabe_text2";

      # Voting auf "Keine" setzen, wenn vorher keins war
      if($comment_erassoft_Ausgabe_voting[$sort]==''){
        $comment_erassoft_Ausgabe_voting[$sort]="keine";
      }
      $sort=$sort+1;
    }
  }
}

# Kommentare ausgeben
include("ausgabe_com.php");

echo"

<!-- (c)ErasSoft.de -->
<!-- Kommentarscript Ende -->
";

###############################################
### Kommentar - Script Ende - (c)ErasSoft   ###
###############################################
?>