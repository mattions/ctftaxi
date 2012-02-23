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
<!-- Quella è la testa -->

<body lang="de">
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
	            <li><a href="prenotazioni.de.php">Bestellung</a></li>
	            <li><a href="preventivo.de.php">Kostenvoranschlag</a></li>
	            <li><a href="shuttle-airport.de.php">Shuttle-Aiport</a>
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
			
				<h1>Taxi Ancona Falconara flughafen</h1>
					<p>Das <img alt="ctf" src="immagini/ctf-logo-small.png" />ist ein <strong>neuer Service</strong> für Privat-und Betriebskunden für den Transport von Personen und kleinen Mengen.</p>
					<p>Wir bieten eine grosse Auswahl von Autos, vom Minivan in der Ausführung Business bis zur Limousine in der Ausführung Comfort und Luxus ohne die praktischen und geräumigen Station-wagon auszuschliessen.</p>
				<h1>Wo befinden wir uns?</h1>
					<p>Unsere Haupstelle ist am <a href = "http://www.ancona-airport.com/Default.asp" class="link" >Flughafen</a> von Falconara Marittima, ungefähr 20 Km von Ancona entfernt</p>
					<p>Unsere Hauptstelle liegt ganz in der Nähe von <b>den turistischen Zielen</b> der Region ( und angrenzenden)  und auch von den Produktions-und Industrielagern der fünf Hauptprovinzen der Region.</p>
				
						<h1>Kontakte</h1>
					<div id = "contatti">	
							<table>
							<tr>
								<<td class = "contatti"><img alt="telefono" title="telefono" width="108" 
									height="52" src="immagini/phone_text.png" /></td>
								<td class = "contatti"><p>+39 334 1548899</p><p>+39 071 9189531</p></td>
								<td class = "contatti"><img alt="fax" title="fax" width="64" height="28" 
									src="immagini/fax_text.png" /></td>
								<td class = "contatti"><p>+39 071 9157034</p></td>
							</tr>
							<tr>
								<td class = "contatti"><img alt="e-mail" title="e-mail" width="98" 
									height="28" 
									src="immagini/mail_text.png" /></td>
								<td><p><a href="mailto:info@ctftaxi.it">info@ctftaxi</a></p></td>
								<td class = "contatti"><img alt="Bestellung" title="Bestellung" 
									width="152" height="35" src="immagini/auto_text.png" /></td>
								<td><p><a href="prenotazioni.de.php">Bestellung</a></p></td>
								
							</tr>
								
							</table>
						</div>
				</div>
			</div>
			
		</div>
</div>
<?php
			include ("include/footer.inc.php")
			?>

</body>

</html>
