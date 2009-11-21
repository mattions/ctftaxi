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

$version='0.1.9.1';
define('IN_PHPSTATS',true);
$php_stats_error='';
$style=''; // In caso di register globals=on
$page='';
// Vars defs
                if(!isset($_POST)) $_POST=$HTTP_POST_VARS;
                         if(!isset($_GET)) $_GET=$HTTP_GET_VARS;
              if(!isset($_COOKIE)) $_COOKIE=$HTTP_COOKIE_VARS;
              if(!isset($_SERVER)) $_SERVER=$HTTP_SERVER_VARS;
     if(isset($_POST['password'])) $password=$_POST['password']; else $password='';
       if(isset($_POST['action'])) $action=$_POST['action']; else $action='';
         if(isset($_POST['lang'])) $lang=$_POST['lang']; else if(isset($_GET['lang'])) $lang=$_GET['lang']; else $lang='';
      if(isset($_POST['license'])) $license=$_POST['license']; else $license=0;
  if(isset($_POST['writeServer'])) $writeServer=$_POST['writeServer']; else $writeServer=1;
if(isset($_COOKIE['pass_cookie'])) $pass_cookie=$_COOKIE['pass_cookie']; else $pass_cookie='';

if($action>0) if($license!=1) { header("location: http://www.php-stats.com"); exit(); }

// Scelta lingua browser
$HTTP_ACCEPT_LANGUAGE=$_SERVER['HTTP_ACCEPT_LANGUAGE'];
$lang_user=explode(',', getenv('HTTP_ACCEPT_LANGUAGE'));
$lang_user=explode('-',strtolower($lang_user[0]));
$lang_user=strtolower($lang_user[0]);
if($lang=='')
  {
  $lang=$lang_user;
  if(@file_exists("setup_files/lang/$lang/setup_lang.inc")) $lang=$lang_user; else $lang='it';
  }
// inclusione delle principali funzioni esterne
if(!@include('config.php')) die('<b>ERRORE</b>: File config.php non accessibile.');
if(!@include('inc/main_func.inc.php')) die('<b>ERRORE</b>: File main_func.inc.php non accessibile.');
if(!@include('inc/admin_func.inc.php')) die('<b>ERRORE</b>: File admin_func.inc.php non accessibile.');

if(isset($option['out_compress'])) if($option['out_compress']==1) if(phpversion()>'4.0.4') ob_start('ob_gzhandler');
if($option['prefix']=='') $option[prefix]='php_stats';
// Connessione a MySQL e selezione database
db_connect();
// Include lingua
include("setup_files/lang/$lang/setup_lang.inc");
// CONTROLLO SE ESISTE IL FILE php-stats.lock
$fp=@fopen("php-stats.lock", "r");
if($fp!=False) $action="locked";
// Auto-login se necessario
if($action==4)
  {
  $cripted_pass=md5($password);
  setcookie('pass_cookie','',time());
  setcookie('pass_cookie',"$cripted_pass",time()+604800,"/");
  }
