<?php 
  /**
   * Dados de conexão do BD a serem utilizados
   * pela classe de conexão
   */
  global $conexaoBD;
  $conexaoBD = array("usuario"=>"root",
  					 "senha"=>"",
					 "host"=>"127.0.0.1",
					 "bd"=>"dev");
					 
					 
					 
  $conexaoBD2 = '';					 
/**
 * Inicio do período letivo para veteranos
 * Formato: Dia-Mês
 */	
define("INIPERVET","06-08");
/**
 * Inicio do período letivo para calouros
 * Formato: Dia-Mês
 */
define("INIPERCAL", "20-08");
/**
 * Fim do período letivo
 * Formato: Dia-Mês
 */
define("FIMPER","21-12");
/**
 * Porcentagem total de faltas
 * Utilize duas casas decimais para maior precisão
 */
define("PORCDIV","25,00");
/**
 * Ano letivo
 * Ano atual retornado pela função date()
 */
$anoLetivo = date("Y");

/**
 * Define se o período começa de acordo com
 * o calendário de calouros ou veteranos
 * INIPERVET para veteranos
 * INIPERCAL para calouros
 */
$inicioPeriodo = INIPERVET;

/**
 * Array com os dias da semana por extenso
 * e traduzidos
 */
$semanaTrad = array(
        'Sun' => 'Domingo',
        'Mon' => 'Segunda',
        'Tue' => 'Terça',
        'Wed' => 'Quarta',
        'Thu' => 'Quinta',
        'Fri' => 'Sexta',
        'Sat' => 'Sábado');
/**
 * Array com o nome dos meses por extenso
 * e traduzidos
 */ 
$mesTrad = array(
        'Jan' => 'Janeiro',
        'Feb' => 'Fevereiro',
        'Mar' => 'Marco',
        'Apr' => 'Abril',
        'May' => 'Maio',
        'Jun' => 'Junho',
        'Jul' => 'Julho',
        'Aug' => 'Agosto',
        'Nov' => 'Novembro',
        'Sep' => 'Setembro',
        'Oct' => 'Outubro',
        'Dec' => 'Dezembro');
//set_error_handler("GenErros");				 
?>