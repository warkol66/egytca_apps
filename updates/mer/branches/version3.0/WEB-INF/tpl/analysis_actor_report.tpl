<table border='0' cellpadding='0' cellspacing='0' width='100%'>
	<tr>
		<td class='titulo'><span class="titulo">##233,Análisis y Evaluación##</span></td>
	</tr>
	<tr>
		<td class='subrayatitulo'><img src="images/clear.gif" height='3' width='1'></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='fondotitulo'>##237,Análisis de Relación con## &quot;|-$actor->getName()-|&quot;</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
</table>
<table width='100%' border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td> 
		|-foreach from=$graphs item=graph name=for_graphs-|
			<form action='Main.php' method='post'>
				<a name='id-|-$graph->getId()-|'></a><div id='hide|-$graph->getId()-|' class='noPrint' align="right"><input type='button' id='button|-$graph->getId()-|' value='Ocultar Sección' onClick='switch_vis("|-$graph->getId()-|");switch_value("button|-$graph->getId()-|");' />Gráfico &quot;|-$graph->getName()-|&quot;</div>
				<div id='|-$graph->getId()-|' style='display:block;'>  
				<table width='100%' class='tableTdBorders' cellpadding='0' cellspacing='1' border='0'>
					<tr>
						<th colspan='2'> |-$graph->getName()-|</th>
					</tr>
					<tr>
						<td width='90%'><img src='Main.php?do=analysisGraphShow&graph=|-$graph->getId()-|&actor=|-$actor->getId()-|&category=|-$category->getId()-|' /> </td>
						<td class='cellbotonbtm' width='100'>&nbsp;</td>
					</tr>
					<tr>
						<td colspan="2" valign='top' nowrap class='fondoffffff'><table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td valign="top" class="titulodato1"><div class="titulo">&nbsp;&nbsp;##239,Juicio##:</div>
										<span class="textoerror">|-if $graph->oldJudgement eq 1-|Desactualizado|-/if-|</span>
									</td>
									<td class="filled1" width="1"><img src="images/clear.gif" width="1" height="1" /> </td>
									<td class="celldato">|-$graph->judgement-|</td>
								</tr>
							</table></td>
					</tr>
				</table>
				</div>
			</form>
			|-/foreach-| 

<!-- ingreso nuevo -->
				<table width='100%' class='tableTdBorders' cellpadding='0' cellspacing='1' border='0'>
					<tr>
						<th colspan='2'>Cuadro Síntesis de Perfil de "|-$actor->getName()-|"</th>
					</tr>
			|-foreach from=$analysisQuestions item=question name=for_analysis_questions-|
			|-assign var=answer value=$question->getAnswer($actor)-|
					<tr>
						<td valign="top" width='35%' class="titulodato1"><div class="titulo">|-$question->getQuestion()-|</div></td>
					<td width='65%'>|-$answer-|</td>
					</tr>
				|-/foreach-|
				</table>
<!-- ingreso nuevo -->

<!-- anterior 

			|-foreach from=$analysisQuestions item=question name=for_analysis_questions-|
			|-assign var=answer value=$question->getAnswer($actor)-|
			<form action='Main.php' method='post'>
				<a name='id-894'></a>
				<table width='100%' class='tableTdBorders' cellpadding='0' cellspacing='1' border='0'>
					<tr>
						<th colspan='2'> |-$question->getQuestion()-| </th>
					</tr>
					<tr>
						<td width='90%'>|-$answer-|</td>
					</tr>
					<tr>
						<td colspan="2" valign='top' nowrap class='fondoffffff'><table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td valign="top" class="titulodato1"><div class="titulo">&nbsp;&nbsp;##239,Juicio##:</div>
										<span class="textoerror">|-if $answer and $answer->getOld() eq 1-|Desactualizado|-/if-|</span>
									</td>
									<td class="filled1" width="1"><img src="images/clear.gif" width="1" height="1" /> </td>
									<td class="celldato">|-if $answer-||-$answer->getJudgement()-||-/if-|</td>
								</tr>
							</table></td>
					</tr>
				</table>
			</form>
			|-/foreach-|
fin anterior -->
		</td>
	</tr>
</table>
<br />
<table width='100%' border='0' align='center' cellpadding="0" cellspacing="0">
	<tr>
		<td><table class='tableTdBorders' width='100%' border='0' cellpadding='0' cellspacing='1'>
				<tr>
					<th colspan='2'><a name='sintesis'>##241,Cuadro Síntesis de Evaluación de ## "
						|-$actor->getName()-|"</a></th>
				</tr>
				<tr>
					<th>##250,Gráfico##</th>
					<th>##239,Juicio##:</th>
				</tr>
				|-foreach from=$graphs item=graph name=for_graph_judgements-|
				<tr>
					<td class='celltitulo'><div class='titulo2'> <a href='#id-894'>|-$graph->getName()-|</a> </div></td>
					<td>|-$graph->judgement-|</td>
				</tr>
				|-/foreach-|
<!-- inicio anterior				|-foreach from=$analysisQuestions item=question name=for_analysis_questions-|
				|-assign var=answer value=$question->getAnswer($actor)-|
				<tr>
					<td class='celltitulo'><div class='titulo2'> <a href='#id-894'>|-$question->getQuestion()-|</a> </div></td>
					<td>|-if $answer-||-$answer->getJudgement()-||-/if-|</td>
				</tr>
				|-/foreach-|
fin anterior -->
			</table></td>
	</tr>
	<tr>
		<td><br />
			<form action='Main.php' method='post' style='display: inline;'>
				<table class='tableTdBorders' width='100%' border='0' cellpadding='3' cellspacing='1'>
					<tr>
						<th colspan='2'> ##242,Calificación de la Relación##
							<select name='mark' >
								<option value='-3'|-if $judgement ne "" and $judgement->getMark() == -3-| selected="selected"|-/if-|>&nbsp;&nbsp;-3|&nbsp;Antagonista</option>
								<option value='-2'|-if $judgement ne "" and $judgement->getMark() == -2-| selected="selected"|-/if-|>&nbsp;&nbsp;-2|&nbsp;Obstaculizador</option>
								<option value='-1'|-if $judgement ne "" and $judgement->getMark() == -1-| selected="selected"|-/if-|>&nbsp;&nbsp;-1|&nbsp;Entorpecedor</option>
								<option value='0'|-if ( $judgement ne "" and $judgement->getMark() == 0 ) or $judgement eq ""-| selected="selected"|-/if-|>&nbsp;&nbsp;&nbsp;0|&nbsp;Neutral</option>
								<option value='1'|-if $judgement ne "" and $judgement->getMark() == 1-| selected="selected"|-/if-|>&nbsp;&nbsp;&nbsp;1|&nbsp;Cooperador</option>
								<option value='2'|-if $judgement ne "" and $judgement->getMark() == 2-| selected="selected"|-/if-|>&nbsp;&nbsp;&nbsp;2|&nbsp;Amigo</option>
								<option value='3'|-if $judgement ne "" and $judgement->getMark() == 3-| selected="selected"|-/if-|>&nbsp;&nbsp;&nbsp;3|&nbsp;Aliado</option>
							</select>
						</th>
					</tr>
					<tr>
						<td width="20%" nowrap class='celltitulo'><div class='titulo'>&nbsp;&nbsp;##243,Juicio Síntesis##</div></td>
						<td>|-if $judgement ne ""-||-$judgement->getJudgement()-||-/if-|</td>
					</tr>
				</table>
			</form></td>
	</tr>
	<tr>
		<td><br />
		</td>
	</tr>
</table>
