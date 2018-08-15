<?php
#############################################################################################
# Copyright des Kommentar Scripts by ErasSoft.de (2012)                                     #
#############################################################################################

# Hiermit kann man den Cookie für die Cookie sperre setzen...
# include("comment/cookie.php"); diesen Teil in den Header deiner Seite,
# um ein Cookie beim absenden des Formulars zu setzen

#####################################################



# Einstellungen auslesen
include("comment/settings.php");


if(isset($_POST[$comment_erassoft_form_text]))
{
  if($comment_erassoft_captcha_stufe!=0){
    $comment_erassoft_captcha=$_POST[$comment_erassoft_form_captcha];
  }
  else{
    $comment_erassoft_captcha=1;
    $_SESSION["captcha_code"]=1;
  }
  $comment_erassoft_name=$_POST[$comment_erassoft_form_name];
  $comment_erassoft_text=$_POST[$comment_erassoft_form_text];
  $comment_kname_länge=strlen($comment_erassoft_name);
  $comment_ktext_länge=strlen($comment_erassoft_text);

  $comment_cookie_setzen=true;

  if($comment_erassoft_captcha!=$_SESSION["captcha_code"] || $comment_erassoft_captcha==""){
    $comment_cookie_setzen=false;
  }
  if($comment_kname_länge<4){
    $comment_cookie_setzen=false;
  }
  if($comment_ktext_länge<4){
    $comment_cookie_setzen=false;
  }

  if($comment_cookie_setzen==true){
    # Cookiedauer in Sekunden? (Standard: 30)
    $comment_erassoft_cookiedauer =  30;

    # Cookie Name
    $comment_erassoft_cookie_name =  "comment";

    # Cookie setzen
    $inhalt="ok";
    setcookie($comment_erassoft_cookie_name, $inhalt, time()+$comment_erassoft_cookiedauer);
  }
}
?>