switch ($action) {
        case '0':
                $page.=
                "<h3>Php-Stats ".$version." - ".$string['install']." (Step 1/5)</h3>\n".
                "<table border=\"1\" bordercolor=#000000 cellpadding=\"0\" cellspacing=\"0\" width=\"400\"><tr><td bordercolor=#EEEEEE>".
                "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" width=\"100%\">".
                "<tr><td bgcolor=#EEEEEE align=\"center\">".
                "<br><span class=\"testo\">$string[license]</span>".
                "<div align=\"center\"><form action=\"setup.php\" method=\"post\">\n".
                "<textarea name=\"text\" readonly cols=\"80\" rows=\"15\">\n";
                $fp=fopen("setup_files/lang/$lang/license","r");
                while(!feof($fp)) $page.=fgets($fp,1024);
                fclose($fp);
                $page.=
                "</textarea><br><br>".
                "<input type=\"radio\" name=\"license\" value=\"1\" class=\"radio\"><span class=\"testo\">$string[license_ok]</span>     <input type=\"radio\" name=\"license\" value=\"0\" class=\"radio\" checked><span class=\"testo\">$string[license_no]</span>".
                "<br><br>".
                "<input type=\"hidden\" name=\"action\" value=\"1\">".
                "<input type=\"hidden\" name=\"lang\" value=\"$lang\">".
                "<input type=\"submit\" name=\"op\" value=\"$string[next]\"><br><br>".
                "</td></tr>".
                "</table>".
                "</td></tr>".
                "</table>".
                "</form></div>\n";
        break;

        case '1':
                $writeServer=false;
                @chmod("option", 0777);
                $writeServer=@touch('option/php-stats-options.php');
                if($writeServer){
                   @chmod('config.php', 0666);
                   $writeFilesList=Array('admin.php','click.php','download.php','escludi.php','php-stats.php','php-stats.recjs.php','php-stats.recphp.php','tracking.php','view_stats.js.php');
                   for($i=0,$tot=count($writeFilesList);$i<$tot;++$i){
                      $ok=@copy('files_Write/'.$writeFilesList[$i],$writeFilesList[$i]);
                      if(!$ok) { $writeServer=FALSE; break; }
                      }
                }
                $page.=
                "<h3>Php-Stats ".$version." - ".$string['install']." (Step 2/5)</h3>\n".
                "<form action=\"setup.php\" method=\"post\">".
                "<table border=\"1\" bordercolor=#000000 cellpadding=\"0\" cellspacing=\"0\" width=\"400\"><tr><td bordercolor=#EEEEEE>".
                "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" width=\"100%\">".
                "<tr><td bgcolor=#EEEEEE align=\"center\">".
                (!$writeServer ? "<br><span class=\"testo\">$error[nowrite_server]<span>" : '').
                "<br><span class=\"testo\">$string[step_1_1]".
                "<br><br>$string[step_1_2]</span><br><br>".
                "<input type=\"hidden\" name=\"action\" value=\"2\">".
                "<input type=\"hidden\" name=\"lang\" value=\"$lang\">".
                "<input type=\"hidden\" name=\"license\" value=\"$license\">".
                (!$writeServer ? "<input type=\"hidden\" name=\"writeServer\" value=\"0\">" : '').
                "<input type=\"submit\" name=\"op\" value=\"$string[next]\"><br><br>".
                "</td></tr>".
                "</table>".
                "</td></tr>".
                "</table>".
                "</form>";
        break;

        case '2':
                $page.=
                "<h3>Php-Stats ".$version." - ".$string['install']." (Step 3/5)</h3>\n".
                "<table border=\"1\" bordercolor=#000000 cellpadding=\"0\" cellspacing=\"0\" width=\"400\"><tr><td bordercolor=#EEEEEE>".
                "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" width=\"100%\">".
                "<tr><td bgcolor=#EEEEEE align=\"center\">";
                $ok_1=exec_sql_lines("setup_files/sql/main.sql");
                if($ok_1==false)
                   $page.="<span class=\"testo\">".$error['error_updating']."<br><br><br>$php_stats_error</span>";
                else
                  {
                  $page.=
                  "<br><span class=\"testo\">".$string['done']."</span><br><br>".
                  "<div align=\"center\"><form action=\"setup.php\" method=\"post\">\n".
                  "<input type=\"hidden\" name=\"action\" value=\"3\" />\n".
                  "<input type=\"hidden\" name=\"lang\" value=\"$lang\" />\n".
                  "<input type=\"hidden\" name=\"license\" value=\"$license\">".
                  (!$writeServer ? "<input type=\"hidden\" name=\"writeServer\" value=\"0\">" : '').
                  "<input type=\"submit\" name=\"op\" value=\"$string[next]\" />\n".
                  "</form></div>\n";
                  }
                  $page.=
                  '</td></tr>'.
                  '</table>'.
                  '</td></tr>'.
                  '</table>';
        break;

        case '3':
                $page.=
                "<SCRIPT language=\"Javascript\" src=\"setup_files/lang/$lang/check.js\"></SCRIPT>".
                "<h3>Php-Stats ".$version." - ".$string['install']." (Step 4/5)</h3>\n".
                "<FORM action=\"setup.php\" method=post name=regform>".
                "<table border=\"1\" bordercolor=#000000 cellpadding=\"0\" cellspacing=\"0\" width=\"400\"><tr><td bordercolor=#EEEEEE>".
                "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" width=\"100%\">".
                "<tr><td bgcolor=#EEEEEE align=\"center\">".
                "<br>".
                "<table>".
                "<tr><td align=\"right\"><span class=\"testo\">$string[step_3_1]</span></td><td><INPUT maxLength=20 name=password tabIndex=1 type=password></td></tr>".
                "<tr><td align=\"right\"><span class=\"testo\">$string[step_3_2]</span></td><td><INPUT maxLength=20 name=password2 tabIndex=2 type=password></td></tr>".
                "</table>".
                "<center>".
                "<br>".
                "<input type=\"hidden\" name=\"lang\" value=\"$lang\" />\n".
                "<input type=\"hidden\" name=\"license\" value=\"$license\">".
                (!$writeServer ? "<input type=\"hidden\" name=\"writeServer\" value=\"0\">" : '').
                "<input type=\"hidden\" name=\"action\" value=\"4\" />".
                "<INPUT name=Submit onclick=GlobalCheck() tabIndex=21 type=button value=\"$string[next]\"><br><br>".
                "</center>".
                "</td></tr>".
                "</table>".
                "</td></tr>".
                "</table>".
                "</FORM>";

        break;

        case '4':
                sql_query("UPDATE $option[prefix]_config SET value='$password' WHERE name='admin_pass'");
                sql_query("UPDATE $option[prefix]_config SET value='$lang' WHERE name='language'");
                $error_config=FALSE;
                if($writeServer){
                  $page_list=Array('main','details','os_browser','reso','systems','pages','percorsi','time_pages','referer','engines','query','searched_words','hourly','daily','weekly','monthly','calendar','compare','ip','country','bw_lang','downloads','clicks','trend');
                  $error_config=create_option_file(1);
                  }
                $fp=@fopen("php-stats.lock", "w+");
                if($fp!=False) $locked=1; else $locked=0;
                $page.=
                "<h3>Php-Stats ".$version." - ".$string['install']." (Step 5/5)</h3>\n".
                "<form action=\"admin.php?action=preferenze\" method=\"post\">".
                "<table border=\"1\" bordercolor=#000000 cellpadding=\"0\" cellspacing=\"0\" width=\"400\"><tr><td bordercolor=#EEEEEE>".
                "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" width=\"100%\">".
                "<tr><td bgcolor=#EEEEEE align=\"center\">".
                ($locked===0 ? "<font color=\"#FF0600\">$string[step_4_1]</font><br><br>" : '').
                "<br><span class=\"testo\">$string[step_4_2]</span><br>".
                "<textarea name=\"mainscript\" cols=\"100%\" rows=\"6\">".
                "<script type=\"text/javascript\" src=\"$option[script_url]/php-stats.js.php\"></script>\n<noscript><img src=\"$option[script_url]/php-stats.php\" border=\"0\" alt=\"\"></noscript>".
                "</textarea><br><br>\n".
                "<span class=\"testo\">$string[step_4_3]</span><br>".
                "<textarea name=\"mainscript\" cols=\"100%\" rows=\"4\">";

                $path_include=(!isset($_SERVER['DOCUMENT_ROOT']) ? dirname($_SERVER['PATH_TRANSLATED']) : $_SERVER['DOCUMENT_ROOT'].str_replace('\\','/',dirname($_SERVER['PHP_SELF']))).'/';
                $path_include=str_replace(Array('//','\\\\'),Array('/','/'),$path_include);
                if(strpos($path_include,':')===1) $path_include=substr($path_include,2);

                $page.=
                "&lt;?php\ndefine('__PHP_STATS_PATH__','$path_include');\ninclude(__PHP_STATS_PATH__.'php-stats.redir.php');\n?&gt;".
                "</textarea><br><br>\n".
                ($error_config ? "<input type=\"hidden\" name=\"action\" value=\"error_config\" />" : '').
                "<input type=\"submit\" name=\"op\" value=\"$string[end]\"><br><br>".
                "</td></tr>".
                "</table>".
                "</td></tr>".
                "</table>".
                "</form></div>\n";
                //$page.="<br><br>$string[step_4_4]";
        break;

                case'locked':
                            $page.=
                            "<h3>Php-Stats $version: $string[install].</h3>\n".
                            "<br><table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" align=\"center\" width=\"300\">".
                            "<tr><td bgcolor=\"#707888\" nowrap><span class=\"tabletitle\">".$string['box_title']."</span></td>".
                            "<tr><td align=\"center\" valign=\"middle\" bgcolor=\"#EEEEEE\" nowrap>".
                            "<table width=\"100%\" height=\"100%\" cellpadding=\"0\" cellspacing=\"5\" border=\"0\"><tr><td align=\"center\" valign=\"middle\"  nowrap>".
                            "<span class=\"testo\">".$error['locked']."</span>".
                            "</td></tr></table>".
                            "</table><br><br><br>";
                break;

        case'error_config':
                           $page.=
                           "<h3>Php-Stats $version: $string[install].</h3>\n".
                           "<br><table border=\"0\" cellpadding=\"1\" cellspacing=\"1\" align=\"center\" width=\"300\">".
                           "<tr><td bgcolor=\"#707888\" nowrap><span class=\"tabletitle\">".$string['box_title']."</span></td>".
                           "<tr><td align=\"center\" valign=\"middle\" bgcolor=\"#EEEEEE\" nowrap>".
                           "<table width=\"100%\" height=\"100%\" cellpadding=\"0\" cellspacing=\"5\" border=\"0\"><tr><td align=\"center\" valign=\"middle\"  nowrap>".
                           "<span class=\"testo\">".$error['error_config']."</span>".
                           "</td></tr></table>".
                           "</table><br><br><br>";
                break;

        default:
                $page.=
                "<h3>Php-Stats ".$version." - ".$string['install']."</h3>".
                "<form action=\"setup.php\" method=\"post\">".
                "<table border=\"1\" bordercolor=#000000 cellpadding=\"0\" cellspacing=\"0\" width=\"300\"><tr><td bordercolor=#EEEEEE>".
                "<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" align=\"center\" width=\"100%\">".
                "<tr><td bgcolor=#EEEEEE align=\"center\">".
                "<br><span class=\"testo\">$string[lang_select]</span>".
                "<select name=\"lang\" onchange=\"window.location=('setup.php?lang='+this.options[this.selectedIndex].value)\">";

                // Inizio lettura directory LINGUE
                $location="setup_files/lang/";
                $hook=opendir($location);
                while(($file=readdir($hook))!==false)
                     {
                     if($file!="." && $file!="..")
                       {
                       $path=$location . "/" . $file;
                       if(is_dir($path)) $elenco0[]=$file;
                       }
                     }
                closedir($hook);
                natsort($elenco0);
                // Fine lettura directory LANG

                while(list ($key, $val)=each ($elenco0))
                     {
                     $val=chop($val);
                     // Leggo il nome della lingua
                     $language_name=file("setup_files/lang/$val/lang.name");
                     $page.="<option value=\"$val\""; if($lang==$val) { $page.="selected"; } $page.=">$language_name[0]</option>";
                     }
                $page.=
                "</select>".
                "<input type=\"hidden\" name=\"action\" value=\"0\"><br><br>".
                "<input type=\"submit\" name=\"op\" value=\"$string[next]\"><br><br>".
                "</td></tr>".
                "</table>".
                "</td></tr>".
                "</table>".
                "</form>\n";
       break;
}

