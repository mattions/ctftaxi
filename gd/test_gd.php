<?php

function GDVersion(){
  if( !in_array('gd', get_loaded_extensions()) ) return 0;
  elseif( isGD2supported() ) return 2;
  else return 1;
}
function isGD2supported(){
  global $GD2;
  if( isset($GD2) AND $GD2 ) return $GD2;
  else{
    $php_ver_arr = explode('.', phpversion());
    $php_ver = intval($php_ver_arr[0])*100+intval($php_ver_arr[1]);

    if( $php_ver < 402 ){ // PHP <= 4.1.x
      $GD2 = in_array('imagegd2',get_extension_funcs("gd"));
    }
    elseif( $php_ver < 403 ){ // PHP = 4.2.x
      $im = @imagecreatetruecolor(10, 10);
      if( $im ){
        $GD2 = 1;
        @imagedestroy($im);
      }
      else $GD2 = 0;
    }
    else{ // PHP = 4.3.x
      $GD2 = function_exists('imagecreatetruecolor');
    }
  }

  return $GD2;
}
/*
echo 'Su questo sistema è presente la versione ' . GDVersion() . ' delle librerie GD.';
*/
function IsFormatSupported($format){
  if( ($format == 'gif') AND (imagetypes() & IMG_GIF) )return true;
  elseif( ($format == 'jpeg') AND (imagetypes() & IMG_JPG) )return true;
  elseif( ($format == 'png') AND (imagetypes() & IMG_PNG) )return true;
  else return false;
}

if( GDVersion() ){
  header("Content-type: image/png");

  if( GDVersion() == 1 ){
    $im = @imagecreate(300, 255) or die("Cannot Initialize new GD image stream");

    $black = imagecolorallocate($im, 0, 0, 0);
    $white = imagecolorallocate($im, 255, 255, 255);
    $red = imagecolorallocate($im, 255, 0, 0);
    $green = imagecolorallocate($im, 0, 255, 0);
    $blue = imagecolorallocate($im, 0, 0, 255);

    imagefilledrectangle($im, 0, 0, 51, 300, $white);
    imagefilledrectangle($im, 51, 0, 102, 300, $red);
    imagefilledrectangle($im, 102, 0, 153, 300, $green);
    imagefilledrectangle($im, 153, 0, 204, 300, $blue);
    imagefilledrectangle($im, 204, 0, 255, 300, $black);
  }
  else{
    $im = @imagecreatetruecolor(300, 255) or die("Cannot Initialize new GD image stream");

    for( $i = 0; $i < 256; $i++ ){
      $col = imagecolorallocate($im, 255, $i, $i);
      imagefilledrectangle($im, 0, $i, 100, $i+1, $col);
    }
    for( $i = 255; $i > -1; $i-- ){
      $col = imagecolorallocate($im, $i, 255, $i);
      imagefilledrectangle($im, 100, 255-$i, 200, 256-$i, $col);
    }
    for( $i = 0; $i < 256; $i++ ){
      $col = imagecolorallocate($im, $i, $i, 255);
      imagefilledrectangle($im, 200, $i, 300, $i+1, $col);
    }
  }

  $grey = imagecolorallocate($im, 100, 100, 100);
  imageString($im, 5, 120, 100, 'GD ' . GDVersion(), $grey);

  imagepng($im);
  imagedestroy($im);
}
else{
  echo 'Errore, libreria GD non disponibile su questo sistema!';
}
?>





<?php
{
IsFormatSupported(gif);
IsFormatSupported(jpeg);
IsFormatSupported(png);
}
?>

<?php
GDVersion();
?>


<?php
{
isGD2supported();
}
?>

<html>

<p>Test_1</p>
<p>Test_formato</p>
<p>Testo la libreria gd</p>

</body>
</html>