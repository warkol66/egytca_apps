<h2>##40,Configuración del Sistema##</h2>
<h1>Administración de Productos</h1>
<div id="div_products">
	|-if $message eq "ok"-|
		<span class="successMessage">Product guardado correctamente</span>
	|-elseif $message eq "deleted_ok"-|
		<span class="successMessage">Product eliminado correctamente</span>
	|-elseif $message eq "activated_ok"-|
		<span class="successMessage">Product activado correctamente</span>
	|-elseif $message eq "reassigned_ok"-|
		<span class="successMessage">Product reasignado correctamente</span>
	|-/if-|
	
	<p>A continuación tiene el listado de los Productos disponibles en el sistema. Si desea agregar uno nuevo, haga click en "Agregar Productos", puede eliminar o agregar nuevos Productos. Si elimina un Producto, puede reactivarlo nuevamente.</p>
	<table id="tabla-products" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
	<col width="5%">
	<col width="20%">
	<col width="60%">
	<col width="15%">
	<col width="5%">
		<thead>
			<tr>
				<th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=importProductsEdit" class="addLink">Agregar Producto</a></div></th>
			</tr>
			<tr>
				<th class="thFillTitle">Código</th>
				<th class="thFillTitle">Nombre</th>
				<th class="thFillTitle">Descripción</th>
				<th class="thFillTitle">Proveedor</th>
				<th class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$products item=product name=for_products-|
			<tr>
				<td>|-$product->getcode()-|</td>
				<td>|-$product->getname()-|</td>
				<td>|-$product->getdescription()-|</td>
				<td>|-assign var=supplier value=$supplierPeer->get($product->getsupplierId())-||-if $supplier neq ''-||- $supplier->getName() -||-/if-|</td>
				<td nowrap="nowrap">
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="importProductsEdit" />
						<input type="hidden" name="id" value="|-$product->getid()-|" />
						<input type="submit" name="submit_go_edit_product" value="Editar" class="iconEdit" />
					</form>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="importProductsDoDelete" />
						<input type="hidden" name="id" value="|-$product->getid()-|" />
						<input type="submit" name="submit_go_delete_product" value="Borrar" onclick="return confirm('Seguro que desea eliminar el product?')" class="iconDelete" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		|-if $pager->getTotalPages() gt 1-|
		<tr> 
				<td colspan="5" class="pages">|-include file="PaginateInclude.tpl"-|</td> 
			</tr>			
			|-/if-|				
			<tr>
				<th colspan="5" class="thFillTitle"><div class="rightLink"><a href="Main.php?do=importProductsEdit" class="addLink">Agregar Producto</a></div></th>
			</tr>
		</tbody>
	</table>
</div>

|-if $supplierAddedProducts|@count gt 0-|

<br />
<div >

<h1>Administracion de Productos dados de Alta por Proveedor</h1>

<p>A continuación tiene el listado de los Productos disponibles en el sistema que han sido dado de alta por los proveedores. Si desea activarlo como un producto normal, puede asignarle un codigo de producto de anmaga. Si desea que este producto reemplace a otro producto, siga la opcion del menu correspondiente.</p>	
<table id="tabla-products-supplier" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
	<col width="5%">
	<col width="20%">
	<col width="60%">
	<col width="15%">
	<col width="5%">
		<thead>
			<tr>
				<th class="thFillTitle">Código</th>
				<th class="thFillTitle">Nombre</th>
				<th class="thFillTitle">Descripción</th>
				<th class="thFillTitle">Proveedor</th>
				<th class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$supplierAddedProducts item=product name=for_products-|
			<tr>
				<td>|-if $product->getcode() neq ''-||-$product->getcode()-||-else-|<div id="productCodeEditor|-$product->getId()-|"> Asignar un Codigo</div>
				<script type="text/javascript">
				 new Ajax.InPlaceEditor('productCodeEditor|-$product->getId()-|', 'Main.php?do=importProductsDoAssignCode',{ 
					callback: function(form, value) { return 'id=|-$product->getId()-|&value='+escape(value) }
				});
				</script>
				|-/if-|</td>
				<td>|-$product->getname()-|</td>
				<td>|-$product->getdescription()-|</td>
				<td>|-assign var=supplier value=$supplierPeer->get($product->getsupplierId())-||-if $supplier neq ''-||- $supplier->getName() -||-/if-|</td>
				<td>
					<form action="Main.php" method="get">
						<input type="hidden" name="do" value="importProductsReassign" />
						<input type="hidden" name="id" value="|-$product->getid()-|" />
						<input type="submit" name="submit_go_delete_product" value="Asignar como reemplazo de Producto" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		
		</tbody>
	</table>

</div>
|-/if-|

|-if $inactiveProducts|@count gt 0-|
<br />
<h1>Productos Inactivos</h1>
<div >
<table id="tabla-inactive-products" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
	<col width="5%">
	<col width="20%">
	<col width="60%">
	<col width="15%">
	<col width="5%">
		<thead>
			<tr>
				<th class="thFillTitle">Código</th>
				<th class="thFillTitle">Nombre</th>
				<th class="thFillTitle">Descripción</th>
				<th class="thFillTitle">Proveedor</th>
				<th class="thFillTitle">&nbsp;</th>
			</tr>
		</thead>
		<tbody>
		|-foreach from=$inactiveProducts item=product name=for_products-|
			<tr>
				<td>|-$product->getcode()-|</td>
				<td>|-$product->getname()-|</td>
				<td>|-$product->getdescription()-|</td>
				<td>|-assign var=supplier value=$supplierPeer->get($product->getsupplierId())-||-if $supplier neq ''-||- $supplier->getName() -||-/if-|</td>
				<td>
					<form action="Main.php" method="post">
						<input type="hidden" name="do" value="importProductsDoActivate" />
						<input type="hidden" name="id" value="|-$product->getid()-|" />
						<input type="submit" name="submit_go_delete_product" value="Activar" class="iconActivate" />
					</form>
				</td>
			</tr>
		|-/foreach-|						
		
		</tbody>
	</table>

</div>
|-/if-|
