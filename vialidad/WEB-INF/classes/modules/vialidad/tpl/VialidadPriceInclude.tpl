|-* params:
  * priceBulletin: bulletin
  * priceNumber: numero de precio del boletin
  * attachInplaceEditors: si se deben correr los scripts para aplicar los inplaceEditors
*-|

|-assign var='i' value=$priceNumber-|

|-assign var='getAffiliateRelatedBySupplierid' value='getAffiliateRelatedBySupplierid'|cat:$i-|
|-assign var='getLastprice' value='getLastprice'|cat:$i-|
|-assign var='getPrice' value='getPrice'|cat:$i-|
|-assign var='getDefinitive' value='getDefinitive'|cat:$i-|
|-assign var='getDocumentRelatedBySupplierdocument' value='getDocumentRelatedBySupplierdocument'|cat:$i-|
|-assign var='getSupplierDocument' value='getSupplierDocument'|cat:$i-|
<tr id="priceBulletinPrice|-$i-|">
	<td align="center">|-$i-|</td>
	<td>
		|-assign var='supplier' value=$priceBulletin->$getAffiliateRelatedBySupplierid()-|
		<span id="supplier|-$i-|_name">|-if $supplier neq ''-||-$supplier->getName()-||-else-|&nbsp;-&nbsp;|-/if-|</span>
		<div id="autocomplete_choices|-$i-|" class="autocomplete" style="position: relative;z-index:12000;display: none;" ></div>
	</td>
	<td align="right">|-$priceBulletin->$getLastprice()|system_numeric_format-|</td>
	<td align="right"><span id="price|-$i-|" |-if "vialidadSupplyPriceEdit"|security_has_access-|class="in_place_editable"|-/if-|>|-$priceBulletin->$getPrice()|system_numeric_format-|</span></td>
	<td align="center"><input id="definitive|-$i-|" onchange="setParam('definitive|-$i-|', this.checked);updateDefinitive();" type="checkbox" value="1" |-$priceBulletin->$getDefinitive()|checked_bool-| /></td>
	<td align="center" nowrap="nowrap">
		|-assign var='document' value=$priceBulletin->$getDocumentRelatedBySupplierdocument()-|
		|-if $document eq ''-|<a href="#lightbox|-$i-|" rel="lightbox|-$i-|" class="lbOn"><img src="images/clear.png" class="icon iconAttach" /></a>|-/if-|
		|-if $document neq ''-|
		|-if !empty($document) && ($document->getDescription() neq '' || $document->getTitle() ne '')-|
		<a class="tooltip" href="#"><span>|-$document->getDescription()-|</span><img src="images/clear.png" class="icon iconInfo"></a>|-/if-|
		<input onclick="window.open('Main.php?do=documentsDoDownload&view=1&id=|-$priceBulletin->$getSupplierDocument()-|')" type="button" class="icon iconView" />
		<form action="Main.php?do=vialidadSupplyPriceDoDeleteDocument" method="post">
			<input type="hidden" name="id" value="|-$priceBulletin->getId()-|" />
			<input type="hidden" name="supplierNumber" value="|-$i-|" />
			<input type="submit"  onclick="return confirm('Seguro que desea eliminar el respaldo definitivamente?')" class="icon iconDelete" />
		</form>|-/if-|
	</td>
	<td align="center" nowrap="nowrap"><input type="button" |-if !$bulletin->getPublished()-|class="icon iconDelete" onclick="if (confirm('¿Está seguro que desea eliminar el precio?')) { deletePrice(|-$i-|) };" title="Elimnar información de precio y proveedor"|-else-|class="icon iconDelete disabled"|-/if-|>
	</td>
</tr>

|-if $attachInplaceEditors|default:false && !$bulletin->getPublished()-|
	<script>
		attachInPlaceEditor('price|-$i-|');
		attachSupplierEditor(|-$i-|);
		updateDefinitive();
	</script>
|-/if-|
