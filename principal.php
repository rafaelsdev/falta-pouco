<?php

	if((!isset($_POST['curso']) || $_POST['curso'] == '' ) && (!isset($_POST['periodoCurso']) || $_POST['periodoCurso'] == '' || $_POST['periodoCurso']  == 'Curso não existe')){
		echo "<script>location.href=\"index.php\"</script>";
	}
 //  require_once("top.php");
   require_once("model/conf.php");  
   require_once("model/conexao.class.php");
   require_once("model/Turma.class.php");
   require_once("model/Datas.class.php");

   $curso = $_POST['curso'];
   $periodoCurso = $_POST['periodoCurso'];
   $turnoCurso = $_POST['turnoCurso'];
   

   /**
    * Recebe uma instancia da classe Conexao
    * @param string, nome do banco
    * @param string, usuario 
    * @param string, senha
    * @param string, host
    */
   $novaConexao = new Conexao($conexaoBD['bd'],$conexaoBD['usuario'],$conexaoBD['senha'],$conexaoBD['host']);
   $novaConexao->getConexao();
   
   /**
    * Array para somar a qtde total 
    * de aulas por disciplinas
    */
   $qtdeAulas = array();
   
   /**
    * Recebe a instancia da classe Data 
    */
   $Data = new Datas();
 
	/**
	 * Recebe a instancia da classe Turma
	 * @param int, código do curso
	 */
	$turma = new Turma($curso,$periodoCurso,$turnoCurso);
	
	
	$gradeTurma = $turma->montaGrade();
	
	if($gradeTurma != false){
	   /**
	    * Separador da data
	    */
	   $dataInicial = explode("-", $inicioPeriodo);
	   
	   /**
	    * Atribui a data de inicio do período
	    * as váriaveis dia e mes
	    */
	   $dia = $dataInicial[0];   
	   $mes = $dataInicial[1];
	   
	   /**
	    * Recupera o último dia do mês
	    */
	   $ultimoDia = $Data->ultimoDiaMes($dia,$mes,$anoLetivo);
	   /**
	    * Define a data a ser comparada 
	    * com a data de término do período
	    * letivo
	    */
	   $terminoPeriodo = $dia."-".$mes;
	   /**
	    * Busca feriados no mês passado
	    * como parâmetro
	    */
	   $feriado = $Data->verificaFeriado($mes);
	
	   while($terminoPeriodo != FIMPER){
		   $diaSemana = $Data->diaSemana($dia,$mes,$anoLetivo);
		   if($dia <= $ultimoDia){
					if(!isset($feriado[$dia])){
						$diaSem = utf8_decode($semanaTrad[$diaSemana]);
						if($diaSem != utf8_decode("Sábado") && $diaSem != "Domingo"){
							for($i = 1; $i < sizeof($gradeTurma[$diaSem]);$i++){
								@$qtdeAulas[$gradeTurma[$diaSem][$i]] += 1;
							}
						}
					}
		   }	 	
			  $dia++;
			  if($dia > $ultimoDia){
			   		$dia = 1; 
			   		$mes++; 
			   		$ultimoDia = $Data->ultimoDiaMes($dia,$mes,$anoLetivo);
				    $feriado = $Data->verificaFeriado($mes);
			 }
			 $terminoPeriodo = $dia."-".$mes;
	   }
	   /**
	    * Atribui o valor em percentual
	    */
	  $percentual = PORCDIV / 100;
	  
	  $tabelaSaida = "<table>
	  				  <tr>
	  				  	<td>Disciplina</td>
	  				  	<td>Faltas</td>
	  				  </tr>";
	  
	   foreach ($qtdeAulas as $disciplina => $totalAulas) {
	   	   if($disciplina != 'Vago'){
			   	$totalAulas = ceil($totalAulas * $percentual);
				$tabelaSaida .= "<tr><td>".$disciplina."</td><td>".$totalAulas."</td></tr>";
		   }
	   }
	   $tabelaSaida .= "</table>";
	   
	   echo utf8_encode($tabelaSaida);
   }else{
	   echo "Não existem disciplinas para o período e curso selecionados";
   }
?>