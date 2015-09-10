<?php
class Turma{
	
	private $curso;
	private $periodo;
	private $turno;
	private $gradeTurma = array();
	
	public function __construct($curso,$periodo,$turno){
		$this->curso = $curso;
		$this->periodo = $periodo;
		$this->turno = $turno;
	}
	public function __get($attrib){
		return $this->$attrib;
	}
	public function montaGrade(){
		$curso = $this->__get("curso");
		$periodo = $this->__get("periodo");
		$turno = $this->__get("turno");
		/**
		 * Recupera o resultado da busca pela grade de
		 * disciplinas do curso
		 * @var mixed
		 */
		$gradeCurso = $this->buscaGrade($curso,$periodo,$turno);
		/**
		 * Contador utilizado para agrupar as disciplinas por dia
		 * da semana
		 * @var int
		 */
		$cont = 0;
		
		if($gradeCurso != false){
			while($grade = mysql_fetch_assoc($gradeCurso)){
				
				/*echo $grade['ID']." - ".$grade['NOME']." - ".$grade['CODCURSO']." - ".
				$grade['CODHORARIO']." - ".$grade['PERIODO']." - ".$grade['HORARIO']." - ".$grade['DIASEMANA']."<br />";*/
				
				$this->gradeTurma[$grade['DIASEMANA']][$cont] = $grade['NOME'];
				
				$cont++;
				if($cont > 4){
					$cont = 0;
				}
			}
			return $this->gradeTurma;
		}
		return false;
	}
	private function buscaGrade($curso,$periodo,$turno){
		
		$buscaGradeCurso = "SELECT * 
							FROM disciplinas d
							LEFT JOIN horario h
							ON d.CODHORARIO = h.id
							WHERE d.CODCURSO = ".$curso."
								  AND d.PERIODO =".$periodo."
								  AND d.TURNO = '".$turno."'
								  AND d.HABILITACAO = 1";
		
		$resultadoBusca = mysql_query($buscaGradeCurso) or trigger_error("001",E_USER_WARNING);
		
		return $resultadoBusca;
	}
	
	public function gradePeriodos(){
		
		$periodos = $this->buscaTotalPeriodos();
		
		$periodosCurso = mysql_fetch_assoc($periodos);
		$montaGrade = "";
		for($i = 1; $i <= $periodosCurso["PERIODO"]; $i++){
			
			$montaGrade .= "<option value=\"".$i."\">".$i."</option>";
		}
		
		return $montaGrade;
	}
	
	private function buscaTotalPeriodos(){
		
		$curso = $this->__get("curso");
		
		$buscaPeriodoCurso = "SELECT PERIODO
							  FROM curso
							  WHERE ID =".$curso."";
		
		$resultadoBusca = mysql_query($buscaPeriodoCurso) or die(mysql_error()); //trigger_error("001",E_USER_WARNING);
		
		return $resultadoBusca;
	}
	
	public function buscaTurnoCurso(){
		
		$buscaTurno = $this->turnoCurso();
		$turnoCurso = "";
		while ($turno = mysql_fetch_assoc($buscaTurno)) {
				 if($turno['TURNO'] == 'N'){
					 $turnoCurso .= "<option value=\"".$turno['TURNO']."\">Noite</option>";
				 }else{
				 	 $turnoCurso .= "<option value=\"".$turno['TURNO']."\">Manhã</option>";
				 }
		}		
		return $turnoCurso;
	}
	
	private function turnoCurso(){
		
		$curso = $this->__get("curso");
		
		$buscaTurnoCurso = "SELECT TURNO 
							FROM disciplinas
							WHERE CODCURSO = ".$curso."
							GROUP BY CODCURSO";
							
		$resultadoBusca = mysql_query($buscaTurnoCurso) or trigger_error("001",E_USER_WARNING);	
		
		return $resultadoBusca;				
	}
}    
?>