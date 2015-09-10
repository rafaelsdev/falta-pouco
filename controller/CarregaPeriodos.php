<?php

	if(is_numeric($_GET['curso']) && $_GET['curso'] != ''){
		require_once("../model/Turma.class.php");
		require_once("../model/conexao.class.php");	
		require_once("../model/conf.php");
		
		$conexao = new Conexao($conexaoBD['bd'],$conexaoBD['usuario'],$conexaoBD['senha'],$conexaoBD['host']);
		$conexao->getConexao();
		
		/**
		 * Define o curso a ser buscado;
		 */
		$curso = $_GET['curso'];
		/*
		 * Define se será buscado o turno
		 * ou não
		 */
		$turno = $_GET['turno'];		
		
		
		/*
		if($turno = 'turno'){
					$turma = new Turma($curso,0,0);
					$periodos = $turma->buscaTurnoCurso();
				}else{*/
		
			$turma = new Turma($curso,$turno,0);
			$periodos = $turma->gradePeriodos();
		//}

		echo isset($periodos) && $periodos != false ? $periodos : "<option>Nenhuma informação encontrada.</option>";
	}else{
		echo "<option>Não foi possível encontrar o curso.</option>";
	}
?>