///////////////
// HTML PAGE //
///////////////
$html=
"\n<html>".
"\n<head>".
"\n<title>Php-Stats ".$version." - ".$string['install']."</title>".
"\n<style type=\"text/css\">".
"\n<!--".
"\nselect, option, textarea, input { BORDER-RIGHT: #9DBECD 1px solid; BORDER-TOP: #9DBECD 1px solid; BORDER-BOTTOM: #9DBECD 1px solid; BORDER-LEFT: #9DBECD 1px solid; COLOR: #000000; FONT-SIZE: 10px; FONT-FAMILY: Verdana; BACKGROUND-COLOR: #ffffff; }".
"\n.radio { BORDER-RIGHT: #9DBECD 0px solid; BORDER-TOP: #9DBECD 0px solid; BORDER-BOTTOM: #9DBECD 0px solid; BORDER-LEFT: #9DBECD 0px solid; COLOR: #000000; FONT-SIZE: 10px; FONT-FAMILY: Verdana; BACKGROUND-COLOR: #EEEEEE }".
"\na:visited,a:active {text-decoration:none; color:#000000; font-weight:plain;}".
"\na:hover {text-decoration:none; color:#AA0000; font-weight:plain;}".
"\na:link { text-decoration:none; color:#000000; font-weight:plain; }".
"\n.testo {  font-family: Verdana; font-size: xx-small; color:#000000; text-align: justify; }".
"\n.tabletitle { font-family: Verdana; font-size: xx-small; color: #FFFFFF ; font-weight: bold}".
"\n-->".
"\n</style>".
"\n</head>".
"\n<body>".
"\n<TABLE cellSpacing=\"1\" cellPadding=\"1\" width=\"760\" height=\"100%\" align=\"center\" bgColor=\"black\">".
"  <TBODY>".
"    <TR>".
"      <TD  height=30 bgColor=#c1c1c1>".
"            <TABLE width=740 cellSpacing=0 cellPadding=0>".
"            <TR>".
"              <TD><IMG alt=\"\" src=\"setup_files/logo.gif\"></TD>".
"              <TD vAlign=bottom align=right><FONT face=verdana size=1>PHP-STATS INSTALLER (v1.3)</FONT></TD>".
"            </TR>".
"        </TABLE>".
"          </TD>".
"    </TR>".
"    <TR>".
"      <TD vAlign=top bgColor=#d9dbe9><CENTER><br><br>".
"\n\n".$page;
"        <br><br></CENTER>".
"    <TR>".
"      <TD height=10 bgColor=#c1c1c1><CENTER><FONT face=verdana size=1>© <A href=\"http://www.php-stats.com/\">Webmaster76</A></FONT></CENTER></TD>".
"    </TR>".
"  </TBODY>".
"\n</TABLE>".
"\n</body>".
"\n</html>";

