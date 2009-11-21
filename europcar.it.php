<!DOCTYPE html
PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
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
		<a href="europcar.it.php"><img class="allineamento" width="68" height="43" title="Italiano" 
		alt="Italiano" src="immagini/bandiera-italiana.gif" /></a>
		<a href="index.en.php"><img class="allineamento" width="68" height="43" title="English" 
		alt="English" src="immagini/bandiera-inglese.gif" /></a>
		<a href="europcar.fr.php"><img class="allineamento" width="68" height="43" title="Français" 
		alt="Français" src="immagini/bandiera-francese.gif" /></a><a href="europcar.de.php"><img class="allineamento" width="68" height="43" title="Deutsch" alt="Deutsch" src="immagini/bandiera-tedesca.gif" /></a>
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
					<li><a id="activelink" href = "europcar.it.php">Europcar</a></li>
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
			<div id="presentazione">
				<p><img src="immagini/logo_europcar.jpg" alt="Europcar" title ="europcar" 
				width="253px" height="73px"/></p>
				<!-- 
					<div class="Prima_Lettera_Intestazioni">
					E
			</div>
				<h1>uropcar</h1>
				 -->
				
				
					<p>Per noleggiare mezzi o automobili potete rivolgervi a </p>
							<h5>Marco -- Sede Aereoporto Raffaello Sanzio</h5>
							<table>
							<tr>
								<td class = "contatti">
								<img alt="telefono" title="telefono" width="50" 
								height="39" src="immagini/phone.png" /></td>
								<td class = "contatti">
								<p>071 91 62 240</p>
								</td>
							</tr>
							<tr>
								<td class = "contatti">
								<img alt="fax" title="fax" width="50" height="62" 
								src="immagini/fax.png" /></td>
								<td class = "contatti"><p>071 20 31 00</p></td>
							</tr>
							</table>
							
							<h5>Massimo -- Sede Stazione F.S. Ancona</h5>
							
							<table>
							
							<tr>
								<td class = "contatti">
								<img alt="telefono" title="telefono" width="50" 
								height="39" src="immagini/phone.png" /></td>
								<td class = "contatti">
								<p>071 20 31 00</p>
								</td>
							</tr>
							<tr>
								<td class = "contatti">
								<img alt="fax" title="fax" width="50" height="62" 
								src="immagini/fax.png" /></td>
								<td class = "contatti"><p>071 43 097</p></td>
							</tr>
							</table>
			</div>
		</div>
</div>
<?php
		include ("include/footer.inc.php")
		?>
<?php
 include ("include/to_cool_for_IE.inc.php")
 ?>
</body>

</html>