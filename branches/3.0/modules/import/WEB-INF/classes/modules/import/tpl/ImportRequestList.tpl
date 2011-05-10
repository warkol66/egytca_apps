				<h2>Ordenes de Pedido</h2>
				<div id="div_requests">
					|-if $message eq "ok"-|<span class="successMessage">Orden de pedido guardado correctamente</span>|-/if-|
					|-if $message eq "deleted_ok"-|<span class="successMessage">Orden de Pedido eliminado correctamente</span>|-/if-|
				|-if $loginAffiliateUser neq ""-|							
					<h3><a href="Main.php?do=importRequestEdit">Agregar Order de Pedido</a></h3>
				|-/if-|

					<table id="tabla-requests" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
						<thead>
							<tr>
                								<th class="thFillTitle">id</th>
																<th class="thFillTitle">creada</th>

|-if $loginUser neq "" and $loginUser->isAdmin() -|
<th class="thFillTitle">Usuario</th>
|-/if-|
<th class="thFillTitle">Status</th>
																<th class="thFillTitle">&nbsp;</th>
							</tr>
						</thead>
						<tbody>
						|-foreach from=$requests item=request name=for_request-|
							<tr>
																<td>|-$request->getid()-|</td>
																<td>|-$request->getCreatedAt()-|</td>
|-if $loginUser neq "" and $loginUser->isAdmin() -|
|-assign var="user" value=$affiliatePeer->get($request->getUserId())-|

<td>|-$user->getName()-|</td>
|-/if-|
<td>|-$request->getStatus()-|</td>
																<td>
									<form action="Main.php" method="get">
										<input type="hidden" name="do" value="importRequestEdit" />
																				<input type="hidden" name="id" value="|-$request->getid()-|" />
																				<input type="submit" name="submit_go_edit_request" value="Editar" class="boton" />
									</form>
						<!--				<form action="Main.php" method="post">
										<input type="hidden" name="do" value="" />
														<input type="hidden" name="id" value="|-$request->getid()-|" />
																				<input type="submit" name="submit_go_delete_request" value="Borrar" onclick="return confirm('Seguro que desea eliminar el Request?')" class="boton" /> 
									</form>
-->
								</td>
							</tr>
						|-/foreach-|						
					|-if $pager->getTotalPages() gt 1-|
						<tr> 
							<td colspan="9" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
						</tr>							
					|-/if-|				
						</tbody>
					</table>
				</div>
