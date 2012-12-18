				<h2>Medias</h2>
				<div id="div_newsmedias">
					|-if $message eq "ok"-|<span class="message_ok">Media guardado correctamente</span>|-/if-|
					|-if $message eq "deleted_ok"-|<span class="message_ok">Media eliminado correctamente</span>|-/if-|
					<table id="tabla-newsmedias">
						<thead>
			<tr>
				<th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newsMediasEdit" class="agregarNueva">Agregar Media</a></div></th>
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
						|-foreach from=$newsmedias item=newsmedia name=for_newsmedias-|
							<tr>
			
																<td>
																	|-assign var=article value=$newsmedia->getNewsArticle()-|
																	|-$article->getTitle()-|
																</td>
																<td>|-$newsmedia->getname()-|</td>
																<td>|-$newsmedia->getmediaTypeName()-|</td>
																<td>|-$newsmedia->getcreationDate()-|</td>
																<td>|-$newsmedia->getstatus()-|</td>
																<td>
																	|-assign var=currentUser value=$newsmedia->getUser()-|
																	|-if not empty($currentUser)-|
																		|-$currentUser->getUsername()-|
																	|-/if-|
																</td>
																<td>
									<form action="Main.php" method="get">
										<input type="hidden" name="do" value="newsMediasEdit" />
																				<input type="hidden" name="id" value="|-$newsmedia->getid()-|" />
																				<input type="submit" name="submit_go_edit_newsmedia" value="Editar" />
									</form>
									<form action="Main.php" method="post">
										<input type="hidden" name="do" value="newsMediasDoDelete" />
																				<input type="hidden" name="id" value="|-$newsmedia->getid()-|" />
																				<input type="submit" name="submit_go_delete_newsmedia" value="Borrar" onclick="return confirm('Seguro que desea eliminar el newsmedia?')" />
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
				<th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=newsMediasEdit" class="agregarNueva">Agregar Media</a></div></th>
			</tr>
						</tbody>
					</table>
				</div>
