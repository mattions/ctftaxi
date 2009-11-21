<SCRIPT LANGUAGE="JavaScript" SRC="javascript/snow.js"></SCRIPT>

<SCRIPT LANGUAGE="JavaScript">
function snow()
{
	Falling(5,"<img src=\"javascript/fiocco.gif\" width=\"25\" height=\"25\">", 10);
	Falling(30,"<FONT SIZE='3' FACE='Verdana' COLOR='#CCCCCC'>*</FONT>", 10);	   
	}
</SCRIPT>

</head>
<!-- Quella è la testa -->
<?php
	
		$file = basename($_SERVER['SCRIPT_NAME']) ;
		if(preg_match("/\w+\.(\w+)\.php/", $file, $regs)) {
			//echo " tana : $regs[1]";
			echo "<body lang=\"$regs[1]\" onLoad=\"snow()\">"; 	
		} else {
			//echo " niente tana" ;
			echo "<body lang=\"it\" onLoad=\"snow()\">";
		}
?>
