<?php
interface ICrypt{
    function getEncrypt($dado);
    function getDecrypt($dado); 
}

class Crypt implements ICrypt{
       public  $iv;
       private $password;
       
       public function __construct($password = "senha"){
             $this->password = $password;
             $this->randomizar();
       }
       
       public function getEncrypt($dado){
             return $this->encrypt($dado);
       }
       
       public function getDecrypt($dado){
             return $this->decrypt($dado);
       }
       
       private function randomizar(){
             # gera iv randomizado
             $tamanho  = mcrypt_get_iv_size(MCRYPT_CAST_256,MCRYPT_MODE_ECB);
             $this->iv = mcrypt_create_iv($tamanho,MCRYPT_DEV_RANDOM);
       }
       private function encrypt($dado){           
             # criptografa os dados
             $crypt = mcrypt_encrypt(MCRYPT_CAST_256,$this->password,$dado,MCRYPT_MODE_ECB,$this->iv);
             
             # retorna o dado criptografado
             return $crypt;
       }
       
       private function decrypt($dado){           
             # descriptografa os dados
             $decrypt = mcrypt_decrypt(MCRYPT_CAST_256,$this->password,$dado,MCRYPT_MODE_ECB,$this->iv);
                  
             # retorna o dado descriptografado
             return $decrypt;
      }
}
?>