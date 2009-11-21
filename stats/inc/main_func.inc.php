<?php
// SECURITY ISSUES
if(!defined('IN_PHPSTATS')) die('Php-Stats internal file.');
define('__RANGE_MACRO__','-Spider,Grabber-');

// CONNESSIONE DATABASE
function db_connect() {
  global $option;
  $error['no_connection']='<b>ERRORE</b>: Non riesco a connttermi a MySQL! Controllare config.php .';
  $error['no_database']='<b>ERRORE</b>: Il database indicato nel config.php non esiste! Il database va creato prima di effettuare l\'installazione.';
  if($option['persistent_conn']==1)
    {
    $db=@mysql_pconnect($option['host'],$option['user_db'],$option['pass_db']);
        if($db==false) { logerrors("DB-PCONN\t".time()."\tFAILED"); die($error['no_connection']); }
    }
        else
    {
        $db=@mysql_connect($option['host'],$option['user_db'],$option['pass_db']);
        if($db==false) { logerrors("DB-CONN"."|".date("d/m/Y H:i:s")."|FAILED"); die($error['no_connection']); }
        }
  $db_sel=@mysql_select_db($option[database]);
  if($db_sel==false) { logerrors("DB-SELECT"."|".date("d/m/Y H:i:s")."|FAILED"); die($error['no_database']); }
  }

// ESECUZIONE QUERY //
function sql_query($query) {
  global $option,$db,$return,$error;
  $return=@mysql_query($query);
  if($return==false)
    {
        $error['debug_level']=1;
        $error['debug_level_error']="<b>QUERY:</b><br>$query<br><br><b>MySql ERROR:</b><br>".mysql_errno().": ".mysql_error();
        logerrors("QUERY|".date("d/m/Y H:i:s")."|".$query."|".mysql_error());
        }
  return($return);
  }

// Ricerca in stringa con wildchars //
function search($string,$mask){
        static $in=array('.', '^', '$', '{', '}', '(', ')', '[', ']', '+', '*', '?');
        static $out=array('\\.', '\\^', '\\$', '\\{', '\\}', '\\(', '\\)', '\\[', '\\]', '\\+', '.*', '.');
        $mask='^'.str_replace($in,$out,$mask).'$';
        return(ereg($mask,$string));
}

// FUNZIONE CHE GENERA UN ID CASUALE //
function get_random($size=8) {
        $id="";
        srand((double)microtime()*1000000);
        $a="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"; // Set caratteri
        for($i=0; $i<$size; ++$i) $id.=substr($a,(rand()%(strlen($a))),1);
        return($id);
}

// Cronometro per tempo creazione pagine //
function get_time() {
        $mtime=microtime();
        $mtime=explode(" ",$mtime);
        $mtime=$mtime[1]+$mtime[0];
        return($mtime);
}

function filter_func($var)
{
 $var=strtolower($var);
 if (strpos($var,$GLOBALS['filter_val'])===FALSE) return ($var);
}

// Filtratura variabili
function filter_urlvar($url,$var) {
   $queryPos=strpos($url,'?');
   if($queryPos===FALSE) return ($url);
   $GLOBALS['filter_val']=$var.'=';
   $url=str_replace('&amp;','&',$url);
   $queryArgs=explode('&',substr($url,$queryPos+1));
   $query_array=array_filter($queryArgs, 'filter_func');
   unSet($GLOBALS['filter_val']);
   if(count($query_array)===0) return substr($url,0,$queryPos);
   return (substr($url,0,$queryPos+1).implode('&',$query_array));
}

function getbrowser($arg){
    if(defined('__PHP_STATS_PATH__')) @include(__PHP_STATS_PATH__.'def/bw.dat'); else @include('def/bw.dat');
    $GLOBALS['cat_macro']='?';
    for($i=0,$tot=count($bw_def);$i<$tot;++$i)
        {
        list($nome_bw,$id_bw,$pre_ver,$macro)=$bw_def[$i];
        if(strpos($arg,$id_bw)===FALSE) continue; //non � stato trovato la stringa del nome del browser
        $GLOBALS['cat_macro']=$macro;
        if($pre_ver===null) return $nome_bw; //per quelli che non scrivono la versione nello user agent (spider e grabbers)
        $tmp=strpos($arg,$pre_ver);
        if($tmp===FALSE) continue; //non � stata trovata la stringa che precede la versione
        $startpos=$tmp+strlen($pre_ver);
        $res=preg_match('/[0-9\.]+/', substr($arg,$startpos), $matches);
        if($res<1) continue; // non � stato trovato il numero di versione
        $version=$matches[0];
        return $nome_bw.' '.$version; //indentificazione avvenuta
        }
        logerrors("Unknown BW|".date("d/m/Y H:i:s")."|$arg");
        return '?';
}

