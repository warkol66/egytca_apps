<h2>##40,Configuración del Sistema##</h2>
<h1>Administración de Proveedores</h1>
<div id="div_suppliers">
	|-if $message eq "ok"-|
		<div class="successMessage">Supplier guardado correctamente</div>
	|-elseif $message eq "deleted_ok"-|
		<div class="successMessage">Supplier eliminado correctamente</div>
	|-elseif $message eq "activated_ok"-|
		<div class="successMessage">Supplier activado correctamente</div>
	|-/if-|
	<p>A continuación tiene el listado de los Proveedores disponibles en el sistema. Si desea agregar uno nuevo, haga click en "Agregar Proveedor", puede eliminar o agregar nuevos Proveedores. Si elimina un Proveedor, puede reactivarlo nuevamente.</p>
	<table id="tabla-suppliers" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
	<col width="10%">
	<col width="60%">
	<col width="20%">
	<col width="10%">
		<thead>
			<tr>
				<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=importSuppliersEdit" class="addLink">Agregar Proveedor</a></div></th>
			</tr>
			<tr>
				<th class="thFillTitle">Id</th>
				<th class="thFillTitle">Nombre</th>
				<th class="thFillTitle">E-mail</th>
				<th class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$suppliers item=supplier name=for_suppliers-|
			<tr>
			<td>|-$supplier->getid()-|</td>
			<td>|-$supplier->getname()-|</td>
			<td>|-$supplier->getEmail()-|</td>
			<td nowrap="nowrap">
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="importSuppliersEdit" />
						<input type="hidden" name="id" value="|-$supplier->getid()-|" />
						<input type="submit" name="submit_go_edit_supplier" value="Editar" class="buttonImageEdit" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="importSuppliersDoDelete" />
						<input type="hidden" name="id" value="|-$supplier->getid()-|" />
						<input type="submit" name="submit_go_delete_supplier" value="Borrar" onclick="return confirm('Seguro que desea eliminar el supplier?')" class="buttonImageDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
			<tr> 
				<td colspan="4" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>			
			|-/if-|				
			<tr>
				<th colspan="4" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=importSuppliersEdit" class="addLink">Agregar Proveedor</a></div></th>
			</tr>
		</tbody>
	</table>
</div>
<br />
|-if $inactiveSuppliers|@count gt 1-|
<h3>Inactivos</h3>
<div >
		<table id="tabla-suppliers" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
	<col width="10%">
	<col width="60%">
	<col width="20%">
	<col width="10%">
		<thead>
			<tr>
				<th class="thFillTitle">Id</th>
				<th class="thFillTitle">Nombre</th>
				<th class="thFillTitle">E-mail</th>
				<th class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$inactiveSuppliers item=supplier name=for_suppliers-|
			<tr>
				<td>|-$supplier->getid()-|</td>
				<td>|-$supplier->getname()-|</td>
				<td>|-$supplier->getEmail()-|</td>
				<td nowrap="nowrap">
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="importSuppliersDoActivate" />
						<input type="hidden" name="id" value="|-$supplier->getid()-|" />
						<input type="submit" name="submit_go_delete_supplier" value="Activar" class="buttonImageActivate" />
					</form>
				</td>
			</tr>
		|-/foreach-|
		
		</tbody>
	</table>

</div>
|-/if-|