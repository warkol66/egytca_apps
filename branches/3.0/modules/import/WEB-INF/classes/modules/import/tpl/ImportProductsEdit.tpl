<h2>##40,Configuración del Sistema##</h2>
<h1>|-if $action eq 'edit'-|Editar|-else-|Crear|-/if-| Producto</h1>
<div id="div_product">
	<form name="form_edit_product" id="form_edit_product" action="Main.php" method="post">
		|-if $message eq "error"-|
			<div class="failureMessage">Ha ocurrido un error al intentar guardar el producto</div>
		|-/if-|
		<p>|-if $action eq 'edit'-|Modifique los datos del Producto y haga click en "Aceptar" para guardar el cambio|-else-|Ingrese los datos del Producto y haga click en "Aceptar" para guardar el Producto|-/if-|.
		</p>
		<fieldset title="Formulario de edición de datos de un producto">
		<legend>Productos</legend>
			<p>
				<label for="code">Código</label>
				<input type="text" id="code" name="product[code]" value="|-if $action eq 'edit'-||-$product->getcode()-||-/if-|" title="code" maxlength="255" />
			</p>
			<p>
				<label for="name">Nombre</label>
				<input name="product[name]" type="text" id="name" title="name" value="|-if $action eq 'edit'-||-$product->getname()-||-/if-|" size="65" maxlength="255" />
			</p>
		<p>
				<label for="description">Descripción</label>
				<textarea name="product[description]" cols="70" rows="7" wrap="virtual" id="description" title="description">|-if $action eq 'edit'-||-$product->getdescription()-||-/if-|</textarea>
			</p>
			<p>
				<label for="name">Nombre en Español</label>
				<input name="product[nameSpanish]" type="text" id="nameSpanish" title="name" value="|-if $action eq 'edit'-||-$product->getnamespanish()-||-/if-|" size="65" maxlength="255" />
			</p>
			<p>
				<label for="description">Descripción en Español</label>
				<textarea name="product[descriptionSpanish]" cols="70" rows="7" wrap="virtual" id="descriptionSpanish" title="description in Spanish">|-if $action eq 'edit'-||-$product->getdescriptionspanish()-||-/if-|</textarea>
			</p>															
			<p>
				<label for="name">Nombre en Chino</label>
				<input name="product[nameChinese]" type="text" id="nameChinese" title="name" value="|-if $action eq 'edit'-||-$product->getnamechinese()-||-/if-|" size="65" maxlength="255" />
			</p>
			<p>
				<label for="descriptionChinese">Descripción en Chino</label>
				<textarea name="product[descriptionChinese]" cols="70" rows="7" wrap="virtual" id="descriptionChinese" title="description in Chinese">|-if $action eq 'edit'-||-$product->getdescriptionchinese()-||-/if-|</textarea>
			</p>															
			<p>
				<label for="supplierId">Proveedor</label>
				<select name="productSupplier[supplierId]" id="supplierId">
					|- foreach from=$suppliers item=supplier-|	
					<option value="|-$supplier->getId()-|" |-if ($product->getSupplierId() == $supplier->getId())-|selected="selected"|-/if-|>|-$supplier->getName()-|</option>
					|-/foreach-|
				</select>			
			</p>
			<p>
				<label for="code">Código  para el Proveedor</label>
				<input type="text" id="productSupplier[code]" name="productSupplier[code]" value="|-if $action eq 'edit'-||-$product->getSupplierProductCode()-||-/if-|" title="code" maxlength="255" />
			</p>
			<p>
				|-if $action eq 'edit'-|
				<input type="hidden" name="product[id]" id="product[id]" value="|-if $action eq 'edit'-||-$product->getid()-||-/if-|" />
				|-/if-|
				<input type="hidden" name="action" id="action" value="|-$action-|" />
				<input type="hidden" name="do" id="do" value="importProductsDoEdit" />
				<input type="submit" id="button_edit_product" name="button_edit_product" title="Aceptar" value="Aceptar" />
			</p>
		</fieldset>
	</form>
</div>
