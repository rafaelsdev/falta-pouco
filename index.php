<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>Calculadora de Faltas | v1.0.0</title>
		<script type="text/javascript" src="view/js/request.js"></script>
		<script type="text/javascript">
			function mostrarPeriodo(opcao) {
			  	curso = document.getElementById('curso').value; 
			  	makeRequest(opcao,curso);
			}
			function alterarTurno(){
				 cursoTurno = document.getElementById('turnoCurso');
				 cursoTurno.value ="";
			}
		</script>
		<style type="text/css">
			body{
				background-color:#b4eeea;
				width:99%;
			}
			fieldset{
				border: 0;
				clear: both;
				margin:200px auto;
				width:400px;
	
			}
			select{
				height:30px;
				outline-color:#ff8d00;
				margin: 5px;
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				width:300px;
			}
			label{
				display: inline-block;
				padding-top:5px;
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
    			width: 60px;
			}
			legend{
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size:18px;
				margin: 0 auto;
				
			}
			input{
				background-color:#f1f26d;
				border: .1em solid #f1f26d;
				border-radius:15px;
				color:#717240;
				display: block;
				float: right;
				font-family: Verdana, Geneva, Arial, Helvetica, sans-serif;
				font-size:18px;
				height: 50px;
				margin: 25px;
				outline:none;
				position: relative;
				width: 200px;
			}
			input:hover{
				background-color:#f3f447;
			}
			input:active{
				background-color:#e6e745;
			}
		</style>
	</head>
	<body>
		<fieldset>
			<legend>Informe</legend>
			<form name="" action="principal.php" method="post">
 				<label for="">Curso</label>
				<select name="curso" id="curso" onchange="alterarTurno()" autocomplete="off">
					<option value="" selected="selected"></option>
					<option value="2">Administração</option>
					<option value="3">Ciências Contábeis</option>
					<option value="4">Direito</option>
					<option value="6">Engenharia Civil</option>
					<option value="5">Engenharia de Produção</option>
					<option value="8">História</option>
					<option value="7">Pedagogia</option>
					<option value="9">Relações Internacionais</option>
					<option value="1">Sistemas de Informação</option>
					<option value="">Tecnologia de Sistemas para Internet</option>
				</select><br />
				<label for="">Turno</label>
				<select name="turnoCurso" id="turnoCurso" onchange="mostrarPeriodo(this.value)" autocomplete="off">
					<option value="" selected="selected"></option>
					<option value="M">Manhã</option>
					<option value="N">Noite</option>
				</select><br />
				<label for="">Período</label>
				<select name="periodoCurso" id="periodoCurso" autocomplete="off">
					<option value="" selected="selected"></option>
				</select><br />
				<input type="submit" id="" name="" value="Calcular"/>
			</form>
		</fieldset>
	</body>
</html>
<?php
    //phpinfo();
?>