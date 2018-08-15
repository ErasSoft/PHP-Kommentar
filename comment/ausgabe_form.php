<?php
#############################################################################################
# Copyright des PHP-Kommentar Scripts by ErasSoft.de (2012)                                 #
#############################################################################################

# Hier kann man das aussehen des Formulars ändern
# Das Copyright Zeichen, sowie der link zu ErasSoft Homepage...
# müssen innerhalb des Formulars gut sichtbar bleiben!

$ErasSoft_copyright = "<a target=\"_blank\" href=\"http://erassoft.de\">©ErasSoft</a>";





echo"
<form action='' method='POST'>
<table border=\"0\" cellspacing=\"0\" cellpadding=\"0\">
<tr>
 <td width=\"80\"></td>
 <td width=\"120\"></td>
 <td width=\"100\"></td>
 <td width=\"100\"></td>
</tr>
<tr>
 <td colspan=\"4\"><a name=\"comment\"></a><h2>Schreibe einen Kommentar</h2></td>
</tr>
<tr>
 <td colspan=\"4\">";

# Fehlerroutine
if($comment_erassoft_fehler_dateiname==true){
echo"
$comment_erassoft_text_dateifehler";
}

if($comment_fehler_ip==true){
echo"
$comment_erassoft_text_iptext";
}
else if($comment_fehler_cookie==true){
echo"
$comment_erassoft_text_cookiefehler";
}
else if($comment_fehler_kname==true){
echo"
$comment_erassoft_text_kname";
}
else if($comment_fehler_ktext==true){
echo"
$comment_erassoft_text_ktext";
}
else if($comment_fehler_captcha==true){
echo"
$comment_erassoft_text_captcha";
}
if($comment_anzeigen==true){
echo"
$comment_erassoft_text_gesendet";
}


if(isset($_POST[$comment_erassoft_form_voting])){
  $comment_erassoft_voting=$_POST[$comment_erassoft_form_voting];
}
else{
  $comment_erassoft_voting = "";
}

echo"
 </td>
</tr>
<tr>";

if($comment_erassoft_mit_voting==false){
echo"
 <td colspan=\"2\">&nbsp;</td>";
}
else{
echo"
 <td><b>Bewertung:</b></td>
 <td>
   <select name=\"$comment_erassoft_form_voting\">
     <option value=\"\""; if($comment_erassoft_voting==""){echo" selected";} echo">Keine Bewertung</option>
     <option value=\"1\""; if($comment_erassoft_voting==1){echo" selected";} echo">1 Stern</option>
     <option value=\"2\""; if($comment_erassoft_voting==2){echo" selected";} echo">2 Sterne</option>
     <option value=\"3\""; if($comment_erassoft_voting==3){echo" selected";} echo">3 Sterne</option>
     <option value=\"4\""; if($comment_erassoft_voting==4){echo" selected";} echo">4 Sterne</option>
     <option value=\"5\""; if($comment_erassoft_voting==5){echo" selected";} echo">5 Sterne</option>
     <option value=\"6\""; if($comment_erassoft_voting==6){echo" selected";} echo">6 Sterne</option>
     <option value=\"7\""; if($comment_erassoft_voting==7){echo" selected";} echo">7 Sterne</option>
     <option value=\"8\""; if($comment_erassoft_voting==8){echo" selected";} echo">8 Sterne</option>
     <option value=\"9\""; if($comment_erassoft_voting==9){echo" selected";} echo">9 Sterne</option>
     <option value=\"10\""; if($comment_erassoft_voting==10){echo" selected";} echo">10 Sterne</option>
   </select>
 </td>";

}

echo"
 <td>";

if($comment_erassoft_captcha_stufe!=0){
  echo"<div align=\"right\"><b>Captcha:</b></div>";
}
echo"</td>
 <td>";

if($comment_erassoft_captcha_stufe!=0){
  echo"<div align=\"right\"><img src=\"$comment_erassoft_ordner/captcha.php\"></div>";
}
echo"</td>
</tr>
<tr>
 <td><b>Name:</b></td>
 <td><input value=\"";
if(isset($_POST[$comment_erassoft_form_name])){
  echo"$_POST[$comment_erassoft_form_name]";
}
echo"\" type=\"name\" name=\"$comment_erassoft_form_name\" size=\"17\" maxlength=\"20\"></td>
 <td>"; if($comment_erassoft_captcha_stufe!=0){echo"<div align=\"right\"><b>Code:</b></div>";} echo"</td>
 <td>";

if($comment_erassoft_captcha_stufe!=0){
  echo"<div align=\"right\"><input style=\"text-align: right;\" type=\"name\" name=\"$comment_erassoft_form_captcha\" size=\"10\" maxlength=\"5\"></div>";
}
echo"</td>
</tr>
<tr>
 <td valign=\"top\"><b>Text:</b>";
if($comment_erassoft_smiley==true){
echo"
<br><br>
<font size=\"-1\"><a target=\"_blank\" href=\"$comment_erassoft_ordner/smileys.php\" onclick=\"window.open('$comment_erassoft_ordner/smileys.php', 'fenster', 'width=400,height=600,top=1,left=1,status,resizable,scrollbars').focus(); return false;\">Smileys<br>anzeigen</a></font>";
}
echo"</td>
 <td colspan=\"4\"><textarea name=\"$comment_erassoft_form_text\" cols=\"45\" rows=\"5\">";

if(isset($_POST[$comment_erassoft_form_text])){
  echo"$_POST[$comment_erassoft_form_text]";
}
echo"</textarea></td>
</tr>
<tr>
  <td>&nbsp;</td>
  <td><input type=\"submit\" name=\"$comment_erassoft_form_abschicken\" value=\"Abschicken\"></td>
  <td><input type=\"reset\" name=\"$comment_erassoft_form_löschen\" value=\"Löschen\"></td>
  <td><div align=\"right\">$ErasSoft_copyright</div></td>
</tr>
</table>
</form>";
?>