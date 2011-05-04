
	<table width='100%' cellspacing='1' cellpadding='0' border='0' class='tablaborde'>
<tr>

<th colspan='2'>
<form method="GET" action="Main.php" style="display:inline">
	<input type="hidden" name="do" value="|-$smarty.request.do-|" />
	<input type="hidden" name="actor" value="|-$actor1->getId()-|" />
Relaciones entre |-$actor1->getName()-| y <select name='actor2' onchange="this.form.submit()">|-html_options options=$actors selected=$actor2->getId() -|<option value="all"|-if $actor2 and $actor2->getName() eq "all"-|selected="selected"|-/if-|>Todos</option></select>
</form>
</th>

</tr>
</table>
<br />

|-if $actor1->getName() and $actor2->getName()-|

<table width='100%' border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td> 
		|-foreach from=$graphs item=graph name=for_graphs-|
			<form action='Main.php' method='post'>
				<a name='id-894'></a>
				<table width='100%' class='tablaborde' cellpadding='0' cellspacing='1' border='0'>
					<tr>
						<th colspan='2'> |-$graph->getName()-| </th>
					</tr>
					<tr>
						<td class='celldato' width='90%'>
							<img src="Main.php?do=analysisGraphRelationShow&graphId=|-$graph->getId()-|" alt="Error al Generar el Grafico Comparativo - No existen datos para las relaciones seleccionadas" />
						</td>
					</tr>
					<tr>
						<td colspan="2" valign='top' nowrap class='fondoffffff'><table border="0" cellpadding="0" cellspacing="0">
								<tr>
									<td valign="top" class="titulodato1"><div class="titulo">&nbsp;&nbsp;##239,Juicio##:</div>
										<span class="textoerror">|-if $graph->getOld() eq 1-|Desactualizado|-/if-|</span>
									</td>
									<td class="filled1" width="1"><img src="images/clear.gif" width="1" height="1" /> </td>
									<td class="celldato"><textarea cols='100' name='judgement' rows='5' class='textodato' wrap='VIRTUAL'>|-$graph->getJudgement()-|</textarea>
									</td>
								</tr>
							</table></td>
					</tr>
					<tr>
						<td colspan='2' class='cellboton'><input type="hidden" name="do" value="analysisRelationJudgementDoEdit" />
							<input type="hidden" name="graphId" value="|-$graph->getId()-|" />
							<input type='submit' name='gnota' value='##240,Guardar Juicio##' class='boton' />
							<input type='button' onClick='location.href="Main.php?do=analysisRelation&actor=|-$actor1->getId()-|"' value='##104,Regresar##'  class='boton' />
						</td>
					</tr>
				</table>
			</form>
			|-/foreach-|
		</td>
	</tr>
</table>
<br />
<table width='100%' border='0' align='center' cellpadding="0" cellspacing="0">
	<tr>
		<td><table class='tablaborde' width='100%' border='0' cellpadding='0' cellspacing='1'>
				<tr>
					<th colspan='2'><a name='sintesis'>##241,Cuadro Síntesis de Evaluación de &quot;##
						|-$actor1->getName()-|&quot; -> &quot;|-if $actor2->getName() ne "all"-||-$actor2->getName()-||-else-|Todos|-/if-|&quot;</a></th>
				</tr>
				<tr>
					<th>##250,Gráfico##</th>
					<th>##239,Juicio##</th>
				</tr>
				|-foreach from=$graphs item=graph name=for_graph_judgements-|
				<tr>
					<td class='celltitulo'><div class='titulo2'> <a href='#id-894'>|-$graph->getName()-|</a> </div></td>
					<td class='celldato'>|-$graph->getJudgement()-|</td>
				</tr>
				|-/foreach-|
			</table></td>
	</tr>
</table>

|-else-|

<a href="Main.php?do=analysisActor&actor=|-$actor1->getId()-|">Ver analisis de Perfil de |-$actor1->getName()-|</a>

|-/if-|

