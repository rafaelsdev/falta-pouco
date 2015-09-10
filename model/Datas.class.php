<?php
Class Datas{
	public $feriado = array();
	
	/**
	 * Retorna o último dia do mês (numérico)
	 * @param int, dia
	 * @param int, mes
	 * @param int, ano
	 * @return int, último dia do mês
	 */
	public function ultimoDiaMes($dia,$mes,$ano){
		 return date("t", mktime(0, 0, 0, $mes, $dia, $ano));
	}
	/**
	 * Retorna o dia da semana abreviado
	 * em inglês 
	 * Ex: Sun (Sunday)
	 * @param int, dia
	 * @param int, mes
	 * @param int, ano
	 * @return String, dia da semana
	 */
	public function diaSemana($dia,$mes,$ano){
		 return date("D", mktime(0, 0, 0, $mes, $dia, $ano));
	}
	public function verificaFeriado($mes){
		
		$buscaFeriado = $this->buscaFeriado($mes); 
		
		$existeFeriado = mysql_num_rows($buscaFeriado);
		
		if($existeFeriado){
			while ($dataFeriado = mysql_fetch_assoc($buscaFeriado)){
				$this->feriado[$dataFeriado['DIA']] = 1;
			}
			
			return $this->feriado;
		}else{
			return false;
		}
	}
	private function buscaFeriado($mes){
		
		$buscaFeriado = "SELECT * FROM feriado WHERE mes=".$mes."";
		
		$retorno = mysql_query($buscaFeriado) or trigger_error("001",E_USER_WARNING);
		
		return $retorno;
	}
}
?>