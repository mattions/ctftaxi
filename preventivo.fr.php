<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-type" lang="italiano" content="text/html; charset=utf-8" />
<meta name="description" content="Il tuo taxi a Falconara Marittima" />
<meta name="keywords" content="taxi aereoporto falconara marittima ancona servio pubblico 
	mezzo trasporto spostamento itinerario auto macchina treno autobus consorzio " />
<title>Consorzio Tassisti Falconara Marittima -- Preventivo -- TAXI FALCONARA ANCONA</title>
<link type="text/css" rel="stylesheet" href="mainstyle-2.css" media="screen"/>
<link type="text/css" rel="stylesheet" href="stile-stampa.css" media="print"/>
</head>
<!-- Quella &egrave; la testa -->

<body lang="fr">
	<div id="header">
			<div id="logo">
				<img alt="C.T.F.Taxi" width="600px" height="208px" src="immagini/ctf-logo.png" />
			</div>

	</div>
<div id="contenitore">
		<div  id="bandiere">
			<a href="preventivo.it.php"><img class="allineamento" width="68" height="43" title="Italiano" alt="Italiano" src="immagini/bandiera-italiana.gif" /></a><a href="preventivo.en.php"><img class="allineamento" width="68" height="43" title="English" alt="English" src="immagini/bandiera-inglese.gif" /></a>
			<a href="preventivo.fr.php"><img class="allineamento" width="68" height="43" title="Fran&ccedil;ais" alt="Fran&ccedil;ais" src="immagini/bandiera-francese.gif" /></a><a href="preventivo.de.php"><img class="allineamento" width="68" height="43" title="Deutsch" alt="Deutsch" src="immagini/bandiera-tedesca.gif" /></a>
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
	            <li><a href="index.fr.php" >Home</a></li>
	            <li><a href="prenotazioni.fr.php">R&eacute;servation</a></li>
	            <li><a id="activelink">Devis</a></li>
	            <li><a href="shuttle-airport.fr.php">Shuttle-Aiport</a>
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
					<li><a href = "http://www.ancona-airport.com/Default.asp" class="link" >Aeroporto Raffaello Sanzio</a></li>
				</ul>
				</div>
			</div>
			<div id="contatori">
				<!-- Contatori -->
							<?php
								define('__PHP_STATS_PATH__','/web/htdocs/www.ctftaxi.it/home/stats/');
								include(__PHP_STATS_PATH__.'php-stats.redir.php');
							?>
					<p>Visitateurs on-line</p><p><script type="text/javascript" src="http://www.ctftaxi.it/stats/view_stats.js.php?mode=0"></script></p>
					<p>N&deg; de visitateurs</p><p><script type="text/javascript" src="http://www.ctftaxi.it/stats/view_stats.js.php?mode=3">Visitatori totali</script></p>
			</div>
		</div>
	<div id = "colonna_centrale">
		<div id="contenuti">
			<div id="presentazione">
			
				<h1>Calculez votre devis</h1>
					<p>La <img alt="ctf" src="immagini/ctf-logo-small.png" />, toujours attentive aux exigences de ses clients, a decid&eacute; de leurs donner la possibilit&eacute; 
					de calculer le devis de leur voyage.</p>
					<p>V&eacute;rifier si votre voyage est un des voyages plus demand&eacute;s de nos clients. Ceci est possible en choisissant simplement le menu.</p>
					<p>Si votre voyage ne fait pas part de ces voyages, n'h&eacute;sitez pas &agrave; nous envoyer une e-mail afin d'obtenir un devis <b>gratuit et sans engagement</b> <a href="mailto:info@ctftaxi.it">info@ctftaxi</a>.</p>
					<p>Le devis propos&eacute; est compris entre une valeur maximale et minimale selon la variabilit&eacute; des conditions de trafic.</p>

<?php
/*
Inclusione delle varie classi
*/
include_once('form/fr_error_const.inc.php') ;
include_once('form/regole.php') ;
include_once('form/tipi.php') ;
include_once('form/form_handler.php') ;

/*
In produzione sopprimiamo gli invevitabili notice sui campi che ancora non esistono
*/
error_reporting(E_ALL ^ E_NOTICE) ;

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

$fields['preventivo'] = new FrmFieldSet( $_REQUEST['preventivo'], 'Calcola il tuo preventivo', true ) ;

/*
Regole che incrociano i campi
*/

$form = new SmartForm('invia', $fields, $cross) ;

/*
Se il form non &egrave; stato inviato o &egrave; inviato ma ci sono errori
*/
if( !$form->isSent || !$form->isValid() )
{
    /*
		Mostra il form ed eventuali errori
		*/
    $form->display('form/preventivo-form.fr.php') ;

}

