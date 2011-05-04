<?php /* Smarty version 2.6.26, created on 2011-05-04 14:28:11
         compiled from analysis_category.tpl */ ?>
<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'>##233,Análisis y Evaluación##</td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1' /></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'>##234,Análisis de Relación de Actores##</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>##235,Este módulo será utilizado por los expertos para analizar y evaluar la relación con cada Actor mediante los gráficos, la data y los indicadores definidos. Esto permitirá la fundamentación del juicio. Esto es, el juicio sobre la situación de la relación (elemento último) estará en función de un conjunto de juicios previos soportados en las gráficas e indicadores de este módulo. Los Actores disponibles para el análisis son los seleccionadas en el proceso de jerarquización.##</td>
	</tr>
	
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
	<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "ActorsSelectInclude.tpl", 'smarty_include_vars' => array('do' => 'analysisActor')));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br />