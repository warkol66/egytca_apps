				<h2>Forms</h2>
				<div id="div_forms">
					|-if $message eq "ok"-|<span class="message_ok">Form guardado correctamente</span>|-/if-|
					|-if $message eq "deleted_ok"-|<span class="message_ok">Form eliminado correctamente</span>|-/if-|
					<h3><a href="Main.php?do=formsEdit">Agregar Form</a></h3>
					<table class='tablaborde0'>
						<thead>
							<tr>
																<th>Name</th>
																<th>Relationship?</th>
																<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						|-foreach from=$forms item=form name=for_forms-|
							<tr>
								<td>|-$form->getname()-|</td>
								<td>|-if $form->getrelationship() eq 1-|Yes|-else-|No|-/if-|</td>
								<td>
									<form action="Main.php" method="get">
										<input type="hidden" name="do" value="formsEdit" />
										<input type="hidden" name="id" value="|-$form->getid()-|" />
										<input type="submit" value="Editar" class="boton" />
									</form>
									<form action="Main.php" method="post">
										<input type="hidden" name="do" value="formsDoDelete" />
										<input type="hidden" name="id" value="|-$form->getid()-|" />
										<input type="submit" value="Borrar" onclick="return confirm('Seguro que desea eliminar el form?')" class="boton" />
									</form>
								</td>
							</tr>
						|-/foreach-|
						</tbody>
					</table>
				</div>
