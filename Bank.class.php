<?php
interface IBank{
   public function getDisconnectMysql();
   public function getManageMysql($query);
}

class Bank implements IBank{     
    protected $host;
    protected $user;
    protected $password;
    protected $bank;
    
    public function __construct($host = "127.0.0.1",$user = "root",$password=null,$bank = "rr"){
        $this->host     = $host;
        $this->user     = $user;
        $this->password = $password;
        $this->bank     = $bank;
        
        $this->connectMysql();
    }
        
    public function getDisconnectMysql(){
        $this->disconnectMysql();
    }
    
    public function getManageMysql($query){
        return $this->manageMysql($query);
    }
    
    private function connectMysql(){
        # conecta ao bank de dados
        if(mysql_connect($this->host,$this->user,$this->password)){
            # seleciona o bank de dados
            if(mysql_select_db($this->bank)){
                return true;
            }else {
                return false;
            }
         }else {
            return false;
         }
         
    }
    
    private function disconnectMysql(){
        # fecha a conexão com o bank
        if(mysql_close()){
            return true;
        }else{
            return false;
        }
    }
    
    protected function manageMysql($query){
        # mostra a estrutura da query
        $result = mysql_query($query);
        
        # verifica se tudo ocorreu bem e retorna a query
        if($result){
            return $result;
        }else{
            return false;
        }
    }

}
?>