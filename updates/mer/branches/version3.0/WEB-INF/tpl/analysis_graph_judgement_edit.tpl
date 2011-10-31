<table width='500' border='0' cellpadding='0' cellspacing='0'>
	<tr> 
		<td class='mda_referenciamodulo'>&nbsp;</td>

	</tr>
	<tr> 
		<td class='mda_referenciamodulo'>M&oacute;dulo de Administraci&oacute;n</td>
	</tr>
	<tr> 
		<td class='mda_nombremodulo'>Administrar Asistentes de Juicio</td>
	</tr>
	<tr> 
		<td class='mda_subrayadoseccion'><img src="/images/px_vacio.gif" width='1' height='3'></td>

	</tr>
	<tr> 
		<td class='comentariostd'>&nbsp;</td>
	</tr>
	<tr> 
		<td class='comentariostd'>Con esta aplicaci&oacute;n podr&aacute; cargar los textos correspondientes 
			a los asistentes de juicio de cada gr&aacute;fico disponible en el sistema.</td>
	</tr>

	<tr> 
		<td class='comentariostd' height="20">&nbsp;</td>
	</tr>
</table>

<a href='Main.php?do=analysisGraphList'>Volver a la lista de Gr&aacute;ficos</a> <br /><br />
<form method='post' action="Main.php">
<table width="500" cellpadding='0' cellspacing='1' class='tableTdBorders0'>
	<tr>
		  <td colspan='2' class="tituloseccion01"> Gr&aacute;fico: |-$graph->getName()-|
											</td>

	</tr>
	
	|-foreach from=$judgements item=judgement name=for_judgements-|
	<tr>
		<td align='center' class="tituloedicionleft">
			<img src='Main.php?do=analysisGraphJudgementShow&graph=|-$graph->getId()-|&quadrant=|-$smarty.foreach.for_judgements.iteration-|' />
		</td>
		<td valign='top' class="detalleedicion">
			<textarea rows='10' cols='40' name='judgement[|-$smarty.foreach.for_judgements.iteration-|]' class='textodato'>|-$judgement->getJudgement()-|</textarea>
		</td>
	</tr>
	|-/foreach-|

	<tr>
		<td colspan='2' class="celboton">
			<input type="hidden" name="graph" value="|-$graph->getId()-|" />
			<input type="hidden" name="do" value="analysisGraphJudgementDoEdit" />
			<input type='submit' value='Guardar' >
		</td>
	</tr>
</table>
</form>
