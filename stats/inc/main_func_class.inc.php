<?php
// SECURITY ISSUES
if(!defined('IN_PHPSTATS')) die('Php-Stats internal file.');
define('__RANGE_MACRO__','-Spider,Grabber-');

class php_stats_recFunction {

var $option,$db,$return,$error,$NowritableServer,$countServerUrl,$serverUrl,$date,$append,$modulo,$secondi,$mese_oggi,$data_oggi,$varie,$cat_macro;

// const rangeMacro = '-Spider,Grabber-';  PHP5 richiamo tramite php_stats_recFunction::rangeMacro

//Inizializzazione variabili
function php_stats_setvariables($option,$NowritableServer) {
    $this->option = $option;
    $this->NowritableServer = $NowritableServer;
}

function php_stats_setvariables2($countServerUrl,$serverUrl,$date,$append,$modulo,$secondi,$mese_oggi,$data_oggi) {
    $this->countServerUrl = $countServerUrl;
    $this->serverUrl = $serverUrl;
    $this->date = $date;
    $this->append = $append;
    $this->modulo = $modulo;
    $this->secondi = $secondi;
    $this->mese_oggi = $mese_oggi;
    $this->data_oggi = $data_oggi;
}

// CONNESSIONE DATABASE
function php_stats_db_connect() {
  $this->error['no_connection']='<b>ERRORE</b>: Non riesco a connttermi a MySQL! Controllare config.php .';
  $this->error['no_database']='<b>ERRORE</b>: Il database indicato nel config.php non esiste! Il database va creato prima di effettuare l\'installazione.';
  if($this->option['persistent_conn']==1)
    {
    $this->php_stats_db=@mysql_pconnect($this->option['host'],$this->option['user_db'],$this->option['pass_db']);
    if($this->php_stats_db==false) { $this->php_stats_logerrors("DB-PCONN\t".time()."\tFAILED"); die($this->error['no_connection']); }
    }
  else
    {
    $this->php_stats_db=@mysql_connect($this->option['host'],$this->option['user_db'],$this->option['pass_db']);
    if($this->php_stats_db==false) { $this->php_stats_logerrors("DB-CONN"."|".date("d/m/Y H:i:s")."|FAILED"); die($this->error['no_connection']); }
    register_shutdown_function(array(&$this, 'php_stats_mysql_close'));
    }
  if($this->option['compatibility_mode']==0){
    $this->php_stats_db_sel=@mysql_select_db($this->option[database]);
    if($this->php_stats_db_sel==false) { $this->php_stats_logerrors("DB-SELECT"."|".date("d/m/Y H:i:s")."|FAILED"); die($this->error['no_database']); }
    }
  }

// ESECUZIONE QUERY //
function php_stats_sql_query($query) {
  $this->return=@mysql_query($query);
  if($this->return==false)
    {
    $this->error['debug_level']=1;
        $this->error['debug_level_error']="<b>QUERY:</b><br>$query<br><br><b>MySql ERROR:</b><br>".mysql_errno().": ".mysql_error();
        $this->php_stats_logerrors("QUERY|".date("d/m/Y H:i:s")."|".$query."|".mysql_error());
        }
  return($this->return);
  }

//Chiude la connessione
function php_stats_mysql_close() {
  @mysql_close($this->php_stats_db);
}

// FUNZIONE PER LOGGARE ERRORI
function php_stats_logerrors($string) {
if($this->option['logerrors'])
  {
  // Tento di impostare i permessi di scrittura
  if(!@is_writable(__PHP_STATS_PATH__."php-stats.log")) @chmod(__PHP_STATS_PATH__."php-stats.log",0666);
  if(@is_writable(__PHP_STATS_PATH__."php-stats.log"))
    {
    $fp=fopen(__PHP_STATS_PATH__."php-stats.log","a");
    fputs($fp,$string."\n");
    }
  }
}

// Traduzione caratteri speciali
function php_stats_unhtmlentities($string) {
   $trans_tbl=get_html_translation_table(HTML_ENTITIES);
   $trans_tbl=array_flip($trans_tbl);
   return strtr($string,$trans_tbl);
}

function php_stats_getbrowser($arg){
    if(defined('__PHP_STATS_PATH__')) @include(__PHP_STATS_PATH__.'def/bw.dat'); else @include('def/bw.dat');
    $this->cat_macro='?';
    for($i=0,$tot=count($bw_def);$i<$tot;++$i)
        {
        list($nome_bw,$id_bw,$pre_ver,$macro)=$bw_def[$i];
        if(strpos($arg,$id_bw)===FALSE) continue; //non � stato trovato la stringa del nome del browser
        $this->cat_macro=trim($macro);
        if($pre_ver===null) return $nome_bw; //per quelli che non scrivono la versione nello user agent (spider e grabbers)
        $tmp=strpos($arg,$pre_ver);
        if($tmp===FALSE) continue; //non � stata trovata la stringa che precede la versione
        $startpos=$tmp+strlen($pre_ver);
                $res=preg_match('/[0-9\.]+/', substr($arg,$startpos), $matches);
        if($res<1) continue; // non � stato trovato il numero di versione
        $version=$matches[0];
        return $nome_bw.' '.$version; //indentificazione avvenuta
        }
        $this->php_stats_logerrors("Unknown BW|".date("d/m/Y H:i:s")."|$arg");
        return '?';
}

function php_stats_getos($arg){
  if(defined('__PHP_STATS_PATH__')) @include(__PHP_STATS_PATH__.'def/os.dat'); else @include('def/os.dat');
  for($i=0,$tot=count($os_def);$i<$tot;++$i)
    {
    list($nome_os,$id_os)=$os_def[$i];
    if(strpos($arg,$id_os)===FALSE) continue;//non � stata trovata la stringa del sistema operativo
    return $nome_os; //identificazione avvenuta
    }
  $this->php_stats_logerrors("Unknown OS|".date("d/m/Y H:i:s")."|$arg");
  return '?';
}

// Restituisco nome del motore e query dall'url passato //
// Revisione in Php-Stats 0.1.9 BY theCAS
function php_stats_getengine($reffer){
   $standardse=TRUE;
   if(strpos($reffer,'?')===FALSE){
      if(substr_count($reffer,'/')>5) $standardse=FALSE; //riconoscimento motori con url rewriting
      else return FALSE; //se non c'� querystring e non � url rewriting non � un motore;
   }
   $append_path=(defined('__PHP_STATS_PATH__') ? __PHP_STATS_PATH__ : '');
   @include($standardse ? $append_path.'def/search_engines.dat' : $append_path.'def/search_engines_ur.dat');
   $reffer=str_replace('&amp;','���',$reffer); // Il carattere &amp; pu� dare problemi => rimpiazzo con ���
   $reffer=$this->php_stats_unhtmlentities($reffer); // DECODIFICO CARATTERI SPECIALI
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

      if(isSet($queryArgs[$queryKW]))   $tmpquery=urldecode($queryArgs[$queryKW]);
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

// PRUNING DELLE TABELLE
function php_stats_prune($table,$offset,$limit=2) {
$righe=@mysql_result($this->php_stats_sql_query("SELECT COUNT(1) AS num FROM $table"), 0, "num");
$to_del=$righe-$offset;
if($to_del>0)
  {
  if($limit!=0) $to_del=min($limit,$to_del); // SE 0 -> NO LIMIT!
  $to_prune=$this->php_stats_sql_query("SELECT date FROM $table ORDER BY date ASC LIMIT $to_del");
  while($row=@mysql_fetch_array($to_prune))
    $this->php_stats_sql_query("DELETE FROM $table WHERE date='$row[0]' LIMIT 1");
  }
}

/* PRUNING TABELLE OTTIMIZZATA PER MySQL 4
function $this->php_stats_prune($table,$offset,$limit=2) {
$result=$this->php_stats_sql_query("SELECT date FROM $table ORDER BY date DESC LIMIT $offset,$limit");
if(mysql_num_rows($result)>0)
while($row=@mysql_fetch_array($result))
  {
  //echo"$row[0]";
  $this->php_stats_sql_query("DELETE FROM $table WHERE date='$row[0]' LIMIT 1");
  }
} */

// Pruning specifico per i dettagli
function php_stats_prune_details($table,$offset) {
$righe=mysql_result($this->php_stats_sql_query("SELECT COUNT(1) AS num FROM $table"),0,"num");
if($righe-$offset>0)
  {
  list($id)=@mysql_fetch_row($this->php_stats_sql_query("SELECT visitor_id FROM $table ORDER BY date ASC LIMIT 1"));
  $this->php_stats_sql_query("DELETE FROM $table WHERE visitor_id='$id'");
  }
}

function php_stats_is_internal($ref) {
   if ($this->NowritableServer==1)
      {
      $to_esclude=explode("\n",$this->option[server_url]);
      $this->countServerUrl=count($to_esclude);
      }
      else $to_esclude=$this->serverUrl;
   for($i=0;$i<$this->countServerUrl;++$i)
      {
      $tmp=trim($to_esclude[$i]);
      if($tmp==='') continue; //la riga � vuota
      if(strpos($ref,$tmp)!==0) continue; //non trovato
      return TRUE; //trovato
      }
   return FALSE;
}

// ip-to-country database functions & Isp Recognize
// ispirato all'implementazione di php.net
// Powered By theCAS

function php_stats_decodeInt($binary){
        $tmp=@unpack('Snum',$binary);
        return $tmp['num'];
}

function php_stats_getDBPos($ip,$idxfile,$limit_char){
        $ipidx=fopen($idxfile,'r')
        or die('ERRORE: Impossibile aprire '.$idxfile.' in lettura.');
        $tosearch=intval($ip/100000)*3;
    if($tosearch>filesize($idxfile)) return -1;
        fseek($ipidx,$tosearch);
        $pos=$this->php_stats_decodeInt(fread($ipidx,2))-1;
        fclose($ipidx);
        return $pos;
}

function php_stats_checkDBLine($fd,$ip,$char_line,$limit_char){
        $res=fread($fd,$char_line);
        $start=substr($res,0,10)-0;
        $end=substr($res,10,10)-0;
        if($ip<$start) return 'unknown'; //l'ip non � nel db
        else if($ip>=$start && $ip<=$end) { if($limit_char=='') return substr($res,20,$limit_char); else return substr($res,20,$limit_char); } //trovato, restituire id
        else return 0; //non trovato, continua
}

function php_stats_getIP($ip,$char_line,$dbfile,$idxfile,$limit_char){
        $pos=$this->php_stats_getDBPos($ip,$idxfile,$limit_char);
        if($pos==-1) return 'unknown';
        $ipdb=fopen($dbfile,'r')
        or die('ERRORE: Impossibile aprire '.$dbfile.' in lettura.');
        fseek($ipdb,$pos*$char_line);
        while(!feof($ipdb)){
                $linedata=$this->php_stats_checkDBLine($ipdb,$ip,$char_line,$limit_char);
                if($linedata!==0) break;
        }
        fclose($ipdb);
        return $linedata;
}

// FUNCTION CLEAR CACHE
function php_stats_do_clear($user_id_tmp='',$force_del_ip=0){
// Se specifico l'user_id e force_del_ip=0 � perch� ho un accesso a cavallo dei 2 giorni e ha priorit�
// Se force_del_ip=1 vuol dire che quell'ip � scaduto e voglio essere sicuro che sia cancellato dalla cache
$clause=($user_id_tmp=='' ? "WHERE data<'".$this->secondi."'" : "WHERE visitor_id='$user_id_tmp'");
$result=$this->php_stats_sql_query("SELECT user_id,lastpage,visitor_id,hits,visits,reso,colo,os,bw,host,lang,giorno FROM ".$this->option[prefix]."_cache $clause LIMIT 1");
if(@mysql_affected_rows()<1) return 1;

list($Cuser_id,$Clastpage,$Cvisitor_id,$Chits,$Cvisits,$Creso,$Ccolo,$Cos,$Cbw,$Chost,$Clang,$Cgiorno)=@mysql_fetch_row($result);

$spider_agent=(strpos(__RANGE_MACRO__,$Cos)==true);

if(($user_id_tmp=='') || ($force_del_ip==1))
  {
  // CANCELLO IL DATO IN CACHE "SCADUTO"
  $this->php_stats_sql_query("DELETE FROM ".$this->option[prefix]."_cache WHERE visitor_id='$Cvisitor_id'");
  // SCRIVO LA PAGINA DI USCITA DAL SITO
  if(($spider_agent===false) && $this->modulo[3]) $this->php_stats_sql_query("UPDATE ".$this->option[prefix]."_pages SET outs=outs+1 WHERE data='$Clastpage' $this->append");
  }
// DEPURO DEI DATI IMMESSI NEL DATABASE PRINCIPALE
else $this->php_stats_sql_query("UPDATE ".$this->option[prefix]."_cache SET hits='0',visits='0',giorno='$this->data_oggi' WHERE visitor_id='$Cvisitor_id' $this->append");

// Inizio l'elaborazione
if(($Chits==0) && ($Cvisits==0)) return 1; //nessuna visita o hit

// SISTEMI (OS,BW,RESO,COLORS)
if($this->modulo[1])
  {
  $clause="os='$Cos' AND bw='$Cbw' AND reso='$Creso' AND colo='$Ccolo'".(($this->modulo[1]==2) ? " AND mese='$this->mese_oggi'" : '');
  $this->php_stats_sql_query("UPDATE ".$this->option[prefix]."_systems SET visits=visits+$Cvisits,hits=hits+$Chits WHERE $clause $this->append");
  if(@mysql_affected_rows()<1)
    {
    $insert="VALUES('$Cos','$Cbw','$Creso','$Ccolo','$Chits','$Cvisits','".(($this->modulo[1]==2) ? $this->mese_oggi : '')."')";
    $this->php_stats_sql_query("INSERT INTO ".$this->option[prefix]."_systems $insert");
    }
  }

// LINGUE (impostate dal browser)
if($spider_agent===false && $this->modulo[2])
  {
  $this->php_stats_sql_query("UPDATE ".$this->option[prefix]."_langs SET hits=hits+$Chits,visits=visits+$Cvisits WHERE lang='$Clang' $this->append");
  if(@mysql_affected_rows()<1) $this->php_stats_sql_query("UPDATE ".$this->option[prefix]."_langs SET hits=hits+$Chits,visits=visits+$Cvisits WHERE lang='unknown' $this->append");
  }

// ACCESSI GIORNALIERI
if($this->modulo[6])
  {
  $this->php_stats_sql_query("UPDATE ".$this->option[prefix]."_daily SET hits=hits+$Chits,visits=visits+$Cvisits".(($this->modulo[11] && $spider_agent) ? ",no_count_hits=no_count_hits+$Chits,no_count_visits=no_count_visits+$Cvisits" : '')." WHERE data='$Cgiorno' ".$this->append);
  if(@mysql_affected_rows()<1) $this->php_stats_sql_query("INSERT INTO ".$this->option[prefix]."_daily VALUES('$Cgiorno','$Chits','$Cvisits'".(($this->modulo[11] && $spider_agent) ? ",'$Chits','$Cvisits'" : ",'0','0'").")");
  }

// INIZIALIZZO L'IP UNA SOLA VOLTA PER TUTTE
$ip_number=sprintf('%u',ip2long($Cuser_id));

// COUNTRY
  if(($spider_agent===false) && $this->modulo[7])
    {
    if(
      ($ip_number>=3232235520 && $ip_number<=3232301055) || //192.168.0.0 ... 192.168.255.255
      ($ip_number>=167772160 && $ip_number<=184549375) || //10.0.0.0 ... 10.255.255.255
      ($ip_number>=2886729728 && $ip_number<=2887778303) || //172.16.0.0 ... 172.31.255.255
      ($ip_number>=0 && $ip_number<=16777215) || //0.0.0.0 ... 0.255.255.255
      ($ip_number>=4026531840 && $ip_number<=4294967295) //240.0.0.0 ... 255.255.255.255
      ) $domain='lan';
    else switch($this->option['ip-zone'])
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
        $result2=$this->php_stats_sql_query("SELECT tld FROM ".$this->option[prefix]."_ip_zone WHERE $ip_number BETWEEN ip_from AND ip_to");
        if(@mysql_affected_rows()>0) list($domain)=@mysql_fetch_row($result2);
        else $domain='unknown';
      break;
      case 2: //tramite ip2c file
        $domain=getIP($ip_number,23,'ip-to-country.db','ip-to-country.idx',2);
      break;
      }
    $this->php_stats_sql_query("UPDATE ".$this->option[prefix]."_domains SET visits=visits+$Cvisits,hits=hits+$Chits WHERE tld='$domain' $this->append");
    if(@mysql_affected_rows()<1) $this->php_stats_sql_query("UPDATE ".$this->option[prefix]."_domains SET visits=visits+$Cvisits,hits=hits+$Chits WHERE tld='unknown' $this->append");
    }

// INDIRIZZI IP
if($this->modulo[10])
  {
  $this->php_stats_sql_query("UPDATE ".$this->option[prefix]."_ip SET visits=visits+$Cvisits,hits=hits+$Chits,date='$this->date' WHERE ip='$ip_number' $this->append");
  if(@mysql_affected_rows()<1) $this->php_stats_sql_query("INSERT INTO ".$this->option[prefix]."_ip VALUES('$ip_number','$this->date','$Chits','$Cvisits')");
  if($this->option['prune_2_on']) prune($this->option[prefix]."_ip",$this->option['prune_2_value']);
  }

// Fine trasferimento
return 1;
}
}
// Fine Class

// Funzioni non incluse nella classe
function php_stats_filter_func($var)
{
 $var=strtolower($var);
 if(strpos($var,$GLOBALS['php_stats_filter_val'])===FALSE) return ($var);
}

// Filtratura variabili
function php_stats_filter_urlvar($url,$var) {
   $queryPos=strpos($url,'?');
   if($queryPos===FALSE) return ($url);
   $GLOBALS['php_stats_filter_val']=$var.'=';
   $url=str_replace('&amp;','&',$url);
   $queryArgs=explode('&',substr($url,$queryPos+1));
   $query_array=array_filter($queryArgs, 'php_stats_filter_func');
   unSet($GLOBALS['php_stats_filter_val']);
   if(count($query_array)===0) return substr($url,0,$queryPos);
   return (substr($url,0,$queryPos+1).implode('&',$query_array));
}
?>