<?php   ////////////////////////////////////////////////
        //   ___ _  _ ___     ___ _____ _ _____ ___   //
        //  | _ \ || | _ \___/ __|_   _/_\_   _/ __|  //
        //  |  _/ __ |  _/___\__ \ | |/ _ \| | \__ \  //
        //  |_| |_||_|_|0.1.9|___/ |_/_/ \_\_| |___/  //
        //                                            //
   /////////////////////////////////////////////////////////
   //       Author: Roberto Valsania (Webmaster76)        //
   //   Staff: Matrix, Viewsource, PaoDJ, Fabry, theCAS   //
   //          Homepage: www.php-stats.com,               //
   //                    www.php-stats.it,                //
   //                    www.php-stat.com                 //
   /////////////////////////////////////////////////////////
	  
  
// Letttura variabili esterne
if(!isset($_GET)) $_GET=$HTTP_GET_VARS;
$IP=trim(addslashes($_GET['IP']));
if(!ereg("^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$",$IP)) die("<b>ERRORE</b>: $IP non � un indirizzo IP valido!");

// Definizione variabili
define('IN_PHPSTATS',true);
$style=""; // In caso di register globals=on	

// inclusione delle principali funzioni esterne
if(!@include("config.php")) die("<b>ERRORE</b>: File config.php non accessibile.");
if(!@include("inc/main_func.inc.php")) die("<b>ERRORE</b>: File main_func.inc.php non accessibile.");

if($option['prefix']=="") $option['prefix']="php_stats";

// Compressione html se necessario
if($option['out_compress']==1) ob_start("ob_gzhandler");

// Connessione a MySQL e selezione database
db_connect();

// Lettura variabili di configurazione
$result=sql_query("SELECT name,value FROM $option[prefix]_config");
while($row=@mysql_fetch_array($result))
  $option[$row[0]]=$row[1];

if($option['template']=="") $option['template']="default";
if(!is_dir("templates/$option[template]")) $template_path="templates/default"; else $template_path="templates/$option[template]";

// Inlcusione file di linguaggio e template
include("lang/".$option['language']."/main_lang.inc");
include("$template_path/def.php");

$page ="<html>";
$page.="\n<head>";
$page.="\n<title>".str_replace("%IP%",$IP,$string['whois_title'])."</title>";
$page.="\n<link rel=\"stylesheet\" href=\"$template_path/styles.css\" type=\"text/css\">";
$page.="\n<META NAME=\"ROBOTS\" CONTENT=\"NONE\">";
$page.="\n</head>";
$page.="\n<body bgcolor=\"$style[bg_pops]\" onload=\"self.focus()\">";
$page.="\n<table $style[table_header] height=\"560\">";
$page.="<tr><td bgcolor=\"$style[table_bgcolor]\">".arin($IP)."</tr></td></table>";
$page.="\n</body>";
$page.="\n</html>";

// Restituisco la pagina
echo $page;

// Chiusura connessione a MySQL se necessario.
if($option['persistent_conn']!=1) mysql_close();

function arin($target){
global $string;
$server="whois.arin.net";
$nextServer="";
$msg="";
$buffer="";
$msg.="<span class=\"tabletextA\">".$string['whois_result']."<blockquote>";
if(!$target=gethostbyname($target))
  $msg.="<span class=\"tabletextA\">".$string['whois_err_1']."</span>";
  else
  {
  $msg.="<span class=\"tabletextA\">".str_replace("%SERVER%",$server,$string['whois_connecting'])."</span>";
  if(!@$sock=fsockopen($server, 43, $num, $error, 20))
    {
    unset($sock);
    $msg.="<span class=\"tabletextA\">".str_replace("%SERVER%",$server,$string['whois_err_2'])."<span>";
    }
    else
	{
	// Lettura whois
    fputs($sock,"$target\n");
	while(!feof($sock))
      $buffer.=fgets($sock, 10240);
	fclose($sock);
    }
	
  // Verifico se � necessaria una connessione ulteriore ad altri server quando whois.arin.net non � sufficiente	
  if(eregi("RIPE.NET",$buffer))
    $nextServer="whois.ripe.net";
  elseif(eregi("whois.apnic.net",$buffer))
    $nextServer="whois.apnic.net";
  elseif(eregi("nic.ad.jp",$buffer))
    {
    $nextServer="whois.nic.ad.jp";
    #/e specifica di non usare caratteri japponesi
    $extra="/e";
    }
  elseif(eregi("whois.registro.br",$buffer))
    $nextServer="whois.registro.br";

  // Se � necessaria una connessione ad altro server procedo con la connessione
  if($nextServer)
    {
    $buffer="";
    $msg.="<span class=\"tabletextA\">".str_replace("%SERVER%",$nextServer,$string['whois_deferring'])."</span>";
    if(!@$sock=fsockopen($nextServer,43,$num,$error,10)){
      unset($sock);
      $msg.="<span class=\"tabletextA\">".str_replace("%SERVER%",$nextServer,$string['whois_err_2'])."</span>";
      }
      else
	  {
      // Lettura whois 
      fputs($sock,"$target$extra\n");
	  while(!feof($sock))
        $buffer.=fgets($sock, 10240);
      fclose($sock);
      }
    }
  $buffer=str_replace(" ","&nbsp;",$buffer);
  $msg.="<span class=\"whois\">".nl2br($buffer)."</span>";
  }
$msg.="</blockquote>";
return($msg);
}
?>

