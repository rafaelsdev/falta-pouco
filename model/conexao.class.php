<?php
/**
 * Classe de conexão com BD
 */
class Conexao{
	
	private $bd;
	private $usuario;
	private $senha;
	private $driver;
	private $conexao;
	
	function __construct() {
		try{
		if($config = parse_ini_file("config.ini.php",true)){
			
			$this->bd = $config["DRIVER"]["DATABASE"];
			$this->usuario = $config["DRIVER"]["USER"];
			$this->senha = $config["DRIVER"]["PASSWORD"];
			$this->driver = $config["DRIVER"]["DRIVER"];
			
		} else {
			throw new RuntimeException("Erro de execu&ccedil;&atilde;o, tente novamente.");
		}
		}catch(RuntimeException $e){
			echo $e->getMessage();
		}
		
	}

	
	private function novaConexao(){
		
		try{
			global $conexaoBD;
			
			$this->conexao = new PDO($this->driver.$this->database.$this->host,$this->usuario,$this->senha);
			
			$this->conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			
			$conexaoBD = $this->conexao;
		}catch(PDOException $e){
			throw new RuntimeException("Falha ao conectar &agrave; base de dados");
		} finally{ 
			  echo $e->getMessage();
		}
		/*
		$this->conexao = mysql_connect($this->link,$this->usuario,$this->senha) or die(mysql_error());
		mysql_select_db($this->bd) or die(mysql_error());
		
		return $this->conexao;*/
	}
		
	public function getConexao(){
		return $this->novaConexao();
	}
}
?>