function getos($arg){
  if(defined('__PHP_STATS_PATH__')) @include(__PHP_STATS_PATH__.'def/os.dat'); else @include('def/os.dat');
  for($i=0,$tot=count($os_def);$i<$tot;++$i)
    {
    list($nome_os,$id_os)=$os_def[$i];
    if(strpos($arg,$id_os)===FALSE) continue;//non � stata trovata la stringa del sistema operativo
    return $nome_os; //identificazione avvenuta
    }
  logerrors("Unknown OS|".date("d/m/Y H:i:s")."|$arg");
  return '?';
}

// Restituisco nome del motore e query dall'url passato //
// Revisione in Php-Stats 0.1.9 BY theCAS
function getengine($reffer){
   $standardse=TRUE;
   if(strpos($reffer,'?')===FALSE){
      if(substr_count($reffer,'/')>5) $standardse=FALSE; //riconoscimento motori con url rewriting
      else return FALSE; //se non c'� querystring e non � url rewriting non � un motore;
   }
   @include($standardse ? 'def/search_engines.dat' : 'def/search_engines_ur.dat');
   $reffer=str_replace('&amp;','���',$reffer); // Il carattere &amp; pu� dare problemi => rimpiazzo con ���
   $reffer=unhtmlentities($reffer); // DECODIFICO CARATTERI SPECIALI
   $URLdata=parse_url($reffer); // estraggo le informazioni dall'url
   $URLdata['host']=strtolower($URLdata['host']); // Metto l'host in caratteri minuscoli
   $URLdata['path']=strtolower($URLdata['path']); // Metto il path in caratteri minuscoli

   //se non contiene querystring bypass

   $nome=''; //Default
   $query=''; //Default
   $domain='unknown'; //Default
   $resultPage=0; //Default

   for($i=0,$tot=count($search_engines_def);$i<$tot;++$i){
      list($name,$searchstring,$forcedDomain,$queryKW,$pageKW,$recordPerPage)=$search_engines_def[$i];

      //decido a seconda del $searchstring su cosa effettuare la ricerca
      $whatToSearch=(strpos($searchstring,'/')===FALSE ? $URLdata['host'] : $URLdata['host'].$URLdata['path']);

      if(strpos($searchstring,'*')===FALSE){//controllo se il domain � incluso o se c'� un carattere jolly
         if(strpos($whatToSearch,$searchstring)===FALSE) continue; //cerco la stringa per identificare il motore di ricerca
         $tmpdomain=$forcedDomain; //il dominio � quello forzato
         $includedDomain=TRUE;
      }
      else{
         $pattern='/'.str_replace(Array('/','.','*'),Array('\\/','\\.','(.+)'),$searchstring).'/';
         if(preg_match($pattern,$whatToSearch,$tmpdomain)===FALSE) continue; //cerco la stringa per identificare il motore di ricerca e trovo il dominio
         if($tmpdomain[0]=='') continue;
         $tmpdomain=$tmpdomain[1];
         $includedDomain=FALSE;
      }

      if($standardse) parse_str($URLdata['query'],$queryArgs); //metto le variabili della query in un array associativo
      else $queryArgs=explode('/',substr($URLdata['path'],1)); //divido le variabili e le inserisco in un array

      if(isSet($queryArgs[$queryKW])) $tmpquery=urldecode($queryArgs[$queryKW]);
      else continue; //il punto di query non � stato trovato

      if(strpos($tmpquery,'cache:')!==FALSE) continue; //non considero la cache di google

      //a questo punto il record � quello giusto

      if($pageKW!==null){//riconoscimento della pagina
         if(!isSet($queryArgs[$pageKW])) $resultPage=1; //il punto di query non � stato trovato, quindi � la prima pagina
         else{
            $recordNumber=$queryArgs[$pageKW]-0; //registro il numero di record
            if($recordPerPage===null) $recordPerPage=10; //il default di record per pagina � 10

            $resultPage=intval($recordNumber/$recordPerPage)+1;
         }
      }

      $query=str_replace('+',' ',$tmpquery); //tolgo i + dalle keywords

      if(strpos($tmpdomain,'.')!==FALSE){//� un dominio multiplo Es. google.com.ar
         $tmp=explode('.',$tmpdomain);
         for($i=count($tmp);$i>=0;$i--){//in ordine inverso perch� i domini significativi sono sempre alla fine
            if(!$tmp[$i]) continue; //esistono domini come 'google.com.'

            $tmpdomain=$tmp[$i];
            break;
         }
      }

      if(strpos($tmpdomain,'-')!==FALSE){//per i domini con il tratto, es. ch-fr.altavista.com
         $tmp=explode('-',$tmpdomain);
         $tmpdomain=$tmp[0];
      }

      if($forcedDomain && ($tmpdomain=='com' || $tmpdomain=='net' || $tmpdomain=='org')) $domain=$forcedDomain;//se � presente il dominio forzato lo uso al posto di com,org,net
      else $domain=$tmpdomain;

      $nome=$name; //imposto il nome
      return Array($nome,$domain,$query,$resultPage);
   }
   return FALSE;
}

