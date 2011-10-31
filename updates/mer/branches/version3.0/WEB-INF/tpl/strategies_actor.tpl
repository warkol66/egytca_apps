<h2>Estrategias y Tácticas</h2>
	<h1>Estrategías y Tácticas asociadas a &quot;|-$actor->getName()-|&quot;</h1>
			<div class="reportlinkdiv"><a href="javascript:void(null);" class="deta" onClick="window.open('#','##204,Reporte##','height=600,width=730,toolbar=no,status=no,scrollbars=yes,resizable=yes')" alt="##205,Reporte para impresión##" title="##205,Reporte para impresión##">##204,Reporte##</a></div>
		<p>A continuación encontrará los elementos necesarios para evaluar el perfil de la relación con el Actor:&nbsp;<b>|-$actor->getName()-|</b>.<br />
			En cada gráfico podrá emitir un juicio que luego podrá ver en el cuadro resumen al final de este formulario, para hacer la evaluación global del perfil.</p>

<table width='100%' border='0' align='center' cellpadding="0" cellspacing="0">
	<tr>
		<td><table class='tableTdBorders' width='100%' border='0' cellpadding='0' cellspacing='1'>
				<tr>
					<th colspan='2'><a name='sintesis'>##241,Cuadro Síntesis de Evaluación de ## "|-$actor->getName()-|"</a></th>
				</tr>
				<tr>
					<th>##250,Gráfico##</th>
					<th>##239,Juicio##</th>
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
				<table class='tableTdBorders' width='100%' border='0' cellpadding='3' cellspacing='1'>
					<tr>
						<td class='celltitulo'><div class='titulo2'>##242,Calificación de la Relación##</div></td>
						<td>
									|-if $judgement ne "" and $judgement->getMark() == -3-|-3|&nbsp;Antagonista|-/if-|
									|-if $judgement ne "" and $judgement->getMark() == -2-|-2|&nbsp;Obstaculizador|-/if-|
									|-if $judgement ne "" and $judgement->getMark() == -1-|-1|&nbsp;Entorpecedor|-/if-|
									|-if ( $judgement ne "" and $judgement->getMark() == 0 ) or $judgement eq ""-|0|&nbsp;Neutral|-/if-|
									|-if $judgement ne "" and $judgement->getMark() == 1-|1|&nbsp;Cooperador|-/if-|
									|-if $judgement ne "" and $judgement->getMark() == 2-|2|&nbsp;Amigo|-/if-|
									|-if $judgement ne "" and $judgement->getMark() == 3-|3|&nbsp;Aliado|-/if-|
						</td>
					</tr>
					<tr>
						<td class='celltitulo'><div class='titulo2'>&nbsp;&nbsp;##243,Juicio Síntesis##</div></td>
						<td>|-if $judgement ne ""-||-$judgement->getJudgement()-||-/if-|</td>
					</tr>
				</table>
		</td>
	</tr>
	<tr>
		<td><br />
			<form action='Main.php' method='post' style='display: inline;'>
				<table class='tableTdBorders' width='100%' border='0' cellpadding='3' cellspacing='1'>
					<tr>
						<td class='celltitulo'><div class='titulo2'>Estrategia</div></td>
						<td><textarea name='strategy' cols='85' rows='4' class='textodato' wrap='virtual'>|-$actor->getStrategy()-|</textarea></td>
					</tr>
					<tr>
						<td class='celltitulo'><div class='titulo2'>T&aacute;ctica</div></td>
						<td><textarea name='tactic' cols='85' rows='4' class='textodato' wrap='virtual'>|-$actor->getTactic()-|</textarea></td>
					</tr>
					<tr>
						<td class='celltitulo'><div class='titulo2'>Observaciones</div></td>
						<td><textarea name='observations' cols='85' rows='4' class='textodato' wrap='virtual'>|-$actor->getObservations()-|</textarea></td>
					</tr>
					<tr>
						<td colspan='2' align='center' class='cellboton'>
							<input type="hidden" name="do" value="strategiesActorDoEdit" />
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
