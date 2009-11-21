<?php
/*
File "en_error_const.inc.php"
*/

define('STR_TOO_LONG', '"%s" can not contain more than %d characters' ) ;
define('STR_TOO_SHORT', '"%s" must contain minimun %d characters' ) ; 
define('STR_BAD_RANGE', '"%s" must contain from %d to %d characters') ;
define('STR_BAD_LEN', '"%s" must contain %d characters') ;

define('ARR_TOO_LONG', '"%s" must not contain more than %d elements' ) ;
define('ARR_TOO_SHORT', '"%s" must contain minimun %d elements' ) ;
define('ARR_BAD_RANGE', '"%s" must contain from %d to %d elements') ;
define('ARR_BAD_LEN', '"%s" must contain %d elements') ;

define('IS_REQUIRED', '"%s" is required') ;
define('BAD_PATTERN', 'The content of "%s"  doesn\'t match with the required format') ;

define('NOT_NUM', '"%s" doesn\'t contain a number') ;

define('NUM_BAD_RANGE', 'the value of "%s" has to be  between %d and %d') ; 

define('LACK_OF_ELEMENTS', '"%s" doesn\'t contain all the required elements') ;


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
