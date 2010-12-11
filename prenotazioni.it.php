<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta http-equiv="content-type" lang="italiano" content="text/html; charset=utf-8"/>
<title>Consorzio Tassisti Falconara Marittima -- Prenotazioni -- TAXI FALCONARA ANCONA</title>
<link type="text/css" rel="stylesheet" href="mainstyle-2.css" media="screen"/>
<link type="text/css" rel="stylesheet" href="stile-stampa.css" media="print"/>
</head>
<!-- Quella è la testa -->

<body lang="it">
<div id="header">
		<div id="logo">
			<img alt="C.T.F.Taxi" width="600px" height="208px" src="immagini/ctf-logo.png" />
		</div>
				
	</div>
<div id="contenitore">
	<div  id="bandiere">
		<a href="prenotazioni.it.php"><img class="allineamento" width="68" height="43" title="Italiano" alt="Italiano" src="immagini/bandiera-italiana.gif" /></a><a href="prenotazioni.en.php"><img class="allineamento" width="68" height="43" title="English" alt="English" src="immagini/bandiera-inglese.gif" /></a>
		<a href="prenotazioni.fr.php"><img class="allineamento" width="68" height="43" title="Français" alt="Français" src="immagini/bandiera-francese.gif" /></a><a href="prenotazioni.de.php"><img class="allineamento" width="68" height="43" title="Deutsch" alt="Deutsch" src="immagini/bandiera-tedesca.gif" /></a>	
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
	            <li><a id="activelink">Prenotazioni</a></li>
	            <li><a href="preventivo.it.php">Preventivi</a></li>
	            <li><a href="shuttle-airport.it.php">Shuttle-Aiport</a>
			        	<sup><img src="immagini/new.gif" alt="new" width="24px" 
			        	height="11px" /></sup></li>
			      <li><a href="meeting.it.php">Meeting</a>
	        	<sup><img src="immagini/new.gif" alt="new" width="24px" 
	        	height="11px" /></sup></li>
	        </ul>
				</div>
				<div id="menu-link">
					<h3>Turistic Link</h3>
				<ul>
					<li><a href="http://www.conero.it/">La Riviera del Conero</a></li>
					<li><a href="http://www.cadnet.marche.it/frasassi/">Le grotte di Frassassi</a></li>
				</ul>
					<h3>Business Link</h3>
				<ul>
					<li><a href = "http://www.ancona-airport.com/Default.asp" class="link" >
					Aeroporto Raffaello Sanzio</a></li>
					<li><a href = "europcar.it.php">Europcar</a></li>
				</ul>
				</div>
			</div>

		</div>
<div id = "colonna_centrale">
	<div id="contenuti"> 			
						
<?php
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
    $form->display('form/prenotazione-form.it.php') ;

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

$destinatario = 'info@ctftaxi.it' . ", " ;
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
?>



						
		</div> 
		
	</div>	
</div>
<?php
		include ("include/footer.inc.php")
		?>

</body>

</html>

