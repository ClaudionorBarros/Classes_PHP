<?php
/*
 * @author rodolfobarretoweb@gmail.com
 * @version 0.0.5
 */
require_once("IBank.php");

class Bank implements IBank{
    /* 
     * @var $host
     * @acess protected
     */
    protected $host;
    
    /* 
     * @var $user
     * @acess protected
     */
    protected $user;
    
    /* 
     * @var $password
     * @acess protected
     */
    protected $password;
    
    /* 
     * @var $bank
     * @acess protected
     */
    protected $bank;
    
    /*
    * @acess public
    * @param $host,$user,$passoword,$bank
    * @return String
    */
    public function __construct($host = "127.0.0.1",$user = "root",$password="",$bank = "montigas"){
        $this->host     = $host;
        $this->user     = $user;
        $this->password = $password;
        $this->bank     = $bank;
        
        $this->connectMysql();
    }
    
    /*
     * @acess public
     * @return Boolean
    */
    public function getDisconnectMysql(){
        $this->disconnectMysql();
    }
    
    /*
    * @acess public
    * @param $query
    * @return String
    */
    public function getManageMysql($query){
        return $this->manageMysql($query);
    }
    
    
    /*
    * @acess private
    * @return Boolean
    */
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
    
    /*
    * @acess private
    * @return Boolean
    */
    private function disconnectMysql(){
        # fecha a conexão com o bank
        if(mysql_close()){
            return true;
        }else{
            return false;
        }
    }
    
    /*
    * @acess protected
    * @param $query
    * @return String
    */
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