</head>
<!-- Quella è la testa -->
<?php
	
		$file = basename($_SERVER['SCRIPT_NAME']) ;
		if(preg_match("/\w+\.(\w+)\.php/", $file, $regs)) {
			//echo " tana : $regs[1]";
			echo "<body lang=\"$regs[1]\">"; 	
		} else {
			//echo " niente tana" ;
			echo "<body lang=\"it\">";
		}
?>  
