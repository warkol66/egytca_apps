<h2>Importar Ordenes</h2>
<h1>Importar pedidos de mayoristas</h1>
<p>A contunuación podrá importar pedidos de mayoristas a partir de archivos de pedidos. Para importar pedidos, seleccione el mayorista e ingrese el archivo de pedidos correspondiente. <br />
El sistema utilizará los formatos cargados para convertir los pedidos del mayorista. </p>
<p>Luego de importalos, los podrá ver en el Listado de Pedidos <a href="Main.php?do=ordersList" title="Ir a listado de pedidos"><img src="images/clear.png" class="icon iconGoTo" /></a></p>
|-if $results ne ""-|
<fieldset>
	<legend>Resultado de la importación</legend>
	<ul>
		<li><strong>Ordenes Creadas:</strong> |-$results.ordersCreated-|</li>
		<li><strong>Ordenes No Creadas: </strong>|-$results.ordersNotCreated-|</li>
		<li><strong>Ordenes Duplicadas: </strong>|-$results.duplicatedOrdersCount-|</li>
		<li><strong>Productos Encontrados: </strong>|-$results.productsFound-|</li>
		<li><strong>Productos No Encontrados:</strong> |-$results.productsNotFound-|</li>
		<li><strong>Productos con Discrepancias en el Precio: </strong>|-$results.productsWrongPriceCount-|</li>
	</ul>
</fieldset>	
	|-if $results.productsCodesNotFounds ne ""-|
	<a name="productsCodesNotFound"></a><p><a href="#productsCodesNotFound" onclick="$('productsNotFound').toggle();" class="detail">Mostrar Códigos de Productos No Encontrados</a></p>
	<div id="productsNotFound" style="display:none;">
	<fieldset>
		<legend>Códigos de Productos no Encontrados</legend>
			<ul>
				|-foreach from=$results.productsCodesNotFoundsUnique item=code-|
				<li>|-$code-|</li>
				|-/foreach-|
			</ul>
	</fieldset>
	</div>
	|-/if-|
	<br />
	|-if $results.duplicatedOrders ne ""-|
	<a name="duplicatedOrders"></a><p><a href="#duplicatedOrders" onclick="$('duplicatedOrders').toggle();" class="detail">Mostrar Números de Ordenes Duplicadas</a></p>
	<div id="duplicatedOrders" style="display:none;">
	<fieldset>
		<legend>Códigos de Productos no Encontrados</legend>
			<ul>
				|-foreach from=$results.duplicatedOrders item=order-|
				<li>|-$order-|</li>
				|-/foreach-|
			</ul>
		</fieldset>
	</div>
	|-/if-|
	<br />					
	|-if $results.ordersReport ne ""-|
	<a name="OrdersWithNotFound"></a><p><a href="#ordersWithNotFound" onclick="$('ordersReport').toggle();" class="detail">Mostrar Detalle de las Ordenes con Productos no Encontrados</a></p>
	<div id="ordersReport" style="display:none;">
	<fieldset>
		<legend>Detalle de las Ordenes con Productos no Encontrados</legend>
		<ul>
			|-foreach from=$results.ordersReport item=order key=orderId-|
			<li>Id Orden: |-$orderId-|
				<table>
					<caption>Productos</caption>
					<tr>
						<th>Code</th>
						<th>Cantidad</th>
					</tr>
				|-foreach from=$order item=product-|
					<tr>
						<td>|-$product.code-|</td>
						<td>|-$product.quantity-|</td>
					</tr>
				|-/foreach-|
				</table>
			</li>
			|-/foreach-|
		</ul>
		</fieldset>
	</div>
	|-/if-|	
	<br />					
	|-if $results.productsWrongPrice ne ""-|
	<a name="productsWrongPrice"></a><p><a href="#productsWrongPrice" onclick="$('productsWrongPrice').toggle();" class="detail">Mostrar Detalle de las Ordenes con Productos con Discrepancias en el Precio</a></p>
	<div id="productsWrongPrice" style="display:none;">
	<fieldset>
		<legend>Detalle de las Ordenes con Productos con Discrepancias en el Precio</legend>
		<ul>
			|-foreach from=$results.productsWrongPrice item=order key=orderId-|
			<li>Id Orden: |-$orderId-|
				<table>
					<caption>Productos</caption>
					<tr>
						<th>Code</th>
						<th>Cantidad</th>
						<th>Precio</th>
					</tr>
				|-foreach from=$order item=product-|
					<tr>
						<td>|-$product.code-|</td>
						<td>|-$product.quantity-|</td>
						<td>|-$product.price-|</td>
					</tr>
				|-/foreach-|
				</table>
			</li>
			|-/foreach-|
		</ul>
		</fieldset>
	</div>
	|-/if-|						
|-/if-|
	
<div>
	<fieldset>
	<legend>Importar pedidos desde archivo</legend>
	<form action="Main.php" method="post" enctype="multipart/form-data">
		|-if $affiliates|@count gt 0-|
		<p>
			<label for="affiliateId">Mayorista:</label>
			<select name="affiliateId">
				<option value="" selected="selected">Seleccionar</option>
				|-foreach from=$affiliates item=affiliate-|
				<option value="|-$affiliate->getId()-|">|-$affiliate->getName()-|</option>
				|-/foreach-|
			</select>
		</p>						
		|-/if-|
		<p>
			<label for="csv">Archivo CSV de ordenes:</label>
			<input type="file" name="csv" id="csv" />
		</p>
		<p>
			<input type="hidden" name="do" id="do" value="ordersDoImport" />
			<input type="submit" value="Importar pedidos" />
		</p>
	</form></fieldset>
</div>