// Restituisco la pagina!
echo"$html";

/*--------------------------------------------------
  remove_remarks()
  Remove # type remarks from large sql files
  --------------------------------------------------*/
function remove_remarks($sql) {
$i=0;
while($i<strlen($sql))
  {
  if($sql[$i]=="#" and ($i==0 or $sql[$i-1]=="\n"))
    {
    $j=1;
    if(!isset($sql[$i+$j])) $sql[$i+$j]=""; // 0.1.8
    while($sql[$i+$j]!="\n")
          {
          ++$j;
      if($j+$i >= strlen($sql)) break;
          }
    $sql=substr($sql,0,$i).substr($sql,$i+$j);
    }
  ++$i;
  }
return($sql);
}

/*--------------------------------------------------
  split_sql_file()
  Split up a large sql file into individual queries
  --------------------------------------------------*/
function split_sql_file($sql, $delimiter) {
        global $option;
        // BEGIN Cambio prefisso della tabella!!!!
        $sql=str_replace("php_stats","$option[prefix]",$sql);
        // END Cambio prefisso della tabella!!!!
        $sql=trim($sql);
        $char="";
        $last_char="";
        $ret=array();
        $in_string=true;
        for($i=0; $i<strlen($sql); ++$i) {
                $char=$sql[$i];

                /* if delimiter found, add the parsed part to the returned array */
                if($char == $delimiter && !$in_string) {
                        $ret[]=substr($sql, 0, $i);
                        $sql=substr($sql, $i + 1);
                        $i=0;
                        $last_char="";
                }

                if($last_char == $in_string && $char == ")")  $in_string=false;
                if($char == $in_string && $last_char != "\\") $in_string=false;
                elseif(!$in_string && ($char == "\"" || $char == "'") && ($last_char != "\\")) $in_string=$char;
                $last_char=$char;
        }

        if(!empty($sql)) $ret[]=$sql;
        return($ret);
}