// Traduzione caratteri speciali
function unhtmlentities($string) {
   $trans_tbl=get_html_translation_table(HTML_ENTITIES);
   $trans_tbl=array_flip($trans_tbl);
   return strtr($string,$trans_tbl);
}

// PRUNING DELLE TABELLE
function prune($table,$offset,$limit=2) {
$righe=@mysql_result(sql_query("SELECT COUNT(1) AS num FROM $table"), 0, "num");
$to_del=$righe-$offset;
if($to_del>0)
  {
  if($limit!=0) $to_del=min($limit,$to_del); // SE 0 -> NO LIMIT!
  $to_prune=sql_query("SELECT date FROM $table ORDER BY date ASC LIMIT $to_del");
  while($row=@mysql_fetch_array($to_prune))
    sql_query("DELETE FROM $table WHERE date='$row[0]' LIMIT 1");
  }
}

/* PRUNING TABELLE OTTIMIZZATA PER MySQL 4
function prune($table,$offset,$limit=2) {
$result=sql_query("SELECT date FROM $table ORDER BY date DESC LIMIT $offset,$limit");
if(mysql_num_rows($result)>0)
while($row=@mysql_fetch_array($result))
  {
  //echo"$row[0]";
  sql_query("DELETE FROM $table WHERE date='$row[0]' LIMIT 1");
  }
} */

// Pruning specifico per i dettagli
function prune_details($table,$offset) {
$righe=mysql_result(sql_query("SELECT COUNT(1) AS num FROM $table"),0,"num");
if($righe-$offset>0)
  {
  list($id)=@mysql_fetch_row(sql_query("SELECT visitor_id FROM $table ORDER BY date ASC LIMIT 1"));
  sql_query("DELETE FROM $table WHERE visitor_id='$id'");
  }
}

function is_internal($ref) {
   global $option,$NowritableServer,$countServerUrl,$serverUrl;
   if ($NowritableServer===1)
      {
      $to_esclude=explode("\n",$option['server_url']);
      $countServerUrl=count($to_esclude);
      }
      else $to_esclude=$serverUrl;
   for($i=0;$i<$countServerUrl;++$i)
      {
      $tmp=trim($to_esclude[$i]);
      if($tmp==='') continue; //la riga � vuota
      if(strpos($ref,$tmp)!==0) continue; //non trovato
      return TRUE; //trovato
      }
   return FALSE;
}

// FUNZIONE PER LOGGARE ERRORI
function logerrors($string) {
global $option;
if($option['logerrors'])
  {
  // Tento di impostare i permessi di scrittura
  if(!@is_writable("php-stats.log")) @chmod("php-stats.log",0666);
  if(@is_writable("php-stats.log"))
    {
    $fp=fopen("php-stats.log","a");
    fputs($fp,$string."\n");
    }
  }
}

