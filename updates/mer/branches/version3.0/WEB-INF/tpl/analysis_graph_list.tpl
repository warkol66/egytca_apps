<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'>Configuración del Sistema</td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1'></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'>Administración de Gráficos </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>Administrar los gráficos </td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<table width="100%" border="0" cellpadding='0' cellspacing='1' class='tableTdBorders0'>
	<tr>
		<th width="40%" class='tituloseccion02'>Nombre</th>
		<th width="10%" class='tituloseccion02'>Tipo</th>
		<th width="40%" class='tituloseccion02'>Actores</th>
		<th width="10%" class='tituloseccion02'>&nbsp;</th>
	</tr>
	|-foreach from=$graphs item=graph name=for_graphs-|
	<tr>
		<td>|-$graph->getName()-|</td>
		<td>|-$graph->getType()-|</td>
		<td>|-if $graph->getActors() eq 0-|Todos|-else-|Uno|-/if-|</td>
		<td nowrap>[ <a href='Main.php?do=analysisGraphDoDelete&id=|-$graph->getId()-|' class='elim'>Eliminar</a> ][ <a href='Main.php?do=analysisGraphEdit&id=|-$graph->getId()-|' class='edit'>Editar</a> ][ <a href='Main.php?do=analysisGraphJudgementEdit&graph=|-$graph->getId()-|' class='deta'>Juicios</a> ]</td>
	</tr>
	|-/foreach-|
</table>
<a href="Main.php?do=analysisGraphEdit">Nuevo Gráfico</a> 