/*--------------------------------------------------
  exec_sql_lines()
  takes a file and executes all its sql-queries
  uses remove_remark() and split_sql_file()
  --------------------------------------------------*/
function exec_sql_lines($sql_file, $old_string='', $new_string='') {
global $php_stats_error;
        $error_lev=0;
        $sql_query=isset($sql_query) ? $sql_query : "";

        if(!empty($sql_file) && $sql_file != "none") {
                $sql_query=fread(fopen($sql_file, "r"), filesize($sql_file));
                /* If magic_quotes_runtime is enabled, most functions that return data from any sort of external source
                   including databases and text files will have quotes escaped with a backslash.
                */
                if(get_magic_quotes_runtime() == 1) $sql_query=stripslashes($sql_query);
                /* replace old_string with new_string if they are set */
                if($old_string != '') {
                        $sql_query=ereg_replace($old_string,$new_string,$sql_query);
                }
        }
        $sql_query=trim($sql_query);

        if($sql_query != "") {
                $sql_query  =remove_remarks($sql_query);
                $pieces     =split_sql_file($sql_query,";");
                $cnt_pieces =count($pieces);
                /* run multiple queries */
                for ($i=0; $i<$cnt_pieces; ++$i) {
                        $sql=trim($pieces[$i]);
                        if(!empty($sql) and $sql[0] != "#")
                                                  {
                                                  $result=sql_query($sql);
                                                  if($result==false)
                                                    {
                                                        $php_stats_error.="<font color=\"#FF0000\" size=\"1\">Error executing: <b>$sql</b><br>Error string: <b>".mysql_error()."</b></font><br><br>";
                                                        $error_lev=1;
                                                        }
                                                  }
                }
        }
        if($error_lev==0)
                return true;
                else
                return false;
}
?>