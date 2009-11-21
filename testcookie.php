<?php
setcookie ("test_cookie","niente di particolare",time()+43200,"/");
# cookie.php
echo "<HTML>";
echo "<BODY>";
if (isset($test_cookie)){
echo "Ciao cookie, i tuoi contenuti sono: $test_cookie";
} else {
echo "Non ho trovato alcun cookie con il nome test_cookie";
}
echo "</BODY>";
echo "</HTML>";
?>
