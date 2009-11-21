<?php
/*
Disabilitiamo il flushing immediato
(vedere 
http://it2.php.net/manual/en/ref.outcontrol.php)
*/
ob_implicit_flush(0) ;

class SmartForm extends AbstrErrHandler
{   

    function SmartForm($triggerVar, &$fields, $crossChecks = array() )
    {
    
        $this->fields = &$fields ;
        
        /*
        Flag che determina se il form è stato inviato
        */
        $this->isSent = isset($_REQUEST[$triggerVar]) ;
        
        /*
        Se i dati sono stati inviati
        */
        if( $this->isSent )
        {
                
            /*
            Procedo ai controlli incrociati sui campi
            */
            while( list($key1, ) = each($crossChecks) )
            {
            
                if( !$crossChecks[$key1]->isValid() )
                {
                    
                    $this->errors[] = $crossChecks[$key1]->getError() ;   
                
                }
            
            }//END while
            
            /*
            Se ci sono già errori, inutile proseguire
            */
            if( !$this->isValid() )
            {
            
                return ;
            
            }
				       
            /*
            Altrimenti procedo alla verifica dei singoli campi
            */
            while( list($key2,) = each($fields) )
            {
            
                $fields[$key2]->validate() ;
                
                /*
                Raccolgo gli eventuali errori
                */
                if( !$fields[$key2]->isValid() )
                {
                
                    $this->errors[] = $fields[$key2]->getError() ;   
                
                }
            
            }//END while
            
                   
        }//END if
    
    }//END constructor

/*
Metodo che preleva il form HTML e lo invia all'output
*/    
    function display($template)
    {
    
        $FORM = &$this ;
        
        $FIELDS = &$this->fields ;
    
        ob_start() ;
        
            include($template) ;
        
        ob_end_flush() ;
    
    }//END display

}//END class

?>
