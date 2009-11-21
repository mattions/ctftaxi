<?php
/*
File "it_error_const.inc.php"
*/

define('STR_TOO_LONG', '"%s" non pu&ograve; contenere più di %d caratteri' ) ;
define('STR_TOO_SHORT', '"%s" deve contenere almeno %d caratteri' ) ;
define('STR_BAD_RANGE', '"%s" deve contenere da %d a %d caratteri') ;
define('STR_BAD_LEN', '"%s" deve contenere %d caratteri') ;

define('ARR_TOO_LONG', '"%s" non pu&ograve; contenere più di %d elementi' ) ;
define('ARR_TOO_SHORT', '"%s" deve contenere almeno %d elementi' ) ;
define('ARR_BAD_RANGE', '"%s" deve contenere da %d a %d elementi') ;
define('ARR_BAD_LEN', '"%s" deve contenere %d elementi') ;

define('IS_REQUIRED', '"%s" &egrave; un campo obbligatorio') ;
define('BAD_PATTERN', 'Il contenuto di "%s" non corrisponde al formato richiesto') ;

define('NOT_NUM', '"%s" non contiene un numero valido') ;

define('NUM_BAD_RANGE', 'il valore di "%s" deve essere compreso tra %d e %d') ;

define('LACK_OF_ELEMENTS', '"%s" non contiene tutti gli elementi richiesti') ;


/*
Classe astratta per la gestione degli errori
*/
class AbstrErrHandler{

    var $errors ;

    
    function AbstrErrHandler()
    {
    
        $this->errors = array() ;
    
    }
    
    function isValid()
		{
        /*
        TRUE se 0 errori
        */
        return !(bool)count($this->errors) ;
    
    }
    
    function getError()
    {
    
        return array_shift($this->errors) ;
    
    }
    
    
		function getErrors()
		{
		
		    return $this->errors ;
		
		}    


}//END AbstrErrHandler

?>
