<!DOCTYPE html>
﻿<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
		<title>Grafico dinâmico</title>
		<script language="javascript" src="js/fusioncharts3.js"></script>
		<script language="javascript" src="js/fusioncharts.charts.js"></script>
		<script language="javascript" src="js/fusioncharts.theme.fint.js"></script>
	</head>
	
	<body>
		<?php
			include 'conexao.php';
			
			$consulta = "SELECT * FROM alunos";
			$con_resultado = mysql_query($consulta);
			
			$dados = array();
			while($row = mysql_fetch_array($con_resultado)) 
			{	
				$dados_a [] = $row['ALUNO'];
				$dados_b [] = $row['NOTA'];
			}
			
			$dados_grafico = "";
			for($i = 0; $i <= count($dados_a)-1; $i++)
			{
				$dados_grafico = $dados_grafico."{'label': '".$dados_a [$i]."', 'value': '".$dados_b [$i]."'}, ";
			}
				
			$tamanho = strlen($dados_grafico);
			$dados_grafico = substr($dados_grafico, 0, $tamanho-2);
			$dados_grafico = "[$dados_grafico]";
			//echo $dados_grafico;
			
			echo "<script type='text/javascript'>var dados_grafico = $dados_grafico;</script>";
		?>
	
		<div id="chart-container">CARREGA GRÁFICO</div>

		<script>
			FusionCharts.ready(function () {
				var revenueChart = new FusionCharts({
				type: 'column2d',
				renderAt: 'chart-container',
				width: '800',
				height: '300',
				dataFormat: 'json',
				dataSource: {
					'chart': {
						'caption': 'TÍTULO',
						'yaxisname': 'SUBTÍTULO',
						'theme': 'fint'
					},
					'data': dados_grafico
					}
        
				});
				revenueChart.render();
			});
		</script>
	</body>
</html>
