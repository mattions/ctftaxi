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

// SECURITY ISSUES
if(!defined('IN_PHPSTATS')) die('Php-Stats internal file.');

/////////////////////////////////////////////
// Preparazione varibili HTML del template //
/////////////////////////////////////////////
$autorefresh='';
$option['nomesito']=stripcslashes($option['nomesito']);
if(isset($option['autorefresh']) && $option['autorefresh']>0) $option['autorefresh']=$option['autorefresh']*60000;
else $option['autorefresh']=600000;
$meta="<META NAME='ROBOTS' CONTENT='NONE'>";
$phpstats_title="Php-Stats $option[phpstats_ver] - $phpstats_title";
if($refresh) $meta.="\n<META HTTP-EQUIV=\"refresh\" CONTENT=\"5;URL=$url\">"; // Refresh pagina breve
else if(!in_array($trad_action,$norefresh_action) && $option['autorefresh']>0) // Alcune pagine sono escluse dal refresh
$autorefresh=
"<script type='text/javascript'>
function selfRefresh(){
  location.href='".$option['script_url'].'/admin.php?'.$QUERY_STRING."';
}
setTimeout('selfRefresh()',$option[autorefresh]);
</script>";
if($update_msg) $meta.="\n".$update_msg;
$generation_time=str_replace('%TOTALTIME%',round($end_time-$start_time,3),$varie['page_time']);
$server_time=str_replace('%SERVER_TIME%',date($varie['time_format']),$varie['server_time']);

//////////////////////////////////
// Generazione HTML da template //
//////////////////////////////////
eval('$template="'.gettemplate("$template_path/admin.tpl").'";');

////////////////////////
// Ricostruzione menu //
////////////////////////

// Non visualizzo le voci che richiedono autentificazione se non si � loggati
if(!$is_loged_in) $template=preg_replace("'<!--Begin is_loged_in--[^>]*?>.*?<!--End is_loged_in-->'si","",$template);

// Non Visualizzo le voci che non sono state attivate nelle opzioni
$moduli_attivabili=Array('details','systems','bw_lang','pages_time','referer_engines','hourly','daily_monthly','country','downloads','clicks','ip');
for($i=0;$i<11;++$i)
  if(!$modulo[$i]) $template=preg_replace("'<!--Begin $moduli_attivabili[$i]--[^>]*?>.*?<!--End $moduli_attivabili[$i]-->'si",'', $template);

// Error-log viewer
if(!$option['logerrors']) $template=preg_replace("'<!--Begin errorlogviewer--[^>]*?>.*?<!--End errorlogviewer-->'si","", $template);
?>