<?php
/*
Il footer
*/

$auguri_it =<<<EOF_AUGURI_IT
			<div id="babbo_natale">
				<p><b>Buone feste</b> dalla <img alt="ctf" title="C.T.F." src="immagini/ctf-logo-small.png" />
				<img alt="babbo natale" title="babbo natale" src="immagini/babbonatale2.gif" /></p>
			</div>
EOF_AUGURI_IT;

$auguri_en =<<<EOF_AUGURI_EN
			<div id="babbo_natale">
				<p><b>Merry Christmas and Happy New Year from</b> <img alt="ctf" title="C.T.F." src="immagini/ctf-logo-small.png" />
				<img alt="babbo natale" title="babbo natale" src="immagini/babbonatale2.gif" /></p>
			</div>
EOF_AUGURI_EN;


$footer=<<<EOF
	

	
		<div id="carte_di_credito">
				<p>The following credit cards are accepted:
				<img src="immagini/Visa.png" alt="Visa" title="Visa" width="53px" height="33px"/> 
				<img src="immagini/american_express.png" alt="American Express" width="53px" height="33px" 
				title="American Express"/> <img src="immagini/MasterCard.png" width="53px" height="33px" 
				title="Mastercard" alt="Mastercard"/> <img src="immagini/cartaSi.png" alt="CartaSi" 
				width="53px" height="33px" title="CartaSi"/>
				<img src="immagini/diners_club.png" alt="Diners Club International" 
				title="Diners Club International" width="53px" height="33px"/></p>						
		</div>		
<div id="footer">
				<a href="http://www.mozilla.org/products/firefox/central.html">
				<img class =" footer" width="60" height="60" alt="firefox-logo" title="a very good browser" src="immagini/firefox.png"/></a>
				<a href="http://bluefish.openoffice.nl/"><img class =" footer" width="88px" height="31px" alt="Made with Bluefish" title="Made with bluefish html-editor" src="immagini/bluefish.png" /></a>
				<!--
					Commento lo standard Xhtml fino a dopo le feste.
				<a href="http://validator.w3.org/check?uri=referer">
				<img class =" footer" width="88px" height="31px" alt="Valid XHTML 1.0!" 
				title="Valid XHTML 1.0!" src="immagini/valid-xhtml10.jpeg" /></a>
				-->
				<a href="http://jigsaw.w3.org/css-validator/validator?uri=http://www.ctftaxi.it"><img class =" footer" width="88px" height="31px" alt="Valid CSS!" title="Valid CSS!" src="immagini/valid-css.jpeg" /></a>

				<a href="mailto:webmaster@ctftaxi.it"><img class =" footer" title="webmaster@ctftaxi.it" alt="webmaster@ctftaxi.it" height="31px" width="54px" src="immagini/mail.png" /></a>
				<h4> &copy; 2005 - 2010 ctftaxi.it  P.IVA 02218920425</h4>	
				
				<p align = "left"><a href="stats/admin.php">stats</a> </p>
				
					
		</div>			
EOF;
		$file = basename($_SERVER['SCRIPT_NAME']) ;
		if(preg_match("/\w+\.(it)\.php/", $file, $regs)) {
			//echo " tana : $regs[1]";
			echo "$auguri_it $footer"; 	
		} else if(preg_match("/\w+\.(en)\.php/", $file, $regs)) {
			
			echo "$auguri_en $footer";
		} else {
			echo "$auguri_it $footer";
		}

		
?>
