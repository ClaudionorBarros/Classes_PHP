<?php
require("lib/smarty/libs/Smarty.class.php");

/*
 * @author rodolfobarretoweb@gmail.com
 * @version 0.0.5
 */

class SmartySetup extends Smarty{
    /* 
     * @var $dir_templates
     * @acess private
     */
    private $dir_templates;
    
    /* 
     * @var $dir_compile
     * @acess private
     */
    private $dir_compile;
    
    /* 
     * @var $dir_cache
     * @acess private
     */
    private $dir_cache;
    
    /* 
     * @var $dir_config
     * @acess private
     */
    private $dir_config;
    
    /* 
     * @var $add_cache
     * @acess private
     */
    private $add_cache;
    
    /* 
     * @var $tmp_cache
     * @acess private
     */
    private $tmp_cache;
    
    /*
    * @acess public
    * @param $dir_templates,$add_cache,$tmp_cache,$dir_compile,$dir_cache,$dir_config
    * @return String
    */
    public function __construct($dir_templates = "", $add_cache = true,$tmp_cache = 10, $dir_compile = "", $dir_cache = "", $dir_config = "") {     
        $this->dir_templates = $dir_templates;
        $this->add_cache     = $add_cache;
        $this->tmp_cache     = $tmp_cache;
        $this->dir_compile   = $dir_compile;
	$this->dir_cache     = $dir_cache;
	$this->dir_config    = $dir_config;
        
        parent::__construct();
                
        # seta os diretorios para o smarty
        parent::setTemplateDir ($this->dir_templates."templates/");
        parent::setCompileDir  ($this->dir_compile."compile/");
        parent::setConfigDir   ($this->dir_config."configs/");
        parent::setCacheDir    ($this->dir_cache."cache/");
        
        # define se o cache está ligado ou não
        $this->caching = $this->add_cache;
        
        # define o tempo para expirar o cache
        $this->cache_lifetime = $this->tmp_cache;
    }
}
?>