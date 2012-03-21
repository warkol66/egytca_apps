<h2>Encuestas</h2>
<h1>Administracion de Respuestas a Encuestas</h1>
				<div id="div_surveyanswers">
<p>					
	|-if $message eq "ok"-|
		<div class="resultSuccess">Respuesta a Encuesta guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="resultSuccess">Respuesta a Encuesta eliminada correctamente</div>
	|-/if-|
</p>

					<table id="tabla-surveyanswers" class="tableTdBorders">
						<thead>
							<tr>
                								<th>id</th>
																<th>Pregunta</th>
																<th>Numero de Respuesta Seleccionada</th>
																<th>Usuario</th>
																<th>Fecha de Creacion</th>
																<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						|-foreach from=$surveyanswers item=surveyanswer name=for_surveyanswers-|
							<tr>
																<td>|-$surveyanswer->getid()-|</td>
																<td>|-assign var=question value=$surveyanswer->getSurveyQuestion()-|
																	|-$question->getQuestion()-|</td>
																<td>|-$surveyanswer->getanswerOptionId()-|</td>
																|-assign var=object value=$surveyanswer->getObject()-|
																<td>|-if $object eq ''-|Respuesta Publica|-else-||-$object-||-/if-|</td>
																<td>|-$surveyanswer->getcreatedAt()-|</td>
																<td>
									<form action="Main.php" method="post">
										<input type="hidden" name="do" value="surveysAnswersDoDelete" />
																				<input type="hidden" name="id" value="|-$surveyanswer->getid()-|" />
																				<input type="submit" class="icon iconDelete" name="submit_go_delete_surveyanswer" value="Borrar" onclick="return confirm('Seguro que desea eliminar el surveyanswer?')" />
									</form>
								</td>
							</tr>
						|-/foreach-|						
							<tr> 
								<td colspan="9">|-include file="PaginateInclude.tpl"-|</td> 
							</tr>							
						
						</tbody>
					</table>
				</div>
