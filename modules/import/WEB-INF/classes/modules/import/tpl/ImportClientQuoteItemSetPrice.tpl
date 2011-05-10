<h2>Solicitud de Cotización</h2>
<h1>Fijar Precio a Cliente</h1>
|-assign var=supplierQuoteItem value=$clientQuoteItem->getSupplierQuoteItem()-|
<fieldset>
<legend>Determinación de precio al cliente</legend>
<div id="div_clientQuoteItemLastQuotes">
	|-include file='ImportClientQuoteRelatedQuotesInclude.tpl' lastClientQuoteItemsRelated=$lastClientQuoteItemsRelated-|
</div>
<div id="div_supplierQuoteReport">
	|-include file='ImportSupplierQuoteItemReportInclude.tpl' supplierQuoteItem=$supplierQuoteItem-|
</div>
<div id="div_clientQuotePrice">
	<h3>Precio</h3>
	<form action="Main.php" method="post">
		<p><label for="precio_cotizado_proveedor">Precio Cotizado por Proveedor</label> 			
			<input name="supplierQuoteItemPrice" type="text" class="readOnly"  size="6" value="|-$supplierQuoteItem->getPrice()|number_format:2:",":"."-|" readonly="readonly" />
		</p>
		<p>
			<label for="precio">Precio a Cliente</label>
			<input name="clientQuoteItem[price]" type="text" value="|-$clientQuoteItem->getPrice()-|" size="8" />
			<input type="hidden" name="clientQuoteItem[id]" value="|-$clientQuoteItem->getId()-|" />
		</p>
		<p>
			<input type="hidden" name="do" value="importClientQuoteItemDoSetPrice" />
			<input type="submit" value="Fijar Precio">
		</p>
	</form>
</div>
</fieldset>
