<h2>##40,Configuración del Sistema##</h2>
<h1>Reemplazo de Producto</h1>
<div id="div_product">
	<form name="form_reassign_product" id="form_reassign_product" action="Main.php" method="post">
		<p>
			A traves de la interfaz usted podra seleccionar que producto quiere que sea reemplazado. Una vez efectuada la accion el producto anterior sera desactivado y el producto dado de alta por el proveedor pasara a activo. El codigo de producto de anmaga que tenia el producto a reemplazar, pasara producto dado de alta por el proveedor.
		</p>
		<fieldset>
		<legend>Informacion del producto dado de alta por el proveedor</legend>
		<p><label>Nombre:</label> |-$product->getName()-|</p>
		<p><label>Codigo de producto del Proveedor:</label> |-$product->getSupplierProductCode()-|</p>
		<p><label>Descripcion:</label> |-$product->getDescription()-|</p>			
		</fieldset>
		<fieldset title="Formulario de edición de datos de un producto">
		<legend>Productos que han sido reemplazados por el producto |-$product->getName()-| en ordenes de pedido a proveedor</legend>
			<p>
				<table id="table-products-replaced" class='tableTdBorders' cellpadding='5' cellspacing='1' width='100%'>
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
						|-foreach from=$replacedProducts item=productReplaced name=for_products-|
							<tr>
								<td>|-$productReplaced->getcode()-|</td>
								<td>|-$productReplaced->getname()-|</td>
								<td>|-$productReplaced->getdescription()-|</td>
								<td>|-assign var=supplier value=$supplierPeer->get($product->getsupplierId())-||-if $supplier neq ''-||- $supplier->getName() -||-/if-|</td>
								<td>
									<form action="Main.php" method="post">
										<input type="hidden" name="do" value="importProductsDoReassign" />
										<input type="hidden" name="productIdToBeReassiged" value="|-$productReplaced->getid()-|" />
										<input type="hidden" name="productId" value="|-$product->getid()-|" />
										<input type="submit" name="submit_go_delete_product" value="Reemplazar por |-$product->getName()-|" />
									</form>
								</td>
							</tr>
						|-/foreach-|						

						</tbody>
					</table>
				
			</p>
		</fieldset>
	</form>
</div>
