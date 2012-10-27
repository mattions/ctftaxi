<?php
include_once ("stile.php");

#Notifica di errore al webmaster.
$notifica="webmaster@ctftaxi.it";

#Nome del tuo dominio
$nomesito="ctftaxi.it";

#Link cliccabile per tornare alla home od ad una pagina a scelta.
$ritornahome="http://www.ctftaxi.it";

# Percorso file errori, permessi da settare a 777
$logerrori = "log/errore.txt";


# percorso immagini da mostrare a seconda degli errori (in questo caso sono tutte uguali)
$immagine = array (
         '000' => '/errore/errore.gif',
         '400' => '/errore/errore.gif',
         '401' => '/errore/errore.gif',
         '403' => '/errore/errore.gif',
         '404' => '/errore/errore.gif',
         '500' => '/errore/errore.gif'
         );


#Oggetto della mail di notifica: e' anche il titolo della pagina corrispondente.
$subject = array ( 
         '000' => 'ctftaxi.it - Errore sconosciuto',
         '400' => 'Errore 400',
         '401' => 'Non sei autorizzato',
         '403' => 'Errore 403',
         '404' => 'ctftaxi.it - Pagina in costruzione',
         '500' => 'Errore di configurazione'
         );

# N = nessun avviso  Y = avvisami in caso di errore.
$email = array (
        '000' => 'Y',
        '400' => 'Y',
        '401' => 'Y',
        '403' => 'Y',
        '404' => 'Y',
        '500' => 'Y'
        );

# N per non scrivere log Y per scrivere
$log = array (
        '000' => 'N',
        '400' => 'N',
        '401' => 'N',
        '403' => 'N',
        '404' => 'N',
        '500' => 'Y'
        );

###################################################################
#
# messaggi di errore.
#
#Pagina che appare con errore 400
$msg['400'] = "
<b>L'indrizzo che hai richiesto, $REDIRECT_URL
non e' un indirizzo valido.</b>";

################################################################## 
#HPagina che appare con errore 401
$msg['401'] = "
<b>L'indrizzo che hai richiesto, $REDIRECT_URL
necessita di autorizzazione.</b>";

################################################################## 
#Pagina che appare con errore 403
$msg['403'] = " 
<b>L'accesso all'indirizzo richiesto , $REDIRECT_URL,
e' proibito.</b>";

################################################################## 
#Pagina che appare con errore 404
$msg['404'] = "
<!DOCTYPE html PUBLIC \"-//W3C//DTD XHTML 1.0 Transitional//IT\"
    \"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd\">
<html xmlns=\"http://www.w3.org/1999/xhtml\">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8\" />
<meta http-equiv=\"content-type\" lang=\"italiano\" content=\"text/html; charset=utf-8\" />
</head>
<body lang=\"it\">
<b>L'indirizzo richiesto $REDIRECT_URL non e' disponibile sul server. Se non e' stato commesso un errore di digitazione, probabilmente 
<li> la pagina e' in costruzione</li>
<li> la pagina e' stata rimossa </li> 
<br /><br />
Abbiamo rilevato questo errore e risolveremo quanto prima il problema in caso si tratti di pagina non raggiungibile.</b>
</body>
</html>";


################################################################## 
#HTML Pagina che appare con errore
$msg['500'] = " 
<b>L'indirizzo richiesto, $REDIRECT_URL
restituisce errori di configurazione. 
<br /><br />
Abbiamo rilevato e registrato l'errore per potere risolvere quanto prima</b>";

################################################################## 
#Pagina che appare con errore sconosciuto
$msg['000'] = "
<b>L'indirizzo richiesto, $REDIRECT_URL
restituisce un errore sconosciuto.
<br /><br />
Abbiamo rilevato e registrato l'errore per potere risolvere quanto prima</b>";


$result = $QUERY_STRING;
if ($result != "400" && $result != "400" && $result != "403" && $result != "404" && $result != "500") $result="000";

print_header($result);
echo $msg[$result];
print_footer();

if ($log[$result] == "Y") notifica("L",$result);
if ($email[$result] == "Y") notifica("M",$result);

function notifica ($action, $result)
{
  global $logerrori, $subject, $notifica, $nomesito, $REQUEST_URI, $REMOTE_ADDR, $HTTP_USER_AGENT, $REDIRECT_ERROR_NOTES, $SERVER_NAME,$HTTP_REFERER;
  $date=date("D j M G:i:s T Y");
 
  if ($action == "L") { 
    $message = "[$date] [client: $REMOTE_ADDR ($HTTP_USER_AGENT)] $REDIRECT_ERROR_NOTES\n";
    $fp = fopen ($logerrori,"a+");
    fwrite($fp, $message);
    fclose($fp);
  } else {
    
        $message = " 
------------------------------------------------------------------------------
Sito:\t\t$nomesito ($SERVER_NAME)
Codice Errore:\t$result $subject[$result] ($REDIRECT_ERROR_NOTES)
Accaduto il:\t$date
URL in errore:\t$REQUEST_URI
Indirizzo IP del browser:\t$REMOTE_ADDR
Browser:\t$HTTP_USER_AGENT
Pagina di provenienza:\t$HTTP_REFERER
------------------------------------------------------------------------------";
    mail("$notifica", "[ Errore del server: $subject[$result] ]", $message,
      "From: gestione_errori@$SERVER_NAME\r\n"
      ."X-Mailer: PHP/" . phpversion());
  }
}

function print_header($result) 
{
  global $subject, $pagina_bg_colore, $tabella_bg_colore, $tabella_testo_colore, $cella_sinistra_colore, $immagine, $colore_titoletto, $nomesito, $REDIRECT_ERROR_NOTES;
    $error_notes = preg_replace("/:.*/","",$REDIRECT_ERROR_NOTES);
  if (empty($error_notes)) $error_notes = "Unknown";
  echo "
<html>
  <head>
    <title>$subject[$result]</title>
    <style>
 
.corpo {
	font-family: 'Courier New', Courier, mono;
	font-size: 12px;
	font-style: normal;
	font-weight: normal;
	color: #333333;
}

    a:link,a:active,a:active {
      font-weight: bold;
      text-decoration: none;
      color: blue;
    }
    a:hover {
      font-weight: bold;
      text-decoration: underline;
      color: blue;
    }
    </style>
  </head>
</html>
<body bgcolor=\"$pagina_bg_colore\" class=\"corpo\">
  <table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" height=\"100%\" width=\"100%\">
    <tr>
      <td valign=\"center\">
        <table width=\"550\" bgcolor=\"$tabella_bg_colore\" border=\"1\" align=\"center\" cellspacing=\"0\" cellpadding=\"5\" color=\"$tabella_testo_colore\">
          <tr>
            <td bgcolor=\"$cella_sinistra_colore\">
              <img src=\"$immagine[$result]\" alt=\"error\">
            </td>
            <td>
              <center>
                <span style=\"font-weight: 600; color: $colore_titoletto;\">$nomesito</span> <b>Errore $result</b>
                <br />
                ($error_notes)
              </center>
              <br />";
}

function print_footer()
{
  global $ritornahome;
  echo "
              <br />
              <br />
              <center> <a href=\"$ritornahome\">Clic</a> per tornare alla nostra HomePage</center>
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>";
}
?>
