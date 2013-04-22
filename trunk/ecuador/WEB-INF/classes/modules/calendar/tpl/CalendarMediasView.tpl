				<h2>Medias</h2>
				<div id="div_calendarMedias">
					|-if $message eq "ok"-|<span class="message_ok">Media guardado correctamente</span>|-/if-|
					|-if $message eq "deleted_ok"-|<span class="message_ok">Media eliminado correctamente</span>|-/if-|
					<table id="tabla-calendarMedias">
						<thead>
			<tr>
				<th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarMediasEdit" class="agregarNueva">Agregar Media</a></div></th>
			</tr>
							<tr>
																<th>Artículo</th>
																<th>Nombre Archivo</th>

																<th>Tipo de Archivo</th>
																<th>Fecha de Creación</th>
																<th>Estado</th>
																<th>Usuario</th>
																<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						|-foreach from=$calendarMedias item=calendarMedia name=for_calendarMedias-|
							<tr>
			
																<td>
																	|-assign var=event value=$calendarMedia->getCalendarEvent()-|
																	|-$event->getTitle()-|
																</td>
																<td>|-$calendarMedia->getname()-|</td>
																<td>|-$calendarMedia->getmediaTypeName()-|</td>
																<td>|-$calendarMedia->getcreationDate()-|</td>
																<td>|-$calendarMedia->getstatus()-|</td>
																<td>
																	|-assign var=currentUser value=$calendarMedia->getUser()-|
																	|-if not empty($currentUser)-|
																		|-$currentUser->getUsername()-|
																	|-/if-|
																</td>
																<td>
									<form action="Main.php" method="get">
										<input type="hidden" name="do" value="calendarMediasEdit" />
																				<input type="hidden" name="id" value="|-$calendarMedia->getid()-|" />
																				<input type="submit" name="submit_go_edit_calendarMedia" value="Editar" />
									</form>
									<form action="Main.php" method="post">
										<input type="hidden" name="do" value="calendarMediasDoDelete" />
																				<input type="hidden" name="id" value="|-$calendarMedia->getid()-|" />
																				<input type="submit" name="submit_go_delete_calendarMedia" value="Borrar" onclick="return confirm('Seguro que desea eliminar el calendarMedia?')" />
									</form>
								</td>
							</tr>
						|-/foreach-|						
	|-if isset($pager) && ($pager->getTotalPages() gt 1)-|
							<tr> 
								<td colspan="7">|-include file="PaginateInclude.tpl"-|</td> 
							</tr>							
		|-/if-|										
			<tr>
				<th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=calendarMediasEdit" class="agregarNueva">Agregar Media</a></div></th>
			</tr>
						</tbody>
					</table>
				</div>
