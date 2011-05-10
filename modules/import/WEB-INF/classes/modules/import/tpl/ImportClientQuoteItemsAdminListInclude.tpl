<div id="clientQuoteItemLister">
	
<form action="Main.php" method="post" >
		|-if not $clientQuote->isQuoted() and not $clientQuote->isAccepted() and not $clientQuote->isPartiallyAccepted() and not $clientQuote->isRejected()-|
		<p>Para generar la solicitud de cotización al proveedor, seleccione un proveedor, al seleccionarlo, se marcaran
		 automáticamente los productos asociados al mismo. Para generar la solicitud de cotización y haga click en el botón de generar solicitud con el Incoterm y puerto seleccionado. </p>
			<select name="supplierId" onChange="javascript:importUpdateItemsBySupplier(this.value,|-$clientQuote->getId()-|)">
				<option value="">Seleccione un Proveedor</option>
			|-foreach from=$suppliers item=supplier name=for_suppliers-|
				<option value="|-$supplier->getId()-|">|-$supplier->getName()-|</option>
			|-/foreach-|
			</select>
			<select name="incotermId">
			|-foreach from=$incoterms item=incoterm name=for_incoterm-|
				<option id='incotermIdOption|-$incoterm->getId()-|' value="|-$incoterm->getId()-|">|-$incoterm->getName()-|</option>
			|-/foreach-|
			</select>
			<select name="portId">
			|-foreach from=$ports item=port name=for_ports-|
				<option id='portIdOption|-$port->getId()-|' value="|-$port->getId()-|">|-$port->getName()-|</option>
			|-/foreach-|
			</select>
			<span id="assignmentMsgBox"></span>
			<input type="hidden" name="clientQuoteId" value="|-$clientQuote->getId()-|" />
		|-/if-|	
		<h3>Selección de productos a cotizar</h3>
		<table id="clientQuoteItemList" cellpadding="4" cellspacing="0" class="tableTdBorders">
		<tr>
			<th></th>
			<th>Código</th>
			<th>Nombre</th>
			<th>Precio al Cliente</th>
			<th>Proveedor</th>			
			<th>Precio del Proveedor</th>
			|-*if "importClientQuoteItemSetPrice"|security_user_has_access *-|<th>Cotizar</th>|-*/if*-|
			|-if $quantitiesOnQuotesFlag or $clientQuote->isQuoted()-|
				<th>Cantidad</th>
			|-/if-|
			<th></th>	
		</tr>
		|-foreach from=$clientQuote->getClientQuoteItems() item=item name=for_clientQuotesItems-|
		|-assign var=product value=$item->getProduct()-|
		<tr>
			<th>
				|-if not $item->hasASupplierQuoteRelated()-|
					<input type="checkbox" href="../actions/ImportIncotermsDoActivateAction.php" title="ImportIncotermsDoActivateAction" name="clientQuoteItems[]" value="|-$item->getId()-|" id="checkboxItem|-$item->getId()-|" />
				|-elseif $clientQuote->isQuoted()-|
					<input type="checkbox" title="ImportIncotermsDoActivateAction" name="clientQuoteItems[]" value="|-$item->getId()-|" id="checkboxItem|-$item->getId()-|" />
				|-else-|
					<input type="checkbox" name="Quoted" value="" disabled="disabled" id="checkboxItem|-$item->getId()-|"/>
				|-/if-|</th>
			<td>|-$product->getCode()-|</td>
			<td>|-$product->getName()-|</td>
			<td>|-if $item->getPrice() eq 0-|No se ha cotizado|-else-||-$item->getPrice()|number_format:2:",":"."-||-/if-|</td>			
			|-assign var=supplierQuoteItem value=$item->getSupplierQuoteItem()-|
			<td>|-if $supplierQuoteItem neq ''-||-assign var=supplierQuote value=$supplierQuoteItem->getSupplierQuote() -||-assign var=supplier value=$supplierQuote->getSupplier()-||-$supplier->getName()-||-/if-|</td>
			<td>|-if $supplierQuoteItem neq ''-||-if $supplierQuoteItem->getPrice() eq 0-|No se ha cotizado|-else-||-$supplierQuoteItem->getPrice()|number_format:2:",":"."-||-/if-||-/if-|</td>
			|-*if "importClientQuoteItemSetPrice"|security_user_has_access *-|<td nowrap="nowrap">
				|-if $supplierQuoteItem neq ''-|
					|-if $supplierQuoteItem->getPrice() neq 0-|
						<a href="Main.php?do=importClientQuoteItemSetPrice&amp;clientQuoteItemId=|-$item->getId()-|">Fijar Precio Cliente</a>	
							|-/if-|
				|-/if-|
			</td>			
			|-*/if*-|
			|-if $quantitiesOnQuotesFlag -|
				<td>|-$item->getQuantity()-|
					|-if $clientQuote->isQuoted()-|
						<input type="hidden" name="clientQuoteItemsQuantity[|-$item->getId()-|]" value="|-$item->getQuantity()-|" id="clientQuoteItemsQuantity[|-$item->getId()-|]" />
					|-/if-|					
				</td>
			|-/if-|
			|-if not $quantitiesOnQuotesFlag and $clientQuote->isQuoted()-|
				<td><input type="text" size="5" name="clientQuoteItemsQuantity[|-$item->getId()-|]" value="" id="clientQuoteItemsQuantity[|-$item->getId()-|]" /></td>
			|-/if-|
			<td></td>
		</tr>
		|-/foreach-|
	</table>

		|-if not $clientQuote->isQuoted() and not $clientQuote->isAccepted() and not $clientQuote->isPartiallyAccepted() and not $clientQuote->isRejected()-|
		<p>	<br /><input type="hidden" name="do" value="importSupplierQuoteCreate" />
			<input type="submit" value="Generar Solicitud de Cotización a Proveedor con los productos seleccionados" />
		</p>
		|-/if-|
		
		|-if $clientQuote->isQuoted()-|
		<p>
			<input type="button" name="selectAll" value="Seleccionar Todos" onClick="javascript:importSelectAllByName('clientQuoteItems[]')" />
		</p>
		<p>
			<input type="hidden" name="clienQuoteId" value="|-$clientQuote->getId()-|" />
			<input type="hidden" name="do" value="importClientQuoteAccept" id="do" />
			<input type="submit" value="Aceptar Cotizacion de Elementos Seleccionados" />
		</p>
		|-/if-|
</form>

</div>