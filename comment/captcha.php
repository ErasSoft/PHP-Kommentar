<?php
#############################################################################################
# Copyright des PHP-Kommentar Scripts by ErasSoft.de (2012)                                 #
#############################################################################################

# Hier wird das Captcha Bild erzeugt



## CAPTCHA ##

# Session starten
session_start();

# Einstellungen auslesen
include("settings.php");

if(!isset($comment_erassoft_captcha_stufe)){
  $comment_erassoft_captcha_stufe=-1;
}

# Größe des Bildes
$captcha_size_x = 70;
$captcha_size_y = 20;

# Erzeuge eine Zufallszahl
$captcha_code = mt_rand(10000, 99999);
$comment_captcha_zeichen[0]=substr($captcha_code, 0, 1);
$comment_captcha_zeichen[1]=substr($captcha_code, 1, 1);
$comment_captcha_zeichen[2]=substr($captcha_code, 2, 1);
$comment_captcha_zeichen[3]=substr($captcha_code, 3, 1);
$comment_captcha_zeichen[4]=substr($captcha_code, 4, 1);



# Zufallszahl der Session-Variablen übergeben
$_SESSION["captcha_code"] = $captcha_code;

# Erstelle das Bild mit der angegebenen Größe!
$captcha_bild = imageCreate($captcha_size_x, $captcha_size_y);

# Erstelle einen weißen Hintergrund
imageColorAllocate($captcha_bild, 255, 255, 255);
imageFill($captcha_bild, 0, 0, 0);
if($comment_erassoft_captcha_stufe>3){
  $captcha_bild = imagecreatefrompng("fonts/hg.png");
}

# Verteile die Farben
#$captcha_rahmen = imageColorAllocate($captcha_bild, 0, 0, 0); // Rahmenfarbe
$captcha_farbe  = imageColorAllocate($captcha_bild, 0, 0, 0); // Textfarbe

# Zeichne den Rahmen
#imageRectangle($captcha_bild, 0, 0, $captcha_size_x-1, $captcha_size_y-1, $captcha_rahmen);

# Zeichne die Zufallszahl
if($comment_erassoft_captcha_stufe < 0){
  imageString($captcha_bild, 2, 2, 0, "ErasSoft.de", $captcha_farbe);
}
else{
  $captcha_grad = 0;
  $captcha_pos_x = 10; // links
  $captcha_pos_y = 15; // oben
  if($comment_erassoft_captcha_stufe>1){
    $captcha_pos_y = mt_rand(14, 16);
  }
  if($comment_erassoft_captcha_stufe>2){
    $captcha_grad = mt_rand(-20, 20);
  }
  for($captcha_i=0; $captcha_i<5; $captcha_i++)
  {
    imagettftext($captcha_bild, 12, $captcha_grad, $captcha_pos_x, $captcha_pos_y, $captcha_farbe, $comment_erassoft_font, "$comment_captcha_zeichen[$captcha_i]");

    if($comment_erassoft_captcha_stufe<=1){
      $captcha_pos_x = $captcha_pos_x + 10;
    }
    else{
      if($captcha_i==0 || $captcha_i==2 || $captcha_i==4){
        $captcha_pos_x = $captcha_pos_x + 12;
        $captcha_pos_y = $captcha_pos_y + mt_rand(1, 3);
      }
      else{
        $captcha_pos_x = $captcha_pos_x + 12;
        $captcha_pos_y = $captcha_pos_y - mt_rand(1, 3);
      }
      if($comment_erassoft_captcha_stufe>2){
        $captcha_grad = mt_rand(-20, 20);
      }
    }
  }
}

if($comment_erassoft_captcha_stufe>=5){
  imageline($captcha_bild,5,2,70,18,$captcha_farbe);
  imageline($captcha_bild,5,18,70,2,$captcha_farbe);
  imageline($captcha_bild,5,10,70,12,$captcha_farbe);
}

# Sende "browser header"
header("Content-Type: image/png");

# Sende das Bild zum Browser
echo imagePNG($captcha_bild);

# Lösche das Bild
imageDestroy($captcha_bild);
?>