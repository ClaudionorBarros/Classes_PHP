<?php
interface IVDocs{
    public function getValidateCPF();
    public function getValidateCNPJ();
}

class VDocs implements IVDocs{
    protected $doc;
   
    public function __construct($doc = null){
        $this->doc = $doc;
    }

    public function getValidateCPF() {
        return $this->validateCPF();
    }
    
    public function getValidateCNPJ() {
        return $this->validateCNPJ();
    }
    
    protected function validateCPF(){        
        $nulos = array("12345678909","11111111111","22222222222","33333333333",
               "44444444444","55555555555","66666666666","77777777777",
               "88888888888","99999999999","00000000000");
     
        # Retira todos os caracteres que nao sejam 0-9 
        $this->doc = preg_replace("/[^0-9]/i", "", $this->doc);

        # Retorna falso se houver letras no cpf 
        if (in_array($this->doc, $nulos))
            return false;

        # Calcula o penúltimo dígito verificador
        $acum=0;
        for($i=0; $i<9; $i++) {
            $acum+= $this->doc[$i]*(10-$i);
        }

        $x=$acum % 11;
        $acum = ($x>1) ? (11 - $x) : 0;
        # Retorna falso se o digito calculado eh diferente do passado na string */
        if ($acum != $this->doc[9]){
            return false;
        }

        # Calcula o último dígito verificador*/
        $acum=0;
        for ($i=0; $i<10; $i++){
            $acum+= $this->doc[$i]*(11-$i);
        }  

        $x= $acum % 11;
        $acum = ($x > 1) ? (11-$x) : 0;
        # Retorna falso se o digito calculado eh diferente do passado na string 
        if ($acum != $this->doc[10]){
            return false;
        }  	
        # Retorna verdadeiro se o cpf eh valido 
        return true;
    }
    
    protected function validateCNPJ(){
        if (strlen($this->doc) <> 18) return 0; 
            $soma1 = ($this->doc[0] * 5) + 

            ($this->doc[1] * 4) + 
            ($this->doc[3] * 3) + 
            ($this->doc[4] * 2) + 
            ($this->doc[5] * 9) + 
            ($this->doc[7] * 8) + 
            ($this->doc[8] * 7) + 
            ($this->doc[9] * 6) + 
            ($this->doc[11] * 5) + 
            ($this->doc[12] * 4) + 
            ($this->doc[13] * 3) + 
            ($this->doc[14] * 2);
            
            $resto = $soma1 % 11; 
            $digito1 = $resto < 2 ? 0 : 11 - $resto; 
            $soma2 = ($this->doc[0] * 6) + 

            ($this->doc[1] * 5) + 
            ($this->doc[3] * 4) + 
            ($this->doc[4] * 3) + 
            ($this->doc[5] * 2) + 
            ($this->doc[7] * 9) + 
            ($this->doc[8] * 8) + 
            ($this->doc[9] * 7) + 
            ($this->doc[11] * 6) + 
            ($this->doc[12] * 5) + 
            ($this->doc[13] * 4) + 
            ($this->doc[14] * 3) + 
            ($this->doc[16] * 2); 
            $resto = $soma2 % 11; 
            $digito2 = $resto < 2 ? 0 : 11 - $resto; 
            return (($this->doc[16] == $digito1) && ($this->doc[17] == $digito2)); 
    }
}
?>