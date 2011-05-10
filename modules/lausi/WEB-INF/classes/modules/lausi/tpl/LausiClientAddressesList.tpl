<h2>Administración de Clientes</h2>
<h1>Direcciones Importantes de Clientes</h1>
<p>A continuación se muestra el listado de direcciones importantes de clientes disponibles en el sistema. Para agregar una nueva dirección, haga click en "Agregar Dirección de Cliente". Para modificar o eliminar una dirección, utilice los controles disponibles en la fila correspondiente a la misma.</p>
<div id="div_clientaddresses">
	|-if $message eq "ok"-|
		<div class="successMessage">Dirección de Cliente guardada correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Dirección de Cliente eliminada correctamente</div>
	|-/if-|
	<table id="tabla-clientaddresses" width='100%' border="0" cellpadding='5' cellspacing='0' class='tableTdBorders'>
		<thead>
			<tr>
				 <th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiClientAddressesEdit" class="addLink">Agregar Dirección de Cliente</a></div></th>
			</tr>
			<tr>
				<th>Calle</th>
				<th>Número</th>
				<th>Intersección</th>
				<th>Circuito</th>
				<th>Cliente</th>
				<th>Barrio</th>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$clientaddresses item=clientaddress name=for_clientaddresses-|
			<tr>
				<td>|-$clientaddress->getstreet()-|</td>
				<td>|-$clientaddress->getnumber()-|</td>
				<td>|-$clientaddress->getintersection()-|</td>
				<td>
					|-assign var=circuit value=$clientaddress->getCircuit()-|
					|-if $circuit ne ''-||-$circuit->getName()-||-/if-|
				</td>
				<td>
					|-assign var=client value=$clientaddress->getClient()-|
					|-$client->getName()-|
				</td>		
				<td>
					|-assign var=region value=$clientaddress->getRegion()-|
					|-if $region ne ''-||-$region->getName()-||-/if-|
				</td>														
				<td>
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="lausiClientAddressesEdit" />
						<input type="hidden" name="id" value="|-$clientaddress->getid()-|" />
						<input type="submit" name="submit_go_edit_clientaddress" value="Editar" class="iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="lausiClientAddressesDoDelete" />
						<input type="hidden" name="id" value="|-$clientaddress->getid()-|" />
						<input type="submit" name="submit_go_delete_clientaddress" value="Borrar" onclick="return confirm('Seguro que desea eliminar el clientaddress?')" class="iconDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="7" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>													
		|-/if-|						
			<tr>
				 <th colspan="7" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=lausiClientAddressesEdit" class="addLink">Agregar Dirección de Cliente</a></div></th>
			</tr>
		</tbody>
	</table>
</div>