<?php
require_once("Bank.class.php");

interface IUser{
    public function setLogin($login);
    public function setPassword($password);
    public function getLogin($name_session_login,$name_session_password,$table);
    public function getValidateLogon($table);
    public function getLogoff();
}

class User extends Bank implements IUser{
    protected $login;
    protected $password;
    
    public function setLogin($login) {
        return $this->login = $login;
    }
    
    public function setPassword($password) {
        return $this->password = $password;
    }
    
    public function getLogin($name_session_login, $name_session_password, $table) {
        return $this->login($name_session_login, $name_session_password, $table);
    }
    
    public function getValidateLogon($table) {
        return $this->validateLogon($table);
    }
    
    public function getLogoff(){
        return $this->logoff();
    }
    
    protected function login($name_session_login, $name_session_password, $table){
        if(mysql_num_rows(parent::manageMysql("SELECT login,password FROM $table WHERE login = '$this->login' AND password = '$this->password'")) == 1){
            session_start();
            $_SESSION[$name_session_login]    = $this->login;
            $_SESSION[$name_session_password] = $this->password;
            
            return true;
        }else{
            return false;
        }
    }
    
    protected function validateLogon($table){
        if(mysql_num_rows(parent::manageMysql("SELECT login,password FROM $table WHERE login = '$this->login' AND password = '$this->password'")) == 1){
            return true;
        }else{
            return false;
        }
    }
    
    protected function logoff(){
        # destroy vars
        unset($this->login);
        unset($this->password);
        
        # destroy session
        session_destroy();
        
        return true;
    }
}
?>