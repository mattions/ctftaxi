<?php
/*
Classe che rappresenta un campo singolo di un form
*/
class FrmField extends AbstrErrHandler
{
    
    /*
    Le regole da applicare
    */
    var $rules ;
    
    /*
    Il valore contenuto dal campo
    */
    var $val ;
    
    /*
    Il valore da attribuire di default
    */
    var $defVal ;
    
    /*
    L'etichetta del campo
    */
    var $label ;
    
    /*
    Il campo è obbligatorio?
    */
    var $req ;

    /*
    Costruttore
    */
    function FrmField($val, $label, $required, $rules = array(), $default = '' )
    {   
    
        parent::AbstrErrHandler() ;
    
        $this->rules = &$rules  ;   
	      
	      $this->label = $label ;
	      
	      $this->req = $required ;
	      
				
        /*
				Se la variabile non esiste viene settata ad un valore di default
				*/      
	      if( !isset($val) )
	      {
	      
	          $val = $default ;
	      
	      }
	      
	      $this->val = &$val ;
	      $this->defVal = $default ;
	      
	      
    }       
    
    
    function validate()
    {
       
       /*
       Se il campo è vuoto
       */
       if( empty($this->val) )
       {
           /*
           Se è obbligatorio
           */
           if($this->req)
           {
              /*
              Se è obbligatorio settiamo un errore
              */
              $this->errors[] = sprintf(IS_REQUIRED, $this->label) ;
              
           }
           /*
           Se vuoto e non obbligatorio inutile fare altri controlli e usciamo
           */    
           return ;   
           
       
       }//END if empty
        
				/*
				Altrimenti procediamo ai controlli successivi
				*/          
        while( list(, $rule) = each($this->rules) )
        {
        
            $rule->check($this->val, $this->label) ;
            
            if( !$rule->isValid() )
            {	
								
								$this->errors[] = $rule->getError() ;
								
								/*
								In caso di errori ripristina il valore di default al 
								posto di quello non corretto
								*/
								$this->val = $this->defVal ;
								              
                return ;
                
            }
				
	      }//end while

    
    }//end function validate
    
}//end class


/*
Classe che rappresenta un campo multiplo (es. select multipla) di un form
*/
class FrmFieldSet extends AbstrErrHandler
{

    /*
    L'array di valori contenuti nel fieldset
    */
    var $val ;
    
    /*
    Le regole da applicare all'intero fieldset
    */
    var $fieldSetR ;
    
    /*
    Le regole da applicare ai singoli valori contenuti
    */
    var $fieldR ;
    
    /*
    L'etichetta del fieldset
    */
    var $label ;
    
    /*
    Il valore da attribuire di default
    */
    var $defVal ;
    
    /*
    Il campo è obbligatorio?
    */
    var $req ;
    

    function FrmFieldSet($sentVals, $label, $required, $fieldSetRules = array(), $fieldRules = array(), $default = array() )
    {
    
        parent::AbstrErrHandler() ;
        
        /*
				Se la variabile non esiste viene settata ad un valore di default
				*/          
        if( !isset($sentVals) )
        {
        
            $sentVals = $default ;        
        
        }
        
        $this->val = &$sentVals ;
        
        $this->req = $required ;
        
        $this->defVal = $default ;
        
        $this->label = $label ;
        
        $this->fieldSetR = &$fieldSetRules ;
        
        $this->fieldR = &$fieldRules ;
        
    }
    
