<script type="text/javascript">

		var elements = document.getElementsByName('clientQuoteItems[]');
		
		for (var i=0; i < elements.length; i++) {
			elements[i].checked = false;
		};
		
		//actualizacion de incoterm a valor default del proveedor
		
		var incotermOption = $('incotermIdOption|-$supplier->getDefaultIncotermId()-|');

		if (incotermOption != null) {
			incotermOption.selected = 'selected';
		}

		//actualizacion de port a valor default del proveedor

		var portOption = $('portIdOption|-$supplier->getDefaultPortId()-|');

		if (portOption != null) {
			portOption.selected = 'selected';
		}

		|-foreach from=$items item=item name=for_clientQuotesItems-|
			|-if not $item->hasASupplierQuoteRelated()-|
			if ($('checkboxItem|-$item->getId()-|'))
				$('checkboxItem|-$item->getId()-|').checked = true;
			|-/if-|
		|-/foreach-|
</script>