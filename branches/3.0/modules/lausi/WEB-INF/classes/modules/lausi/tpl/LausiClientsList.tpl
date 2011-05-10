<h2>Administración de Clientes</h2>
<h1>Clientes del Sistema</h1>
<p>A continuación se muestra el listado de clientes disponibles en el sistema. Para agregar un nuevo cliente, haga click en "Agregar cliente". Para modificar o eliminar un cliente, utilice los controles disponibles en la fila correspondiente al mismo.</p>
<div id="div_clients">
	|-if $message eq "ok"-|
		<div class="successMessage">Cliente guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Cliente eliminado correctamente</div>
	|-/if-|
	<table id="tabla-clients" border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
		<thead>
			<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiClientsEdit" class="addLink">Agregar cliente</a></div></th>
			</tr>
			<tr>
				<th>Nombre</th>
				<th>Contacto</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$clients item=client name=for_clients-|
			<tr>
				<td>|-$client->getname()-|</td>
				<td>|-$client->getcontact()-|</td>
				<td nowrap>
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="lausiClientsEdit" />
						<input type="hidden" name="id" value="|-$client->getid()-|" />
						<input type="submit" name="submit_go_edit_client" value="Editar" class="iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="lausiClientsDoDelete" />
						<input type="hidden" name="id" value="|-$client->getid()-|" />
						<input type="submit" name="submit_go_delete_client" value="Borrar" onclick="return confirm('Seguro que desea eliminar el client?')" class="iconDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="3" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>							
		|-/if-|						
			<tr>
				 <th colspan="3" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiClientsEdit" class="addLink">Agregar cliente</a></div></th>
			</tr>
		</tbody>
	</table>
</div>