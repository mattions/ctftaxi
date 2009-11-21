
	//Parte uguale per tutti i preventivi riorganizzata.
	
	// variabili per una migliore editing del codice.
	
	$Staz_Falc_Mar = '13,00 €' ;
	$Staz_Ancona = '30,00 €' ;
	$Ancona_Centro = '33,00 € - 36,00 €';
	$Ancona_Porto = '33,00 € - 36,00 €'; 
	$Ancona_Alberghi = '33,00 € - 36,00 €';
	$Portonovo = '50,00 € - 55,00 €';
	$Numana = '55,00 € - 60,00 €';
	$H_Monteconero = '55,00 € - 60,00';	
	$Sirolo = '55,00 € - 60,00 €';
	
	$Loreto = '60,00 € - 65,00 €';
	$Porto_Recanati = '60,00 € - 65,00 €';
	$Recanati = '62,00 € - 68,00';
	$Civitanova_Marche = '80,00 € - 85,00 €';
	$Porto_Sant_Elpidio = '83,00 € - 88,00 €';
	$Macerata = '75,00 € - 85,00 €';
	
	$Jesi_Centro = '28,00 € - 33,00 €';
   $Zona_Z_I_P_A = '26,00 € - 31,00 €';
   $Alberghi_Jesi = '26,00 € - 31,00 €';

   $Senigallia_Alberghi_Ponente = '37,00 € - 40,00 €';
   $Senigallia_Alberghi_Levante = '35,00 € - 38,00 €';   
   $Senigallia_Alberghi_Centro = '35,00 € - 38,00 €'; 
	
	$Fano_Centro = '70,00 € - 75,00 €';
	$Fano_Alberghi = '70,00 € - 75,00 €';
	$Fano_Zona_Industriale = '70,00 € - 75,00 €';
	
	$Pesaro_Centro = '85,00 € - 90,00 €';
	$Pesaro_Alberghi = '85,00 € - 90,00 €';
	$Pesaro_Zona_Industriale = '88,00 € - 95,00 €';
	
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

else if ($_POST['preventivo'] == 'Ancona Alberghi')
{

	$prezzo = $Ancona_Alberghi ;

}
else if ($_POST['preventivo'] == 'Portonovo')
{

	$prezzo = $Portonovo ;

}

else if ($_POST['preventivo'] == 'Numana')
{

	$prezzo = $Numana ;

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

else if ($_POST['preventivo'] == 'Civitanova Marche')
{

	$prezzo = $Civitanova_Marche ;

}

else if ($_POST['preventivo'] == 'Porto Sant Elpidio')
{

	$prezzo = $Porto_Sant_Elpidio ;

}

else if ($_POST['preventivo'] == 'Jesi Centro')
{

	$prezzo = $Jesi_Centro ;

}

else if ($_POST['preventivo'] == 'Zona Z.I.P.A.')
{

	$prezzo = $Zona_Z_I_P_A ;

}

else if ($_POST['preventivo'] == 'Alberghi Jesi')
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

echo ("<h1>Estimate :</h1> The price of the trip from the <b>Airport Raffaello 
	Sanzio of Falconara</b> to <b>"  . $_POST['preventivo'] . "</b> is <div id=\"prev_risp\">" . $prezzo . "</div>");
