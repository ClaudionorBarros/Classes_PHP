<?php
/*
 * @author rodolfobarretoweb@gmail.com
 * @version 0.0.5
 */

interface IBank{
   public function getDisconnectMysql();
   public function getManageMysql($query);
}
?>