// ip-to-country database functions & Isp Recognize
// ispirato all'implementazione di php.net
// Powered By theCAS

function decodeInt($binary){
        $tmp=@unpack('Snum',$binary);
        return $tmp['num'];
}

function getDBPos($ip,$idxfile){
        $ipidx=fopen($idxfile,'r')
        or die('ERRORE: Impossibile aprire '.$idxfile.' in lettura.');
        $tosearch=intval($ip/100000)*3;
    if($tosearch>filesize($idxfile)) return -1;
        fseek($ipidx,$tosearch);
        $pos=decodeInt(fread($ipidx,2))-1;
        fclose($ipidx);
        return $pos;
}

function checkDBLine($fd,$ip,$char_line,$limit_char){
        $res=fread($fd,$char_line);
        $start=substr($res,0,10)-0;
        $end=substr($res,10,10)-0;
        if($ip<$start) return 'unknown'; //l'ip non � nel db
        else if($ip>=$start && $ip<=$end) { if($limit_char=='') return substr($res,20,$limit_char); else return substr($res,20,$limit_char); } //trovato, restituire id
        else return 0; //non trovato, continua
}

function getIP($ip,$char_line,$dbfile,$idxfile,$limit_char){
        $pos=getDBPos($ip,$idxfile);
        if($pos==-1) return 'unknown';
        $ipdb=fopen($dbfile,'r')
        or die('ERRORE: Impossibile aprire '.$dbfile.' in lettura.');
        fseek($ipdb,$pos*$char_line);
        while(!feof($ipdb)){
                $linedata=checkDBLine($ipdb,$ip,$char_line,$limit_char);
                if($linedata!==0) break;
        }
        fclose($ipdb);
        return $linedata;
}

