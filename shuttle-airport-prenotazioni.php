<?php 
//dati per il login 
$login_user="Hotel_1"; 
$pass_user="prova"; //passwd="prova" 
//$pass_user="15525372b2149b83049790766bd6a728"; //passwd="prova" 

$redirect="shuttle-airport-prenotazioni.php"; 

 
//gestione della sessione nel caso in cui i cookie sono disabilitati 
if(IsSet($_POST['PHPSESSID']) && !IsSet($_COOKIE['PHPSESSID'])) 
{ 
  $PHPSESSID=$_POST['PHPSESSID']; 
  header("Location: $redirect?PHPSESSID=$PHPSESSID"); //si ricarica la pagina di login 
} 

session_start(); //si inizia o continua la sessione 

//controllo user e passwd da login 
if(IsSet($_POST['posted_username']) && IsSet($_POST['posted_password'])) 
{ 
/*
  if($login_user==($_POST['posted_username']) && $pass_user==md5($_POST['posted_password'])) 
    $_SESSION['user']=$_POST['posted_username']; 
*/
	if($login_user==($_POST['posted_username']) && $pass_user==($_POST['posted_password'])) 
		$_SESSION['user']=$_POST['posted_username'];
} 

//creazione cookie per login automatico 
if(IsSet($_POST['ricorda']) && IsSet($_SESSION['user'])) 
{ 
  $cok=md5($login_user)."%%".$pass_user; 
  setcookie("sav_user",$cok,time()+31536000); 
} 

//logout 
if($_GET['logout']==1) 
{ 
  $_SESSION=array(); // Desetta tutte le variabili di sessione. 
  session_destroy(); //DISTRUGGE la sessione. 
  if(IsSet($_COOKIE['sav_user'])) //se presente si distrugge il cookie di login automatico 
    setcookie("sav_user",$cok,time()-31536000); 
  header("Location: $redirect"); //si ricarica la pagina di login 
  exit; //si termina lo script in modo da ritornare alla schermata di login 
} 

//controllo user e passwd da cookie 
if(IsSet($_COOKIE['sav_user'])) 
{ 
  $info_cok=$_COOKIE['sav_user']; 
  $cok_user=strtok($info_cok,"%%"); 
  $cok_pass=strtok("%%"); 
  setcookie("sav_user",$info_cok,time()+31536000); 
  if($cok_user==md5($login_user) && $cok_pass==$pass_user) 
    $_SESSION['user']=$login_user; 
} 

//caso in cui si vuole ricordare il login, ma i cookie sono off 
if(!IsSet($_COOKIE['PHPSESSID']) && IsSet($_POST['ricorda'])) 
  header("Location: $redirect?nocookie=1"); 
?> 
<!DOCTYPE html PUBLIC "-//W3C//Dtd XHTML 1.0 Transitional//IT"
    "http://www.w3.org/tr/xhtml1/Dtd/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" / >
<meta http-equiv="content-type" lang="italiano" content="text/html; charset=utf-8" />
<title>Consorzio Tassisti Falconara Marittima -- Prenotazioni</title>
<link type="text/css" rel="stylesheet" href="mainstyle-2.css" media="screen"/>
<link type="text/css" rel="stylesheet" href="stile-stampa.css" media="print"/>
</head>
<!-- Quella è la testa -->

