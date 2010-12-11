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
<title>Consorzio Tassisti Falconara Marittima</title>
<link type="text/css" rel="stylesheet" href="mainstyle-2.css" media="screen"/>
<link type="text/css" rel="stylesheet" href="stile-stampa.css" media="print"/>
<link rel="icon" href="favicon.ico" type="image/x-icon" />
<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />

<!-- Introduco lo scriptino natalizio -->
<?php
	$natale = 1 ;
	if ($natale == 1) {
		include ("include/header.natalizio.inc.php");
	} else {
				include ("include/header.inc.php");
	}
?>
<!-- Quella &egrave; la testa -->

<body lang="fr">
<div id="header">
		<div id="logo">
		<img alt="C.T.F.Taxi" width="600px" height="208px" src="immagini/ctf-logo.png" />
		</div>
		
	</div>
<div id="contenitore">
	<div  id="bandiere">
		<a href="index.it.php"><img class="allineamento" width="68" height="43" title="Italiano" alt="Italiano" src="immagini/bandiera-italiana.gif" /></a><a href="index.en.php"><img class="allineamento" width="68" height="43" title="English" alt="English" src="immagini/bandiera-inglese.gif" /></a>
		<a href="index.fr.php"><img class="allineamento" width="68" height="43" title="Fran&ccedil;ais" alt="Fran&ccedil;ais" src="immagini/bandiera-francese.gif" /></a><a href="index.de.php"><img class="allineamento" width="68" height="43" title="Deutsch" alt="Deutsch" src="immagini/bandiera-tedesca.gif" /></a>
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
	            <li><a href="prenotazioni.fr.php">R&eacute;servation</a></li>
	            <li><a href="preventivo.fr.php">Devis</a></li>
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
					<p>Visitateurs on-line</p><p><script type="text/javascript" src="http://www.ctftaxi.it/stats/view_stats.js.php?mode=0"></script></p>
					<p>N&deg; de visitateurs</p><p><script type="text/javascript" src="http://www.ctftaxi.it/stats/view_stats.js.php?mode=3">Visitatori totali</script></p>
			</div>
		</div>
	<div id = "colonna_centrale">
		<div id="contenuti">
			<div id="promozione">
				<p>La promozione ora non c'&egrave;</p>
			</div>
			<div id="presentazione">
			
				<h1>Taxi Ancona Falconara aeroport</h1>
					<p>La <img alt="ctf" src="immagini/ctf-logo-small.png" />est un <strong>nouveau service</strong> &agrave; disposition de clients priv&eacute;s et entrepreneurs 
					<strong>pour le transport</strong> de personnes et de petits volumes.</p>
					<p>Nous avons une large gamme de voitures allant de la monovolume version business &agrave; la berline version confort et luxe sans 
						oublier les station wagons &agrave; grande commodit&eacute;.</p>

				<h1>O&ugrave; nous trouvons-nous?</h1>
					<p>Notre base est &agrave; l'<a href = "http://www.ancona-airport.com/Default.asp" class="link" >a&eacute;roport</a> de Falconara Marittima, &agrave; 20 Km de Ancona</p>
					<p>&Agrave; partir de la notre base il est possible d'arriver facilement aux <b>principales destinations touristiques</b> de la r&eacute;gion (et m&ecirc;me limitrophes) et de visiter les principales installations 
					productives et industrielles des cinq principales provinces des Marches.</p>

					<h1>Contacts</h1>
					<div id = "contatti">	
							<table>
							<tr>
								<td class = "contatti"><img alt="telefono" title="telefono" width="108" 
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
								<td class = "contatti"><img alt="R&eacute;servation" title="R&eacute;servation" 
								width="152" height="35" src="immagini/auto_text.png" /></td>
								<td><p><a href="prenotazioni.it.php">R&eacute;servation</a></p></td>
								
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
