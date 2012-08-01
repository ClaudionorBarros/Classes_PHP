<?php
/*
 * @author rodolfobarretoweb@gmail.com
 * @version 0.0.5
 */

require_once("ICrypt.php");

class Crypt implements ICrypt{
       /*
        * @var $iv 
        * @acess public
       */
       public static $iv;
       
       /*
        * @var $password 
        * @acess private
       */
       private $password;
       
       /*
        * @acess public
        * @param $password
        * @return String
       */
       public function __construct($password = "a54ba2c"){
             $this->password = $password;
             $this->randomizar();
       }
       
       /*
        * @acess public
        * @param $string
        * @return String
       */
       public function getEncrypt($string){
             return $this->encrypt($string);
       }
       
       /*
        * @acess public
        * @param $string
        * @return String
       */
       public function getDecrypt($string){
             return $this->decrypt($string);
       }
       
       /*
        * @acess private
        * @return String
       */
       private function randomizar(){
             # gera iv randomizado
             $tamanho  = mcrypt_get_iv_size(MCRYPT_CAST_256,MCRYPT_MODE_ECB);
             $this->iv = mcrypt_create_iv($tamanho,MCRYPT_DEV_RANDOM);
       }
       
       /*
        * @acess private
        * @param $string
        * @return String
       */
       private function encrypt($string){           
             # criptografa os dados
             $crypt = mcrypt_encrypt(MCRYPT_CAST_256,$this->password,$string,MCRYPT_MODE_ECB,$this->iv);
             
             # retorna o dado criptografado
             return $crypt;
       }
       
       
       /*
        * @acess private
        * @param $string
        * @return String
       */
       private function decrypt($string){           
             # descriptografa os dados
             $decrypt = mcrypt_decrypt(MCRYPT_CAST_256,$this->password,$string,MCRYPT_MODE_ECB,$this->iv);
                  
             # retorna o dado descriptografado
             return $decrypt;
      }
}
?>