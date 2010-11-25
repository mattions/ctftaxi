<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-type" lang="english" content="text/html; charset=utf-8" />
<meta name="description" content="Il tuo taxi a Falconara Marittima" />
<meta name="keywords" content="taxi aereoporto falconara marittima ancona servio pubblico mezzo trasporto spostamento itinerario auto macchina treno autobus  " />
<title>Consorzio Tassisti Falconara Marittima -- TAXI FALCONARA ANCONA</title>
<link type="text/css" rel="stylesheet" href="stile-stampa.css" media="print"/>
<link type="text/css" rel="stylesheet" href="mainstyle-2.css" />


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
	            <li><a href="prenotazioni.en.php">Reservation</a></li>
	            <li><a href="preventivo.en.php">Estimate</a></li>
	            <li><a href="shuttle-airport.en.php">Shuttle-Aiport</a>
	        	<sup><img src="immagini/new.gif" alt="new" width="24px" 
	        	height="11px" /></sup></li>
	        		<li><a href="meeting.en.php">Meeting</a>
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
					<li><a href = "europcar.en.php">Europcar</a></li>
				</ul>
				</div>
			</div>
			<div id="contatori">
				<!-- Contatori -->
							<?php
								define('__PHP_STATS_PATH__','/web/htdocs/www.ctftaxi.it/home/stats/');
								include(__PHP_STATS_PATH__.'php-stats.redir.php');
							?>
					<p>On-line users</p><p><script type="text/javascript" src="http://www.ctftaxi.it/stats/view_stats.js.php?mode=0"></script></p>
					<p>Number of visitors</p><p><script type="text/javascript" src="http://www.ctftaxi.it/stats/view_stats.js.php?mode=3">Visitatori totali</script></p>
			</div>
		</div>
	<div id = "colonna_centrale">
		<div id="contenuti">
			<div id="presentazione">

				<h1>Taxi Ancona Falconara airport</h1>
					<p>The <img alt="ctf" src="immagini/ctf-logo-small.png" /> is a <strong>new service</strong> for private and business customers<strong> for the transport</strong> of people and small volumes.</p> 
					<p>In our fleet there are monovolumes, stations-wagon and also comfortable sedan.</p>

				<h1>Where do you find us ?</h1>
					<p>Our base is at the <a href = "http://www.ancona-airport.com/Default.asp" class="link" >airport</a> of Falconara Marittima, 20 Kms far from Ancona. </p>
					<p>From our base it is possible to reach in an easy way the principal <b>tourist goals</b> and also the principal factories of the region. </p>

					<h1>Contacts</h1>
						<div id = "contatti">	
							<table>
							<tr>
								<td class = "contatti"><img alt="telefono" title="telefono" width="108" 
									height="52" src="immagini/phone_text.png" /></td>
								<td class = "contatti"><p>334-1548899</p><p>071-9189531</p></td>
								<td class = "contatti"><img alt="fax" title="fax" width="64" height="28" 
									src="immagini/fax_text.png" /></td>
								<td class = "contatti"><p>071-9157034</p></td>
							</tr>
							<tr>
								<td class = "contatti"><img alt="e-mail" title="e-mail" width="98" 
									height="28" 
									src="immagini/mail_text.png" /></td>
								<td><p><a href="mailto:info@ctftaxi.it">info@ctftaxi</a></p></td>
								<td class = "contatti"><img alt="Reservation!!!" title="Reservation!!!" 
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