//Se invece &egrave; tutto ok
//elabora i dati inviati
else { 

// Tutti i preventivi inclusi in un unico file per migliore manutenzione codice.

	//Parte uguale per tutti i preventivi riorganizzata.
	
	// Prezzi inclusi per aggiornarli una volta sola.
	include("include/prezzi.inc.php");
	
	if ($_POST['preventivo'] == 'Stazione F.S. Falconara Marittima')
{
#Variabile all'interno della quale inserisco il prezzo
	$prezzo = $Staz_Falc_Mar ;
	
}

else if ($_POST['preventivo'] == 'Stazione F.S. Ancona')
{

	$prezzo = $Staz_Ancona ;

}

else if ($_POST['preventivo'] == 'Ancona Centro')
{

	$prezzo = $Ancona_Centro ;

}

else if ($_POST['preventivo'] == 'Ancona Porto')
{

	$prezzo = $Ancona_Porto ;

}

else if ($_POST['preventivo'] == 'Ancona Hotel')
{

	$prezzo = $Ancona_Alberghi ;

}

else if ($_POST['preventivo'] == 'Ancona Baraccola')
{

	$prezzo = $Ancona_Baraccola ;

}



else if ($_POST['preventivo'] == 'Portonovo')
{

	$prezzo = $Portonovo ;

}

else if ($_POST['preventivo'] == 'Numana')
{

	$prezzo = $Numana ;

}

else if ($_POST['preventivo'] == 'Hotel Monteconero')
{

	$prezzo = $Hotel_Monteconero ;

}

else if ($_POST['preventivo'] == 'Sirolo')
{

	$prezzo = $Sirolo ;

}

else if ($_POST['preventivo'] == 'Loreto')
{

	$prezzo = $Loreto ;

}

else if ($_POST['preventivo'] == 'Porto Recanati')
{

	$prezzo = $Porto_Recanati ;

}

else if ($_POST['preventivo'] == 'Recanati')
{

	$prezzo = $Recanati ;

}


else if ($_POST['preventivo'] == 'Civitanova Marche')
{

	$prezzo = $Civitanova_Marche ;

}

else if ($_POST['preventivo'] == 'Porto Sant Elpidio')
{

	$prezzo = $Porto_Sant_Elpidio ;

}

else if ($_POST['preventivo'] == 'Macerata')
{

	$prezzo = $Macerata ;

}

else if ($_POST['preventivo'] == 'Jesi Centro')
{

	$prezzo = $Jesi_Centro ;

}

else if ($_POST['preventivo'] == 'Zona Z.I.P.A.')
{

	$prezzo = $Zona_Z_I_P_A ;

}

else if ($_POST['preventivo'] == 'Jesi Hotel Federico II')
{

	$prezzo = $Alberghi_Jesi ;

}

else if ($_POST['preventivo'] == 'Senigallia Alberghi Centro')
{

	$prezzo = $Senigallia_Alberghi_Centro ;

}

else if ($_POST['preventivo'] == 'Senigallia Alberghi Ponente')
{

	$prezzo = $Senigallia_Alberghi_Ponente ;

}

else if ($_POST['preventivo'] == 'Senigallia Alberghi Levante')
{

	$prezzo = $Senigallia_Alberghi_Levante ;

}

else if ($_POST['preventivo'] == 'Fano Centro')
{

	$prezzo = $Fano_Centro ;

}

else if ($_POST['preventivo'] == 'Fano Alberghi')
{

	$prezzo = $Fano_Alberghi ;

}

else if ($_POST['preventivo'] == 'Fano Zona Industriale')
{

	$prezzo = $Fano_Zona_Industriale ;

}

else if ($_POST['preventivo'] == 'Pesaro Centro')
{

	$prezzo = $Pesaro_Centro ;

}

else if ($_POST['preventivo'] == 'Pesaro Alberghi')
{

	$prezzo = $Pesaro_Alberghi ;

}

else if ($_POST['preventivo'] == 'Pesaro Zona Industriale')
{

	$prezzo = $Pesaro_Zona_Industriale ;

}
echo ("<h1>Devis :</h1>Le prix de l'<b>A&eacute;roport Raffaello 
	Sanzio de Falconara</b> &agrave; <b>"  . $_POST['preventivo'] . "</b> est <div id=\"prev_risp\">" . $prezzo . "</div>");

}

?>
					
		</div>	
		</div>
		
	</div>	
</div>
<?php
		include ("include/footer.inc.php")
		?>
		
</body>

</html>

