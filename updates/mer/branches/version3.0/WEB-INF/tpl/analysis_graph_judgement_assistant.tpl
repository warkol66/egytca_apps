<center>
	<table width='400' cellpadding="3" cellspacing="1" class='tablaborde'>
		<tr>
			<th>##238,Asistente de Juicios##</th>
		</tr>
		|-foreach from=$judgements item=judgement name=for_judgements-|
		<tr>
			<td class='celldato'><table width="100%">
					<tr>
						<td><p><img src='Main.php?do=analysisGraphJudgementShow&graph=|-$graph->getId()-|&quadrant=|-$smarty.foreach.for_judgements.iteration-|'' align='left' />|-$judgement->getJudgement()-|</p></td>
					</tr>
				</table></td>
		</tr>
		|-/foreach-|
		<tr>
			<td class='cellboton'><input type='button' onClick='window.close()' value='##253,Cerrar##'  class='boton' />
			</td>
		</tr>
	</table>
</center>
