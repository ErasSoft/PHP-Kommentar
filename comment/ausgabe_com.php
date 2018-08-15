<?php
#############################################################################################
# Copyright des PHP-Kommentar Scripts by ErasSoft.de (2012)                                 #
#############################################################################################

# Hier kann man das aussehen der Kommentare ändern



# Überschrift
echo"
<a name=\"comment0\"></a><h2>Kommentare</h2>";

if($comment_erassoft_comment_allcomment==true){
echo"
  <script type=\"text/javascript\">
  function show (allcomments) {
    if (document.getElementById) {
      if (document.getElementById(allcomments).style.display == \"block\") {
        document.getElementById(allcomments).style.display = \"none\";
      }
      else{
        document.getElementById(allcomments).style.display = \"block\";
      }
    }
  }
  </script>";
}

$comment_erassoft_Ausgabe_FehlerOK=1;
$comment_nr = $comment_erassoft_Ausgabe_zeilen;
$comment_erassoft_comment_anzahl_zähler=1;
$comment_erassoft_comment_weitere=0;

echo"
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">";

for($sort=($comment_erassoft_Ausgabe_zeilen-1);$sort>=0;$sort--){
  if($comment_erassoft_Ausgabe_exist[$sort]==1){
    $comment_erassoft_Ausgabe_FehlerOK=0;

    # Smileys benutzen/ausgeben
    if($comment_erassoft_smiley==true){
      include("smileys.php");
    }

    echo"
<tr>
 <td width=\"40\"><b><a name=\"comment$comment_nr\" href=\"#comment$comment_nr\">#$comment_nr</a></b></td>
 <td width=\"245\"><b>$comment_erassoft_Ausgabe_name[$sort]</b>";

    if($comment_erassoft_Ausgabe_voting[$sort]!='keine'){
      echo" ($comment_erassoft_Ausgabe_voting[$sort])";
    }
    echo"</td>
 <td width=\"175\">$comment_erassoft_Ausgabe_datum[$sort] - $comment_erassoft_Ausgabe_uhrzeit[$sort] Uhr</td>
</tr>
<tr>
 <td colspan=\"3\">$comment_erassoft_Ausgabe_text[$sort]<hr></td>
</tr>";

    if($comment_erassoft_comment_anzahl==$comment_erassoft_comment_anzahl_zähler && $sort!=0){
      if($comment_erassoft_comment_allcomment==true){
        echo"
</table>
<div id=\"allcomments\" style=\"display:none\">
<table cellspacing=\"0\" cellpadding=\"0\" border=\"0\">
<tr>
 <td>";
        $comment_erassoft_comment_weitere=1;
      }
      else{
        $sort=0;
      }
    }
    $comment_erassoft_comment_anzahl_zähler++;
  }
  $comment_nr = $comment_nr-1;
}

echo"
</table>";

if($comment_erassoft_comment_weitere==1 && $comment_erassoft_comment_allcomment==true){
  echo"</div>
<a href=\"javascript:show('allcomments')\">Alle Kommentare anzeigen</a>";
}

# Fehler, keine Kommentare vorhanden/freigeschalten
if( $comment_erassoft_Ausgabe_FehlerOK==1){
  if($comment_erassoft_Ausgabe_Fehler==1){
    echo"Keine Kommentare vorhanden...";
  }
  else if($comment_erassoft_Ausgabe_Fehler==2){
    echo"Keine Kommentare freigeschalten...";
  }
}
?>