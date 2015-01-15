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
<title>Consorzio Tassisti Falconara Marittima -- TAXI FALCONARA ANCONA</title>
<link type="text/css" rel="stylesheet" href="mainstyle-2.css" media="screen"/>
<link type="text/css" rel="stylesheet" href="stile-stampa.css" media="print"/>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

<!-- Introduco lo scriptino natalizio -->
<?php
	$natale = 0 ;
	if ($natale == 1) {
		include ("include/header.natalizio.inc.php");
	} else {
				include ("include/header.inc.php");
	}
?>
<div id="header">
		<div id="logo">
		<img alt="C.T.F.Taxi" width="600px" height="208px" src="immagini/ctf-logo.png" />
		</div>
		
	</div>
<div id="contenitore">
	<div  id="bandiere">
		<a href="index.it.php"><img class="allineamento" width="68" height="43" title="Italiano" alt="Italiano" src="immagini/bandiera-italiana.gif" /></a><a href="index.en.php"><img class="allineamento" width="68" height="43" title="English" alt="English" src="immagini/bandiera-inglese.gif" /></a>
		<a href="index.fr.php"><img class="allineamento" width="68" height="43" title="Français" alt="Français" src="immagini/bandiera-francese.gif" /></a><a href="index.de.php"><img class="allineamento" width="68" height="43" title="Deutsch" alt="Deutsch" src="immagini/bandiera-tedesca.gif" /></a>
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
	            <li><a id="activelink">Home</a></li>
	            <li><a href="prenotazioni.it.php">Prenotazioni</a></li>
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
				<div id="presentazione">
					<h1 >Taxi Ancona Falconara aeroporto</h1>
						<p>La <img alt="ctf" title="C.T.F." src="immagini/ctf-logo-small.png" /> &egrave; un <strong>servizio</strong> a disposizione di utenti privati ed aziendali <strong>per il trasporto</strong> di persone e piccoli volumi.</p> 
						<p>Offriamo una vasta gamma di mezzi che vanno dalla monovolume versione business alla berlina comfort e di lusso senza escludere le comode e spaziose station wagon.</p>
					<h1 >Dove ci trovi</h1>
						<p>La nostra sede &egrave; sita presso 
						<a href = "http://www.ancona-airport.com/Default.asp" class="link" >l'aeroporto</a> 
						di Falconara Marittima, a circa 20 Km da Ancona</p>
						<p>Dalla nostra sede si possono raggiungere facilmente le principali <b>mete turistiche</b> della regione ( e limitrofe) ed anche i maggiori insediamenti e distretti produttivi ed industriali delle cinque province marchigiane</p>
								
							<h1 >Contatti</h1>
						<div id = "contatti">	
								<table>
								<tr>
									<td class = "contatti"><img alt="telefono" title="telefono" width="108" 
									height="52" src="immagini/phone_text.png" /></td>
									<td class = "contatti"><p>+39 334 1548899</p><p>+39 071 9189531</p></td>
									<td class = "contatti"><img alt="fax" title="fax" width="64" height="28" 
									src="immagini/fax_text.png" /></td><td class = "contatti"><p>+39 071 9157034</p></td>
								</tr>
								<tr>
									<td class = "contatti"><img alt="e-mail" title="e-mail" width="98" 
									height="28" 
									src="immagini/mail_text.png" /></td>
									<td><p><a href="mailto:info@ctftaxi.it">info@ctftaxi</a></p></td>
									<td class = "contatti"><img alt="Prenota il tuo taxi" title="Prenota il tuo taxi!!!" 
									width="152" height="35" src="immagini/auto_text.png" /></td>
									<td><p><a href="prenotazioni.it.php">Prenotazioni</a></p></td>
									
								</tr>
									
								</table>
						</div>
				</div>
			</div>
			
		</div>
</div>
	<?php
			if ($natale == 1) {
				include ("include/footer.natalizio.inc.php");
			} else {
				include ("include/footer.inc.php");
			}			
	?>
			
</body>

</html>