<body lang="it">
<div id="contenitore">
	<div id="header">
		<div id="logo">
			<img alt="C.T.F.Taxi" width="600px" height="208px" src="immagini/ctf-logo.png" />
		</div>
				<div  id="bandiere">
		<a href="prenotazioni.it.php"><img class="allineamento" width="68" height="43" title="Italiano" alt="Italiano" src="immagini/bandiera-italiana.gif" /></a><a href="prenotazioni.en.php"><img class="allineamento" width="68" height="43" title="English" alt="English" src="immagini/bandiera-inglese.gif" /></a>
		<a href="prenotazioni.fr.php"><img class="allineamento" width="68" height="43" title="Français" alt="Français" src="immagini/bandiera-francese.gif" /></a><a href="prenotazioni.de.php"><img class="allineamento" width="68" height="43" title="Deutsch" alt="Deutsch" src="immagini/bandiera-tedesca.gif" /></a>	
		</div>
	</div>
	<?php
	/*
		Includo il template del rettangolo destro alto ;-)
	*/
		include("include/rettangolo_destro_alto.php");
	?>
				<div class="pre-menu">
			<div id="menu">
				<div id="menu-navigazione">
				<h3>Navigazione Sito</h3>
				<ul>
	            <li><a href="index.it.php">Home</a></li>
	            <li><a href="prenotazioni.it.php">Prenotazioni</a></li>
	            <li><a href="preventivo.it.php">Preventivi</a></li>
		        	<li><a href="shuttle-airport.it.php">Shuttle-Aiport</a>
			        	<sup><img src="immagini/new.gif" alt="new" width="24px" height="11px" /></sup></li>
		        	<li><a id="activelink" title="Link riservato per gli hotel"
		        	href="shuttle-airport-prenotazioni.php">Shuttle Aiport Prenotazioni</a><sup>alpha</sup></li>
		       </ul>
				</div>
				<div id="menu-link">
					<h3>Turistic Link</h3>
				<ul>
					<li><a href="http://www.conero.it/">La Riviera del Conero</a></li>
					<li><a href="http://www.cadnet.marche.it/frasassi/">Le grotte di Frassassi</a></li>
				</ul>
					<h3>Buisness Link</h3>
				<ul>
					<li><a href = "http://www.ancona-airport.com/Default.asp" class="link" >
					Aeroporto Raffaello Sanzio</a></li>
					<li><a href = "europcar.it.php">Europcar</a></li>
				</ul>
				</div>
			</div>
			<div id="contatori">
				<!-- Contatori -->
							<?php
								define('__PHP_STATS_PATH__','/web/htdocs/www.ctftaxi.it/home/stats/');
								include(__PHP_STATS_PATH__.'php-stats.redir.php');
							?>
					<p>Utenti on line</p><p><script type="text/javascript" src="http://www.ctftaxi.it/stats/view_stats.js.php?mode=0"></script></p>
					<p>Visitatori totali</p><p><script type="text/javascript" src="http://www.ctftaxi.it/stats/view_stats.js.php?mode=3">Visitatori totali</script></p>
			</div>
			
			</div>
	<div id="contenuti"> 			
		<img alt="shuttle-airport-logo" src="immagini/shuttle-airport.png" 
			title="il nuovo servizio targato ctftaxi" width="300px" height="99px"/>
			<div id="presentazione">				
<?php 
$PHPSESSID=session_id(); 

if(!IsSet($_SESSION['user'])) //non siamo loggati, pagina di login 

