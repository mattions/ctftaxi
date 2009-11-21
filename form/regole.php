<?php
/*
Classe astratta, definisce il modello da cui deriveranno tutte le altre regole
*/
class AbstractRule extends AbstrErrHandler
{
     /*
     Contiene i messaggi di errore
     */
     var $errors  = array() ;

     /*
     costruttore
     */
     function AbstractRule()
     {
     
         parent::AbstrErrHandler() ;
     
     }

     /*
     Effettua il parsing alla caccia di errori
     riceve come argomenti il valore e l'etichetta del campo
     */
     function check($val, $label)
     {
     }

}//end class

/*
Verifica la lunghezza di una stringa
*/
class StrRangeRule extends AbstractRule
{
    /*
    la lunghezza massima e quella minima
    */
    var $min ;
    var $max ;

    function StrRangeRule($min, $max)
    {
        parent::AbstractRule() ;

        $this->min = $min ;
        $this->max = $max ;

    }

    /*
    Verifica che il campo contenga una stringa compresa entro un certo range di caratteri
    */
    function check($val, $label)
    {

        $val = trim($val) ;
        $len =  strlen($val) ;

        
        if($this->min == $this->max)
        {
            if((bool)$this->min)
						{
						
						    /*
						    Il valore non è 0
						    il controllo non è disabilitato
								*/ 
								$this->checkFixedLen($len, $label) ;   
						
						}
				
				    /*
				    Il valore è 0 
						il controllo disabilitato
				    */
				    return ;
				
				}
				elseif( $this->min == 0 )
        {   
            /*
            E' necessario verificare solo max
            */
            $this->checkMax($len, $label) ;

        }
        elseif( $this->max == 0 )
        {   
            /*
            E' necessario verificare solo min
            */
            $this->checkMin($len, $label) ;

        }
        else
				{   
            /*
            E' necessario verificare entrambi
            */
            $this->checkBoth($len, $label) ;
        
        }


    }//end check

    function checkMin($len, $label)
    {

        if($len < $this->min)
        {

            $this->errors[] = sprintf(STR_TOO_SHORT, $label, $this->min) ;

        }

    }//end checkMin

    function checkMax($len, $label)
    {

        if($len > $this->max)
        {

             $this->errors[] = sprintf(STR_TOO_LONG, $label, $this->max)  ;

        }

    }//end checkMax

    function checkBoth($len, $label)
    {

       if($len < $this->min || $len > $this->max)
       {

           $this->errors[] = sprintf(STR_BAD_RANGE, $label, $this->min, $this->max) ;

       }


    }//end checkBoth
    
    function checkFixedLen($len, $label)
    {
		    
		   if( $len != $this->min )
       { 
		    
		       $this->errors[] = sprintf(STR_BAD_LEN, $label, $this->min) ;
		    
		   }
		
		}//end checkFixed



}//end class


/*
Verifica la corrispondenza a un pattern
*/
class PatternRule extends AbstractRule
{

    var $regex ;

    function PatternRule($regex)
    {

        parent::AbstractRule() ;

        $this->regex = $regex ;

    }


    function check($val, $label)
    {

         $val = trim($val) ;

         if( !preg_match($this->regex, $val) )
         {

             $this->errors[] = sprintf(BAD_PATTERN, $label) ;

         }

    }



}//end class



/*
Verifica se un campo è di tipo numerico
*/
class IsNumericRule extends AbstractRule
{
     /*
     Costruttore
     */
     function isNumericRule(){
         
         /*
         Costruttore della classe genitore astratta         
				 */
         parent::AbstractRule() ;

     }

     function check($val, $label)
     {

         if( !is_numeric($val) )
         {

             $this->errors[]  = sprintf(NOT_NUM, $label) ;

         }

     }

}//end class

/*
Verifica il valore umerico di un campo è compreso in un dato range
*/
class NumRangeRule extends IsNumericRule
{

    /*
    il valore massimo e quello minimo
    */
    var $min ;
    var $max ;


    function NumRangeRule($min, $max){

        parent::IsNumericRule() ;

        $this->min = $min ;
        $this->max = $max ;

    }

    function check($val, $label)
    {

        parent::check($val, $label) ;

        if( $this->isValid() && ( $val < $this->min || $val > $this->max ) )
        {

            $this->errors[] = sprintf(NUM_BAD_RANGE, $label, $this->min, $this->max) ;

        }

    }


}//end class

/*
Verifica se il contenuto di un campo fa parte di una lista predefinita di valori
*/
class InListRule extends AbstractRule
{

    var $list ;

    function InListRule($arrValues)
    {
    	
    	parent::AbstractRule() ;
    	
    	$this->list = $arrValues ;
    	
    }
    
    function check($val, $label, $strict = false)
    {
    
        if( !in_array($val, $this->list, $strict) ){
                                          	
            $this->errors[] =  sprintf(NOT_IN_LIST, $label) ;
            	
        }

    }//end function check

}//end class

/*
Verifica se un stringa ne contiene un'altra
*/
class ContainsRule extends AbstractRule{

    function ContainsRule($startStr)
    {
    
        parent::AbstractRule() ;
        
        $this->str  = strtolower($startStr) ;
    
    }
    
    
    function check($val, $label)
    {
    
    
        $pos = strpos( strtolower($val), strtolower($this->str) ) ;
    
        if( $pos === false )
        {
        
            $this->errors[] = sprintf(CONTAIN_ERR, $label, $this->str) ;            
        
        }
        
    }    
  

}//END class

