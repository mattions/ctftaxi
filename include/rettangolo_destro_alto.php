
<?php
/*
	Questo file viene incluso su ogni pagina.
	E' il rettangolo destro alto
	Ogni modifica fatta qui si ripercuote su tutte le
	pagine -- speriamo -- :)
*/
$giorno = date(" j F Y ");
$spaziatore = "<br/>";
$formattazione = "<div id = \"orario\">";
$formattazione_fine = "</div>";
$ora = date (" H:m:s "); 
$time_ok =  $formattazione . $giorno . $spaziatore . $ora . $formattazione_fine ;
?>
<?php
$rettangolo_destro_alto_prima_parte=<<<EOF
<div id = "banner">
			<div class = "banner_piccolo">
				<div id ="rettangolo_destro">
					<div id = "rettangolo_alto_dx">
						
EOF;
				
$rettangolo_destro_alto_seconda_parte=<<<EOF2
		
		<div class = "ogni_banner">
			<a target="_blank" href="http://www.infotaxi.org/"><img 
			width="100" height="44" title="Worldwide Taxi Service -- Find a taxi anywhere in the world" 
			alt="infotaxi homepage" src="immagini/info-taxi2.png" /></a>
		</div>
		<div class = "ogni_banner">
			<a target="_blank" href="hotel.it.php"><img 
			width="100" height="33" title="Our choose" 
			alt="Hotel " src="immagini/hotels.png" /></a>
		</div>
		<div class = "ogni_banner">
			<a target="_blank" href="http://www.taxihelp.com/"><img 
			width="100" height="35" title="Our choose" 
			alt="Hotel " src="immagini/taxi_help_logo.png" /></a>
		</div>
		<div class = "ogni_banner">
			<a target="_blank" href="http://www.anconanetwork.it/"><img 
			width="100" height="35" title="Our choose" 
			alt="Hotel " src="immagini/anconaNetwork.jpeg" /></a>
		</div>
		<div class = "ogni_banner">
			<a target="_blank" href="http://www.essentiarelais.it/"><img 
			width="100" height="35" title="Our choose" 
			alt="Hotel " src="immagini/Essentia_relais_logo_small.jpg" /></a>
		</div>
		<div class = "ogni_banner">
			<!-- INSERISCI QUESTA TAG NELLA POSIZIONE DESIDERATA DELL'AREA ANNUNCIO Banner1Dx180x150 -->
			<script type="text/javascript">
			  GA_googleFillSlot("Banner1Dx180x150");
			</script>
			<!-- FINE TAG PER AREA Banner1Dx180x150 -->
		</div>
		
						</div>
					</div>
			</div>
		</div>
EOF2;

/*
Inserire i banner subito dopo EOF2
ecco un esempio x i nostri
<a href="www.ctftaxi.it"><img 
			width="160" height="30" title="ctfTaxi Prenota il tuo taxi" 
			alt="ctftaxi homepage" src="banner/ctf-banner-1.png" /></a>
			<br/>
			<a href="www.ctftaxi.it"><img 
			width="160" height="30" title="ctfTaxi Prenota il tuo taxi" 
			alt="ctftaxi homepage" src="banner/ctf-banner-2.png" /></a>
			<br/>
			<a href="www.ctftaxi.it"><img 
			width="160" height="30" title="ctfTaxi Prenota il tuo taxi" 
			alt="ctftaxi homepage" src="banner/ctf-banner-3.png" /></a>
*/

$rettangolo_destro_alto = $rettangolo_destro_alto_prima_parte .
	$time_ok . $rettangolo_destro_alto_seconda_parte ;
echo $rettangolo_destro_alto;

?>