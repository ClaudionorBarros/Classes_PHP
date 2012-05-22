<?php
require("lib/smarty/libs/Smarty.class.php");

class SmartySetup extends Smarty{
    private $dir;
    private $add_cache;
    private $tmp_cache;
    
    public function __construct($dir = "",$add_cache = true,$tmp_cache = 10) {     
        $this->dir       = $dir;
        $this->add_cache = $add_cache;
        $this->tmp_cache = $tmp_cache;
        
        # converte alguns valores
        $this->dir = str_replace(" ","",$this->dir);
        $this->dir = str_replace(null,"",$this->dir);
        
        parent::__construct();
                
        # seta os diretorios para o smarty
        parent::setTemplateDir ($this->dir."templates/");
        parent::setCompileDir  ($this->dir."compile/");
        parent::setConfigDir   ($this->dir."configs/");
        parent::setCacheDir    ($this->dir."cache/");
        
        # define se o cache está ligado ou não
        $this->caching = $this->add_cache;
        
        # define o tempo para expirar o cache
        $this->cache_lifetime = $this->tmp_cache;
    }
}
?>