/*
Verifica se un stringa inizia con un'altra
*/
class StartsWithRule extends AbstractRule
{
    
    /*
    La stringa da cercare
    */
    var $str ;

    function StartsWithRule($startStr)
    {
    
        parent::AbstractRule() ;
        
        $this->str  = strtolower($startStr) ;
    
    }
    
    function check($val, $label)
    {
    
        parent::check($val, $label) ;
				    
        $val = strtolower( trim($val) ) ;
    
        /*
        confronto esatto sul tipo
        */
        if( !strpos($val, $this->str) === 0 )
        {
        
            $this->errors[] = sprintf(STARTWITH_ERR, $label, $this->str) ;
        
        }
    
    }

}//end class

/*
Verifica se un stringa termina con un'altra
*/
class EndsWithRule extends ContainsRule
{

    function EndsWithRule($startStr)
    {
    
				parent::ContainsRule($startStr) ;
           
    }
    
    function check($val, $label)
    {
    
        parent::check($val, $label) ;
        
        $endPos = substr($val, -( strlen($this->str ) ) ) == $this->str  ;
        
        if( $this->isValid() && !$endPos  )
        {
        
            $this->errors[] = sprintf(ENDWITH_ERR, $label, $this->str) ;
        
        }
    
    }

}//END class


/*
Verifica che il contenuto di un fieldset multiplo
contenga un dato numero di elementi o sia compreso in un certo range
*/
class NumElementsRule extends AbstractRule
{

    /*
    I limiti ammessi
    */
    var $min ;
    var $max ;

    function NumElementsRule($min, $max)
    {
    
        parent::AbstractRule() ;
        
        $this->min = $min ;
        $this->max = $max ;
    
    }
    
    function check($val, $label)
    {
        
        $count = is_array($val) ? count($val) : 0 ;
        
        if($this->min == $this->max)
        {
            if((bool)$this->min)
						{
						
						    /*
						    Il valore non è 0
						    il controllo non è disabilitato
								*/ 
								$this->checkFixedNum($count, $label) ;   
						
						}
				
				    /*
				    Il valore è 0 
						il controllo disabilitato
				    */
				    return ;
				
				}
				elseif( $this->min == 0 )
        {   
            /*
            E' necessario verificare solo max
            */
            $this->checkMax($count, $label) ;

        }
        elseif( $this->max == 0 )
        {   
            /*
            E' necessario verificare solo min
            */
            $this->checkMin($count, $label) ;

        }
        else
				{   
            /*
            E' necessario verificare entrambi
            */
            $this->checkBoth($count, $label) ;
        
        }
        
    
    }//end check
    
    function checkMin($count, $label)
    {
    
        if($count < $this->min)
				{
				
				    $this->errors[] = sprintf(ARR_TOO_SHORT, $label, $this->min) ;
				
        }
       
    }//end checkmin
    
    function checkMax($count, $label)
    {
    
        if($count > $this->max)
				{
				
				    $this->errors[] = sprintf(ARR_TOO_LONG, $label, $this->max) ;
				
        }
    
    }//end checkmax
    
    function checkBoth($count, $label)
    {
    
        if($count < $this->min || $count > $this->max)
        {
    
            $this->errors[] = sprintf(ARR_BAD_RANGE, $label, $this->min, $this->max) ;
            
        }
    }//end checkboth
    
    function checkFixedNum($count, $label)
    {
    
        if( $count != $this->min)
        {
        
            $this->errors[] = sprintf(ARR_BAD_LEN, $label, $this->min) ;
        
        }
    
    }//end checkFixedNum

}//end class

/*
Verifica che il contenuto di un fieldset multiplo contenga uno o più elementi predefiniti
*/
class HasElementsRule extends AbstractRule
{

   /*
   Gli elementi da cercare
   */
    var $elements ;
    
    function HasElementsRule($arrElms)
    {
    
        parent::AbstractRule() ;
        
        $this->elements = $arrElms ;
    
    }
    
    function check( $val, $label, $allRequired = false )
    {
    
        $result = array_intersect($this->elements, $val) ; 
        
        $error = sprintf(LACK_OF_ELEMENTS, $label) ; 
    
        if($allRequired)
        {
        
            if(count($result) < count($this->elements) )
            {
            
                $this->errors[] = $error ; 
            
            }
        
        }
        elseif( empty($result) )
        {
        
            $this->errors[] = $error ;
        
        }
    
    }//END function

}//END class


/*$field = new ArrayRequiredRule() ;

$field->check('', 'Città') ;

if( !$field->isValid() )
{
    echo $field->getError() ;
}
*/


/*$field = new HasElementsRule( array('pippo', 'paperino') ) ;

$field->check( array('paperoga', 'archimede'), 'Personaggi Disney', true) ;

if(!$field->isValid()){

    echo $field->getError() ;

}*/


/*$k = new NumElementsRule(0,1) ;

$k->check(array(), 'test') ;

echo $k->getError() ;*/

/*$field = new PatternRule("/^\w{3,20}$/i") ;

$field->check('fa', 'nome') ;

if(!$field->isValid())
{

    echo $field->getError() ;

}*/




?>