{ 
  if($_GET['nocookie']==1) //i cookie sono off e si vuole ricordare il login 
    print("Spiacente, ma i cookie sono disabilitati. Attivali altrimenti 
    	non posso abilitare l'autologin ;)<br/> "); 
	echo<<<EOF
	
	<div id="shuttle-airport">
				<div class="Prima_Lettera_Intestazioni">
						S
				</div>
						<h1>huttle-Airport</h1>
						
						<form action="shuttle-airport-prenotazioni.php" method="post">
							<table>
								<tr>
								
									<td class="Campo">Hotel :</td>
									<td>
									<select name="hotel">
									   <option>Hotel_1</option>
									   <option>Hotel_2</option>
									   <option>Hotel_3</option>
								 </select>
									</td>
								</tr>
								<tr>
									<td class="Campo">Password :</td>
									<td>
										<input type="password" size="20" name="posted_password" />
									</td>
								</tr>
								<tr>
									<td class="Campo">Autologin :</td>
									<td>
										<input type="checkbox" name="ricorda" value="1" />
									</td>
								</tr>								
							<tr>
								<td><input type="submit" name="submit" value="Loggami"></td>
							</tr>
						</table>	
						</form> 
			</div>
EOF;
  if(!IsSet($_COOKIE['PHPSESSID'])) //i cookie sono off, dobbiamo propagare noi il PHPSESSID 
    print("<INPUT TYPE=HIDDEN NAME=PHPSESSID VALUE=$PHPSESSID>"); 
  print("</FORM>"); 
} 
else //siamo loggati pagina riservata 
{ 
  $username=$_SESSION['user']; 
  print("<div id=\"shuttle-airport\" class=\"esempio\">");
  print("Sei loggato come: <div class=\"nome_login\">$login_user</div><br/><br/>"); 
  print("Se non sei $login_user effettua il <a href=\"shuttle-airport.php?logout=1\">logout</a> <br/><br/>");
/*
Inclusione delle varie classi
*/
include_once('form/it_error_const.inc.php') ;
include_once('form/regole.php') ;
include_once('form/tipi.php') ;
include_once('form/form_handler.php') ;

/*
In produzione sopprimiamo gli invevitabili notice sui campi che ancora non esistono
*/
#error_reporting(E_ALL ^ E_NOTICE) ;

class CrossPassword extends AbstrErrHandler
{

    function CrossPassword($pass1, $pass2, $error)
    {
    
        if($pass1 != $pass2)
				{
				
				   $this->errors[] =  $error ;
				
				}        
    
    }//END CrossPassword

}
/*
Verifica che su due campi, almeno uno sia settato
*/

class CrossOneRequired extends AbstrErrHandler
{
	
		function CrossOneRequired($field1, $field2, $error)
		{
			
				if ( $field1 = '' || $field2 = '' )
					{
					
						$this->errors[] = $error ;
					
					}
		}//END CrossOneRequired

}

$fields = array() ;

$cross =  array() ;


/*
Definizione dei campi
*/
$fields['giorno'] = new FrmFieldSet( $_REQUEST['giorno'], 'Giorno', true ) ;

$fields['mese']= new FrmFieldSet ($_REQUEST['mese'], 'Mese' , true ) ;

$fields['ora']= new FrmFieldSet ($_REQUEST['ora'], 'Ora' , true ) ;

$fields['minuti']= new FrmFieldSet ($_REQUEST['minuti'], 'Minuti' , true ) ;

$fields['passeggeri'] = new FrmField ($_REQUEST['passeggeri'], 'Numero Passeggeri', true, array(), "1" ) ;

$fields['bagaglio'] = new FrmField ($_REQUEST['bagaglio'], 'Bagaglio', false ) ;

$fields['bambini'] = new FRmField ($_REQUEST['bambini'], 'Bambini in sicurezza', false ) ;

$fields['partenza'] = new FrmField ($_REQUEST['partenza'], 'Partenza', true  ) ;

$fields['arrivo'] = new FrmField ($_REQUEST['arrivo'], 'Arrivo', true  ) ;

$fields['nome'] = new FrmField( $_REQUEST['nome'], 'Nome', true, array( new PatternRule("/^\w{3,15}$/i") ) ) ;

$fields['cognome'] = new FrmField( $_REQUEST['cognome'], 'Cognome', true, array( new PatternRule("/^\w{3,20}$/i") ) ) ;

$fields['e-mail'] = new MailField( $_REQUEST['e-mail'], 'e-mail', false ) ;

$fields['telefono'] = new PhoneField( $_REQUEST['telefono'], 'Recapito Telefonico', true) ;

$fields['note'] = new FrmField ($_REQUEST['note'], 'Note' , false, array( new StrRangeRule (0 , 250) ) ) ;

$fields['informativa'] = new FrmFieldset($_REQUEST['informativa'], 'informativa', true);



/*
Regole che incrociano i campi
*/
#$cross[] = new CrossOneRequired($_REQUEST['e-mail'], $_REQUEST['telefono'], 'Almeno uno dei due campi (E-mail o Recapito Telefonico) deve essere compilato') ;

$form = new SmartForm('invia', $fields, $cross) ;

/*
Se il form non è stato inviato o è inviato ma ci sono errori
*/
if( !$form->isSent || !$form->isValid() )
{
    /*
		Mostra il form ed eventuali errori
		*/
    $form->display('form/shuttle-airport-form.php') ;

}

//Se invece è tutto ok
//elabora i dati inviati
else { 
echo <<<EOF
<style type="text/css">

body p {
	text-align: left;
	}
#risposta {
	padding-top: 3em;
	}

.dati_immessi {
	width: 370px ;
	margin-top: 0px;
	margin-bottom: 0px;
	margin-left: auto;
	margin-right: auto;
	font-weight: bold;
	}
#png {
	width: 370px ; height: 180px ;
	margin-top: 0px;
	margin-bottom: 0px;
	margin-left: auto;
	margin-right: auto;
	}
	
</style>
<div id = "risposta">
	<p> I dati da lei immessi sono :</p>
</div>
EOF;
echo ("<div class = \"dati_immessi\"><p>Giorno : " . $_POST['giorno'] . 
		"<br />Mese : " . $_POST['mese'] .
		"<br />Ora : " . $_POST['ora'] .
		"<br />Minuti : " . $_POST['minuti'] .
		"<br />Passeggeri : " . $_POST['passeggeri'] .
		"<br />Bagaglio : " . $_POST['bagaglio'] .
		"<br />Bambini in sicurezza : "  . $_POST['bambini'] .
		"<br />Partenza : " . $_POST['partenza'] .
		"<br />Destinazione : " . $_POST['arrivo'] .
		"<br />Nome : " . $_POST['nome'] .
		"<br />Cognome : " . $_POST['cognome'] .
		"<br />E-Mail : " . $_POST['e-mail'] .
		"<br />Recapito Telefonico : " . $_POST['telefono'] .
		"<br />Note : " . $_POST['note'] . "</p></div>" );
echo<<<HD
<div id = "png"> 
		<img alt = "taxi-reserved" src = "immagini/taxi-reserved.png" / >
	</div>
<div class = "dati_immessi">
	<p> Grazie per aver scelto <img alt="ctf" src="immagini/ctf-logo-small.png" /></p>
</div>
HD;
/* 
Mail
*/
//Formatto il corpo del messaggio

//Variabili della mail

//$destinatario = 'info@ctftaxi.it' . ", " ;
$destinatario .= 'webmaster@ctftaxi.it' ;

$soggetto = 'Richiesta prenotazione' ;

$corpo_messaggio = 	"Giorno : " . $_POST['giorno'] . 
							"\nMese : " . $_POST['mese'] .
							"\nOra : " . $_POST['ora'] .
							"\nMinuti : " . $_POST['minuti'] .
							"\nPasseggeri : " . $_POST['passeggeri'] .
							"\nBagaglio : " . $_POST['bagaglio'] .
							"\nBambini in sicurezza : "  . $_POST['bambini'] .
							"\nPartenza : " . $_POST['partenza'] .
							"\nDestinazione : " . $_POST['arrivo'] .
							"\nNome : " . $_POST['nome'] .
							"\nCognome : " . $_POST['cognome'] .
							"\nE-Mail : " . $_POST['e-mail'] .
							"\nRecapito Telefonico : " . $_POST['telefono'] .
							"\nNote : " . $_POST['note'] ;

$mittente = "form-prenotazione@ctftaxi.it" ;


mail ($destinatario, $soggetto, $corpo_messaggio, "From: $mittente");
}

   
} 
?> 


						
		</div> 
		<?php
		include ("include/footer.inc.php")
		?>
	
</div>
</body>
</html>