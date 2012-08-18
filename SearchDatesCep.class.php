<?php
/*
 * Script originalmente retirado de: http://www.eliseuborges.com/download/buscaCepCorreios2011.rar
 * 
 * @author rodolfobarretoweb@gmail.com
 * @version 0.0.1
 */

require_once("ISearchDatesCep.php");

final class SearchDatesCep implements ISearchDatesCep{
    
    /*
     * @acess public
     * @param $cep
     * @return array
     */
    public function getSearchDates($cep) {
        return $this->searchDates($cep);
    }
    
    /*
     * @acess private
     * @param $cep
     * @return array
     */
    private function searchDates($cep){
        $ch = curl_init("http://www.buscacep.correios.com.br/servicos/dnec/consultaLogradouroAction.do");
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true );
        
        curl_setopt($ch, CURLOPT_POST, true );
        curl_setopt($ch, CURLOPT_POSTFIELDS, "CEP=".$cep."&Metodo=listaLogradouro&TipoConsulta=cep&StartRow=1&EndRow=10");
		
	$retorno_curl = curl_exec($ch);
	curl_close($ch);
        
        # pega o html que contem as informacoes necessarias
	if($html = strpos($retorno_curl,'<table border="0" cellspacing="1" cellpadding="5" bgcolor="gray">')){
            $html = substr($retorno_curl,$html,500);
            
            # separa os dados atraves do explode no html retornado
            list($endereco,$bairro,$cidade,$estado) = explode("     ",trim(strip_tags($html)));
            
            # converte os dados para o formato utf8
            $endereco = utf8_encode($endereco);
            $bairro   = utf8_encode($bairro);
            $cidade   = utf8_encode($cidade);
            $estado   = utf8_encode($estado);
            
            # prepara os dados para o formato json
            $json = array("endereco"=>$endereco,"bairro"=>$bairro,"cidade"=>$cidade,"estado"=>$estado);
            
            print json_encode($json);
        }else{
            return false;
        }
    }
}
?>