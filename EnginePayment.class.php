<?php
/*
 * Font:http://forum.wmonline.com.br/topic/192371-funcao-para-parcelamento-juros-compostos/ (original code)
 * Developers: fabiano@wd2.com.br (original code) | rodolfobarretoweb@gmail.com
 * 
 * PT-BR
 * rate: Taxa em porcentagem
 * capital: Entrada do valor
 * qtn_division: Quantidade de parcelamento
 * expiration_date: Data de vencimento do pagamento
 */

interface IEnginePayment{
    public function setRate($rate);
    public function setCapital($capital);
    public function setQtnDivision($qtn_division);
    public function setExpirationDate($expiration_date);
    public function getDivision();
}

class EnginePayment implements IEnginePayment{
    protected $rate;
    protected $capital;
    protected $qtn_division;
    protected $expiration_date;
    
    public function setRate($rate) {
        return $this->rate = $rate;
    }
    
    public function setCapital($capital) {
        return $this->capital = $capital;
    }
    
    public function setQtnDivision($qtn_division) {
        return $this->qtn_division = $qtn_division;
    }
    
    public function setExpirationDate($expiration_date) {
        return $this->expiration_date = $expiration_date;
    }
    
    public function getDivision() {
        return $this->division();
    }
    
    protected function division(){
        for ($i=0; $i < $this->qtn_division; $i++){
            $this->capital *= 1 + ($this->rate / 100);
            
            $array[] = array('value_division'=>number_format($this->capital/($i + 1),2,',','.'),'date_division'=>date("d-m-y", mktime (0, 0, 0, date("m")+$i+1, $this->expiration_date, date("y"))),'qtn_division'=>$this->qtn_division);
        }
        
        return $array;
    }
}

/*
 * RETURN
 * 
 $pagamento = new EnginePayment;
 $pagamento->setRate(0);
 $pagamento->setCapital(500.00);
 $pagamento->setQtnDivision(3);
 $pagamento->setExpirationDate(30);
 $retorno = $pagamento->getDivision();

 var_dump($retorno);
 
  array
  0 => 
    array
      'value_division' => string '500,00' (length=6)
      'date_division' => string '30-07-2012' (length=10)
      'qtn_division' => int 3
  1 => 
    array
      'value_division' => string '250,00' (length=6)
      'date_division' => string '30-08-2012' (length=10)
      'qtn_division' => int 3
  2 => 
    array
      'value_division' => string '166,67' (length=6)
      'date_division' => string '30-09-2012' (length=10)
      'qtn_division' => int 3
 */
?>
