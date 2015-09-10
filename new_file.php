<?php
 require_once("conf.php");  
   require_once("conexao.class.php");
   require_once("Turma.class.php");
  require_once("Datas.class.php");
   
   $Data = new Datas();
 /*
   $novaConexao = new Conexao($conexaoBD['bd'],$conexaoBD['usuario'],$conexaoBD['senha'],$conexaoBD['host']);
   $novaConexao->getConexao();


	$turma = new Turma(1);
	$turma->montaGrade();

  // $teste = mysql_query("SELECT * FROM horario") or die(mysql_error());
   
  // $dados = mysql_fetch_assoc($teste);

  // var_dump($dados);
   
 */ 
   
   $dataInicial = explode("-", $inicioPeriodo);
   
   $dia = $dataInicial[0];   
   $mes = $dataInicial[1];
   
   /**
    * Abreviação de 3 letras do dia da semana
    */
 //  $diaSemana =  diaSemana($mes,$dia,$anoLetivo);
   /**
    * Total de dias do mês
    */
   $diaSemana = $Data->diaSemana($dia,$mes,$ano);
   $ultimoDia = ultimoDiaMes($mes, $dia, $anoLetivo);
   $terminoPeriodo = $dia."-".$mes;
  // $ultimoDia = ultimoDiaMes($mes, $dia, $anoLetivo);
   while($terminoPeriodo != FIMPER){
   	
	 $diaSemana =  diaSemana($mes,$dia,$anoLetivo);
	
	echo utf8_decode($semanaTrad[$diaSemana]).", ".$dia." de ".$mes." de ".$anoLetivo."<br/>";
	
//	echo $dia."-".$mes." / "."Teste";
	   $dia++;
	   if($dia > $ultimoDia){$dia = 1; $mes++; $ultimoDia = ultimoDiaMes($mes, $dia, $anoLetivo);}
	   
	
	$terminoPeriodo = $dia."-".$mes;
   }
   
   
 //  echo $dia."-".$mes." / "."Teste";
   
function diaSemana($mes,$dia,$ano){
  return date("D", mktime(0, 0, 0, $mes, $dia, $ano));
}   
function ultimoDiaMes($mes,$dia,$ano){
  return date("t", mktime(0, 0, 0, $mes, $dia, $ano));
}   
 
 
?>