    /*
    Determina se un valore è presente nel fieldset
    */
    function selected($what)
    {
    
        return in_array($what, $this->val) ;
    
    }
    
    
    /*
    Esegue i controlli sul fieldset
    */
    function validate()
    {   
    
       /*
       Se il campo è vuoto
       */
       if( empty($this->val) )
       {
           /*
           Se è obbligatorio settiamo un errore
           */
           if($this->req)
           {
           
               $this->errors[] = sprintf(IS_REQUIRED, $this->label) ;
           
           }
           /*
           Se vuoto e non obbligatorio inutile fare altri controlli e usciamo
           */			           
           return ;   
       
       }//END if empty
        
       /*
       Altrimeti ciclo di controlli sul fieldset nel suo complesso
       */
        while( list(, $rule) = each( $this->fieldSetR)  )
        {
        
            $rule->check($this->val, $this->label) ;
            
            if( !$rule->isValid() )
            {	
								
								$this->errors[] = $rule->getError() ;
								
								/*
								In caso di errori ripristina il valore di default al 
								posto di quello non corretto
								*/
								$this->val = $this->defVal ;
								              
                return ;
                
            }
				
	      }//end while  
				
				/*
				ciclo di controlli su ogni campo nel fieldset
				*/
				while( list(, $rule) = each($this->fieldR) )
				{
				
				    while( list(, $field) = each($this->val) )
				    {
				    
				        $rule->check($field, $this->label) ;
				        
				        if( !$rule->isValid() )
                {	
								
								    $this->errors[] = $rule->getError() ;
								
								    /*
								    Ripristina il valore di default al 
								    posto di quello non corretto
								    */
								    $this->val = $this->defVal ;
								              
                    return ;
                
                }//END if
				    
				    } //END while2
				    
				} //END while1 
	      
    
    }//end function "validate"


}//END class


class CapField extends FrmField
{

    function CapField($val, $label, $required, $default='')
    {
    
        $rules = array() ;
        $rules[] = new PatternRule("/^\d{5}$/") ;
        
        parent::FrmField($val, $label, $required, $rules, $default) ;
    
    }

}//end class

class MailField extends FrmField
{
    
  function MailField($val, $label, $required, $default='')
  {     
	      $rules = array() ;   
        $rules[] = new PatternRule("/^[a-zA-Z]{1}\w{1,10}[-|.|_]{0,1}\w{0,10}@\w{3,10}\.\w{0,10}-{0,1}\w{0,10}\.{0,1}\w{2,6}$/i") ;
        
				parent::FrmField($val, $label, $required, $rules, $default) ;	
  } 

}//end class

class PhoneField extends FrmField
{

    function PhoneField($val, $label, $required, $default='')
    {
        $rules = array() ;
        $rules[] = new PatternRule("/^\+{0,1}\d{0,4}[-|\\\| |\/]{0,1}\d{3,5}[-|\\\|\/]{0,1}\d{5,10}$/U") ;
        
        parent::FrmField($val, $label, $required, $rules, $default) ;	
    
    }

}//end class



/*
$x = new FrmField('', 'cap', true, array(new StrRangeRule(5,5), new IsNumericRule()) ) ;

$x->validate() ;

if($x->isValid())
{

    echo $x->val ;   

} 
else 
{

    echo $x->getError() ;

}
*/


/*
$z = new MailField('s1234@html.it', 'e-mail', true) ;

$z->validate() ;

if($z->isValid())
{

    echo $z->val ;   

} 
else 
{

    echo $z->getError() ;

}
*/





/*$k = new CapField('12345', 'cap', true) ;

$k->validate() ;

if($k->isValid())
{

    echo $k->val ;   

} 
else 
{

    echo $k->getError() ;

}
*/



/*
$w= new PhoneField('320/7148101', 'telefono', false) ;

$w->validate() ;

if($w->isValid())
{

    echo $w->val ;   

} 
else 
{

    echo $w->getError() ;

}
*/




/*$fieldset = array('uno'=>'pluto', 'due' => 1 ) ;

$r1 =  array( new HasElementsRule( array('pluto') ) ) ;

$r2 = array( new IsNumericRule() ) ;

$u = new FrmFieldset($fieldset, 'Personaggi Disney', false, $r1, $r2) ;

$u->validate() ;

echo $u->getError() ; var_dump($u->val) 
*/






?>
