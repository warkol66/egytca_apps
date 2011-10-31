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
		<td class='fondotitulo'>##237,Análisis de Relación con## &quot;|-$actor->getName()-|&quot;
			<div class="reportlinkdiv"><a href="javascript:void(null);" class="deta" onClick="window.open('#','##204,Reporte##','height=600,width=730,toolbar=no,status=no,scrollbars=yes,resizable=yes')" alt="##205,Reporte para impresión##" title="##205,Reporte para impresión##">##204,Reporte##</a></div></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class='texto'>##251,A continuación encontrará los elementos necesarios para evaluar el perfil de la relación con el Actor:##&nbsp;<b>|-$actor->getName()-|</b>.<br />
			##252,En cada gráfico podrá emitir un juicio que luego podrá ver en el cuadro resumen al final de este formulario, para hacer la evaluación global del perfil.##</td>
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
				<a name='id-894'></a>
				<table width='100%' class='tableTdBorders' cellpadding='0' cellspacing='1' border='0'>
					<tr>
						<th colspan='2'> |-$graph->getName()-| </th>
					</tr>
					<tr>
						<td width='90%'><img src='Main.php?do=analysisGraphShow&graph=|-$graph->getId()-|&actor=|-$actor->getId()-|&category=|-$category->getId()-|' /> </td>
						<td class='cellbotonbtm' width='100'><table width='90' class='tableTdBorders' border='0' cellspacing='1' cellpadding='3'>
								<tr>
									<td nowrap class='cellasistjuicio'><a href='javascript:void(null);' onClick="window.open('Main.php?do=analysisGraphJudgementAssistant&graph=|-$graph->getId()-|','asistente','toolbars=no,width=450,height=350,scrollbars=yes')"><b>##238,Asistente de Juicios##</b></a></td>
								</tr>
							</table></td>
					</tr>
					<tr>
						<td colspan="2" valign='top' nowrap class='fondoffffff'><table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td valign="top" class="titulodato1"><div class="titulo">&nbsp;&nbsp;##239,Juicio##:</div>
										<span class="textoerror">|-if $graph->oldJudgement eq 1-|Desactualizado|-/if-|</span>
									</td>
									<td class="filled1" width="1"><img src="images/clear.gif" width="1" height="1" /> </td>
									<td class="celldato"><textarea cols='100' name='judgement' rows='5' class='textodato' wrap='VIRTUAL'>|-$graph->judgement-|</textarea>
									</td>
								</tr>
							</table></td>
					</tr>
					<tr>
						<td colspan='2' class='cellboton'><input type="hidden" name="do" value="analysisActorJudgementDoEdit" />
							<input type="hidden" name="actor" value="|-$actor->getId()-|" />
							<input type="hidden" name="category" value="|-$category->getId()-|" />
							<input type="hidden" name="graph" value="|-$graph->getId()-|" />
							<input type='submit' name='gnota' value='##240,Guardar Juicio##' />
							<input type='button' onClick='location.href="Main.php?do=analysisCategory&category=|-$category->getId()-|"' value='##104,Regresar##' />
						</td>
					</tr>
				</table>
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
									<td class="celldato"><textarea cols='100' name='judgement' rows='5' class='textodato' wrap='VIRTUAL'>|-if $answer-||-$answer->getJudgement()-||-/if-|</textarea>
									</td>
								</tr>
							</table></td>
					</tr>
					<tr>
						<td colspan='2' class='cellboton'><input type="hidden" name="do" value="analysisActorJudgementDoEdit" />
							<input type="hidden" name="actor" value="|-$actor->getId()-|" />
							<input type="hidden" name="category" value="|-$category->getId()-|" />
							<input type="hidden" name="question" value="|-$question->getId()-|" />
							<input type='submit' name='gnota' value='##240,Guardar Juicio##' />
							<input type='button' onClick='location.href="Main.php?do=analysisCategory&category=|-$category->getId()-|"' value='##104,Regresar##' />
						</td>
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
						<td><textarea name='judgement' cols='85' rows='4' class='textodato' wrap='virtual'>|-if $judgement ne ""-||-$judgement->getJudgement()-||-/if-|</textarea></td>
					</tr>
					<tr>
						<td colspan='2' align='center' class='cellboton'><input type="hidden" name="do" value="analysisActorJudgementDoEdit" />
							<input type="hidden" name="actor" value="|-$actor->getId()-|" />
							<input type="hidden" name="category" value="|-$category->getId()-|" />
							<input type='submit' name='guardarc' value='##97,Guardar##' />
							&nbsp;&nbsp;
							<input type='button' onClick='history.go(-1)' value='##104,Regresar##' />
						</td>
					</tr>
				</table>
			</form></td>
	</tr>
	<tr>
		<td><br />
			<table width="100%" border="0" cellspacing="1" cellpadding="3" class='tableTdBorders'>
      	<tr>
      		<td class="celltitulo2" colspan="3">&nbsp;##244,Asistentes Virtuales##</td>
     		</tr>
      	<tr>
      		<td height="15" class="cellasistvirt" align="center"><a href='javascript:void(null)' onClick='javascript:window.open("Main.php?do=analysisGetQuestionByLabel&label=JuicioIntercambios&actor=|-$actor->getId()-|","perfil","toolbar=no,scrollbars=yes,width=425,height=320")' class="menu2">Juicio Intercambios</a></td>
      		<td height="15" class="cellasistvirt" align="center"><a href='javascript:void(null)' onClick='javascript:window.open("Main.php?do=analysisGetQuestionByLabel&label=JuicioPerfilCentroUrbano&actor=|-$actor->getId()-|","perfilpsico","toolbar=no,scrollbars=yes,width=425,height=320")' class="menu2">Juicio Perfil Centro Urbano</a></td>
      		<td height="15" class="cellasistvirt" align="center"><a href='javascript:void(null)' onClick='javascript:window.open("Main.php?do=analysisGetQuestionByLabel&label=JuicioConectividad&actor=|-$actor->getId()-|","actuacion","toolbar=no,scrollbars=yes,width=425,height=320")' class="menu2">Juicio Conectividad</a></td>
     		</tr>
      	</table></td>
	</tr>
</table>