// FUNCTION CLEAR CACHE
function do_clear($user_id_tmp='',$force_del_ip=0){
global $option,$date,$append,$modulo,$secondi,$mese_oggi,$data_oggi;
// Se specifico l'user_id e force_del_ip=0 � perch� ho un accesso a cavallo dei 2 giorni e ha priorit�
// Se force_del_ip=1 vuol dire che quell'ip � scaduto e voglio essere sicuro che sia cancellato dalla cache
$clause=($user_id_tmp=='' ? "WHERE data<'$secondi'" : "WHERE visitor_id='$user_id_tmp'");
$result=sql_query("SELECT user_id,lastpage,visitor_id,hits,visits,reso,colo,os,bw,host,lang,giorno FROM $option[prefix]_cache $clause LIMIT 1");
if(@mysql_affected_rows()<1) return 1;

list($Cuser_id,$Clastpage,$Cvisitor_id,$Chits,$Cvisits,$Creso,$Ccolo,$Cos,$Cbw,$Chost,$Clang,$Cgiorno)=@mysql_fetch_row($result);

$spider_agent=(strpos(__RANGE_MACRO__,$Cos)==true);

if(($user_id_tmp=='') || ($force_del_ip==1))
  {
  // CANCELLO IL DATO IN CACHE "SCADUTO"
  sql_query("DELETE FROM $option[prefix]_cache WHERE visitor_id='$Cvisitor_id'");
  // SCRIVO LA PAGINA DI USCITA DAL SITO
  if(($spider_agent===false) && $modulo[3]) sql_query("UPDATE $option[prefix]_pages SET outs=outs+1 WHERE data='$Clastpage' $append");
  }
// DEPURO DEI DATI IMMESSI NEL DATABASE PRINCIPALE
else sql_query("UPDATE $option[prefix]_cache SET hits='0',visits='0',giorno='$data_oggi' WHERE visitor_id='$Cvisitor_id' $append");

// Inizio l'elaborazione
if(($Chits==0) && ($Cvisits==0)) return 1; //nessuna visita o hit

// SISTEMI (OS,BW,RESO,COLORS)
if($modulo[1])
  {
  $clause="os='$Cos' AND bw='$Cbw' AND reso='$Creso' AND colo='$Ccolo'".(($modulo[1]==2) ? " AND mese='$mese_oggi'" : '');
  sql_query("UPDATE $option[prefix]_systems SET visits=visits+$Cvisits,hits=hits+$Chits WHERE $clause $append");
  if(@mysql_affected_rows()<1)
    {
    $insert="VALUES('$Cos','$Cbw','$Creso','$Ccolo','$Chits','$Cvisits','".(($modulo[1]==2) ? $mese_oggi : '')."')";
    sql_query("INSERT INTO $option[prefix]_systems $insert");
    }
  }

// LINGUE (impostate dal browser)
if($spider_agent===false && $modulo[2])
  {
  sql_query("UPDATE $option[prefix]_langs SET hits=hits+$Chits,visits=visits+$Cvisits WHERE lang='$Clang' $append");
  if(@mysql_affected_rows()<1) sql_query("UPDATE $option[prefix]_langs SET hits=hits+$Chits,visits=visits+$Cvisits WHERE lang='unknown' $append");
  }

// ACCESSI GIORNALIERI
if($modulo[6])
  {
  sql_query("UPDATE $option[prefix]_daily SET hits=hits+$Chits,visits=visits+$Cvisits".(($modulo[11] && $spider_agent) ? ",no_count_hits=no_count_hits+$Chits,no_count_visits=no_count_visits+$Cvisits" : '')." WHERE data='$Cgiorno' ".$append);
  if(@mysql_affected_rows()<1) sql_query("INSERT INTO $option[prefix]_daily VALUES('$Cgiorno','$Chits','$Cvisits'".(($modulo[11] && $spider_agent) ? ",'$Chits','$Cvisits'" : ",'0','0'").")");
  }

// INIZIALIZZO L'IP UNA SOLA VOLTA PER TUTTE
$ip_number=sprintf('%u',ip2long($Cuser_id));

// COUNTRY
  if(($spider_agent===false) && $modulo[7])
    {
    if(
      ($ip_number>=3232235520 && $ip_number<=3232301055) || //192.168.0.0 ... 192.168.255.255
      ($ip_number>=167772160 && $ip_number<=184549375) || //10.0.0.0 ... 10.255.255.255
      ($ip_number>=2886729728 && $ip_number<=2887778303) || //172.16.0.0 ... 172.31.255.255
      ($ip_number>=0 && $ip_number<=16777215) || //0.0.0.0 ... 0.255.255.255
      ($ip_number>=4026531840 && $ip_number<=4294967295) //240.0.0.0 ... 255.255.255.255
      ) $domain='lan';
    else switch($option['ip-zone'])
      {
      case 0: //tramite host
        $domain='';
        $tmp=explode('.',$Chost);
        for($i=count($tmp)-1;$i>=0;--$i)
          {
          if(@!$tmp[$i]) continue; //esistono domini come 'google.com.'
          $domain=$tmp[$i];
          break;
          }
      break;
      case 1: //tramite ip2c MySQL
        $result2=sql_query("SELECT tld FROM $option[prefix]_ip_zone WHERE $ip_number BETWEEN ip_from AND ip_to");
        if(@mysql_affected_rows()>0) list($domain)=@mysql_fetch_row($result2);
        else $domain='unknown';
      break;
      case 2: //tramite ip2c file
        $domain=getIP($ip_number,23,'ip-to-country.db','ip-to-country.idx',2);
      break;
      }
    sql_query("UPDATE $option[prefix]_domains SET visits=visits+$Cvisits,hits=hits+$Chits WHERE tld='$domain' $append");
    if(@mysql_affected_rows()<1) sql_query("UPDATE $option[prefix]_domains SET visits=visits+$Cvisits,hits=hits+$Chits WHERE tld='unknown' $append");
    }

// INDIRIZZI IP
if($modulo[10])
  {
  sql_query("UPDATE $option[prefix]_ip SET visits=visits+$Cvisits,hits=hits+$Chits,date='$date' WHERE ip='$ip_number' $append");
  if(@mysql_affected_rows()<1) sql_query("INSERT INTO $option[prefix]_ip VALUES('$ip_number','$date','$Chits','$Cvisits')");
  if($option['prune_2_on']) prune("$option[prefix]_ip",$option['prune_2_value']);
  }

// Fine trasferimento
return 1;
}
?>