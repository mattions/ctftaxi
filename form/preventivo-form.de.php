<?php
/*
File preventivo-form.it.php
Contiene il file del form per il preventivo.
*/



	    $errors = $FORM->getErrors() ;
	
	    if( !empty($errors) )
		{
		    echo "<br><br>" ;
		    echo( join("<br>\r\n" ,  $errors) ) ; 
			echo "<br><br>" ;   
		
		}
	
?>
	 <!-- Form preventivo -->
	 <form action="preventivo.de.php" method="post" name="Preventivo">
	 <table>
	 <tr>
		<td class="Campo">Kostenvoranschlag!</td>
		</tr>
	<tr>	
		<td>
			<?php
				include("preventivo.inc.php");
			?>  
		</td>
			<td>
				<input class = "formatta_bottoni" name="invia" type="submit" />  
			</td>
	</tr>
</table>
</form>